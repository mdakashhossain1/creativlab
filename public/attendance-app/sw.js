const CACHE   = 'creativlab-attendance-v1';
const OFFLINE = ['./index.html', './app.css', './app.js',
  'https://cdn.jsdelivr.net/npm/html5-qrcode@2.3.8/html5-qrcode.min.js'];

// ── Install: cache app shell ─────────────────────────────────────
self.addEventListener('install', e => {
  e.waitUntil(caches.open(CACHE).then(c => c.addAll(OFFLINE)));
  self.skipWaiting();
});

// ── Activate: clean old caches ───────────────────────────────────
self.addEventListener('activate', e => {
  e.waitUntil(
    caches.keys().then(keys =>
      Promise.all(keys.filter(k => k !== CACHE).map(k => caches.delete(k)))
    )
  );
  self.clients.claim();
});

// ── Fetch: serve from cache, fall back to network ────────────────
self.addEventListener('fetch', e => {
  if (e.request.method !== 'GET') return;
  e.respondWith(
    fetch(e.request)
      .then(r => {
        const clone = r.clone();
        caches.open(CACHE).then(c => c.put(e.request, clone));
        return r;
      })
      .catch(() => caches.match(e.request))
  );
});

// ── Background sync: flush offline check-in/out queue ────────────
self.addEventListener('sync', e => {
  if (e.tag === 'attendance-sync') {
    e.waitUntil(flushQueue());
  }
});

async function flushQueue() {
  const db      = await openDB();
  const tx      = db.transaction('queue', 'readwrite');
  const store   = tx.objectStore('queue');
  const records = await storeGetAll(store);

  for (const rec of records) {
    try {
      const res = await fetch(rec.url, {
        method:  'POST',
        headers: { 'Content-Type': 'application/json', 'Accept': 'application/json' },
        body:    JSON.stringify(rec.body),
      });
      if (res.ok) await storeDelete(db, rec.id);
    } catch {}
  }
}

// ── IndexedDB helpers ────────────────────────────────────────────
function openDB() {
  return new Promise((resolve, reject) => {
    const req = indexedDB.open('AttendanceDB', 1);
    req.onupgradeneeded = e => e.target.result.createObjectStore('queue', { keyPath: 'id', autoIncrement: true });
    req.onsuccess  = e => resolve(e.target.result);
    req.onerror    = e => reject(e.target.error);
  });
}
function storeGetAll(store) {
  return new Promise((res, rej) => {
    const r = store.getAll();
    r.onsuccess = () => res(r.result);
    r.onerror   = () => rej(r.error);
  });
}
function storeDelete(db, id) {
  return new Promise((res, rej) => {
    const tx = db.transaction('queue', 'readwrite');
    const r  = tx.objectStore('queue').delete(id);
    r.onsuccess = () => res();
    r.onerror   = () => rej(r.error);
  });
}
