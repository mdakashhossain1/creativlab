'use strict';

// ── Configuration ─────────────────────────────────────────────────
// Priority: Electron/Capacitor injected config > auto-detect from URL
const API_BASE = (() => {
  if (window.APP_CONFIG?.apiBase) return window.APP_CONFIG.apiBase;
  const url = new URL(window.location.href);
  if (url.protocol === 'file:') return 'https://creativlab.in/api'; // local Electron fallback
  const root = url.pathname.replace(/\/attendance-app\/?.*$/, '');
  return url.origin + root + '/api';
})();

// The QR code displayed at the office entrance contains today's date.
// Admin generates: CREATIVLAB_OFFICE_CHECKIN_{YYYYMMDD}
// We validate the prefix AND the date must be today.
const QR_CHECKIN_PREFIX = 'CREATIVLAB_OFFICE_CHECKIN';

// ── State ─────────────────────────────────────────────────────────
let allMembers         = [];
let myDevice           = null;   // { fingerprint, teamId, teamName }
let qrScanner          = null;
let refreshTimer       = null;
let activeFilter       = 'all';
let wifiMonitorTimer   = null;
let checkoutGraceTimer = null;

// ── Native Bridge detection ────────────────────────────────────────
function isElectron()   { return !!window.electron; }
function isCapacitor()  { return !!(window.Capacitor?.isNativePlatform?.()); }
function isNativeApp()  { return isElectron() || isCapacitor(); }

function getOfficeSSID() {
  return window.APP_CONFIG?.officeSSID || localStorage.getItem('office_ssid') || '';
}

// ── Boot ──────────────────────────────────────────────────────────
document.addEventListener('DOMContentLoaded', async () => {
  registerServiceWorker();
  updateHeaderDate();
  updateNativePlatformUI();
  myDevice = loadDevice();

  if (!myDevice) {
    await loadTeamForRegistration();
    showScreen('register');
  } else {
    await loadTeamData();
    showScreen('home');
    await refreshMyStatus();
    startAutoRefresh();
    startWifiMonitor();
  }

  // Listen for real-time Wi-Fi events pushed from Electron main process
  if (isElectron()) {
    window.electron.onWifiChange((ssid, isOffice) => {
      updateWifiBadge(ssid, isOffice);
      if (myDevice) handleWifiState(ssid, isOffice);
    });
  }
});

function updateNativePlatformUI() {
  const badge = document.getElementById('platformBadge');
  if (!badge) return;
  if (isElectron())  { badge.textContent = '🖥 Windows App';  badge.style.display = 'inline'; }
  if (isCapacitor()) { badge.textContent = '📱 Android App'; badge.style.display = 'inline'; }
}

// ── Service Worker ────────────────────────────────────────────────
function registerServiceWorker() {
  if ('serviceWorker' in navigator) {
    navigator.serviceWorker.register('./sw.js').catch(() => {});
  }
}

// ── Device persistence ────────────────────────────────────────────
function loadDevice() {
  try {
    const raw = localStorage.getItem('cl_device');
    return raw ? JSON.parse(raw) : null;
  } catch { return null; }
}

function saveDevice(data) {
  localStorage.setItem('cl_device', JSON.stringify(data));
  myDevice = data;
}

function generateFingerprint() {
  // Stable device fingerprint using browser + stored random seed
  const seed = localStorage.getItem('cl_seed') || crypto.randomUUID();
  localStorage.setItem('cl_seed', seed);
  return 'cl-' + seed;
}

// ── Registration ──────────────────────────────────────────────────
async function loadTeamForRegistration() {
  const sel = document.getElementById('reg-member');
  sel.addEventListener('change', () => {
    document.getElementById('reg-btn').disabled = !sel.value;
  });

  try {
    const data = await apiFetch('/team-members');
    data.forEach(m => {
      const opt = document.createElement('option');
      opt.value = m.id;
      opt.textContent = m.name + (m.designation ? ` — ${m.designation}` : '');
      sel.appendChild(opt);
    });
  } catch {
    toast('Could not load team list. Check your connection.', 'error');
  }
}

