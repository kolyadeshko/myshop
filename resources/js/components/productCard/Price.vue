<template>
    <div class="prod-card__price">
        <div class="title3">Цена:</div>
        <span class="discount-price" v-if="discount_price">
                        {{ discount_price }}
                    </span>
        <span class="price" :class="{ 'through' : discount_price}">{{ price}}</span>
    </div>
</template>

<script>
export default {
    name: "Price",
    props : ['price','discount_price']
}
</script>

<style scoped>
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
