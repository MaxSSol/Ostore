<template>
      <button :class="'btn btn-outline-primary mx-2'" @click="pageClick(page)">{{page}}</button>
</template>

<script>
export default {
  name: "pagination",
  props: [
      'page'
  ],
  methods: {
    pageClick(page) {
      this.$emit('sendPage', page)
    }
  },
}
</script>

<style scoped>

</style>