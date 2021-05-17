<template>
    <div class="pb__body">
        <a :href="getUrl()" class="pb__title title2">
            {{ title }}
        </a>
        <spin v-if="loading"></spin>
        <div class="pb__row" v-else>
            <product-card
                v-if="!without.includes(product.id)"
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
        type : {

        },
        title : {

        },
        without : {
            default : []
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
        },
        getUrl()
        {
            if (this.type === 'promotion-products')
            {
                return this.type;
            }
            else
            {
                return '/products-type/' + this.type;
            }
        }
    }
}
</script>

<style scoped>
.pb__body {
    /*border: 1px solid black;*/
    position: relative;
    min-height: 200px;
}

.pb__title {
    display: block;
    text-align: center;
}

.pb__row {
    display: flex;
    justify-content: center;
    align-items: center;
}
.pb__row>*{
    margin: 0 20px;
    flex: 0 1 22%;
}
</style>
