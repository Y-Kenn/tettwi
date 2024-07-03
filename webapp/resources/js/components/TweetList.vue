<template>
    <div>aaaa</div>
<!--    <Tweet v-for="tweet in tweet_list.data"-->
<!--            :key="tweet.id"-->
<!--            :base_id="base_id"-->
<!--            :tweet="tweet"/>-->
</template>


<!--<script>-->
<!--import {onMounted, reactive} from "vue";-->
<!--import Tweet from '../components/Tweet.vue'-->

<!--export default {-->
<!--    components: { Tweet },-->
<!--    props: {-->
<!--        base_id: String,-->
<!--        tweets: Array-->
<!--    },-->
<!--    setup(props){-->
<!--        let tweet_list = reactive({-->
<!--            data: []-->
<!--        })-->
<!--        console.log('test')-->
<!--        const loadTweets = ()=>{-->
<!--            let i = 0;-->
<!--            const interval = setInterval(()=>{-->
<!--                tweet_list.data.push(props.tweets[i])-->
<!--                console.log('interval')-->
<!--                console.log(i)-->
<!--                if(i >= tweets.data.length - 1){-->
<!--                    clearInterval(interval)-->
<!--                }-->
<!--                i++-->
<!--            },500)-->
<!--        }-->
<!--        loadTweets()-->

<!--        return { tweet_list }-->
<!--    }-->

<!--}-->
<!--</script>-->
