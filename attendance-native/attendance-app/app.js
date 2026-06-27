'use strict';

// ── Config ────────────────────────────────────────────────────────
const API_BASE = (() => {
  if (window.APP_CONFIG?.apiBase) return window.APP_CONFIG.apiBase;
  const url = new URL(window.location.href);
  if (url.protocol === 'file:') return 'https://creativlab.in/api';
  return url.origin + url.pathname.replace(/\/attendance-app\/?.*$/, '') + '/api';
})();

// ── State ─────────────────────────────────────────────────────────
let allMembers       = [];
let allTeamMembers   = [];
let refreshTimer     = null;
let pendingLinkDevice = null;
let detailMemberId   = null;

// ── Boot ──────────────────────────────────────────────────────────
document.addEventListener('DOMContentLoaded', async () => {
  updateHeaderDate();
  initEditDatePicker();
  updateNativePlatformUI();

  await loadTeamData();
  showScreen('home');
  startAutoRefresh();

  if (isElectron()) {
    window.electron.onWifiChange((ssid, isOffice) => updateWifiBadge(ssid, isOffice));
  }
});

function updateNativePlatformUI() {
  const badge = document.getElementById('platformBadge');
  if (badge && isElectron()) {
    badge.textContent = '🖥 Windows App';
    badge.style.display = 'inline';
  }
}

// ── Platform ──────────────────────────────────────────────────────
function isElectron() { return !!window.electron; }
function getOfficeSSID() {
  return window.APP_CONFIG?.officeSSID || localStorage.getItem('office_ssid') || '';
}

