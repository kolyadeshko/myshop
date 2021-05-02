<template>
    <img class="spin" src="/img/Loader.gif" alt="">
</template>

<script>
export default {
name: "Spin"
}
</script>

<style scoped>
.spin{
    position: absolute;
    top:50%;
    left: 50%;
    transform: translate(-50%,-50%);
    height: 20%;
}
</style>
