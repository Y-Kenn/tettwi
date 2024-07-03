<template>
    <div>test</div>
</template>

<script>
import { defineProps } from "vue";

const props = defineProps({
    test: {
        type: String,
        required: true,
    },
});
const un = 'chinko'
console.log(props)

</script>

<style scoped>

</style>
