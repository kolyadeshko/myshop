<template>
<div v-if="!loading && conditions.downLevelTypes">
    <div v-for="type in conditions.downLevelTypes">
        {{ type.name }}
    </div>
</div>
</template>

<script>
import axios from 'axios';
import Spin from "../components/Spin";


export default {
    name: "ProductsFilter",
    components : {
        Spin
    },
    props : {
        productType :
            {
                type : Number
            }
    },
    mounted() {
        this.getConditions();
    },
    data : () => ({
        conditions : {},
        loading : true
    }),
    methods : {
        getConditions(){
            axios.get(`/api/products-filter/${this.productType}`)
                .then(response => {
                    this.conditions = response.data
                    this.loading = false
                });
        }
    }
}
</script>

<style scoped>

</style>
