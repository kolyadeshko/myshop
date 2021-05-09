<template>
    <a :href="'/product/' + product.id" class="prod-card">
        <div class="prod-card__body">
            <div class="prod-card__row">
                <div class="prod-card__img">
                    <img :src="'/storage/' + product.img" alt="">
                </div>
                <div class="prod-card__name title3">
                    {{ product.name }}
                </div>
                <div class="prod-card__price">
                    <div class="title3">Цена:</div>
                    <span class="discount-price" v-if="product.discount_price">
                        {{ product.discount_price }}
                    </span>
                    <span class="price" :class="{ 'through' : product.discount_price}">{{ product.price}}</span>
                </div>
            </div>
        </div>
    </a>
</template>

<script>
export default {
    name: "ProductCard",
    props : ['product']
}
</script>

<style scoped>
.prod-card{
    display: block;
}
.prod-card__body{
    padding: 5px;
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
.prod-card__price{

}
.price{
    color: green;
    font-size: 25px;
}
.price.through{
    text-decoration: line-through;
    color:red;
    font-size: 19px;
}
.discount-price{
    font-size: 25px;
    color: green;
}
</style>