async function registerDevice() {
  const teamId     = document.getElementById('reg-member').value;
  const deviceName = document.getElementById('reg-device-name').value.trim()
                     || navigator.userAgent.substring(0, 40);
  const fingerprint = generateFingerprint();
  const btn = document.getElementById('reg-btn');

  if (!teamId) return;
  btn.disabled = true;
  btn.textContent = 'Registering…';

  try {
    await apiFetch('/attendance/register-device', {
      method: 'POST',
      body: {
        team_id:            teamId,
        device_name:        deviceName,
        device_type:        detectDeviceType(),
        device_fingerprint: fingerprint,
      },
    });

    const members = await apiFetch('/team-members');
    const me = members.find(m => m.id == teamId);

    saveDevice({ fingerprint, teamId, teamName: me?.name ?? 'You', role: me?.designation ?? '' });
    toast('Device registered! Welcome ' + (me?.name ?? ''), 'success');

    await loadTeamData();
    showScreen('home');
    await refreshMyStatus();
    startAutoRefresh();
    startWifiMonitor();
    await syncPrefsToAndroid();
  } catch (err) {
    toast(err.message || 'Registration failed', 'error');
    btn.disabled = false;
    btn.textContent = 'Register Device';
  }
}

function detectDeviceType() {
  const ua = navigator.userAgent.toLowerCase();
  if (/android/.test(ua)) return 'android';
  if (/windows/.test(ua)) return 'windows';
  return 'other';
}

// ── Team Data & Grid ──────────────────────────────────────────────
async function loadTeamData() {
  try {
    allMembers = await apiFetch('/team-members');
    renderGrid(allMembers);
    updateCounts();
  } catch {
    document.getElementById('teamGrid').innerHTML =
      '<div class="empty-state"><div class="icon">⚠️</div><p>Failed to load team. Check your connection.</p></div>';
  }
}

function renderGrid(members) {
  const grid = document.getElementById('teamGrid');

  if (!members.length) {
    grid.innerHTML = '<div class="empty-state"><div class="icon">🔍</div><p>No members found</p></div>';
    return;
  }

  grid.innerHTML = members.map(m => `
    <div class="member-card status-${m.status}" onclick="showDetail(${m.id})">
      <div class="status-dot ${m.status === 'late' ? 'late' : (m.check_in ? 'present' : 'absent')}"></div>
      ${m.image
        ? `<img class="member-avatar" src="${m.image}" alt="${m.name}" loading="lazy">`
        : `<div class="member-avatar-placeholder">${m.name.charAt(0).toUpperCase()}</div>`}
      <div class="member-name">${escHtml(m.name)}</div>
      <div class="member-role">${escHtml(m.designation || '')}</div>
      <div class="member-time">${m.check_in ? '🟢 ' + fmt12(m.check_in) : '⚪ Not in'}</div>
    </div>
  `).join('');
}

function updateCounts() {
  document.getElementById('cnt-all').textContent     = allMembers.length;
  document.getElementById('cnt-present').textContent = allMembers.filter(m => ['present','late'].includes(m.status)).length;
  document.getElementById('cnt-late').textContent    = allMembers.filter(m => m.status === 'late').length;
  document.getElementById('cnt-absent').textContent  = allMembers.filter(m => !m.check_in).length;
}

function filterTeam(q) {
  const lower = q.toLowerCase();
  const filtered = allMembers.filter(m =>
    m.name.toLowerCase().includes(lower) ||
    (m.designation || '').toLowerCase().includes(lower)
  );
  renderGrid(filtered);
}

function filterByStatus(status) {
  activeFilter = status;
  document.querySelectorAll('.stat-chip').forEach(c => c.style.fontWeight = '');
  event.currentTarget.style.fontWeight = '800';

  const filtered = status === 'all' ? allMembers
    : status === 'absent' ? allMembers.filter(m => !m.check_in)
    : allMembers.filter(m => m.status === status);
  renderGrid(filtered);
}

// ── Member Detail ─────────────────────────────────────────────────
function showDetail(memberId) {
  const m = allMembers.find(x => x.id === memberId);
  if (!m) return;

  // Avatar
  const avatarEl = document.getElementById('detailAvatar');
  avatarEl.innerHTML = m.image
    ? `<img class="detail-avatar" src="${m.image}" alt="${m.name}">`
    : `<div class="detail-avatar-placeholder">${m.name.charAt(0)}</div>`;

  document.getElementById('detailName').textContent  = m.name;
  document.getElementById('detailRole').textContent  = m.designation || '';
  document.getElementById('detailIn').textContent    = m.check_in  ? fmt12(m.check_in)  : '—';
  document.getElementById('detailOut').textContent   = m.check_out ? fmt12(m.check_out) : '—';

  // Hours
  let hours = '—';
  if (m.check_in && m.check_out) {
    const diff = (parseTime(m.check_out) - parseTime(m.check_in)) / 3600000;
    hours = diff.toFixed(1) + 'h';
  }
  document.getElementById('detailHours').textContent = hours;

  // Status badge
  const badge = document.getElementById('detailBadge');
  badge.className = `status-badge ${m.status}`;
  badge.textContent = { present: '✅ Present', late: '⏰ Late', half_day: '🌤 Half Day', absent: '❌ Absent' }[m.status] ?? m.status;

  document.getElementById('detailOverlay').classList.add('open');
}

