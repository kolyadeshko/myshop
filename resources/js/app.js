window.Vue = require('vue').default;


// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('social-links', require('./components/SocialLinks.vue').default);
Vue.component('product-types',require('./components/ProductTypes.vue').default);
Vue.component('form-input',require('./components/FormInput.vue').default)
Vue.component('products-block',require('./components/ProductsBlock.vue').default);
Vue.component('product-card',require('./components/ProductCard.vue').default);
Vue.component('products',require('./components/Products.vue').default);
Vue.component('message',require('./components/Message.vue').default);
Vue.component('product-detail',require('./components/ProductDetail.vue').default)

const app = new Vue({
    el: '#app'
});

