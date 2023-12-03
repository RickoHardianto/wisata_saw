<script>
export default {
  props: ["destination"],
};
</script>

<template>
  <div class="col mb-5">
    <div class="card h-100">
      <!-- Product image-->
      <img :src="`http://localhost:8000/storage/${destination.img}`" class="card-img-top" />
      <!-- Product details-->
      <div class="card-body p-4">
        <div class="text-center">
          <!-- Product name-->
          <h5 class="fw-bolder">{{ destination.wisata }}</h5>
          <!-- Product price-->
          HTM {{ destination.price }}
        </div>
      </div>
      <!-- Product actions-->
      <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
        <div class="text-center">
          <router-link :to="/detail/+ destination.id" class="btn btn-outline-success mt-auto">detail</router-link>
        </div>
      </div>
    </div>
  </div>
</template>

<style>
.bg-hefo {
  background-color: #86B817;
}


</style>
