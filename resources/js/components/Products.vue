<template>
    <div class="products">
        <div class="products__container">
            <div class="products__filter">
                <div class="prod-filter">
                    <div class="prod-filter__container">
                        <div class="prod-filter__title title1">
                            Фильтры
                        </div>
                        <div class="prod-filter__body">
                            <products-filter
                                :product-type="productType.id"
                                v-on:apply-conditions="applyConditions"
                            ></products-filter>
                        </div>
                    </div>
                </div>
            </div>
            <div class="products__list">
                <div class="prod-list">
                    <div class="prod-list__container">
                        <div class="prod-list__title title1">
                            {{ productType.name }}
                        </div>
                        <div class="prod-list__body">
                            <spin v-if="loading"></spin>
                            <product-card
                                v-else
                                v-for="product in products"
                                :key="product.id"
                                :product="product"
                            >
                            </product-card>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';
import Spin from "../components/Spin";
import ProductsFilter from "../components/ProductsFilter";

export default {
    name: "Products",
    components: {
        Spin,ProductsFilter
    },
    props: ['productType'],
    mounted() {
        this.getProducts()
    },
    data: () => ({
        conditions: [],
        products: [],
        loading : true
    }),
    methods: {
        getProducts() {
            axios.get(`/api/products-type/${this.productType.id}`, {
                params: {
                    'downLevelTypes' : this.conditions.downLevelTypes,
                    'promotionType' : this.productType.id == 0 ? 'with' : this.conditions.promotionType
                }
            })
                .then(response => {
                    this.products = response.data;
                    this.loading = false
                })
        },
        applyConditions(conditions){
            this.conditions = conditions;
            this.loading = true;
            this.getProducts();
        }
    }
}
</script>

<style scoped>
.products {

}

.products__container {
    padding:10px;
    display: flex;
}

.products__filter {
    flex: 1 1 25%;
}

.prod-filter {

}

.prod-filter__container {
    padding: 10px;
}

.prod-filter__title {
    text-align: center;
}

.prod-filter__body {
    margin: 10px 0;
    padding: 0 10px;
    box-shadow: rgba(0, 0, 0, 0.07) 0px 1px 2px, rgba(0, 0, 0, 0.07) 0px 2px 4px, rgba(0, 0, 0, 0.07) 0px 4px 8px, rgba(0, 0, 0, 0.07) 0px 8px 16px, rgba(0, 0, 0, 0.07) 0px 16px 32px, rgba(0, 0, 0, 0.07) 0px 32px 64px;
}

.products__list{
    flex: 1 1 75%;
}
.prod-list{

}
.prod-list__container{
    padding: 10px;
}
.prod-list__title{
    text-align: center;
}
.prod-list__body{
    display: flex;
    flex-wrap: wrap;
    justify-content: space-around;
    position: relative;
    min-height: 200px;
}
.prod-list__body>*{
    flex: 0 1 30%;
    margin: 10px 0;
}
</style>
