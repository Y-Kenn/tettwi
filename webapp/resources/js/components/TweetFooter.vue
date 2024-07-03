<template>
    <div class="tweet-footer row w-100 position-absolute bg-white px-3 py-2 m-0">
<!--    <div class="tweet-footer d-flex justify-content-around align-items-center position-relative bg-white py-2">-->
        <div class="col-4 p-0 d-flex align-items-center">
            <button class="" @click="toggleGoodStatus">
                <i :class="{'text-danger': class_is_good, 'text-muted': !class_is_good}" class="icon-button fa-solid fa-hand-middle-finger"></i>
            </button>
            <span class="ms-1">{{tweet.good_num}}</span>
        </div>
        <div class="col-4 p-0 d-flex align-items-center">
            <button @click="toggleBadStatus">
                <i :class="{'text-primary': class_is_bad, 'text-muted': !class_is_bad}" class="icon-button fa-solid fa-hand-peace"></i>
            </button>
            <span class="ms-1">{{tweet.bad_num}}</span>
        </div>
        <div class="col-2 p-0 d-flex align-items-center">
            <button @click="toggleBookmarkStatus">
                <i :class="{'text-success': class_is_bookmark, 'text-muted': !class_is_bookmark}" class="icon-button fa-solid fa-bookmark"></i>
            </button>
        </div>
        <div class="col-2 p-0 d-flex align-items-center justify-content-end">
            <button :id="id_ellipsis" @click="toggleTweetModal" class="ellipsis-button btn btn-sm rounded-circle border">
                <i :id="id" class="fa-solid fa-ellipsis"></i>
            </button>
        </div>
    </div>
    <TweetModal v-if="show_tweet_modal"
                :base_id="base_id"
                :id_ellipsis="id_ellipsis"
                :tweet="tweet"
                @close="toggleTweetModal"/>
</template>

<script>
import {onMounted, ref} from 'vue'
import TweetModal from './TweetModal.vue'
export default {
    name: "TweetFooter",
    components: {TweetModal},
    props: {
        base_id: String,
        tweet: Object
    },
    setup(props){

        /**************************
         * グッドボタンによる切り替え処理
         **************************/
        //この変数によってクラス（グッドボタンの色）をトグルする
        let class_is_good = ref(props.tweet.is_good)
        const postGood = async ()=>{
            const url = 'http://localhost/good';
            const data = { tweet_record_id: props.tweet.id }
            await axios.post(url, data).then(res =>{
                class_is_good.value = props.tweet.id
                //コントローラからの送信データに合わせてレコードIDを入れている(true or false でも動作に問題なし)
                props.tweet.is_good = props.tweet.id;
            }).catch(err => {
                console.log("error:", err);
            });
            console.log('post', class_is_good.value)
        }
        const deleteGood = async ()=>{
            const url = 'http://localhost/good/' +  props.tweet.id;
            await axios.delete(url).then(res =>{
                class_is_good.value = false
                //コントローラからの送信データに合わせてnullを入れている(true or false でも動作に問題なし)
                props.tweet.is_good = null
            }).catch(err => {
                console.log("delete error:", err)
            });
            console.log('delete', class_is_good.value)
        }
        const toggleGoodStatus = ()=>{
            if(!class_is_good.value){
                postGood()
            }else{
                deleteGood()
            }
        }

        /**************************
         * バッドボタンによる切り替え処理
         **************************/
        let class_is_bad = ref(props.tweet.is_bad)
        const postBad = async ()=>{
            const url = 'http://localhost/bad';
            const data = { tweet_record_id: props.tweet.id }
            await axios.post(url, data).then(res =>{
                class_is_bad.value = props.tweet.id
                props.tweet.is_bad = props.tweet.id;
            }).catch(err => {
                console.log("error:", err);
            });
            console.log('post', class_is_bad.value)
        }
        const deleteBad = async ()=>{
            const url = 'http://localhost/bad/' +  props.tweet.id;
            await axios.delete(url).then(res =>{
                class_is_bad.value = null
                props.tweet.is_bad = null
            }).catch(err => {
                console.log("delete error:", err);
            });
            console.log('post', class_is_bad.value)
        }
        const toggleBadStatus = ()=>{
            if(!class_is_bad.value){
                postBad()
            }else{
                deleteBad()
            }
        }

        /*******************************
         * ブックマークボタンによる切り替え処理
         *******************************/
        let class_is_bookmark = ref(props.tweet.is_bookmark)
        const postBookmark = async ()=>{
            const url = 'http://localhost/bookmark';
            const data = { tweet_record_id: props.tweet.id }
            await axios.post(url, data).then(res =>{
                class_is_bookmark.value = props.tweet.id
                props.tweet.is_bookmark = props.tweet.id;
            }).catch(err => {
                console.log("error:", err);
            });
        }
        const deleteBookmark = async ()=>{
            const url = 'http://localhost/bookmark/' +  props.tweet.id;
            await axios.delete(url).then(res =>{
                class_is_bookmark.value = null
                props.tweet.is_bad = null;
            }).catch(err => {
                console.log("delete error:", err);
            });
        }
        const toggleBookmarkStatus = ()=>{
            if(!class_is_bookmark.value){
                postBookmark()
            }else{
                deleteBookmark()
            }
        }

        /*******************************
         * モーダル関連
         *******************************/
        const id_ellipsis = props.base_id + 'ellipsis' + props.tweet.id
        let show_tweet_modal = ref(false)
        const toggleTweetModal = ()=>{
            show_tweet_modal.value = !show_tweet_modal.value
        }





        return { class_is_good, toggleGoodStatus, class_is_bad, toggleBadStatus, class_is_bookmark, toggleBookmarkStatus, id_ellipsis, show_tweet_modal, toggleTweetModal }
    }
}

