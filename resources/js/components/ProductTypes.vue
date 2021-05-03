<template>
    <div class="prod-types">
        <div class="prod-types__body">
            <div class="prod-types__content" @click="changeMainDropActive">
                <div class="prod-types__text">
                    Все товары
                </div>
                <div class="prod-types__down" :class="{ 'active' : mainDropActive }">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                         class="bi bi-arrow-down-circle" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" color="green"
                              d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8zm15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8.5 4.5a.5.5 0 0 0-1 0v5.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V4.5z"/>
                    </svg>
                </div>
            </div>
            <div class="prod-types__main-drop" v-if="mainDropActive">
                <div v-html="buildMenu(productTypes)">
                </div>
            </div>
        </div>
    </div>

</template>
<script>
import axios from 'axios';
import Spin from "../components/Spin";

export default {
    name: "ProductTypes",
    components: {
        Spin
    },
    mounted() {
        this.getProductTypes();
    },
    data: () => ({
        productTypes: [],
        mainDropActive : false
    }),
    methods: {
        changeMainDropActive: function (){
            this.mainDropActive = !this.mainDropActive;
        },
        getProductTypes: function () {
            axios.get('/api/product-types')
                .then(response => {
                    this.productTypes = response.data;
                    console.log(this.productTypes);
                })
        },
        buildMenu : function (typeObjects)
        {
            let res = "";
            let pointer = "<span class='pointer'>></span>";
            for (let typeObject of typeObjects)
            {
                let drop = "";
                let link = "";
                let hasChildren = 'children' in typeObject;
                link =
                    `<a class="link__link" href='/category/${typeObject.id}'>`+
                    `<div class="link__text">${typeObject.name}</div>` + (hasChildren ? pointer : "") +
                    `</a>`
                if (hasChildren)
                {
                    drop = `<div class="link__dropdown">` +
                        this.buildMenu(typeObject.children) +
                        `</div>`;
                }
                res += "<div class='link__item'>" + link + drop + "</div>";
            }
            return res;

        }
    }
}
</script>

<style scoped>
.prod-types {
    position: relative;
}

.prod-types__body {
    display: flex;
    padding: 5px ;
    border-radius: 8px;
    cursor: pointer;
    border: 3px solid #298800;
}
.prod-types__content{
    display: flex;
    align-items: center;
}
.prod-types__content > * {
    margin: 0 5px;
}

.prod-types__text {
    font-size: 18px;
}

.prod-types__down {
    display: flex;
    align-items: center;
}
.prod-types__down.active{
    transform: rotate(180deg);
}
.prod-types__main-drop{
    position: absolute;
    top:100%;
    left: 0;
    user-select: none;
    border:4px solid #298800;
    border-radius: 2px;
    border-top:none;
}
</style>
<style>
.link__dropdown{
    display: none;
    left: 100%;
    top:0;
    position: absolute;
    border:4px solid #298800;
    border-radius: 2px;
}
.link__item{
    position: relative;
    background-color: #38c172;
    padding: 3px 10px;
}
.link__link{
    padding: 5px;
    display: flex;
    justify-content: space-between;
    align-items: center;
}
.link__item:hover>.link__dropdown{
    display: block;
}
.link__item:hover{
    background-color: #68ca91;
}
.link__link:hover>.pointer{
    transform: scale(1.4);
}
.pointer{
    font-size: 21px;
    margin-left: 10px;
}
</style>
