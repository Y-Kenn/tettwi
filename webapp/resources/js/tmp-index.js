import {createApp} from 'vue';
import TweetList from './components/TweetList.vue';

const app_new = createApp(TweetList, {
    base_id: 'new',
    url: import.meta.env.VITE_URL_TWEET
});
app_new.mount('#new');

const app_weekly = createApp(TweetList, {
    base_id: 'weekly',
    url: import.meta.env.VITE_URL_TWEET
});
app_weekly.mount('#weekly');

const app_daily = createApp(TweetList, {
    base_id: 'daily',
    url: import.meta.env.VITE_URL_TWEET
});
app_daily.mount('#daily');
