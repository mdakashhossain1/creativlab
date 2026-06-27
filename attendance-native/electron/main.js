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
let mainWindow = null;
let tray       = null;

// Per-device tracking for the ARP-based monitor.
// Key: normalised MAC address (XX:XX:XX:XX:XX:XX uppercase)
// Value: { checkedIn: boolean, graceTimer: NodeJS.Timeout | null }
const trackedDevices = new Map();

const GRACE_MS = 300_000; // 5 minutes before checkout after device leaves

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

// ── HTTP POST helper (returns a Promise) ──────────────────────────
function apiPost(urlStr, data) {
  return new Promise((resolve, reject) => {
    try {
      const parsed = new URL(urlStr);
      const lib    = parsed.protocol === 'https:' ? https : http;
      const body   = JSON.stringify(data);
      const req    = lib.request(parsed, {
        method: 'POST',
        headers: {
          'Content-Type':   'application/json',
          'Accept':         'application/json',
          'Content-Length': Buffer.byteLength(body),
        },
      }, (res) => {
        let raw = '';
        res.on('data', d => raw += d);
        res.on('end', () => {
          try { resolve(JSON.parse(raw)); } catch { resolve({}); }
        });
      });
      req.on('error', reject);
      req.write(body);
      req.end();
    } catch (e) {
      reject(e);
    }
  });
}

