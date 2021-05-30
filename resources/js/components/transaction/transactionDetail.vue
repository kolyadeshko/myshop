<template>
    <div class="trans-detail">
        <div class="trans-detail__deleted title1" v-if="deleted">
            Удалено
        </div>
        <div class="trans-detail__container" v-else>
            <div class="trans-detail__first-column">
                <div class="trans-detail__title title1">
                    Заказ №{{ transactionId }}
                </div>
                <spin v-if="loading"></spin>
                <div class="trans-detail__body" v-else>
                    <div class="trans-detail__status">
                        <transaction-status :transaction-status-id="statusId"></transaction-status>
                    </div>
                    <div class="trans-detail__buttons">
                        <div class="trans-detail__delete-btn button" @click="deleteTransaction">
                            Удалить заказ
                        </div>
                        <div class="trans-detail__delete-btn button" @click="changeStatus" v-if="statusId ==1 || statusId==2">
                            <span v-if="statusId==1">Оформить</span>
                            <span v-else-if="statusId==2">Вернуться в статус оформления заказа</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="trans-detail__second-column">
                <spin v-if="loading"></spin>
                <div class="orders" v-else>
                    <orders-list :orders="orders"></orders-list>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

import axios from 'axios';
import TransactionStatus from "./TransactionStatus";
import OrdersList from "./OrdersList";
import Spin from "../Spin";

export default {
    name: "transactionDetail",
    props : ['transactionId','transStatusId'],
    components : {
        TransactionStatus,
        OrdersList,
        Spin
    },
    data : () => ({
        orders : [],
        loading : true,
        statusId : null,
        deleted : false
    }),
    mounted() {
        this.getOrders();
        this.statusId = this.transStatusId;
    },
    methods : {
        getOrders(){
            this.loading = true;
            axios.get('/api/get-orders-by-transaction-id/' + this.transactionId)
            .then( response => {
                this.orders = response.data;
                this.loading = false;
            })
        },
        changeStatus()
        {
            this.loading = true;
            if (this.statusId == 1) {
                this.statusId = 2;
            }else if(this.statusId == 2){
                this.statusId = 1;
            }
            axios.get('/api/change-transaction-status',{
                params : {
                    transactionId : this.transactionId
                }
            })
            .then(response => {
                this.getOrders();
            })
        },
        deleteTransaction(){
            this.deleted = true;
            axios.get('/api/delete-my-transaction/' + this.transactionId)
                .then(response => {

                });
        }
    }
}
</script>

<style scoped>
.trans-detail{

}
.trans-detail__container{
    width: 80%;
    margin:20px auto;
    display:flex;
    justify-content: center;
}
.trans-detail__container>*{
    margin: 0 10px;
    min-height:100px;
    position: relative;
    box-shadow: rgba(0, 0, 0, 0.07) 0px 1px 2px, rgba(0, 0, 0, 0.07) 0px 2px 4px, rgba(0, 0, 0, 0.07) 0px 4px 8px, rgba(0, 0, 0, 0.07) 0px 8px 16px, rgba(0, 0, 0, 0.07) 0px 16px 32px, rgba(0, 0, 0, 0.07) 0px 32px 64px;
}
.trans-detail__first-column{
    flex: 1 1 65%
}
.trans-detail__second-column{
    flex:1 1 35%;
}
.trans-detail__title{
    margin: 10px ;
    text-align:center;
}
.trans-detail__body{

}
.trans-detail__status{

}
.trans-detail__buttons{
    padding: 20px 0;
    display: flex;
    justify-content: space-around;
}
.trans-detail__deleted{
    margin: 20px auto;
    text-align: center;
}
</style>
