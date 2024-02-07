<script>
import { mapActions, mapState } from "pinia";
import { useUserStore } from "../stores/wisata";
import CardComponent from "../components/landing/CardComponent.vue";
import { ref, onMounted } from "vue";
import axios from "axios";

export default {
  data() {
    return {
      selectedCategory: "",
    };
  },
  computed: {
    ...mapState(useUserStore, ["destinations", "categories"]),
    filteredDestinations() {
      if (this.selectedCategory === "") {
        return this.destinations.filter(
          (destination) => destination.status === "Validasi"
        );
      } else {
        return this.destinations.filter(
          (destination) =>
            destination.category_id === this.selectedCategory &&
            destination.status === "Validasi"
        );
      }
    },
  },
  methods: {
    ...mapActions(useUserStore, ["fetchDestination", "fetchCategories"]),
    filterDestinations() {
      this.fetchDestination({
        filter: { category: this.selectedCategory },
      });
    },
  },
  created() {
    this.fetchDestination();
    this.fetchCategories();
  },
  components: { CardComponent },
};
</script>

<template>
  <!-- Navigation-->
  <nav class="navbar navbar-expand-lg navbar-light bg-primary">
    <div class="container px-4 px-lg-5">
      <router-link class="navbar-brand text-white" to="/">Destinasi Wisata</router-link>
      <button
        class="navbar-toggler"
        type="button"
        data-bs-toggle="collapse"
        data-bs-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent"
        aria-expanded="false"
        aria-label="Toggle navigation"
      >
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
          <li class="nav-item">
            <router-link class="nav-link active text-white" aria-current="page" to="/"
              >Home</router-link
            >
          </li>
          <li class="nav-item">
            <router-link
              class="nav-link active text-white"
              aria-current="page"
              to="/rekomendasi"
              >Rekomendasi Wisata</router-link
            >
          </li>
          <!-- <li class="nav-item">
            <router-link class="nav-link active" aria-current="page" to="login"
              >Login</router-link
            >
          </li> -->
          <!-- <li class="nav-item">
            <router-link
              class="nav-link active"
              aria-current="page"
              to="register"
              >Register</router-link
            >
          </li> -->
          <!-- <li class="nav-item">
            <router-link class="nav-link active" aria-current="page" to="#"
              >Logout</router-link
            >
          </li> -->
        </ul>
      </div>
    </div>
  </nav>
  <!-- Header-->
  <div class="container-fluid bg-light py-5 mb-5 hero-header">
    <div class="container py-5">
      <div class="row justify-content-center py-5">
        <div class="col-lg-10 pt-lg-5 mt-lg-5 text-center">
          <h1 class="display-3 text-white mb-3 animated slideInDown">
            Destinasi Wisata Kota Malang
          </h1>
          <h1 class="fs-4 text-white mb-4 animated slideInDown">
            Panduan Wisata Terbaik Untuk Menikmati Petualangan Tak Terlupakan
          </h1>
        </div>
      </div>
    </div>
  </div>
  <!-- Section-->
  <section class="py-5">
    <div class="container">
      <div class="col-md-2">
        <div class="row">
          <h4>Kategori</h4>
          <select
            class="form-control"
            v-model="selectedCategory"
            @change="filterDestinations"
          >
            <option value="" selected>All Category</option>
            <option
              v-for="category in categories"
              :key="category.id"
              :value="category.id"
            >
              {{ category.category }}
            </option>
          </select>
        </div>
      </div>
    </div>
    <div
      class="container px-4 px-lg-5 mt-5"
      v-if="filteredDestinations.length > 0"
    >
      <div
        class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center"
      >
        <CardComponent
          v-for="destination in filteredDestinations"
          :key="destination.id"
          :destination="destination"
        />
      </div>
    </div>
    <div class="container px-4 px-lg-5 mt-5" v-else>
      <div
        class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center"
      >
        <h4>Tidak ada destinasi yang tersedia.</h4>
      </div>
    </div>
  </section>
  <!-- Footer-->
  <footer class="py-5 bg-primary">
    <div class="container">
      <p class="m-0 text-center text-white">
        Rekomendasi Destinasi Wisata Malang
      </p>
    </div>
  </footer>
</template>
<style>
.hero-header {
    background: linear-gradient(rgba(20, 20, 31, .7), rgba(20, 20, 31, .7)), url(../assets/landing/bg-hero.jpg);
    background-position: center center;
    background-repeat: no-repeat;
    background-size: cover;
}
.bg-hefo {
  background-color: #86b817;
}
</style>
