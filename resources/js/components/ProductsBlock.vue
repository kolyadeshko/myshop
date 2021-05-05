<template>
    <div class="pb__body">
        <div class="pb__title">
            {{ title }}
        </div>
        <spin v-if="loading"></spin>
        <div class="pb__row" v-else>
            <product-card
                v-for="product in products"
                :product="product"
                :key="product.id"
            >
            </product-card>
        </div>
    </div>
</template>

<script>
import Spin from "../components/Spin";
import ProductCard from "../components/ProductCard";
import axios from 'axios';

export default {
    name: "ProductsBlock",
    components: {
        Spin, ProductCard
    },
    props: {
        type: {
            type: String,
            default: [1, 2, 3, 4]
        },
        title : {
            type : String
        }
    },
    mounted() {
        this.getProducts()
    },
    data: () => ({
        products: [],
        loading: true
    }),
    methods: {
        getProducts() {
            axios.get('/api/get-product-blocks', {
                params: {
                    type: this.type
                }
            })
                .then(response => {
                    this.products = response.data;
                    this.loading = false;
                })
        }
    }
}
</script>

<style scoped>
.pb__body {
    border: 1px solid black;
    position: relative;
}

.pb__title {

}

.pb__row {
    display: flex;
}
</style>
