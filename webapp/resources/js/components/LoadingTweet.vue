<template>
    <div :id="id" class="position-absolute w-100 d-flex justify-content-center align-items-center bg-white">
        <div class="spinner-border" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
    </div>

</template>

<script>
import {onMounted, watch} from "vue";

export default {
    name: "LoadingTweet",
    props: {
        height: String,
        base_id: String,
    },

    setup(props, context){
        watch(props, ()=>{
            console.log(props.height)
            const elm = document.getElementById(id)
            const height = parseInt(props.height) + 20
            elm.style.height = height.toString() + 'px'
        })
        const id = props.base_id + '-loading'
        onMounted(()=>{
            const elm = document.getElementById(id)

            elm.style.height = props.height + 'px'
            console.log(elm.style.height)

            context.emit('LoadingMounted')
        })

        console.log('props.height', props.height)
        return { id, }
    }
}
</script>

<style scoped>

</style>
