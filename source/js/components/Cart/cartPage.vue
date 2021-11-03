<template>
<div>
  <cart v-for="product in cart" :key = "product.id"
        :id = "product.id"
        :productId = "product.productId"
        :title = "product.productTitle"
        :price = "product.price"
        :quantity = "product.quantity"
        @quantityDesc = "setQuantityDesc"
        @quantityAsc = "setQuantityAsc"
  ></cart>
  <p class="d-flex justify-content-center">Total price: ${{totalPrice}}</p>
</div>
</template>

<script>
export default {
  name: "cartPage",
  props: {},
  methods:{
    getCart: async () => {
      let cart = await fetch('https://ostore.local.com/get/cart');
      const productFromCart = await cart.json()
      return productFromCart
    },
    setQuantityDesc(productId) {
      this.cart.forEach(product => {
        if (product.productId === productId) {
          product.quantity--
        }
      })
    },
    setQuantityAsc(productId) {
      this.cart.forEach(product => {
        if (product.productId === productId) {
          product.quantity++
        }
      })
    }
  },
  data() {
    return {
      cart: [],
      totalPrice: 0,
      quantity: 1
    }
  },
  computed: {
    getTotalPrice: function () {
      let price = 0
      this.cart.forEach(product => {
        price += (product.price * product.quantity)
      })
      this.totalPrice = price
      return this.totalPrice
    }
  },

  created() {
    this.getCart().then(productFromCart => {
      this.cart = productFromCart;
    })
  },
  mounted() {

  }
}
</script>

<style scoped>

</style>