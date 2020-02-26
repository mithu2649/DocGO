// when the browser sees this ServiceWorker for the first time
self.addEventListener('install', function(event) {
    event.waitUntil(
      // open/create a cache
      caches.open('DocGO-v1').then(function(cache) {
        return cache.addAll([
          '/',
          'resources/icons/document.png',
          'resources/icons/user.png',
          'resources/icons/document.svg',
          'resources/img/docx.png',
          'resources/img/pdf.png',
          'resources/img/epub.png',
          'resources/img/txt.png',
          'resources/img/unknown.png',
          'feed',
          'manifest.webmanifest',
          'resources/css/header.css',
          'resources/css/index.css',
          'resources/css/login.css',
          'resources/css/posts.css',
          'app.js',
          'resources/js/search.js',
          'resources/js/upload.js'
        ])
      })
    );
  });

  self.addEventListener('fetch', function(event) {
    event.respondWith(
      caches.match(event.request, {
        ignoreSearch: true
      }).then(function(response) {
        return response || fetch(event.request);
      })
    );
  });