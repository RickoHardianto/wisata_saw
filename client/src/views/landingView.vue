<script>
import { mapActions, mapState } from "pinia";
import { useUserStore } from "../stores/wisata";
import CardComponent from "../components/landing/CardComponent.vue";

export default {
  computed: {
    ...mapState(useUserStore, ["destinations"]),
  },
  methods: {
    ...mapActions(useUserStore, ["fetchDestination"]),
  },
  created() {
    this.fetchDestination();
  },
  components: { CardComponent },
};
</script>

<template>
  <!-- Navigation-->
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container px-4 px-lg-5">
      <a class="navbar-brand" href="#!">Destinasi Wisata</a>
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
          <!-- <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="#!">Home</a>
          </li>
          <li class="nav-item"><a class="nav-link" href="#!">About</a></li> -->
        </ul>
      </div>
    </div>
  </nav>
  <!-- Header-->
  <header class="bg-dark py-5">
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
      <div
        class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center"
      >
        <CardComponent
          v-for="destination in destinations"
          key="destination.id"
          :destination="destination"
        />
      </div>
    </div>
  </section>
  <!-- Footer-->
  <footer class="py-5 bg-dark">
    <div class="container">
      <p class="m-0 text-center text-white">
        Copyright &copy; Your Website 2023
      </p>
    </div>
  </footer>
</template>
