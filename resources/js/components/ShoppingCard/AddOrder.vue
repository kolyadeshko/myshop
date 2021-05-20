<template>
    <div class="add-order">
        <div v-if="loading" class="add-order__spin">
            <spin ></spin>
        </div>
        <div class="add-order__container">
            <div class="add-order__title title3">
                Добавить в корзину
            </div>
            <div class="add-order__body">
                <div class="add-order__counter">
                    <div class="add-order__decr" @click="decr">
                        -
                    </div>
                    <div class="add-order__count">
                        {{ unitsNum }}
                    </div>
                    <div class="add-order__incr" @click="incr">
                        +
                    </div>
                </div>
                <div v-if="unitsNum" class="add-order__total-cost">
                    {{ totalCost }}
                </div>
                <div v-if="false" class="add-order__message">
                </div>
                <div :class="{ active : unitsNum }" @click="addProductToShoppingCard" class="add-order__btn">
                    Добавить в корзину
                </div>
                <div v-if="answer" class="add-order__answer">
                    <div :class="{ 'red' : !answer.status }" class="add-order__answer-text">
                        {{ answer.message }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';
import Spin from "../Spin";

export default {
    name: "AddOrder",
    props: ['product'],
    components: {
        Spin
    },
    data: () => ({
        unitsNum: 0,
        loading: false,
        answer: false
    }),
    methods: {
        decr() {
            if (this.unitsNum > 0) {
                this.unitsNum--;
            }
        },
        incr() {
            if (this.unitsNum < 100) {
                this.unitsNum++;
            }
        },
        addProductToShoppingCard() {
            this.loading = true;
            axios.post(
                '/api/add-order-to-cart',
                {
                    'product_id': this.product.id,
                    'count': this.unitsNum
                },
                {
                    headers: {
                        'Content-type': "application/json"
                    }
                }
            )
                .then(response => {
                    if (response.data.status) {
                        this.unitsNum = 0;
                    }
                    this.answer = response.data;
                    this.loading = false
                })
        }
    },
    computed: {
        totalCost() {
            if (this.unitsNum) {
                return "Всего: " +
                    (this.unitsNum *
                        (this.product.discount_price ?? this.product.price)
                    ) + ' грн';
            }
        }
    }
}
</script>

<style scoped>
.add-order {
    position: relative;
}

.add-order__container {

}

.add-order__title {

}

.add-order__body {

}

.add-order__counter {
    padding: 10px 0;
    display: flex;
    width: 100%;
}

.add-order__decr, .add-order__incr {
    width: 40px;
    text-align: center;
    padding: 10px 0;
    background-color: #38c172;
    user-select: none;
    cursor: pointer;
}

.add-order__decr {
    border-bottom-left-radius: 20px;
    border-top-left-radius: 20px;
}

.add-order__count {
    flex: 1 1 auto;
    text-align: center;
    padding: 5px 0;
    font-size: 22px;
    color: black;
    text-shadow: none;
    border-top: 2px solid #38c172;
    border-bottom: 2px solid #38c172;
}

.add-order__incr {
    border-bottom-right-radius: 20px;
    border-top-right-radius: 20px;
}

.add-order__btn {
    display: none;
    background-color: #38c172;
    border-radius: 5px;
    overflow: hidden;
    padding: 10px;
    user-select: none;
    margin: 10px 0;
    cursor: pointer;
}

.add-order__btn.active {
    display: block;
}

.add-order__total-cost {
    text-align: center;
    color: #9d9d9d;
    text-shadow: none;
}

.add-order__answer {

}

.add-order__answer-text {
    text-align: center;
    text-shadow: none;
    font-size: 13px;
    color: green;
}
.add-order__spin{
    position: absolute;
    top:0;
    left: 0;
    height: 100%;
    width: 100%;
}
.red{
    color:red;
}
</style>
