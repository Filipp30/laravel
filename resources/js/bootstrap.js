window._ = require('lodash');

window.axios = require('axios');

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */

// import Echo from 'laravel-echo';
//
// window.Pusher = require('pusher-js');
//
// window.Echo = new Echo({
//     broadcaster: 'pusher',
//     key: process.env.MIX_PUSHER_APP_KEY,
//     cluster: process.env.MIX_PUSHER_APP_CLUSTER,
//     forceTLS: false,
//     encrypted: false
// });
// Pusher.logToConsole = true;

// let pusher = new Pusher('8a34625906a44e573ba7', {
//     cluster: 'eu',
//     encrypted:false
// });

// let channel = pusher.subscribe('my-channel');
// channel.bind('my-event', function(data) {
//     alert(JSON.stringify(data));
//     console.log(JSON.stringify(data));
// });
// window.Echo.private("my-channel").listen("my-event", function (message){
//     console.log(message);
//     console.log('console from ChatTemplate mounted')
// });