function closeDetail(e) {
  if (!e || e.target === document.getElementById('detailOverlay')) {
    document.getElementById('detailOverlay').classList.remove('open');
  }
}

// ── My Status Screen ──────────────────────────────────────────────
async function refreshMyStatus() {
  if (!myDevice) return;

  try {
    const data = await apiFetch(`/attendance/status/${myDevice.fingerprint}`);

    document.getElementById('myStatusName').textContent = myDevice.teamName;
    document.getElementById('myStatusRole').textContent = myDevice.role || '';
    document.getElementById('myCheckIn').textContent    = data.check_in  ? fmt12(data.check_in)  : '—';
    document.getElementById('myCheckOut').textContent   = data.check_out ? fmt12(data.check_out) : '—';

    const status = data.status || 'absent';
    const icons  = { present: '✅', late: '⏰', half_day: '🌤', absent: '⭕' };
    const labels = { present: 'Present', late: 'Late', half_day: 'Half Day', absent: 'Not Checked In' };

    document.getElementById('myStatusIcon').textContent        = icons[status]  || '⭕';
    document.getElementById('myCurrentStatus').textContent     = labels[status] || '—';
    const badge = document.getElementById('myStatusBadge');
    badge.className   = `status-badge ${status}`;
    badge.textContent = labels[status] || status;

    document.getElementById('btnCheckIn').disabled  = data.checked_in;
    document.getElementById('btnCheckOut').disabled = !data.checked_in || data.checked_out;
  } catch {}
}

async function manualCheckIn() {
  if (!myDevice) return;
  document.getElementById('btnCheckIn').disabled = true;
  try {
    await apiFetch('/attendance/checkin', { method: 'POST', body: { device_fingerprint: myDevice.fingerprint, source: 'manual' } });
    toast('Checked in successfully! 🎉', 'success');
    await refreshMyStatus();
    await loadTeamData();
  } catch (e) {
    toast(e.message || 'Check-in failed', 'error');
    document.getElementById('btnCheckIn').disabled = false;
  }
}

async function manualCheckOut() {
  if (!myDevice) return;
  document.getElementById('btnCheckOut').disabled = true;
  try {
    await apiFetch('/attendance/checkout', { method: 'POST', body: { device_fingerprint: myDevice.fingerprint } });
    toast('Checked out. See you tomorrow! 👋', 'success');
    await refreshMyStatus();
    await loadTeamData();
  } catch (e) {
    toast(e.message || 'Check-out failed', 'error');
    document.getElementById('btnCheckOut').disabled = false;
  }
}

// ── QR Scanner ────────────────────────────────────────────────────
async function startScanner() {
  if (qrScanner) return;

  try {
    qrScanner = new Html5Qrcode('qr-reader');
    await qrScanner.start(
      { facingMode: 'environment' },
      { fps: 10, qrbox: { width: 250, height: 250 } },
      onQrCodeSuccess,
      () => {}
    );
  } catch (err) {
    toast('Camera access denied. Please allow camera permission.', 'error');
    showScreen('home');
  }
}

async function stopScanner() {
  if (qrScanner) {
    try { await qrScanner.stop(); } catch {}
    qrScanner = null;
    document.getElementById('qr-reader').innerHTML = '';
  }
}

async function stopScanAndGoHome() {
  await stopScanner();
  showScreen('home');
}

async function onQrCodeSuccess(text) {
  await stopScanner();

  // Validate prefix + today's date (YYYYMMDD)
  const todayStr = new Date().toISOString().slice(0, 10).replace(/-/g, '');
  const expected = QR_CHECKIN_PREFIX + '_' + todayStr;
  if (text !== expected) {
    toast('Invalid or expired QR code. Ask admin to show today\'s QR.', 'error');
    showScreen('home');
    return;
  }

  if (!myDevice) {
    toast('Please register your device first.', 'error');
    showScreen('register');
    return;
  }

  try {
    const res = await apiFetch('/attendance/checkin', {
      method: 'POST',
      body: { device_fingerprint: myDevice.fingerprint, source: 'qr' },
    });

    if (res.already_in) {
      toast('You are already checked in at ' + fmt12(res.check_in), 'success');
    } else {
      toast('QR Check-in successful! 🎉 ' + fmt12(res.check_in), 'success');
    }

    await refreshMyStatus();
    await loadTeamData();
    showScreen('mystatus');
  } catch (e) {
    toast(e.message || 'Check-in failed', 'error');
    showScreen('home');
  }
}

