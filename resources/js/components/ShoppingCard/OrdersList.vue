<template>
    <div class="orders-list">
        <div class="orders-list__container">
            <div class="orders-list__title">
                <div class="orders-list__transaction-name">
                    {{ title }}
                </div>
                <div class="orders-list__total-sum">
                    Сумма: {{ calculateSum }} грн.
                </div>
                <a href="/transaction" v-if="transaction.transaction_status_id === 1 && transaction.orders.length > 0" class="orders-list__btn button">
                    Оформить
                </a>
                <div v-if="canDeleteTransaction" class="orders-list__cross" title="Удалить данный список товаров" @click="deleteTransaction">
                    ✖
                </div>
            </div>
            <div class="orders-list__row">
                <div v-for="order in transaction.orders" class="orders-list__item">
                    <order-item v-on:delete-order-from-transaction="deleteOrderFromTransaction"
                                :order="order"></order-item>
                </div>
            </div>

        </div>
    </div>
</template>

<script>
import axios from 'axios';
import Spin from "../Spin";
import OrderItem from "./OrderItem";

export default {
    name: "OrdersList",
    props: {
        transaction: {},
        title: {
            type: String
        },
        canDeleteTransaction: {

        }
    },
    components: {
        OrderItem
    },
    data: () => ({}),
    computed: {
        calculateSum() {
            let sum = 0;
            for (let order of this.transaction.orders) {
                let price = order.product.discount_price ?? order.product.price;
                sum += order.count * price;
            }
            return sum;
        }
    },
    methods: {
        deleteTransaction() {
            this.$emit('delete-transaction', this.transaction.id)
        },
        deleteOrderFromTransaction(orderId) {
            axios.get('/api/delete-order-from-transaction', {
                params: {
                    orderId: orderId,
                    transactionId: this.transaction.id
                }
            }).then(response => {
                this.transaction.orders = this.transaction.orders.filter((order) => order.id !== orderId);
            })
        }
    }
}
</script>

<style scoped>
.orders-list {

}

.orders-list__container {

}

.orders-list__title {
    background-color: #2db800;
    padding: 10px;
    box-shadow: rgba(60, 64, 67, 0.3) 0px 1px 2px 0px, rgba(60, 64, 67, 0.15) 0px 1px 3px 1px;    display: flex;
    align-items: center;
    justify-content: space-between;
}

.orders-list__transaction-name {

}

.orders-list__total-sum {

}

.orders-list__cross {
    font-size: 30px;
    cursor: pointer;
    user-select: none;
}

.orders-list__item {
    margin: 20px;
}
.orders-list__btn{

}
</style>
