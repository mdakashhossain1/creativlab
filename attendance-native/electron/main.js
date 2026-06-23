'use strict';

const { app, BrowserWindow, Tray, Menu, ipcMain, nativeImage, shell } = require('electron');
const path  = require('path');
const fs    = require('fs');
const { exec } = require('child_process');

// ── Paths ──────────────────────────────────────────────────────────
const CONFIG_PATH = path.join(__dirname, '..', 'config.json');
// In production (packaged), web assets are in extraResources/attendance-app
// In dev, they are two levels up in public/attendance-app
const WEB_ROOT = app.isPackaged
  ? path.join(process.resourcesPath, 'attendance-app')
  : path.join(__dirname, '..', '..', 'public', 'attendance-app');

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
let lastSSID   = undefined; // undefined = not yet polled

// ── Wi-Fi detection (cross-platform) ──────────────────────────────
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

// ── Window ─────────────────────────────────────────────────────────
function createWindow() {
  mainWindow = new BrowserWindow({
    width:    430,
    height:   800,
    minWidth: 380,
    minHeight: 600,
    icon: path.join(__dirname, 'icons', 'icon.ico'),
    title: 'CreativLab Attendance',
    show: false,
    webPreferences: {
      preload:          path.join(__dirname, 'preload.js'),
      contextIsolation: true,
      nodeIntegration:  false,
      // Allow loading local files via file:// and fetching the API (https)
      webSecurity: false,
    },
  });

  mainWindow.loadFile(path.join(WEB_ROOT, 'index.html'));
  mainWindow.once('ready-to-show', () => mainWindow.show());

  // Hide to tray instead of quitting
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
    { label: 'Open Attendance App', click: () => { mainWindow.show(); mainWindow.focus(); } },
    { type: 'separator' },
    { label: 'Quit', click: () => { app._quitting = true; app.quit(); } },
  ]);
}

function createTray() {
  const iconPath = path.join(__dirname, 'icons', 'icon.ico');
  const icon = fs.existsSync(iconPath)
    ? nativeImage.createFromPath(iconPath)
    : nativeImage.createEmpty();

  tray = new Tray(icon);
  tray.setToolTip('CreativLab Attendance');
  tray.setContextMenu(buildTrayMenu());
  tray.on('click', () => {
    mainWindow.isVisible() ? mainWindow.hide() : (mainWindow.show(), mainWindow.focus());
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
      lastSSID = ssid;
      const isOffice = !!config.officeSSID && ssid === config.officeSSID;
      updateTray(ssid, isOffice);
      // Notify renderer
      if (mainWindow && !mainWindow.isDestroyed()) {
        mainWindow.webContents.send('wifi-change', ssid, isOffice);
      }
    }
  }

  poll(); // immediate first check
  setInterval(poll, 30_000);
}

// ── Auto-launch setup ──────────────────────────────────────────────
async function setupAutoLaunch() {
  try {
    const AutoLaunch = require('auto-launch');
    const al = new AutoLaunch({ name: 'CreativLab Attendance', path: app.getPath('exe') });
    const enabled = await al.isEnabled();
    if (!enabled) await al.enable();
  } catch {}
}

// ── IPC handlers ───────────────────────────────────────────────────
ipcMain.handle('get-wifi-ssid', () => getWifiSSID());
ipcMain.handle('get-config',    () => readConfig());
ipcMain.handle('save-config',   (_, delta) => { writeConfig(delta); return true; });
ipcMain.handle('get-version',   () => app.getVersion());

// ── App lifecycle ──────────────────────────────────────────────────
app.whenReady().then(() => {
  createWindow();
  createTray();
  startWifiPoll();
  setupAutoLaunch();
});

// Keep the process alive — tray app never fully quits unless user picks Quit
app.on('window-all-closed', () => { /* stay in tray */ });
app.on('activate', () => {
  if (BrowserWindow.getAllWindows().length === 0) createWindow();
});
