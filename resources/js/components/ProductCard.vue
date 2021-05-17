<template>
    <a :href="'/product/' + product.id" class="prod-card">
        <div class="prod-card__body">
            <div class="prod-card__row">
                <div class="prod-card__img">
                    <img :src="'/storage/' + product.img" alt="">
                </div>
                <discount-price
                    :discount_price="product.discount_price"
                    :price="product.price"
                >
                </discount-price>
                <div class="prod-card__name title3">
                    {{ product.name }}
                </div>
                <price
                    :price="product.price"
                    :discount_price="product.discount_price"
                >
                </price>
            </div>
        </div>
    </a>
</template>

<script>
import Price from "../components/productCard/Price";
import DiscountPrice from "../components/productCard/DiscountPercents";


export default {
    name: "ProductCard",
    props : ['product'],
    components : {
        Price,DiscountPrice
    },

}
</script>

<style scoped>
.prod-card{
    display: block;
}
.prod-card__body{
    padding: 5px;
    position:relative;
    /*height: 400px;*/
    overflow: hidden;
    box-shadow: rgba(0, 0, 0, 0.07) 0px 1px 2px, rgba(0, 0, 0, 0.07) 0px 2px 4px, rgba(0, 0, 0, 0.07) 0px 4px 8px, rgba(0, 0, 0, 0.07) 0px 8px 16px, rgba(0, 0, 0, 0.07) 0px 16px 32px, rgba(0, 0, 0, 0.07) 0px 32px 64px;
}
.prod-card__row:hover > .prod-card__img{
    transform: scale(1.05);
}
.prod-card__row{
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
}
.prod-card__row>*{
    margin: 10px 0;
}
.prod-card__img{
    height: 300px;
    transition: all 0.05s;
}
.prod-card__img>img{
    display: block;
    max-height: 100%;
}
.prod-card__name{
    font-size: 20px;
    text-align: center;
    padding: 0 10px;
}

</style>
