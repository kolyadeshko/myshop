<template>
    <a :href="'/product/' + product.id" class="prod-card">
        <div class="prod-card__body">
            <div class="prod-card__row">
                <div class="prod-card__img">
                    <img :src="'storage/' + product.img" alt="">
                </div>
                <div class="prod-card__name">
                    {{ product.name }}
                </div>
            </div>
        </div>
    </a>
</template>

<script>
export default {
    name: "ProductCard",
    props : ['product']
}
</script>

<style scoped>
.prod-card{
    display: block;
}
.prod-card__body{
    padding: 5px;
}
.prod-card__row{
    display: flex;
    flex-direction: column;
    align-items: center;
}
.prod-card__img{
    height: 200px;
}
.prod-card__img>img{
    display: block;
    max-height: 100%;
}
.prod-card__name{
}
</style>