// ── Auto Refresh ──────────────────────────────────────────────────
function startAutoRefresh() {
  clearInterval(refreshTimer);
  refreshTimer = setInterval(async () => {
    await loadTeamData();
    await refreshMyStatus();
  }, 30_000);
}

// ── Wi-Fi Monitor (native apps only) ──────────────────────────────
const WIFI_POLL_MS      = 30_000;
const CHECKOUT_GRACE_MS = 5 * 60 * 1000; // 5 minutes after leaving office Wi-Fi

async function getNativeWifiSSID() {
  try {
    if (isElectron())  return await window.electron.getWifiSSID();
    if (isCapacitor() && window.Capacitor?.Plugins?.WifiInfo) {
      const r = await window.Capacitor.Plugins.WifiInfo.getSSID();
      return r?.ssid ?? null;
    }
  } catch {}
  return null;
}

function startWifiMonitor() {
  if (!isNativeApp()) return;
  clearInterval(wifiMonitorTimer);
  wifiMonitorLoop();
  wifiMonitorTimer = setInterval(wifiMonitorLoop, WIFI_POLL_MS);
}

async function wifiMonitorLoop() {
  const officeSSID = getOfficeSSID();
  if (!officeSSID || !myDevice) return;

  const ssid     = await getNativeWifiSSID();
  const isOffice = ssid === officeSSID;
  updateWifiBadge(ssid, isOffice);
  handleWifiState(ssid, isOffice);
}

async function handleWifiState(ssid, isOffice) {
  if (!myDevice) return;

  if (isOffice) {
    // Cancel pending checkout grace
    if (checkoutGraceTimer) { clearTimeout(checkoutGraceTimer); checkoutGraceTimer = null; }

    // Auto check-in if not already in
    try {
      const s = await apiFetch(`/attendance/status/${myDevice.fingerprint}`);
      if (!s.checked_in) {
        await apiFetch('/attendance/checkin', { method: 'POST', body: { device_fingerprint: myDevice.fingerprint, source: 'wifi' } });
        toast('Wi-Fi auto check-in 🌐', 'success');
        await refreshMyStatus();
        await loadTeamData();
        // Persist to Android SharedPrefs so the foreground service knows the fingerprint
        syncPrefsToAndroid();
      }
    } catch {}
  } else {
    // Start 5-minute grace timer before auto checkout
    if (!checkoutGraceTimer) {
      checkoutGraceTimer = setTimeout(async () => {
        checkoutGraceTimer = null;
        try {
          const s = await apiFetch(`/attendance/status/${myDevice.fingerprint}`);
          if (s.checked_in && !s.checked_out) {
            await apiFetch('/attendance/checkout', { method: 'POST', body: { device_fingerprint: myDevice.fingerprint } });
            toast('Auto check-out – left office Wi-Fi 👋', 'success');
            await refreshMyStatus();
            await loadTeamData();
          }
        } catch {}
      }, CHECKOUT_GRACE_MS);
    }
  }
}

function updateWifiBadge(ssid, isOffice) {
  const el = document.getElementById('wifiBadge');
  if (!el) return;
  if (!isNativeApp()) { el.style.display = 'none'; return; }
  el.style.display = 'inline';
  if (!ssid) {
    el.textContent = '📵 No Wi-Fi';
    el.style.background = 'rgba(239,68,68,.15)';
    el.style.color = '#ef4444';
  } else if (isOffice) {
    el.textContent = '🌐 Office';
    el.style.background = 'rgba(34,197,94,.15)';
    el.style.color = '#16a34a';
  } else {
    el.textContent = '📶 Away';
    el.style.background = 'rgba(234,179,8,.15)';
    el.style.color = '#ca8a04';
  }
}

// Sync current config to Android BackgroundServicePlugin SharedPrefs
async function syncPrefsToAndroid() {
  if (!isCapacitor() || !window.Capacitor?.Plugins?.BackgroundService) return;
  try {
    await window.Capacitor.Plugins.BackgroundService.savePrefs({
      apiBase:           API_BASE,
      officeSSID:        getOfficeSSID(),
      deviceFingerprint: myDevice?.fingerprint || '',
    });
    await window.Capacitor.Plugins.BackgroundService.start();
  } catch {}
}

