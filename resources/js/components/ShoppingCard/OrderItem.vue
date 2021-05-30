<template>
    <div class="order-item">
        <div class="order-item__container">
            <div class="order-item__row">
                <div class="order-item__img">
                    <img :src="'/storage/'+order.product.img" alt="">
                </div>
                <a :href="'/product/'+order.product.id" class="order-item__body">
                    <div class="order-item__body-item">{{ order.product.name }}</div>
                    <div class="order-item__body-item">Сумма: {{ orderSum }} грн.</div>
                    <div class="order-item__body-item">Количество единиц: {{ order.count }}</div>
                    <div class="order-item__body-item">Цена товара: {{ price }} грн.</div>
                </a>
                <div class="order-item__cross" @click="deleteMyOrderFromTransaction">
                    ✖
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "OrderItem",
    props: {
        order: {}
    },
    data : () => ({

    }),
    computed : {
        price(){
            return this.order.product.discount_price ?? this.order.product.price;
        },
        orderSum(){
            return this.price * this.order.count;
        },
    },
    methods : {
        deleteMyOrderFromTransaction()
        {
            this.$emit(
                'delete-order-from-transaction',
                this.order.id
            )
        }
    }
}
</script>

<style scoped>
.order-item{

}
.order-item__container{
    margin: 0 0 0 20px;
    padding: 10px;
    /*height: 100px;*/
    box-shadow: rgba(0, 0, 0, 0.07) 0px 1px 2px, rgba(0, 0, 0, 0.07) 0px 2px 4px, rgba(0, 0, 0, 0.07) 0px 4px 8px, rgba(0, 0, 0, 0.07) 0px 8px 16px, rgba(0, 0, 0, 0.07) 0px 16px 32px, rgba(0, 0, 0, 0.07) 0px 32px 64px;
}
.order-item__row{
    display: flex;
    align-items: center;
}
.order-item__img{
    height: 100%;
    flex: 0 1 10%;
}
.order-item__img>img{
    display: block;
    max-height: 70px;
}
.order-item__body{
    flex: 1 1 70%;
    display: flex;
    flex-wrap: wrap;
    padding: 0 15px;
}
.order-item__body>*{
    flex: 1 1 50%;
    margin:5px 0;
}
.order-item__body-item{
    color:#1a202c;
    text-shadow:none
}
.order-item__cross{
    flex: 0 1 10%;
    font-size: 30px;
    color: #38c172;
    text-align: center;
    user-select: none;
    cursor: pointer;
}
</style>
