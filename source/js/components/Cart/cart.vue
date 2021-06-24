<template>
<div>
    <div class="cart-inner d-flex flex-column justify-content-center align-items-center">
      <div class="cart-product d-flex justify-content-between m-0 mb-3">
        <ul class="list-unstyled text-small d-flex justify-content-center align-items-center">
          <li>
            <input class="me-4"
                   type="checkbox"
                   :name="'product_id_' + productId"
                   :value="productId"
                   checked/>
          </li>
          <li class="cart-product-title">
            <p>{{title}}</p>
          </li>
          <li class="mx-5">
            <p>Price: <br/>${{price}}</p>
            <p>Quantity</p>
            <input type="button" name="descending" value="-" @click="decrement()">
            <input class="cart-quantity"
                   type="number"
                   min="1"
                   max="50"
                   :value="quantity"
                   :name="'quantity_' + productId"/>
            <input type="button" name="ascending" value="+" @click="increment()">
          </li>
          <li>
            <a class="btn btn-danger" :href="'/cart/d?id=' + id">X</a>
          </li>
        </ul>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "cart",
  props:[
      'id',
      'productId',
      'title',
      'price',
      'quantity',
      'totalPrice'
  ],
  methods: {
    decrement() {
      this.$emit('quantityDesc',this.productId)
    },
    increment() {
      this.$emit('quantityAsc',this.productId)
    }
  }
}
</script>

<style scoped>

</style>