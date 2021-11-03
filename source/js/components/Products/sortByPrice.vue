<template>
  <div class="d-flex">
    <a class="nav nav-link" @click="sortByAscending">Sort ascending</a>
    <a class="nav nav-link" @click="sortByDescending">Sort descending</a>
  </div>
</template>

<script>
export default {
  name: "sortByPrice",
  props:{},
  methods: {
    sortByAscending() {
      this.$emit('sortAscending')
    },
    sortByDescending() {
      this.$emit('sortDescending')
    }
  }
}
</script>

<style scoped>
.nav {
  cursor: pointer;
}
</style>