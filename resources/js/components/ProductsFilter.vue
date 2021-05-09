<template>
    <div class="prod-filter">
        <div class="prod-filter__body">
            <spin v-if="loading"></spin>
            <div class="prod-filter__item" v-else-if="!loading && conditions.downLevelTypes">
                <div class="prod-filter__title title3">
                    Категории
                </div>
                <div class="prod-filter__types">
                    <div class="types">
                        <div class="type__item" v-for="type in conditions.downLevelTypes">
                            <input
                                v-model="downLevelTypes"
                                :id="'down-level-type-'+type.id"
                                name="down-level-types"
                                :value="type.id"
                                type="checkbox"
                                class="type__input input"
                            >
                            <label
                                :for="'down-level-type-'+type.id"
                                class="type__text input__text"
                            >
                                {{ type.name }}
                            </label>
                        </div>
                    </div>
                </div><hr>
            </div>

            <div class="prod-filter__item">
                <div class="prod-filter__title title3">
                    Акции
                </div>
                <div class="prod__promotions">
                    <div class="promotions">
                        <div class="promotion__item">
                            <input
                                type="radio"
                                name="promotion"
                                value="all"
                                v-model="promotionType"
                                id="promotions-all"
                                class="promotions__input input">
                            <label for="promotions-all" class="input__text">Все</label>
                        </div>
                        <div class="promotion__item">
                            <input
                                type="radio"
                                value="with"
                                name="promotion"
                                v-model="promotionType"
                                id="promotions-with"
                                class="promotions__input input">
                            <label for="promotions-with" class="input__text">Только акционные</label>
                        </div>
                        <div class="promotion__item">
                            <input
                                type="radio"
                                v-model="promotionType"
                                name="promotion"
                                value="without"
                                id="promotions-without"
                                class="promotions__input input">
                            <label for="promotions-without" class="input__text">Только без акции</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="prod-filter__button button" v-on:click="applyConditions">
                Применить
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';
import Spin from "../components/Spin";


export default {
    name: "ProductsFilter",
    components: {
        Spin
    },
    props: {
        productType:
            {
                type: Number
            }
    },
    mounted() {
        this.getConditions();
    },
    data: () => ({
        conditions: {},
        loading: true,
        downLevelTypes: [],
        promotionType: "all"
    }),
    methods: {
        getConditions() {
            axios.get(`/api/products-filter/${this.productType}`)
                .then(response => {
                    this.conditions = response.data
                    this.loading = false
                });
        },
        applyConditions(){
            this.$emit('apply-conditions',{
                'downLevelTypes' : this.downLevelTypes,
                'promotionType' : this.promotionType
            })
        }
    },

}
</script>

<style scoped>
.prod-filter {

}

.prod-filter__body {
    padding: 10px;
    position: relative;
}

.prod-filter__item {
    margin: 10px 0;
}

.prod-filter__title {

}

.prod-filter__types {

}

.type {

}

.type__item {

}

.type__input {

}

.type__text {

}

.input {

}

.input__text {
    color: #4a5568;
    text-shadow: none;
}

.prod-filter__button {
    margin: 10px auto;
    width: 100%;
    text-align: center;
}
</style>
