<template>
  <div class="col">
    <div class="card">
      <img :src="productPhoto" :alt="title"/>
      <div class="card-body">
        <p class="card-text">{{title}}</p>
        <p class="card-text">Price: ${{price}}</p>
        <div class="card-btn d-flex justify-content-center align-items-center">
          <a class="btn btn-primary me-2" :href="'/product?id=' + id">View product</a>
          <a class="btn btn-primary px-4" :href="'/cart/add?id=' + id">Add to cart</a>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "product",
  props: [
    'id',
    'title',
    'price',
    'productPhoto'
  ]
}
</script>

<style scoped>

</style>