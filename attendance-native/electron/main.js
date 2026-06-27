'use strict';

const { app, BrowserWindow, Tray, Menu, ipcMain, nativeImage } = require('electron');
const path  = require('path');
const fs    = require('fs');
const os    = require('os');
const { exec } = require('child_process');
const https = require('https');
const http  = require('http');

// ── Paths ──────────────────────────────────────────────────────────
const CONFIG_PATH = path.join(__dirname, '..', 'config.json');
const isDev       = !app.isPackaged;
const APP_HTML    = isDev
  ? path.join(__dirname, '..', 'attendance-app', 'index.html')
  : path.join(process.resourcesPath, 'attendance-app', 'index.html');

// ── Config ─────────────────────────────────────────────────────────
function readConfig() {
  try { return JSON.parse(fs.readFileSync(CONFIG_PATH, 'utf8')); }
  catch { return {}; }
}
function writeConfig(delta) {
  const current = readConfig();
  fs.writeFileSync(CONFIG_PATH, JSON.stringify({ ...current, ...delta }, null, 2));
}

// ── State ──────────────────────────────────────────────────────────
let mainWindow   = null;
let tray         = null;
let lastSSID     = undefined; // undefined = not yet polled
let officeLeftAt = -1;
let scheduledOut = false;
const GRACE_MS   = 300_000; // 5 minutes

// ── Wi-Fi detection (Windows) ──────────────────────────────────────
function getWifiSSID() {
  return new Promise((resolve) => {
    let cmd;
    if (process.platform === 'win32') {
      cmd = 'netsh wlan show interfaces';
    } else if (process.platform === 'darwin') {
      cmd = '/System/Library/PrivateFrameworks/Apple80211.framework/Versions/Current/Resources/airport -I';
    } else {
      cmd = 'iwgetid -r';
    }

    exec(cmd, { encoding: 'utf8', timeout: 5000 }, (err, stdout) => {
      if (err) return resolve(null);
      let ssid = null;
      if (process.platform === 'win32') {
        const m = stdout.match(/^\s+SSID\s+:\s+(.+)$/m);
        ssid = m ? m[1].trim() : null;
      } else if (process.platform === 'darwin') {
        const m = stdout.match(/\s+SSID:\s+(.+)/);
        ssid = m ? m[1].trim() : null;
      } else {
        ssid = stdout.trim() || null;
      }
      resolve(ssid);
    });
  });
}

// ── HTTP POST helper ───────────────────────────────────────────────
function apiPost(urlStr, data) {
  try {
    const parsed  = new URL(urlStr);
    const lib     = parsed.protocol === 'https:' ? https : http;
    const body    = JSON.stringify(data);
    const req     = lib.request(parsed, {
      method: 'POST',
      headers: {
        'Content-Type':   'application/json',
        'Accept':         'application/json',
        'Content-Length': Buffer.byteLength(body),
      },
    });
    req.on('error', (e) => console.error('[attendance] API error:', e.message));
    req.write(body);
    req.end();
  } catch (e) {
    console.error('[attendance] apiPost error:', e.message);
  }
}

// ── Window ─────────────────────────────────────────────────────────
function createWindow() {
  mainWindow = new BrowserWindow({
    width:     430,
    height:    780,
    minWidth:  380,
    minHeight: 600,
    title:     'CreativLab Attendance',
    show:      false,
    webPreferences: {
      preload:          path.join(__dirname, 'preload.js'),
      contextIsolation: true,
      nodeIntegration:  false,
      sandbox:          false,
      webSecurity:      false,
    },
  });

  mainWindow.loadFile(APP_HTML);
  mainWindow.once('ready-to-show', () => mainWindow.show());

  // Minimise to tray instead of closing
  mainWindow.on('close', (e) => {
    if (!app._quitting) {
      e.preventDefault();
      mainWindow.hide();
    }
  });
}

// ── Tray ───────────────────────────────────────────────────────────
function buildTrayMenu() {
  return Menu.buildFromTemplate([
    {
      label: 'Open Settings',
      click: () => { mainWindow.show(); mainWindow.focus(); },
    },
    { type: 'separator' },
    {
      label: 'Quit',
      click: () => { app._quitting = true; app.quit(); },
    },
  ]);
}

function createTray() {
  // Use a simple 16×16 PNG tray icon. Falls back to an empty icon if missing.
  const iconPath = path.join(__dirname, 'icons', 'icon.png');
  const icoPath  = path.join(__dirname, 'icons', 'icon.ico');

  let icon;
  if (fs.existsSync(iconPath)) {
    icon = nativeImage.createFromPath(iconPath);
  } else if (fs.existsSync(icoPath)) {
    icon = nativeImage.createFromPath(icoPath);
  } else {
    // Minimal fallback: 1×1 transparent PNG encoded as base64
    icon = nativeImage.createFromDataURL(
      'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAYAAAAfFcSJAAAADUlEQVQIW2P4z8BQDwADhQGAWjR9awAAAABJRU5ErkJggg=='
    );
  }

  tray = new Tray(icon);
  tray.setToolTip('CreativLab Attendance');
  tray.setContextMenu(buildTrayMenu());
  tray.on('click', () => {
    if (mainWindow.isVisible()) {
      mainWindow.hide();
    } else {
      mainWindow.show();
      mainWindow.focus();
    }
  });
}

function updateTray(ssid, isOffice) {
  if (!tray) return;
  const tip = ssid
    ? `CreativLab Attendance\nWi-Fi: ${ssid}${isOffice ? ' ✓ Office' : ''}`
    : 'CreativLab Attendance\nWi-Fi: Disconnected';
  tray.setToolTip(tip);
}

