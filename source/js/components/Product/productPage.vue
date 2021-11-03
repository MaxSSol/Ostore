<template>
  <div>
    <div class="product" v-for="info in product" :key="info.id">
  <section class="product mb-5">
    <div class="product-name">
      <p class="h3">{{info.title}}</p>
    </div>
    <div class="product-inner d-flex justify-content-between align-items-center">
      <div class="product-img">
        <img :src="info.productPhoto" :alt="info.title"/>
      </div>
      <div class="product-info">
        <p class="product-price">Price: ${{info.price}}</p>
        <p class="product-amount">In stock: {{info.amount}}</p>
        <p>Quantity:</p>
        <form method="post" action="/order">
        <input type="hidden" name="product_id" :value="info.id">
        <input class="product-quantity" type="number" min="1" :max="info.amount" value="1" name="quantity">
        <button type="submit" class="btn btn-primary me-2" name="button" value="Checkout">Checkout</button>
        <button type="submit" class="btn btn-primary" name="button" value="Add to cart">Add to Cart</button>
        </form>
      </div>
    </div>
  </section>
  <section class="description">
    <div class="description-inner">
      <p class="fs-3 title">Description</p>
      <p class="description-title" align="justify">{{info.description}}</p>
    </div>
  </section>
    </div>
  </div>
</template>

<script>
export default {
  name: "productPage",
  props: {},
  methods: {
    getProductById: async () => {
      let params = (new URLSearchParams(document.location.search))
      let id = params.get("id");
      let getProduct = await fetch(`https://ostore.local.com/get/product?id=${id}`);
      const product = await getProduct.json();
      return product
    }
  },
  data() {
    return {
      product: []
    }
  },
  created() {
    this.getProductById().then(product => {
      this.product = product;
    })
  }
}
</script>

<style scoped>
.product-quantity {
  display: flex;
  justify-content: center;
  width: 100px;
  margin-bottom: 10px;
}
</style>