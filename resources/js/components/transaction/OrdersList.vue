<template>
<div class="orders">
    <div class="orders__container">
        <div class="orders__title title2">
            Чек: {{ calculateSum }} ₴
        </div>
        <div class="orders__body">
            <div class="orders__item" v-for="order in orders">
                <order-item :order="order"></order-item>
            </div>
        </div>
    </div>
</div>
</template>

<script>

import OrderItem from "./OrderItem";

export default {
    name: "OrdersList",
    props : ['orders'],
    components : {
        OrderItem
    },
    computed: {
        calculateSum() {
            let sum = 0;
            for (let order of this.orders) {
                let price = order.product.discount_price ?? order.product.price;
                sum += order.count * price;
            }
            return sum;
        }
    },
}
</script>

<style scoped>
.orders{

}
.orders__container{
    padding: 0 0 0 15px;
}
.orders__title{
    margin: 10px;
}
.orders__body{
    padding: 10px 0;
}
.orders__item{

}
</style>
