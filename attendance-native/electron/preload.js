'use strict';

const { contextBridge, ipcRenderer } = require('electron');
const path = require('path');
const fs   = require('fs');

// Read config bundled next to this preload
const configPath = path.join(__dirname, '..', 'config.json');
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
});
