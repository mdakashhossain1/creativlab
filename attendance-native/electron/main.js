'use strict';

const { app, BrowserWindow, Tray, Menu, ipcMain, nativeImage } = require('electron');
const path  = require('path');
const fs    = require('fs');
const os    = require('os');
const { exec } = require('child_process');
const https = require('https');
const http  = require('http');
let autoUpdater = null;
try { autoUpdater = require('electron-updater').autoUpdater; } catch (_) {}

// ── Paths ──────────────────────────────────────────────────────────
const isDev    = !app.isPackaged;
const APP_HTML = isDev
  ? path.join(__dirname, '..', 'attendance-app', 'index.html')
  : path.join(process.resourcesPath, 'attendance-app', 'index.html');

// Config lives in the user's writable AppData dir — never in Program Files.
// app.getPath('userData') = C:\Users\<user>\AppData\Roaming\CreativLab Attendance
function getConfigPath() {
  return path.join(app.getPath('userData'), 'config.json');
}

// ── Config ─────────────────────────────────────────────────────────
function readConfig() {
  try { return JSON.parse(fs.readFileSync(getConfigPath(), 'utf8')); }
  catch { return {}; }
}
function writeConfig(delta) {
  const cfgPath = getConfigPath();
  fs.mkdirSync(path.dirname(cfgPath), { recursive: true });
  const current = readConfig();
  fs.writeFileSync(cfgPath, JSON.stringify({ ...current, ...delta }, null, 2));
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
    // Start hidden from taskbar — only tray icon is shown while minimised
    skipTaskbar: true,
    webPreferences: {
      preload:          path.join(__dirname, 'preload.js'),
      contextIsolation: true,
      nodeIntegration:  false,
      sandbox:          false,
      webSecurity:      false,
    },
  });

  mainWindow.loadFile(APP_HTML);
  mainWindow.once('ready-to-show', () => {
    mainWindow.show();
    mainWindow.setSkipTaskbar(false); // show in taskbar when window is open
  });

  // X button → hide to tray, NEVER quit
  mainWindow.on('close', (e) => {
    if (!app._quitting) {
      e.preventDefault();
      mainWindow.hide();
      mainWindow.setSkipTaskbar(true); // remove from taskbar while hidden
    }
  });
}

