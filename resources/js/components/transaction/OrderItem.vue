<template>
    <div class="order">
        <div class="order__body">
            <a :href="'/product/'+order.product.id" class="order__name title3">
                {{ order.product.name }}
            </a>
            <div class="order__sum">
                {{ price }}₴ x {{ order.count }} = {{ price*order.count }} ₴
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "OrderItem",
    props : ['order'],
    computed : {
        price(){
            return this.order.product.discount_price ?? this.order.product.price;
        }
    }
}
</script>

<style scoped>
.order{

}
.order__body{
    display: flex;
    flex-direction: column;
    align-items: center;
    padding: 5px 10px;
}
.order__name{
    display: block;
}
.order__sum{
    color: #38c172;
    text-shadow: none;
}
</style>
