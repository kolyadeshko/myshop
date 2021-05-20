<template>
    <div class="shop-card">
        <div class="shop-card__container">
            <div class="shop-card__nav">
                <div class="shop-card__title">
                    Корзина
                </div>
                <div class="shop-card__cross" @click="closeShopCard">
                    ✖
                </div>
            </div>
            <div class="shop-card__body">
                <spin></spin>
            </div>
        </div>
    </div>
</template>

<script>
import Spin from "../Spin";

export default {
    name: "ShoppingCard",
    components : {
        Spin
    },
    methods : {
        closeShopCard(){
            this.$emit('close-shop-card');
        }
    }
}
</script>

<style scoped>
.shop-card{
    position: fixed;
    top:50%;
    left: 50%;
    width: 100%;
    transform: translate(-50%,-50%);
    z-index: 2;
}
.shop-card__container{
    width: 50%;
    margin: 0 auto;
}
.shop-card__nav{
    background-color: #38c172;
    display: flex;
    padding: 10px;
    justify-content: space-between;
}
.shop-card__title{

}
.shop-card__cross{
    font-size: 20px;
    user-select: none;
    cursor: pointer;
}
.shop-card__body{
    border:2px solid #38c172;
    position: relative;
    background-color: white;
    min-height: 500px;
}
</style>
