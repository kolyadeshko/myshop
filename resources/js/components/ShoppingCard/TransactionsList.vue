<template>
    <div class="transactions">
        <div class="transactions__container">
            <spin v-if="loading"></spin>
            <div v-else class="transactions__body">
                <div class="transactions__row">
                    <div v-for="transaction in transactions" class="transaction__orders-list">
                        <orders-list
                            :can-delete-transaction="canDeleteTransaction"
                            title="Ваши сохраненные товары"
                            :transaction="transaction"
                            v-on:delete-transaction="deleteTransaction"
                        ></orders-list>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from "axios";
import Spin from "../Spin";
import OrdersList from "./OrdersList";

export default {
    name: "TransactionsList",
    props: {
        transactionStatus: {
            default: 1
        },
        canDeleteTransaction :
            {
                default: true
            }
    },
    components: {
        OrdersList,
        Spin
    },
    data: () => ({
        transactions: [],
        loading: true
    }),
    mounted() {
        this.getTransactions();
    },
    methods: {
        getTransactions() {
            axios.get('/api/get-transactions', {
                params : {
                    transactionStatus: this.transactionStatus
                }
            })
                .then(response => {
                    this.transactions = response.data;
                    this.loading = false;
                })
        },
        deleteTransaction(transactionId){
            this.loading = true;
            axios.get('/api/delete-my-transaction/' + transactionId)
            .then(response => {
                this.transactions = this.transactions.filter((transaction) => transaction.id !== transactionId);
                this.loading = false;
            });
        }
    }
}
</script>

<style scoped>

</style>
