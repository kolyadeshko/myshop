<template>
    <div class="form__item">
        <div class="form__input">
            <label class="form__title title2" :for="name">
                {{ title }}:
            </label>
            <input :id="name" :name="name" :type="type">
        </div>
    </div>

</template>

<script>
export default {
    name: "FormInput",
    props: {
        name: {
            type: String,
            default: ""
        },
        type : {
            type : String,
            default : "text"
        },
        title : {
            type : String,
            default : "Input"
        }
    }
}
</script>

<style scoped>
.form__item{
    margin: 10px 0;
}
.form__title{

}
.form__input{
    margin: 5px 0;
}
.form__input>input{
    width: 100%;
    border-radius: 5px;
    background-color: #68ca91;
}
.form__input>input:focus{
    background-color: #38c172;
}
</style>
