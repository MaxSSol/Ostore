<template>
      <div class="col">
        <div class="card">
          <img :src="productPhoto" :alt="title"/>
        </div>
        <div class="card-body">
          <p class="card-text">{{title}}</p>
          <p class="card-text">Price: ${{price}}</p>
          <div class="card-btn d-flex justify-content-center">
            <a class="btn btn-primary me-3" :href="'/product?id=' + id" role="button">View</a>
            <a class="btn btn-primary" :href="'/cart/add?id=' + id" role="button">Add to Cart</a>
          </div>
        </div>
      </div>
</template>

<script>
export default {
  name: "mainProducts",
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