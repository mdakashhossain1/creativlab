'use strict';

const { contextBridge, ipcRenderer } = require('electron');
const path = require('path');
const fs   = require('fs');

// Read config from the user-writable AppData dir — matches app.getPath('userData') in main.js.
// app name (package.json "name") = creativlab-attendance  →  %APPDATA%\creativlab-attendance
const configPath = path.join(
  process.env.APPDATA || path.join(require('os').homedir(), 'AppData', 'Roaming'),
  'creativlab-attendance',
  'config.json'
);
let cfg = {};
try { cfg = JSON.parse(fs.readFileSync(configPath, 'utf8')); } catch {}

// ── Inject APP_CONFIG into page (read by app.js for API base + office SSID)
contextBridge.exposeInMainWorld('APP_CONFIG', {
  apiBase:    cfg.apiBase    || 'https://creativlab.in/api',
  officeSSID: cfg.officeSSID || '',
  platform:   'electron',
});

// ── Expose electron bridge (read by app.js for native capabilities)
contextBridge.exposeInMainWorld('electron', {
  // Returns current Wi-Fi SSID or null
  getWifiSSID: () => ipcRenderer.invoke('get-wifi-ssid'),

  // Get/save config (used by settings screen)
  getConfig:  ()      => ipcRenderer.invoke('get-config'),
  saveConfig: (delta) => ipcRenderer.invoke('save-config', delta),

  // Subscribe to real-time Wi-Fi change events from main process
  // fn(ssid: string|null, isOffice: boolean)
  onWifiChange: (fn) => {
    ipcRenderer.on('wifi-change', (_event, ssid, isOffice) => fn(ssid, isOffice));
  },

  // App info
  getVersion: () => ipcRenderer.invoke('get-version'),

  // Network & device identity
  scanNetwork:     ()      => ipcRenderer.invoke('scan-network'),
  scanNetworkFull: ()      => ipcRenderer.invoke('scan-network-full'),
  getNetworkInfo:  ()      => ipcRenderer.invoke('get-network-info'),
  getUsername:     ()      => ipcRenderer.invoke('get-username'),
  getHostname:     ()      => ipcRenderer.invoke('get-hostname'),

  // Ask the main process to run an ARP scan immediately (e.g. after linking a device)
  triggerMonitorScan: () => ipcRenderer.invoke('trigger-monitor-scan'),

  // Real-time events pushed from the background monitor
  // fn({ mac, name }) — fired when a linked device appears / disappears
  onMemberArrived: (fn) => ipcRenderer.on('member-arrived', (_e, data) => fn(data)),
  onMemberLeft:    (fn) => ipcRenderer.on('member-left',    (_e, data) => fn(data)),

  // Auto-update
  onUpdateAvailable: (fn) => ipcRenderer.on('update-available', (_e, v)  => fn(v)),
  onUpdateProgress:  (fn) => ipcRenderer.on('update-progress',  (_e, pct) => fn(pct)),
  onUpdateDownloaded:(fn) => ipcRenderer.on('update-downloaded', (_e, v) => fn(v)),
  installUpdate:     ()   => ipcRenderer.invoke('install-update'),
});
