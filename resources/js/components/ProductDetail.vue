<template>
    <div class="prod-detail">
        <div class="prod-detail__container">
            <spin v-if="!productLocal"></spin>
            <div v-else class="prod-detail__title title2">
                {{ productLocal.name }}
            </div>
            <div v-if="productLocal" class="prod-detail__body">
                <div class="prod-detail__img" >
                    <img :src="'/storage/' + this.productLocal.img" alt="">
                </div>
                <div class="prod-detail__info">
                    <price style="font-size: 30px;"
                        :price="productLocal.price"
                        :discount_price="productLocal.discount_price"
                    >
                    </price>
                    <discount-price
                        :price="productLocal.price"
                        :discount_price="productLocal.discount_price"
                    ></discount-price>
                    <add-order
                        :product="productLocal"
                    ></add-order>
                </div>
            </div>
        </div>
        <div class="prod-detail__block" v-if="productLocal">
            <products-block
                :title="'Похожи товары'"
                :type="productLocal.type_id"
                :without="[productLocal.id]"
            ></products-block>
        </div>
    </div>
</template>
<script>

import Price from "../components/productCard/Price";
import DiscountPrice from "../components/productCard/DiscountPercents";
import ProductsBlock from "../components/ProductsBlock";
import Spin from "../components/Spin";

import axios from 'axios';
import AddOrder from "./ShoppingCard/AddOrder";

export default {
    name: "ProductDetail",
    props : ['productId'],
    components : {
        Price,
        DiscountPrice,
        ProductsBlock,
        Spin,
        AddOrder
    },
    beforeMount() {
        this.getSingleProduct()
    },
    data : () => ({
        productLocal : false,
    }),
    methods : {
        getSingleProduct(){
            axios.get(`/api/product/${this.productId}`)
            .then(response => {
                this.productLocal = response.data;
            })
        }
    }
}
</script>

<style scoped>
.prod-detail{

}
.prod-detail__container{
    width: 70%;
    margin: 0 auto;
    position: relative;
    min-height: 200px;
    box-shadow: rgba(0, 0, 0, 0.07) 0px 1px 2px, rgba(0, 0, 0, 0.07) 0px 2px 4px, rgba(0, 0, 0, 0.07) 0px 4px 8px, rgba(0, 0, 0, 0.07) 0px 8px 16px, rgba(0, 0, 0, 0.07) 0px 16px 32px, rgba(0, 0, 0, 0.07) 0px 32px 64px;
}
.prod-detail__title{
    text-align: center;
    margin:15px 0;
}
.prod-detail__body{
    display: flex;
    align-items: center;
}
.prod-detail__img{
    flex:1 1 70%;
    padding: 20px
}
.prod-detail__img>img{
    display: block;
    margin:0 auto;
    max-width: 100%;
    max-height: 550px;
}
.prod-detail__info{
    flex:1 1 30%;
    display: flex;
    flex-direction: column;
    align-items: center;
    padding: 20px

}
.prod-detail__block{
    margin:15px 0;
}
</style>