</script>





<style scoped>
#menuOn{
    display : none
}

menu{
    position    : relative;
    font-size   : 20px;
    line-height : 20px;
    height      : 40px;
    width       : 20px;
    /*width       : 100%;*/
    min-width   : 20px;
    /*background  : black;*/
}

/* メニュー */
#menuOn:checked + menu{
    max-width : 960px;/*コンテナと同じ数値を指定しておく必要あり*/
    z-index   : 20;
}

/* オーバーレイ                                         */
/* メニューが表示されているときに                   */
/* LightBoxのように画面全体を覆うブロックを表示する     */
/* これによってメニュー部分を除いて                     */
/* 画面全体がチェックボックスへのクリックになるので     */
/* メニュー以外の部分をクリックするとメニューが閉じます */
#menuOn:checked + menu + div.overlay{
    position : fixed;
    top      :  0;
    bottom   :  0;
    left     :  0;
    right    :  0;
    z-index  : 10;
    background : rgba(0,0,0,0.1);
}

#menuOn:checked + menu ul{
    display: block;
}

ul{
    position: absolute;
    top    : 40px;
    right  : -25px;
    display: none;
}

li{
    list-style-type : none;
    /* メニュー要素の背景色と合わせる*/
    background      : white;
    min-width       :  105px;
    max-width       :  200px;
    white-space     : nowrap;
    text-overflow   : ellipsis;
    display       : block;
    padding       :  10px;
}

li:hover{
    cursor: pointer;
}

/* ハンバーガーメニュー */
#menuOn + menu::after {
    position     : absolute;
    z-index      : 30;
    display      : block;
    /*content      : '\2026';!*'\2261'; ハンバーガーメニュー*!*/
    content: '\22ef';
    line-height  : 40px;
    width        : 20px;
    padding-left : 10px;
    /*color        : white;*/
    right        :  0;
    top          :  0;
    /*background   : black;*/
    font-weight: bold;
    margin-right: 0.5rem;
}

/* メニューを閉じる */
#menuOn:checked + menu::after {
    content : '×';/* 閉じるボタン */
}

</style>
