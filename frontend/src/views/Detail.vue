<template>
    <div id="content">
        i am content
    </div>
</template>

<script>
export default {
    data(){
        return {
            msg: "content"
        }
    },
    mounted(){
        console.log(this.$route.params)
    }
}
</script>