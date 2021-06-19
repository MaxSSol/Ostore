window.Vue = require('vue')

Vue.component('product', require('./components/Products/product.vue').default)
Vue.component('pagination', require('./components/Products/pagination.vue').default)
Vue.component('productsList', require('./components/Products/products-list.vue').default)
Vue.component('sortByPrice', require('./components/Products/sortByPrice.vue').default)

const app = new Vue({
  el: '#app'
})