// ── Settings Screen ───────────────────────────────────────────────
function showSettings() {
  const ssidInput = document.getElementById('settings-ssid');
  if (ssidInput) ssidInput.value = getOfficeSSID();

  const apiInput = document.getElementById('settings-api');
  if (apiInput) apiInput.value = window.APP_CONFIG?.apiBase || API_BASE;

  showScreen('settings');
}

async function detectOfficeSSID() {
  const ssid = await getNativeWifiSSID();
  if (ssid) {
    document.getElementById('settings-ssid').value = ssid;
    toast('Detected: ' + ssid, 'success');
  } else {
    toast('Cannot detect Wi-Fi here – enter manually', 'error');
  }
}

async function saveSettings() {
  const ssid = (document.getElementById('settings-ssid')?.value || '').trim();
  localStorage.setItem('office_ssid', ssid);

  // Persist to Electron config file
  if (isElectron()) {
    await window.electron.saveConfig({ officeSSID: ssid }).catch(() => {});
  }

  // Persist to Android SharedPrefs
  await syncPrefsToAndroid();

  toast('Settings saved', 'success');
  showScreen('home');
  startWifiMonitor();
}

// ── Screen Management ─────────────────────────────────────────────
function showScreen(name) {
  document.querySelectorAll('.screen').forEach(s => s.classList.remove('active'));
  document.getElementById('screen-' + name).classList.add('active');

  if (name === 'scan') {
    startScanner();
  } else {
    stopScanner();
  }

  if (name === 'mystatus') {
    refreshMyStatus();
  }
}

// ── Utilities ─────────────────────────────────────────────────────
function updateHeaderDate() {
  const el = document.getElementById('headerDate');
  if (el) el.textContent = new Date().toLocaleDateString('en-IN', { weekday: 'short', day: 'numeric', month: 'short' });
}

function fmt12(timeStr) {
  if (!timeStr) return '—';
  const [h, m] = timeStr.split(':');
  const hour = parseInt(h), min = m;
  const ampm = hour >= 12 ? 'PM' : 'AM';
  return ((hour % 12) || 12) + ':' + min + ' ' + ampm;
}

function parseTime(str) {
  const [h, m, s = 0] = str.split(':').map(Number);
  const d = new Date();
  d.setHours(h, m, s, 0);
  return d;
}

function escHtml(str) {
  return (str || '').replace(/&/g,'&amp;').replace(/</g,'&lt;').replace(/>/g,'&gt;');
}

function toast(msg, type = 'info') {
  const container = document.getElementById('toastContainer');
  const el = document.createElement('div');
  el.className = `toast ${type}`;
  el.textContent = msg;
  container.appendChild(el);
  requestAnimationFrame(() => { requestAnimationFrame(() => el.classList.add('show')); });
  setTimeout(() => {
    el.classList.remove('show');
    setTimeout(() => el.remove(), 400);
  }, 3500);
}

// ── API Fetch with offline queue ──────────────────────────────────
async function apiFetch(path, opts = {}) {
  const url    = API_BASE + path;
  const method = opts.method || 'GET';
  const headers = { 'Accept': 'application/json' };

  let body;
  if (opts.body) {
    headers['Content-Type'] = 'application/json';
    body = JSON.stringify(opts.body);
  }

  try {
    const res = await fetch(url, { method, headers, body });
    const json = await res.json();

    if (!res.ok) {
      // Push to offline queue if it's a check-in/out that failed due to network
      if (!navigator.onLine && opts.body?.device_fingerprint) {
        await queueOfflineRequest(url, opts.body);
        throw new Error('Queued offline — will sync when back online');
      }
      throw new Error(json.message || `HTTP ${res.status}`);
    }
    return json;
  } catch (err) {
    if (!navigator.onLine && opts.body?.device_fingerprint) {
      await queueOfflineRequest(url, opts.body);
      throw new Error('Offline — request queued');
    }
    throw err;
  }
}

async function queueOfflineRequest(url, body) {
  return new Promise((resolve, reject) => {
    const req = indexedDB.open('AttendanceDB', 1);
    req.onupgradeneeded = e =>
      e.target.result.createObjectStore('queue', { keyPath: 'id', autoIncrement: true });
    req.onsuccess = e => {
      const db = e.target.result;
      const tx = db.transaction('queue', 'readwrite');
      tx.objectStore('queue').add({ url, body, ts: Date.now() });
      tx.oncomplete = () => {
        // Register background sync
        if ('serviceWorker' in navigator && 'SyncManager' in window) {
          navigator.serviceWorker.ready.then(sw => sw.sync.register('attendance-sync'));
        }
        resolve();
      };
      tx.onerror = () => reject(tx.error);
    };
    req.onerror = () => reject(req.error);
  });
}
