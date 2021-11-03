<template>
  <div>
    <sort-by-price @sortAscending="sortAscending" @sortDescending="sortDescending"></sort-by-price>
    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3">
    <product v-for="product in paginatedProducts" :key = "product.id"
             :id = "product.id"
             :title = "product.title"
             :productPhoto = "product.productPhoto"
             :price = "product.price"
    ></product>
    </div>
    <div class="products-button d-flex justify-content-center">
    <pagination v-for="page in pages" :key="page"
      :page = "page"
      :class = '{"btn btn-primary mx-2": page === pageNumber}'
      @sendPage="getPageNumber"
    ></pagination>
    </div>
  </div>
</template>
<script>
export default {
  name: "products-list",
  props: {},
  methods: {
    getProducts: async () => {
      let getProducts = await fetch('https://ostore.local.com/get/products');
      const products = await getProducts.json();
      return products;
    },
    getPageNumber(page) {
      this.pageNumber = page
    },
    sortAscending() {
      this.products.sort((a,b) => a.price - b.price)
      this.pageNumber = 1
    },
    sortDescending() {
      this.products.sort((a,b) => b.price - a.price)
      this.pageNumber = 1
    }
  },
  data() {
    return {
      products: [],
      productsPerPage: 10,
      pageNumber: 1
    }
  },
  computed: {
    pages() {
      return Math.ceil(this.products.length / 10);
    },
    paginatedProducts() {
      let from = (this.pageNumber - 1) * this.productsPerPage;
      let to = from + this.productsPerPage;
      window.scrollTo(0,0)
      return this.products.slice(from,to);
    },
  },
  created() {
    this.getProducts().then(products => {
      this.products = products;
    })
  }
}
</script>

<style scoped>

</style>