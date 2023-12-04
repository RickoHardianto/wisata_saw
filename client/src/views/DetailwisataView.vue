<script>
import { mapActions, mapState } from "pinia";
import { useUserStore } from "../stores/wisata";

export default {
  computed: {
    ...mapState(useUserStore, ["destination"]),
  },
  methods: {
    ...mapActions(useUserStore, ["fetchById"]),
    displayAccess() {
      if (Array.isArray(this.destination.access)) {
        return this.destination.access.join(", ");
      } else if (typeof this.destination.access === 'string') {
        try {
          const accessArray = JSON.parse(this.destination.access);
          if (Array.isArray(accessArray)) {
            return accessArray.join(", ");
          }
        } catch (error) {
          // Handle JSON parsing error, if any
          console.error("Error parsing 'access' JSON string:", error);
        }
      }
      return this.destination.access;
    },
  },
  created() {
    this.fetchById(this.$route.params.id);
  },
};
</script>

<template>
  <!-- Navigation-->
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container px-4 px-lg-5">
      <router-link class="navbar-brand" to="/">Destinasi Wisata</router-link>
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
            <router-link class="nav-link active" aria-current="page" to="login"
              >Login</router-link
            >
          </li>
          <li class="nav-item">
            <router-link
              class="nav-link active"
              aria-current="page"
              to="register"
              >Register</router-link
            >
          </li>
          <li class="nav-item">
            <router-link class="nav-link active" aria-current="page" to="#"
              >Logout</router-link
            >
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <!-- Header-->
  <header class="bg-hefo py-5">
    <div class="container px-4 px-lg-5 my-5">
      <div class="text-center text-white">
        <h1 class="display-4 fw-bolder">Destinasi Wisata</h1>
        <p class="lead fw-normal text-white-50 mb-0"></p>
      </div>
    </div>
  </header>
  <!-- Section-->
  <section class="py-5">
    <div class="container px-4 px-lg-5 mt-5">
      <h1 class="text-center mb-5" style="color: black">
        {{ destination.wisata }}
      </h1>
      <div class="justify-content-center">
        <div class="d-flex justify-content-center align-items-center mb-5">
          <img :src="`http://localhost:8000/storage/${destination.img}`" />
        </div>
        <p>Harga Tiket Masuk : {{ destination.price }}.000</p>
        <p>Jam Buka : {{ destination.openTime }}</p>
        <p>Jam Tutup : {{ destination.closeTime }}</p>
        <p>Access Kendaraan: {{ displayAccess() }}</p>
        <p>Alamat : {{ destination.address }}</p>
        <p>Kecamatan : {{ destination.kecamatan }}</p>
      </div>
      <div class="d-flex justify-content-center align-items-center">
        <img :src="`http://localhost:8000/storage/${destination.img_lokasi}`" />
      </div>
    </div>
  </section>
</template>
<style>
.bg-hefo {
  background-color: #86b817;
}
</style>