// ── Window ─────────────────────────────────────────────────────────
function createWindow() {
  const winIcon = (() => {
    const ico = path.join(__dirname, 'icons', 'icon.ico');
    const png = path.join(__dirname, 'icons', 'icon.png');
    if (fs.existsSync(ico)) return ico;
    if (fs.existsSync(png)) return png;
    return undefined;
  })();

  mainWindow = new BrowserWindow({
    width:     430,
    height:    780,
    minWidth:  380,
    minHeight: 600,
    title:     'CreativLab Attendance',
    icon:      winIcon,
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
      label: 'Open Attendance',
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
  const iconPath = path.join(__dirname, 'icons', 'icon.png');
  const icoPath  = path.join(__dirname, 'icons', 'icon.ico');

  let icon;
  if (fs.existsSync(iconPath)) {
    icon = nativeImage.createFromPath(iconPath);
  } else if (fs.existsSync(icoPath)) {
    icon = nativeImage.createFromPath(icoPath);
  } else {
    icon = nativeImage.createFromDataURL(
      'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAYAAAAfFcSJAAAADUlEQVQIW2P4z8BQDwADhQGAWjR9awAAAABJRU5ErkJggg=='
    );
  }

  tray = new Tray(icon);
  tray.setToolTip('CreativLab Attendance — monitoring');
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
  const present = [...trackedDevices.values()].filter(s => s.checkedIn).length;
  const total   = trackedDevices.size;
  const netInfo = ssid
    ? `Wi-Fi: ${ssid}${isOffice ? ' ✓ Office' : ''}`
    : 'Wi-Fi: Not connected';
  tray.setToolTip(`CreativLab Attendance\n${netInfo}\nPresent: ${present}/${total}`);
}

// ── Network helpers ────────────────────────────────────────────────
function normaliseMac(mac) {
  return mac.replace(/-/g, ':').toUpperCase();
}

function scanNetworkDevices() {
  return new Promise((resolve) => {
    exec('arp -a', { encoding: 'utf8', timeout: 8000 }, (err, stdout) => {
      if (err) return resolve([]);
      const devices = [];
      for (const line of stdout.split('\n')) {
        const m = line.match(/(\d{1,3}(?:\.\d{1,3}){3})\s+([0-9a-f-]{17})\s+(dynamic|static)/i);
        if (m) devices.push({ ip: m[1], mac: normaliseMac(m[2]), type: m[3] });
      }
      resolve(devices);
    });
  });
}

function scanNetworkFull() {
  return new Promise((resolve) => {
    exec('arp -a', { encoding: 'utf8', timeout: 8000 }, (err, stdout) => {
      if (err) return resolve([]);
      const devices = [];
      for (const line of stdout.split('\n')) {
        const m = line.match(/(\d{1,3}(?:\.\d{1,3}){3})\s+([0-9a-f-]{17})\s+(dynamic|static)/i);
        if (m) devices.push({ ip: m[1], mac: normaliseMac(m[2]), type: m[3], hostname: null });
      }
      if (!devices.length) return resolve(devices);
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

// ── Check-out a tracked device after grace period ──────────────────
function triggerCheckOut(mac, assignment) {
  const state = trackedDevices.get(mac);
  if (state) { state.graceTimer = null; state.checkedIn = false; }

  const cfg     = readConfig();
  const apiBase = (cfg.apiBase || 'https://creativlab.in/api').replace(/\/$/, '');
  console.log(`[monitor] ${assignment.teamName} — grace elapsed, checking out`);

  apiPost(`${apiBase}/attendance/checkout`, { device_fingerprint: assignment.fingerprint })
    .then(() => {
      if (mainWindow && !mainWindow.isDestroyed()) {
        mainWindow.webContents.send('member-left', { mac, name: assignment.teamName });
      }
    })
    .catch(e => console.error('[monitor] checkout error:', e.message));
}

// ── ARP-based network monitor ──────────────────────────────────────
// Runs every 30 s in the background (even when the window is closed).
// For each device linked in config.deviceAssignments:
//   • Appears on the office network  → check-in via API
//   • Off the network for 5 minutes  → check-out via API
// Linking is a one-time operation; assignments persist in config.json.
async function networkMonitorLoop() {
  const config      = readConfig();
  const assignments = config.deviceAssignments || {};
  const macs        = Object.keys(assignments);
  if (!macs.length) return; // nothing linked yet — skip

  const apiBase = (config.apiBase || 'https://creativlab.in/api').replace(/\/$/, '');

  // ── Wi-Fi gate: only run attendance logic while on office network ──
  let ssid      = null;
  let isOffice  = true; // assume in office if no SSID restriction configured
  if (config.officeSSID) {
    ssid     = await getWifiSSID();
    isOffice = ssid === config.officeSSID;
    updateTray(ssid, isOffice);
    if (mainWindow && !mainWindow.isDestroyed()) {
      mainWindow.webContents.send('wifi-change', ssid, isOffice);
    }
  }

  if (!isOffice) {
    // Admin PC left the office — start grace timers for all still-checked-in devices
    for (const [mac, state] of trackedDevices) {
      if (state.checkedIn && !state.graceTimer) {
        const assignment = assignments[mac];
        if (assignment) {
          console.log(`[monitor] Off office Wi-Fi — grace timer for ${assignment.teamName}`);
          state.graceTimer = setTimeout(() => triggerCheckOut(mac, assignment), GRACE_MS);
        }
      }
    }
    return;
  }

  // ── Scan ARP table for all devices on the local network ───────────
  const found    = await scanNetworkDevices();
  const seenMacs = new Set(found.map(d => d.mac));

  for (const rawMac of macs) {
    const mac        = normaliseMac(rawMac);
    const assignment = assignments[rawMac] || assignments[mac];
    if (!assignment) continue;

    // Initialise tracking state for this device on first encounter
    if (!trackedDevices.has(mac)) {
      trackedDevices.set(mac, { checkedIn: false, graceTimer: null });
    }
    const state = trackedDevices.get(mac);

    if (seenMacs.has(mac)) {
      // ── Device is on the network ──────────────────────────────────
      if (state.graceTimer) {
        // Back before grace elapsed — cancel checkout
        clearTimeout(state.graceTimer);
        state.graceTimer = null;
        console.log(`[monitor] ${assignment.teamName} — back on network, grace cancelled`);
      }
      if (!state.checkedIn) {
        state.checkedIn = true; // optimistic; API handles duplicates safely
        console.log(`[monitor] ${assignment.teamName} — arrived, checking in`);
        apiPost(`${apiBase}/attendance/checkin`, {
          device_fingerprint: assignment.fingerprint,
          source: 'wifi',
        })
          .then(() => {
            updateTray(ssid, isOffice);
            if (mainWindow && !mainWindow.isDestroyed()) {
              mainWindow.webContents.send('member-arrived', { mac, name: assignment.teamName });
            }
          })
          .catch(e => console.error('[monitor] checkin error:', e.message));
      }
    } else {
      // ── Device not on network ─────────────────────────────────────
      if (state.checkedIn && !state.graceTimer) {
        console.log(`[monitor] ${assignment.teamName} — left, grace timer started`);
        state.graceTimer = setTimeout(() => triggerCheckOut(mac, assignment), GRACE_MS);
      }
    }
  }

  updateTray(ssid, isOffice);
}

function startNetworkMonitor() {
  networkMonitorLoop();                  // run immediately on app start
  setInterval(networkMonitorLoop, 30_000); // then every 30 seconds
}

// ── Auto-launch setup ──────────────────────────────────────────────
async function setupAutoLaunch() {
  try {
    const AutoLaunch = require('auto-launch');
    const al = new AutoLaunch({ name: 'CreativLab Attendance', path: app.getPath('exe') });
    if (!(await al.isEnabled())) await al.enable();
  } catch { /* optional feature */ }
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

// Renderer can ask for an immediate monitor scan (e.g. after linking a new device)
ipcMain.handle('trigger-monitor-scan', () => {
  networkMonitorLoop();
  return true;
});

// ── App lifecycle ──────────────────────────────────────────────────
app.whenReady().then(() => {
  createWindow();
  createTray();
  startNetworkMonitor(); // background ARP monitor — runs forever in tray
  setupAutoLaunch();     // registers app to start on Windows login
});

// Stay alive in tray even when all windows are closed
app.on('window-all-closed', () => { /* intentional – tray app */ });
app.on('activate', () => {
  if (BrowserWindow.getAllWindows().length === 0) createWindow();
});
