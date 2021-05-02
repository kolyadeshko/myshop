
window.Vue = require('vue').default;


// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('social-links', require('./components/SocialLinks.vue').default);
import ExampleComponent from "./components/ExampleComponent";
Vue.component('product-types',require('./components/ProductTypes.vue').default);

const app = new Vue({
    el: '#app'
});

