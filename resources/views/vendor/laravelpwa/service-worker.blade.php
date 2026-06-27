const CACHE_NAME = 'foodigo-cache-v1';
const urlsToCache = [
    '/',
    '/css/*',
    '/js/*',
    '/images/*',
    '/fonts/*'
];

// Install event
self.addEventListener('install', function(event) {
    console.log('Service Worker: Installing...');
    self.skipWaiting();
    event.waitUntil(
        caches.open(CACHE_NAME)
            .then(function(cache) {
                console.log('Service Worker: Cache opened');
                return cache.addAll(urlsToCache);
            })
            .catch(function(error) {
                console.log('Service Worker: Cache failed', error);
            })
    );
});

// Fetch event
self.addEventListener('fetch', function(event) {
    // Skip non-GET and cross-origin requests (e.g. tawk.to analytics)
    if (event.request.method !== 'GET' || !event.request.url.startsWith(self.location.origin)) {
        return;
    }

    // Skip attendance-app requests to avoid conflicts with its own service worker
    if (event.request.url.includes('/attendance-app')) {
        return;
    }

    event.respondWith(
        caches.match(event.request)
            .then(function(response) {
                // Return cached version or fetch from network
                return response || fetch(event.request);
            })
            .catch(function(error) {
                console.log('Service Worker: Fetch failed', error);
                // Return fallback for html pages if they fail
                if (event.request.headers.get('accept') && event.request.headers.get('accept').includes('text/html')) {
                    return caches.match('/');
                }
            })
    );
});

// Activate event
self.addEventListener('activate', function(event) {
    console.log('Service Worker: Activating...');
    event.waitUntil(
        Promise.all([
            self.clients.claim(),
            caches.keys().then(function(cacheNames) {
                return Promise.all(
                    cacheNames.map(function(cacheName) {
                        if (cacheName !== CACHE_NAME) {
                            console.log('Service Worker: Deleting old cache', cacheName);
                            return caches.delete(cacheName);
                        }
                    })
                );
            })
        ])
    );
});

// Message event for debugging
self.addEventListener('message', function(event) {
    console.log('Service Worker: Message received', event.data);
});