// ── Team Grid ─────────────────────────────────────────────────────
async function loadTeamData() {
  try {
    allMembers = await apiFetch('/team-members');
    allTeamMembers = allMembers;
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
    </div>`).join('');
}

function updateCounts() {
  document.getElementById('cnt-all').textContent     = allMembers.length;
  document.getElementById('cnt-present').textContent = allMembers.filter(m => ['present','late'].includes(m.status)).length;
  document.getElementById('cnt-late').textContent    = allMembers.filter(m => m.status === 'late').length;
  document.getElementById('cnt-absent').textContent  = allMembers.filter(m => !m.check_in).length;
}

function filterTeam(q) {
  const lower = q.toLowerCase();
  renderGrid(allMembers.filter(m =>
    m.name.toLowerCase().includes(lower) || (m.designation || '').toLowerCase().includes(lower)));
}

function filterByStatus(status) {
  document.querySelectorAll('.stat-chip').forEach(c => c.style.fontWeight = '');
  event.currentTarget.style.fontWeight = '800';
  const f = status === 'all'    ? allMembers
    : status === 'absent' ? allMembers.filter(m => !m.check_in)
    : allMembers.filter(m => m.status === status);
  renderGrid(f);
}

// ── Member Detail + inline edit ────────────────────────────────────
function showDetail(memberId) {
  const m = allMembers.find(x => x.id === memberId);
  if (!m) return;
  detailMemberId = memberId;

  const avatarEl = document.getElementById('detailAvatar');
  avatarEl.innerHTML = m.image
    ? `<img class="detail-avatar" src="${m.image}" alt="${m.name}">`
    : `<div class="detail-avatar-placeholder">${m.name.charAt(0)}</div>`;

  document.getElementById('detailName').textContent = m.name;
  document.getElementById('detailRole').textContent = m.designation || '';
  document.getElementById('detailIn').textContent   = m.check_in  ? fmt12(m.check_in)  : '—';
  document.getElementById('detailOut').textContent  = m.check_out ? fmt12(m.check_out) : '—';

  let hours = '—';
  if (m.check_in && m.check_out) {
    const diff = (parseTime(m.check_out) - parseTime(m.check_in)) / 3600000;
    hours = diff.toFixed(1) + 'h';
  }
  document.getElementById('detailHours').textContent = hours;

  const badge = document.getElementById('detailBadge');
  badge.className   = `status-badge ${m.status}`;
  badge.textContent = statusLabel(m.status);

  // Pre-fill edit fields (HH:MM format)
  document.getElementById('editCheckIn').value  = m.check_in  ? m.check_in.slice(0,5)  : '';
  document.getElementById('editCheckOut').value = m.check_out ? m.check_out.slice(0,5) : '';
  document.getElementById('saveTimeBtn').textContent = 'Save Changes';
  document.getElementById('saveTimeBtn').disabled    = false;

  document.getElementById('detailOverlay').classList.add('open');
}

function closeDetail(e) {
  if (!e || e.target === document.getElementById('detailOverlay'))
    document.getElementById('detailOverlay').classList.remove('open');
}

async function saveDetailTime() {
  if (!detailMemberId) return;
  const checkIn  = document.getElementById('editCheckIn').value;
  const checkOut = document.getElementById('editCheckOut').value;

  if (!checkIn && !checkOut) {
    toast('Enter at least a check-in time', 'error');
    return;
  }

  const btn = document.getElementById('saveTimeBtn');
  btn.disabled = true; btn.textContent = 'Saving…';

  try {
    await apiFetch('/attendance/admin-edit', {
      method: 'POST',
      body: {
        team_member_id: detailMemberId,
        date:      todayDate(),
        check_in:  checkIn  || null,
        check_out: checkOut || null,
      },
    });
    toast('Attendance updated ✅', 'success');
    document.getElementById('detailOverlay').classList.remove('open');
    await loadTeamData();
  } catch (e) {
    toast(e.message || 'Failed to save', 'error');
    btn.disabled = false; btn.textContent = 'Save Changes';
  }
}

// ── Edit Attendance Screen ────────────────────────────────────────
function initEditDatePicker() {
  const picker = document.getElementById('editDatePicker');
  if (picker) picker.value = todayDate();
}

async function loadEditList() {
  const list   = document.getElementById('editList');
  const picker = document.getElementById('editDatePicker');
  const date   = picker?.value || todayDate();

  list.innerHTML = '<div class="empty-state"><div class="spinner" style="width:32px;height:32px;border-width:3px;"></div></div>';

  try {
    const records = await apiFetch(`/attendance/by-date?date=${date}`);
    // records: [{ team_member_id, name, designation, image, check_in, check_out, status }]
    if (!records.length) {
      list.innerHTML = '<div class="empty-state"><div class="icon">📋</div><p>No records for this date</p></div>';
      return;
    }
    list.innerHTML = records.map(r => `
      <div class="edit-row" id="editrow-${r.team_member_id}">
        <div class="edit-row-meta">
          ${r.image
            ? `<img class="edit-avatar" src="${r.image}" alt="${r.name}">`
            : `<div class="edit-avatar-placeholder">${r.name.charAt(0)}</div>`}
          <div>
            <div class="edit-row-name">${escHtml(r.name)}</div>
            <div class="edit-row-role">${escHtml(r.designation || '')}</div>
          </div>
          <span class="status-badge ${r.status}" style="margin-left:auto;">${statusLabel(r.status)}</span>
        </div>
        <div class="edit-row-times">
          <div class="edit-time-field">
            <label>Check In</label>
            <input type="time" id="in-${r.team_member_id}" value="${r.check_in ? r.check_in.slice(0,5) : ''}">
          </div>
          <div class="edit-time-field">
            <label>Check Out</label>
            <input type="time" id="out-${r.team_member_id}" value="${r.check_out ? r.check_out.slice(0,5) : ''}">
          </div>
          <button class="save-row-btn" onclick="saveEditRow(${r.team_member_id}, '${date}', this)">Save</button>
        </div>
      </div>`).join('');
  } catch (e) {
    list.innerHTML = `<div class="empty-state"><div class="icon">⚠️</div><p>${escHtml(e.message)}</p></div>`;
  }
}

async function saveEditRow(memberId, date, btn) {
  const checkIn  = document.getElementById(`in-${memberId}`)?.value;
  const checkOut = document.getElementById(`out-${memberId}`)?.value;

  btn.disabled = true; btn.textContent = '…';

  try {
    await apiFetch('/attendance/admin-edit', {
      method: 'POST',
      body: {
        team_member_id: memberId,
        date,
        check_in:  checkIn  || null,
        check_out: checkOut || null,
      },
    });
    toast('Saved ✅', 'success');
    btn.textContent = '✓';
    setTimeout(() => { btn.disabled = false; btn.textContent = 'Save'; }, 2000);
    await loadTeamData();
  } catch (e) {
    toast(e.message || 'Failed', 'error');
    btn.disabled = false; btn.textContent = 'Save';
  }
}

// ── Auto Refresh ──────────────────────────────────────────────────
function startAutoRefresh() {
  clearInterval(refreshTimer);
  refreshTimer = setInterval(() => loadTeamData(), 30_000);
}

// ── Wi-Fi badge (display only — actual check-in handled by main process) ──
async function getNativeWifiSSID() {
  try { if (isElectron()) return await window.electron.getWifiSSID(); } catch {}
  return null;
}

function updateWifiBadge(ssid, isOffice) {
  const el = document.getElementById('wifiBadge');
  if (!el || !isElectron()) return;
  el.style.display = 'inline';
  if (!ssid) {
    el.textContent = '📵 No Wi-Fi'; el.style.background = 'rgba(239,68,68,.15)'; el.style.color = '#ef4444';
  } else if (isOffice) {
    el.textContent = '🌐 Office';   el.style.background = 'rgba(34,197,94,.15)';  el.style.color = '#16a34a';
  } else {
    el.textContent = '📶 Away';     el.style.background = 'rgba(234,179,8,.15)';  el.style.color = '#ca8a04';
  }
}

// ── Devices Screen ────────────────────────────────────────────────
async function refreshDevices() {
  const info = document.getElementById('devicesScanInfo');
  const list = document.getElementById('devicesList');
  info.textContent = 'Scanning network…';
  list.innerHTML   = '<div class="empty-state"><div class="spinner" style="width:32px;height:32px;border-width:3px;"></div></div>';

  if (!isElectron()) {
    info.textContent = 'Device scanning is only available in the Windows app.';
    list.innerHTML = '<div class="empty-state"><div class="icon">🖥</div><p>Open this app on your Windows PC to manage device links.</p></div>';
    return;
  }

  try {
    const [devices, cfg, myNetInfo] = await Promise.all([
      window.electron.scanNetworkFull(),
      window.electron.getConfig(),
      window.electron.getNetworkInfo(),
    ]);

    const assignments = cfg.deviceAssignments || {};
    const myMacs = (myNetInfo || [])
      .map(n => (n.mac || '').replace(/[:-]/g, '').toUpperCase())
      .filter(Boolean);

    info.textContent = devices.length
      ? `${devices.length} device${devices.length !== 1 ? 's' : ''} on this network`
      : 'No devices found';

    if (!devices.length) {
      list.innerHTML = '<div class="empty-state"><div class="icon">📡</div><p>No devices found. Make sure you\'re connected to the office Wi-Fi.</p></div>';
      return;
    }

    list.innerHTML = devices.map(d => {
      const mac    = d.mac.replace(/-/g, ':').toUpperCase();
      const macKey = mac.replace(/:/g, '');
      const isMe   = myMacs.includes(macKey);
      const linked = assignments[mac] || assignments[macKey];
      const name   = d.hostname || d.ip;

      return `
      <div class="device-card${isMe ? ' device-me' : ''}">
        <div class="device-icon-wrap">
          <span class="device-icon">${isMe ? '🖥' : '💻'}</span>
          ${isMe ? '<span class="me-chip">This PC</span>' : ''}
        </div>
        <div class="device-info">
          <div class="device-name">${escHtml(name)}</div>
          <div class="device-sub">${d.ip} · ${mac}</div>
        </div>
        <div class="device-action">
          ${linked
            ? `<span class="linked-tag">✅ ${escHtml(linked.teamName)}</span>
               <button class="unlink-btn" onclick="unlinkDevice('${mac}','${macKey}')">✕</button>`
            : `<button class="link-btn" onclick="openLinkDialog('${mac}','${escHtml(name)}','${d.ip}')">+ Link</button>`}
        </div>
      </div>`;
    }).join('');

  } catch (e) {
    info.textContent = 'Scan failed';
    list.innerHTML = `<div class="empty-state"><div class="icon">⚠️</div><p>${escHtml(e.message)}</p></div>`;
  }
}

async function openLinkDialog(mac, displayName, ip) {
  pendingLinkDevice = { mac, displayName, ip };

  if (!allTeamMembers.length) {
    try { allTeamMembers = await apiFetch('/team-members'); } catch {}
  }

  const sel = document.getElementById('linkMemberSelect');
  sel.innerHTML = '<option value="">— Select who uses this device —</option>';
  allTeamMembers.forEach(m => {
    const opt = document.createElement('option');
    opt.value = m.id;
    opt.textContent = m.name + (m.designation ? ` — ${m.designation}` : '');
    sel.appendChild(opt);
  });

  document.getElementById('linkDeviceInfo').textContent = `${displayName} (${mac})`;
  document.getElementById('linkConfirmBtn').disabled    = false;
  document.getElementById('linkConfirmBtn').textContent = 'Link Device';
  document.getElementById('linkOverlay').classList.add('open');
}

function closeLink() {
  document.getElementById('linkOverlay').classList.remove('open');
  pendingLinkDevice = null;
}

async function confirmLink() {
  if (!pendingLinkDevice) return;
  const sel    = document.getElementById('linkMemberSelect');
  const teamId = sel.value;
  if (!teamId) { toast('Please select a team member', 'error'); return; }

  const { mac, displayName, ip } = pendingLinkDevice;
  const member      = allTeamMembers.find(m => m.id == teamId);
  const macKey      = mac.replace(/:/g, '');
  const fingerprint = 'cl-mac-' + macKey.toLowerCase();
  const btn         = document.getElementById('linkConfirmBtn');
  btn.disabled = true; btn.textContent = 'Linking…';

  try {
    await apiFetch('/attendance/register-device', {
      method: 'POST',
      body: {
        team_id:            teamId,
        device_name:        displayName || ip,
        device_type:        'windows',
        device_fingerprint: fingerprint,
      },
    });

    if (isElectron()) {
      const cfg         = await window.electron.getConfig();
      const assignments = cfg.deviceAssignments || {};
      assignments[mac]  = { teamId, teamName: member?.name ?? 'Unknown', fingerprint };
      await window.electron.saveConfig({ deviceAssignments: assignments });
    }

    toast(`${member?.name ?? 'Device'} linked! ✅`, 'success');
    closeLink();
    await refreshDevices();
  } catch (e) {
    toast(e.message || 'Failed to link device', 'error');
    btn.disabled = false; btn.textContent = 'Link Device';
  }
}

async function unlinkDevice(mac, macKey) {
  if (!isElectron()) return;
  const cfg         = await window.electron.getConfig();
  const assignments = cfg.deviceAssignments || {};
  delete assignments[mac];
  delete assignments[macKey];
  await window.electron.saveConfig({ deviceAssignments: assignments });
  toast('Device unlinked', 'success');
  await refreshDevices();
}

// ── Settings ──────────────────────────────────────────────────────
function showSettings() {
  const ssidInput = document.getElementById('settings-ssid');
  if (ssidInput) ssidInput.value = getOfficeSSID();
  showScreen('settings');
}

async function detectOfficeSSID() {
  const ssid = await getNativeWifiSSID();
  if (ssid) { document.getElementById('settings-ssid').value = ssid; toast('Detected: ' + ssid, 'success'); }
  else toast('Cannot detect Wi-Fi — enter manually', 'error');
}

async function saveSettings() {
  const ssid = (document.getElementById('settings-ssid')?.value || '').trim();
  localStorage.setItem('office_ssid', ssid);
  if (isElectron()) await window.electron.saveConfig({ officeSSID: ssid }).catch(() => {});
  toast('Settings saved', 'success');
  showScreen('home');
}

// ── Screen Management ─────────────────────────────────────────────
function showScreen(name) {
  document.querySelectorAll('.screen').forEach(s => s.classList.remove('active'));
  document.getElementById('screen-' + name).classList.add('active');
  if (name === 'devices') refreshDevices();
  if (name === 'edit')    loadEditList();
}

// ── Utilities ─────────────────────────────────────────────────────
function updateHeaderDate() {
  const el = document.getElementById('headerDate');
  if (el) el.textContent = new Date().toLocaleDateString('en-IN', { weekday: 'short', day: 'numeric', month: 'short' });
}

function todayDate() {
  return new Date().toISOString().slice(0, 10);
}

function fmt12(t) {
  if (!t) return '—';
  const [h, m] = t.split(':');
  const hr = parseInt(h);
  return ((hr % 12) || 12) + ':' + m + ' ' + (hr >= 12 ? 'PM' : 'AM');
}

function parseTime(str) {
  const [h, m, s = 0] = str.split(':').map(Number);
  const d = new Date(); d.setHours(h, m, s, 0); return d;
}

function statusLabel(status) {
  return { present: '✅ Present', late: '⏰ Late', half_day: '🌤 Half Day', absent: '❌ Absent' }[status] ?? status;
}

function escHtml(str) {
  return (str || '').replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;');
}

function toast(msg, type = 'info') {
  const c  = document.getElementById('toastContainer');
  const el = document.createElement('div');
  el.className = `toast ${type}`; el.textContent = msg;
  c.appendChild(el);
  requestAnimationFrame(() => requestAnimationFrame(() => el.classList.add('show')));
  setTimeout(() => { el.classList.remove('show'); setTimeout(() => el.remove(), 400); }, 3500);
}

// ── API Fetch ─────────────────────────────────────────────────────
async function apiFetch(path, opts = {}) {
  const url     = API_BASE + path;
  const method  = opts.method || 'GET';
  const headers = { 'Accept': 'application/json' };
  let body;
  if (opts.body) { headers['Content-Type'] = 'application/json'; body = JSON.stringify(opts.body); }
  const res  = await fetch(url, { method, headers, body });
  const json = await res.json();
  if (!res.ok) throw new Error(json.message || `HTTP ${res.status}`);
  return json;
}