// ── Tray ───────────────────────────────────────────────────────────
function buildTrayMenu() {
  return Menu.buildFromTemplate([
    {
      label: 'Open Attendance',
      click: () => {
        mainWindow.setSkipTaskbar(false);
        mainWindow.show();
        mainWindow.focus();
      },
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
      mainWindow.setSkipTaskbar(true);
    } else {
      mainWindow.setSkipTaskbar(false);
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

// ── Ping sweep — populates ARP cache for ALL devices on the subnet ─
// Without this, arp -a only shows devices the PC has recently talked to.
function pingSubnet() {
  return new Promise((resolve) => {
    // Find the local IPv4 address to derive the subnet base (e.g. 192.168.1)
    const ifaces = os.networkInterfaces();
    const bases  = new Set();
    for (const addrs of Object.values(ifaces)) {
      for (const addr of addrs) {
        if (addr.family === 'IPv4' && !addr.internal) {
          const parts = addr.address.split('.');
          if (parts.length === 4) bases.add(`${parts[0]}.${parts[1]}.${parts[2]}`);
        }
      }
    }
    if (!bases.size) return resolve();

    // Fire a ping to every host in each detected subnet simultaneously.
    // -n 1  = one packet   -w 300 = 300 ms timeout (fast, just to populate ARP)
    const pings = [];
    for (const base of bases) {
      for (let i = 1; i <= 254; i++) {
        pings.push(new Promise(r => {
          exec(`ping -n 1 -w 300 ${base}.${i}`, { timeout: 500 }, () => r());
        }));
      }
    }
    Promise.all(pings).then(() => resolve());
  });
}

// Read ARP table after ensuring the cache is warm
function readArp() {
  return new Promise((resolve) => {
    exec('arp -a', { encoding: 'utf8', timeout: 8000 }, (err, stdout) => {
      if (err) return resolve([]);
      const devices = [];
      for (const line of stdout.split('\n')) {
        const m = line.match(/(\d{1,3}(?:\.\d{1,3}){3})\s+([0-9a-f-]{17})\s+(dynamic|static)/i);
        if (m) devices.push({ ip: m[1], mac: normaliseMac(m[2]) });
      }
      resolve(devices);
    });
  });
}

async function scanNetworkDevices() {
  await pingSubnet();
  return readArp();
}

async function scanNetworkFull() {
  await pingSubnet();
  const devices = (await readArp()).map(d => ({ ...d, type: 'dynamic', hostname: null }));
  if (!devices.length) return devices;

  // Best-effort hostname resolution via nbtstat (parallel, non-blocking)
  await Promise.all(devices.map(d => new Promise(resolve => {
    exec(`nbtstat -A ${d.ip}`, { encoding: 'utf8', timeout: 3000 }, (e, out) => {
      if (!e && out) {
        const hm = out.match(/<00>\s+UNIQUE\s+Registered/i) &&
                   out.match(/^([A-Z0-9_-]{1,15})\s+<00>/im);
        if (hm) d.hostname = hm[1];
      }
      resolve();
    });
  })));
  return devices;
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

// ── Background service registration (Windows Task Scheduler) ──────
// Registers the app as a scheduled task that:
//   • starts automatically at every user logon
//   • restarts itself up to 9999 times (1 min wait) if it crashes
// This replaces auto-launch and survives crashes without manual restart.
function registerBackgroundService() {
  if (isDev || process.platform !== 'win32') return;

  const exePath  = app.getPath('exe').replace(/'/g, "''");
  const taskName = 'CreativLabAttendance';

  // PowerShell script — idempotent, overwrites existing task
  const ps = [
    `$a = New-ScheduledTaskAction -Execute '${exePath}'`,
    `$t = New-ScheduledTaskTrigger -AtLogOn`,
    `$s = New-ScheduledTaskSettingsSet -ExecutionTimeLimit ([TimeSpan]::Zero) ` +
         `-RestartCount 9999 -RestartInterval (New-TimeSpan -Minutes 1) ` +
         `-StartWhenAvailable $true`,
    `$p = New-ScheduledTaskPrincipal -LogonType Interactive -RunLevel Highest`,
    `Register-ScheduledTask -TaskName '${taskName}' -Action $a -Trigger $t -Settings $s -Principal $p -Force | Out-Null`,
  ].join('; ');

  exec(
    `powershell -NonInteractive -NoProfile -WindowStyle Hidden -Command "${ps}"`,
    (err) => {
      if (err) console.error('[service] Task Scheduler registration failed:', err.message);
      else     console.log('[service] Registered as background service (Task Scheduler)');
    }
  );
}

// ── Auto-updater ───────────────────────────────────────────────────
function setupAutoUpdater() {
  if (isDev || !autoUpdater) return;

  autoUpdater.autoDownload        = true;
  autoUpdater.autoInstallOnAppQuit = true;

  autoUpdater.on('update-available', (info) => {
    if (mainWindow && !mainWindow.isDestroyed())
      mainWindow.webContents.send('update-available', info.version);
  });

  autoUpdater.on('download-progress', (progress) => {
    if (mainWindow && !mainWindow.isDestroyed())
      mainWindow.webContents.send('update-progress', Math.round(progress.percent));
  });

  autoUpdater.on('update-downloaded', (info) => {
    if (mainWindow && !mainWindow.isDestroyed())
      mainWindow.webContents.send('update-downloaded', info.version);
    if (tray) tray.setToolTip(`CreativLab Attendance\n⬆ Update v${info.version} ready — restart to install`);
  });

  autoUpdater.on('error', (err) => {
    console.error('[updater] Error:', err.message);
  });

  autoUpdater.checkForUpdatesAndNotify().catch(() => {});
  setInterval(() => autoUpdater.checkForUpdatesAndNotify().catch(() => {}), 4 * 60 * 60 * 1000);
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
ipcMain.handle('install-update',     ()      => { if (autoUpdater) autoUpdater.quitAndInstall(); });

// Renderer can ask for an immediate monitor scan (e.g. after linking a new device)
ipcMain.handle('trigger-monitor-scan', () => {
  networkMonitorLoop();
  return true;
});

// ── App lifecycle ──────────────────────────────────────────────────
app.whenReady().then(() => {
  createWindow();
  createTray();
  startNetworkMonitor();      // background ARP monitor — runs forever in tray
  registerBackgroundService(); // Windows Task Scheduler: auto-start + crash-restart
  setupAutoUpdater();          // check GitHub releases for updates
});

// Never quit when all windows close — stay alive in the system tray
app.on('window-all-closed', () => { /* intentional: tray app */ });

app.on('activate', () => {
  if (BrowserWindow.getAllWindows().length === 0) createWindow();
});

// Only truly quit when the user picks "Quit" from the tray menu
app.on('before-quit', () => { app._quitting = true; });
