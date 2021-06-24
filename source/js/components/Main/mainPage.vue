<template>
  <div>
    <main-slider></main-slider>
    <section class="top-products mb-5">
      <p class="top-products-title d-flex justify-content-center mb-5">Only in Ostore</p>
      <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3">
        <main-products v-for="product in products" :key = "product.id"
                       :id = "product.id"
                       :title = "product.title"
                       :productPhoto = "product.productPhoto"
                       :price = "product.price"
        >
        </main-products>
      </div>
    </section>
  </div>
</template>

<script>
export default {
  name: "mainPage",
  data() {
    return {
      products: []
    }
  },
  methods: {
    getProducts: async () => {
      let getProducts = await fetch('https://ostore.local.com/get/products');
      const products = await getProducts.json();
      return products;
    }
  },
  created() {
    this.getProducts().then(products => {
      this.products = products.slice(0,6)
    })
  }
}
</script>

<style scoped>

</style>