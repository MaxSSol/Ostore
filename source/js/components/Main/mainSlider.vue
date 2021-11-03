<template>
  <section class="promo d-flex justify-content-center align-items-center mb-5">
  <div class="promo-inner w-100">
  <div id="carouselIndicators" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-indicators">
      <button type="button" data-bs-target="#carouselIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
      <button type="button" data-bs-target="#carouselIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
      <button type="button" data-bs-target="#carouselIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
    </div>
    <div class="carousel-inner">
      <div class="carousel-item active">
        <a href="/products">
          <img class="d-block w-100" src="https://i.imgur.com/WyH9fUs.png" alt="test1">
        </a>
      </div>
      <div class="carousel-item">
        <a href="/products">
          <img class="d-block w-100" src="https://i.imgur.com/Aqsiuk0.png" alt="Tools">
        </a>
      </div>
      <div class="carousel-item">
        <a href="/products">
          <img class="d-block w-100" src="https://i.imgur.com/ozrJHd4.png" alt="Tools">
        </a>
      </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselIndicators" data-bs-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselIndicators" data-bs-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Next</span>
    </button>
  </div>
  </div>
  </section>
</template>

<script>
export default {
  name: "mainSlider"
}
</script>

<style scoped>

</style>