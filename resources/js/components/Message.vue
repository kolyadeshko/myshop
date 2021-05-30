<template>
    <div class="message" :class="{ 'none' : hidden }">
        <div class="message__container">
            <div class="message__title title2">
                Внимание!
            </div>
            <div class="message__body">
                {{ text }}
            </div>
            <div class="message__cross" @click="hidden = true">
                ×
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "Message",
    props : {
        text : {
            type : String,
        },

    },
    data : () => ({
        hidden : false
    }),
    mounted() {
        setTimeout(() => {this.hidden = true},6000)
    }
}
</script>

<style scoped>
.message{
    margin-top:15px;
    bottom: 15px;
    left: 50%;
    position: fixed;
    z-index: 2;
    transform: translate(-50%,0);
}
.message__container{
    margin: 0 auto;
    width: 100%;
    background-color: #68ca91;
    position: relative;
    border-radius: 10px;
}
.none{
    display: none;
}

.message__title{
    color: #FFFFFF;
    padding:10px 10px 0 10px;
}
.message__body{
    padding: 15px;
}
.message__cross{
    top:0;
    right:0;
    position: absolute;
    font-size: 25px;
    padding:0 10px;
    cursor: pointer;
}

</style>
