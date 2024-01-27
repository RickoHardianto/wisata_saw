<script>
import StarRating from "vue-star-rating";

export default {
  components: {
    StarRating,
  },
  props: ["destination"],
};
</script>

<template>
  <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
    <div class="card shadow" style="width: 100%; height: 100%;">
      <!-- Product image-->
      <div class="card-img-top">
        <img
          :src="`http://localhost:8000/storage/${destination.img}`"
          class="img-fluid"
        />
      </div>
      <div class="d-flex border-bottom">
        <small class="flex-fill text-center border-end py-2"
          ><i class="fa fa-map-marker-alt text-primary me-2"></i
          >{{ destination.kecamatan }}</small
        >
        <small class="flex-fill text-center border-end py-2"
          ><i class="fa fa-calendar-alt text-primary me-2"></i
          >{{ destination.penginapan }}</small
        >
        <small class="flex-fill text-center py-2"
          ><i class="fa fa-user text-primary me-2"></i
          >{{ destination.category_id }}</small
        >
      </div>
      <div class="card-body text-center">
        <h3 class="mb-2">{{ destination.wisata }}</h3>
        <h3 class="mb-0">Rp {{ destination.price }}</h3>
        <div class="mb-3">
          <StarRating
            :rating="parseFloat(destination.reviews_avg_rating)"
            :increment="0.5"
            :star-size="20"
            :read-only="true"
            :show-rating="false"
            :inline="true"
          ></StarRating>
          (<strong>{{ destination.reviews_count }}</strong> ulasan)
        </div>
        <div class="d-flex justify-content-center mb-2">
          <router-link
            :to="/detail/ + destination.id"
            class="btn btn-sm btn-primary px-3 border-end"
            style="border-radius: 30px 30px 30px 30px"
            >Detail</router-link
          >
        </div>
      </div>
    </div>
  </div>
</template>

<style>
.bg-hefo {
  background-color: #86b817;
}
</style>
