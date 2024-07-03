import './bootstrap';
import {createApp} from 'vue';
import TweetList from './components/TweetList.vue';

import Alpine from 'alpinejs';
import jQuery from 'jquery';

window.$ = jQuery;
window.Alpine = Alpine;

// createApp({
//     components:{
//         TweetList,
//     }
// }).mount('#my-tweets')

// const app = createApp({});
// app.component('tweet-list', TweetList);
// app.mount('#my-tweets');

// const app_new = createApp(TweetList, {
//     base_id: 'my-tweets',
//     url: import.meta.env.VITE_URL_TWEET
// });
// app_new.mount('#new');

Alpine.start();
