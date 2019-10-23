'use strict';

// Update cache names any time any of the cached files change.
const CACHE_NAME = 'static-cache-v1';

// Add list of files to cache here.
const FILES_TO_CACHE = [
    '/',
];

self.addEventListener('install', (evt) => {
    //console.log('[ServiceWorker] Install');

    evt.waitUntil(
        caches.open(CACHE_NAME).then(cache => {
            //console.log('[ServiceWorker] Caching app shell');
            return cache.addAll(FILES_TO_CACHE).then(() => self.skipWaiting());
        })
    )
});

self.addEventListener('activate', (evt) => {
    //console.log('[ServiceWorker] Activate');
    self.clients.claim();
});

self.addEventListener('fetch', (evt) => {
    //console.log('[ServiceWorker] Fetch', evt.request.url);
});