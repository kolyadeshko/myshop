<template>
    <div v-if="discount_price" class="prod-card__discount-percents">
        -{{ calcDiscountPercents() }}%
    </div>
</template>

<script>
export default {
name: "DiscountPercents",
    props : ['price','discount_price'],
    methods : {
        calcDiscountPercents(){
            return Math.round((this.price - this.discount_price) / this.price * 100);
        }
    }

}
</script>

<style scoped>
.prod-card__discount-percents{
    position: absolute;
    top:0;
    right: 0;
    padding: 10px;
    background-color: red;
    border-bottom-left-radius: 50%;

}
</style>
