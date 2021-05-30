<template>
    <div class="trans-status">
        <div class="trans-status__container">
            <div class="trans-status__title title3">
                Статус заказа: {{ transactionStatusText }}
            </div>
            <div class="trans-status__body">
                <transaction-status-line
                    :statuses="transactionStatuses"
                    :current-status="transactionStatusId"
                ></transaction-status-line>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';
import Spin from "../Spin";
import TransactionStatusLine from "./TransactionStatusLine";

export default {
    name: "TransactionStatus",
    props : ['transactionStatusId'],
    components : {
        Spin,
        TransactionStatusLine
    },
    mounted() {
        this.getTransactionStatuses();
    },
    data : () => ({
        transactionStatuses : [],
        loading: true
    }),
    methods : {
        getTransactionStatuses(){
            axios.get('/api/transaction-statuses')
            .then( response => {
                this.transactionStatuses = response.data;
                this.loading = false;
            })
        }
    },
    computed : {
        transactionStatusText()
        {
            for (let status of this.transactionStatuses)
            {
                if (status.id === Number(this.transactionStatusId)) return status.status;
            }
        }
    }
}
</script>

<style scoped>
.trans-status{

}
.trans-status__container{
    width: 80%;
    margin: 0 auto;
}
.trans-status__title{

}
.trans-status__body{

}
</style>