// ── Wi-Fi polling loop ─────────────────────────────────────────────
function startWifiPoll() {
  async function poll() {
    const config = readConfig();
    const ssid   = await getWifiSSID();

    if (ssid !== lastSSID) {
      const isOffice  = !!config.officeSSID && ssid === config.officeSSID;
      const wasOffice = !!config.officeSSID && lastSSID === config.officeSSID;

      updateTray(ssid, isOffice);

      // Notify renderer if open
      if (mainWindow && !mainWindow.isDestroyed()) {
        mainWindow.webContents.send('wifi-change', ssid, isOffice);
      }

      // Auto-attendance
      const fp      = config.deviceFingerprint;
      const apiBase = (config.apiBase || 'https://creativlab.in/api').replace(/\/$/, '');

      if (fp && config.officeSSID) {
        if (isOffice && !wasOffice) {
          officeLeftAt = -1;
          scheduledOut = false;
          console.log('[attendance] Arrived at office – checking in…');
          apiPost(`${apiBase}/attendance/checkin`, { device_fingerprint: fp, source: 'wifi' });
        } else if (!isOffice && wasOffice) {
          console.log('[attendance] Left office – grace timer started');
          officeLeftAt = Date.now();
        }
      }

      lastSSID = ssid;
    }

    // Grace-period checkout
    if (officeLeftAt > 0 && !scheduledOut) {
      if (Date.now() - officeLeftAt >= GRACE_MS) {
        scheduledOut = true;
        const cfg     = readConfig();
        const apiBase = (cfg.apiBase || 'https://creativlab.in/api').replace(/\/$/, '');
        if (cfg.deviceFingerprint) {
          console.log('[attendance] Grace period elapsed – checking out…');
          apiPost(`${apiBase}/attendance/checkout`, { device_fingerprint: cfg.deviceFingerprint });
        }
      }
    }
  }

  poll();                        // run immediately on start
  setInterval(poll, 30_000);    // then every 30 s
}

// ── Auto-launch setup ──────────────────────────────────────────────
async function setupAutoLaunch() {
  try {
    const AutoLaunch = require('auto-launch');
    const al = new AutoLaunch({ name: 'CreativLab Attendance', path: app.getPath('exe') });
    if (!(await al.isEnabled())) await al.enable();
  } catch { /* optional feature */ }
}

// ── Network device scan (ARP cache) ───────────────────────────────
function scanNetworkDevices() {
  return new Promise((resolve) => {
    exec('arp -a', { encoding: 'utf8', timeout: 8000 }, (err, stdout) => {
      if (err) return resolve([]);
      const devices = [];
      for (const line of stdout.split('\n')) {
        const m = line.match(/(\d{1,3}(?:\.\d{1,3}){3})\s+([0-9a-f-]{17})\s+(dynamic|static)/i);
        if (m) devices.push({ ip: m[1], mac: m[2].toUpperCase(), type: m[3] });
      }
      resolve(devices);
    });
  });
}

// ── ARP scan + nbtstat hostname resolution ─────────────────────────
function scanNetworkFull() {
  return new Promise((resolve) => {
    exec('arp -a', { encoding: 'utf8', timeout: 8000 }, (err, stdout) => {
      if (err) return resolve([]);
      const devices = [];
      for (const line of stdout.split('\n')) {
        const m = line.match(/(\d{1,3}(?:\.\d{1,3}){3})\s+([0-9a-f-]{17})\s+(dynamic|static)/i);
        if (m) devices.push({ ip: m[1], mac: m[2].toUpperCase(), type: m[3], hostname: null });
      }
      if (!devices.length) return resolve(devices);
      // Try to resolve hostnames via nbtstat -A (best-effort, parallel)
      let pending = devices.length;
      devices.forEach((d) => {
        exec(`nbtstat -A ${d.ip}`, { encoding: 'utf8', timeout: 3000 }, (e, out) => {
          if (!e && out) {
            const hm = out.match(/<00>\s+UNIQUE\s+Registered/i) &&
                       out.match(/^([A-Z0-9_-]{1,15})\s+<00>/im);
            if (hm) d.hostname = hm[1];
          }
          if (--pending === 0) resolve(devices);
        });
      });
    });
  });
}

// ── Own network interfaces (to identify which device is THIS PC) ───
function getNetworkInfo() {
  const ifaces = os.networkInterfaces();
  const result = [];
  for (const [name, addrs] of Object.entries(ifaces)) {
    for (const addr of addrs) {
      if (addr.internal) continue;
      result.push({ iface: name, ip: addr.address, mac: addr.mac, family: addr.family });
    }
  }
  return result;
}

// ── IPC handlers ───────────────────────────────────────────────────
ipcMain.handle('get-wifi-ssid',      ()      => getWifiSSID());
ipcMain.handle('get-config',         ()      => readConfig());
ipcMain.handle('save-config',        (_, d) => { writeConfig(d); return true; });
ipcMain.handle('get-version',        ()      => app.getVersion());
ipcMain.handle('scan-network',       ()      => scanNetworkDevices());
ipcMain.handle('scan-network-full',  ()      => scanNetworkFull());
ipcMain.handle('get-network-info',   ()      => getNetworkInfo());
ipcMain.handle('get-username',       ()      => os.userInfo().username);
ipcMain.handle('get-hostname',       ()      => os.hostname());

// ── App lifecycle ──────────────────────────────────────────────────
app.whenReady().then(() => {
  createWindow();
  createTray();
  startWifiPoll();
  setupAutoLaunch();
});

// Stay alive in tray
app.on('window-all-closed', () => { /* intentional – tray app */ });
app.on('activate', () => {
  if (BrowserWindow.getAllWindows().length === 0) createWindow();
});
