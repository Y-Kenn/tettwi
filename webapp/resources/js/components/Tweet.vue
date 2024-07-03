<template>
    <div class="relative w-100 my-3">
        <LoadingTweet v-if="loading_flag.flag"
                      ref="loading"
                      :base_id="id"
                      :height="loading_size.height"
                      @LoadingMounted="setLoadingSize"/>

        <div :id="id" v-once ref="twt" v-html="tweet.html" class="tweet-widget"></div>

        <TweetFooter  v-if="!loading_flag.flag"
                      :base_id="base_id"
                      :tweet="tweet"/>
    </div>

</template>

<script>
import {onMounted, reactive, ref} from "vue";
import LoadingTweet from "./LoadingTweet.vue"
import TweetFooter from "./TweetFooter.vue"

export default {
    name: "Tweet",
    components: { LoadingTweet, TweetFooter },
    props: {
        base_id: String,
        tweet: Object,
    },
    setup(props){

        const id = props.base_id + props.tweet.id
        let loading_size = reactive({
            height: '50',
            width: '50'
        })
        let twt = ref(null)
        let loading_flag = reactive({
            flag: true
        })

        onMounted(()=>{
            //埋め込みツイートのスタイル取得・適用関係
            window.twttr = ((() => {
                const fjs = twt.value;
                let js;
                let t = window.twttr || {};
                if(t.widgets) return t; // もう関数定義されている
                js = document.createElement("script");
                js.src = "https://platform.twitter.com/widgets.js";
                fjs.appendChild(js);

                t._e = [];
                t.ready = function(f){
                    t._e.push(f);
                };
                return t;
            })());
            twttr.ready( () => {
                twttr.widgets.load( twt.value);
            });

            loading_size.height = twt.value.clientHeight
            console.log(loading_size.height)

            let flag = true
            const interval = setInterval(()=>{
                setTimeout(()=>{
                    loading_flag.flag = false
                    clearInterval(interval)
                }, 5000)

                let elm = document.getElementById(id)
                flag = (elm.children[0].tagName === 'BLOCKQUOTE')
                console.log(id, loading_flag.flag)
                if(!flag){
                    clearInterval(interval)
                    setTimeout(()=>{
                        loading_flag.flag = flag
                    },1500)

                }
            }, 500)

        })

        const setLoadingSize = ()=>{
            //ローディングカバーのサイズ調整
            let elm = document.getElementById(id)
            loading_size.height = elm.style.height
        }


        return { twt, loading_size, id, loading_flag, setLoadingSize }
    }
}
</script>

<style scoped>

</style>
