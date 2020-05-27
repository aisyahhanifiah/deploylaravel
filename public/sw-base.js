importScripts('https://storage.googleapis.com/workbox-cdn/releases/3.5.0/workbox-sw.js');

if (workbox) {
  console.log(`Yay! Workbox is loaded 🎉`);

  workbox.precaching.precacheAndRoute([]);

  const networkFirstHandler = new workbox.strategies.NetworkFirst({
  	cacheName: 'dynamic',
  	plugins: [
  		new workbox.expiration.Plugin({
  			maxEntries: 10
  		}),
  		new workbox.cacheableResponse.Plugin({
  			statuses: [200]
  		})
  	]
  });

  const FALLBACK_URL = workbox.precaching.getCacheKeyForURL('/offline.html');
  const matcher = ({ event }) => event.request.mode === 'navigate';
  const handler = args =>
  	networkFirstHandler
  		.handle(args)
  		.then(response => response || caches.match(FALLBACK_URL))
  		.catch(() => caches.match(FALLBACK_URL));

  workbox.routing.registerRoute(matcher, handler);

} else {
  console.log(`Boo! Workbox didn't load 😬`);
}