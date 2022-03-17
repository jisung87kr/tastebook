require('./bootstrap');

import Alpine from 'alpinejs';

window.Alpine = Alpine;
window.PhotoSwipe = require('photoswipe/dist/photoswipe');
window.PhotoSwipeUI_Default = require('photoswipe/dist/photoswipe-ui-default');

Alpine.start();
