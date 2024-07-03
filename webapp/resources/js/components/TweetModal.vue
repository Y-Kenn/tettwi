<template>
<div :id="id" class="tweet-modal position-absolute top-100 end-0 translate-middle-y w-75 text-center bg-white border shadow-lg rounded-3">
    <div>削除する</div>
    <div>報告する</div>
</div>
</template>

<script>
import { onMounted, onBeforeUnmount } from "vue";

export default {
    name: "TweetModal",
    props: {
        base_id: String,
        id_ellipsis: String,
        tweet: Object
    },
    setup(props, context){
        const id = props.base_id + 'tmodal' + props.tweet.id
        // console.log('modal', id)

        onMounted(()=>{
            window.addEventListener('click', closeTweetModal);
        })
        onBeforeUnmount(()=>{
            window.removeEventListener('click', closeTweetModal);
        })

        const closeTweetModal = event =>{
            if (!document.getElementById(id).contains(event.target)
                &&!document.getElementById(props.id_ellipsis).contains(event.target)){
                context.emit('close')
                console.log('close')
            }
        }

        return { id }
    }
}
</script>

<style scoped>

</style>
