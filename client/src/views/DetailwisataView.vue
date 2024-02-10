<script>
import { mapActions, mapState } from "pinia";
import { useUserStore } from "../stores/wisata";
import StarRating from 'vue-star-rating'
import axios from "axios";

export default {
  components: {
    StarRating,
  },
  data() {
    return {
      userReview: {
        star: 0,
        review: "",
        nama: "",
      },
    };
  },
  computed: {
    ...mapState(useUserStore, ["destination"]),
  },
  methods: {
    ...mapActions(useUserStore, ["fetchById"]),
    displayAccessLabel(accessValue) {
      const accessMapping = {
        1: "Kendaraan Roda 4",
        2: "Kendaraan Roda 2",
        3: "Kendaraan Umum",
        // Sesuaikan dengan pilihan yang Anda miliki
      };

      return accessMapping[accessValue] || accessValue;
    },
    displayAccess() {
      if (Array.isArray(this.destination.access)) {
        return this.destination.access.join(", ");
      } else if (typeof this.destination.access === "string") {
        try {
          const accessArray = JSON.parse(this.destination.access);
          if (Array.isArray(accessArray)) {
            return accessArray.join(", ");
          }
        } catch (error) {
          console.error("Error parsing 'access' JSON string:", error);
        }
      }
      return this.destination.access;
    },
    async submitReview(destination_id) {
      let formData = new FormData();
    
      formData.append("nama", this.userReview.nama);
      formData.append("rating",  this.userReview.star);
      formData.append("review", this.userReview.review);
      formData.append("destination_id", destination_id);

      try {
        const response = await axios.post(
          "http://localhost:8000/api/reviews",
          formData
        );
        // Lakukan sesuatu dengan respons dari permintaan POST, jika diperlukan
        console.log("Review submitted:", response.data);
        // Setelah berhasil, kosongkan input ulasan
        this.userReview.star = 0;
        this.userReview.review = "";
        this.userReview.nama = "";

        await this.fetchById(this.$route.params.id);
      } catch (error) {
        console.error("Error submitting review:", error);
      }
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
            <router-link class="nav-link active" aria-current="page" to="/"
              >Home</router-link
            >
          </li>
          <li class="nav-item">
            <router-link class="nav-link active" aria-current="page" to="/rekomendasi"
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
  <header class="bg-primary py-5">
    <div class="container px-4 px-lg-5 my-5">
      <div class="text-center text-white">
        <h1 class="display-4 fw-bolder">Destinasi Wisata</h1>
        <p class="lead fw-normal text-white-50 mb-0"></p>
      </div>
    </div>
  </header>
  <!-- Section-->
  <section class="py-5">
    <div class="container">
      <div class="row">
        <!-- data detail start  -->
        <div class="col-lg-8">
          <div class="card shadow-sm">
            <div class="card-body">
              <img
                :src="`http://localhost:8000/storage/${destination.img}`"
                class="card-img-top img-fluid"
                style="width: 100%; height: auto"
              />
            </div>
          </div>
          <h1 class="mb-3 mt-3" style="color: black">
            {{ destination.wisata }}
          </h1>
          <div class="card-header">
            <h5>Deskripsi</h5>
          </div>
          <div class="card-body">
            <p>{{ destination.deskripsi }}</p>
          </div>
          <p>Harga Tiket Masuk : {{ destination.price }}</p>
          <p>Jumlah Penginapan : {{ destination.penginapan }}</p>
          <p>Jam Buka : {{ destination.openTime }}</p>
          <p>Jam Tutup : {{ destination.closeTime }}</p>
          <p>Access Kendaraan: {{ displayAccess().split(',').map(value => displayAccessLabel(Number(value))).join(', ') }}</p>
          <p>Nomor Telepon: {{ destination.numberPhone }}</p>
          <p>Alamat : {{ destination.address }}</p>
          <p>Kecamatan : {{ destination.kecamatan }}</p>
          <p>Jumlah Wisata Terdekat : {{ destination.jarak }}</p>

          <!-- data detail end  -->

          <div class="row mt-4">
            <div class="col-md-12">
              <div class="card border-0 rounded shadow-sm">
                <div class="card-body">
                  <h5>
                    <i class="fa fa-comments"></i> Review (
                    <strong>{{ destination.reviews_count }}</strong> ulasan )
                  </h5>
                  <hr />
                  <div
                    class="card bg-light shadow-sm rounded"
                    v-for="review in destination.reviews"
                    :key="review.id"
                  >
                    <div class="card-body">
                      <div class="row">
                        <div class="col-md-1">
                          <div class="review-avatar avatar-sm"></div>
                        </div>
                        <div class="col-md-11">
                          <star-rating
                            class="mb-2"
                            :rating="review.rating"
                            :star-size="20"
                            :read-only="true"
                            :show-rating="false"
                          >
                          </star-rating>
                          <strong>
                            <span class="text-dark">{{ review.nama }}</span>
                          </strong>
                          <div class="description mt-2">
                            <span
                              style="
                                color: rgb(119, 118, 118);
                                font-size: 15px;
                                font-style: italic;
                              "
                            >
                              {{ review.review }}
                            </span>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

                  <!-- Form untuk menambahkan ulasan baru -->
                  <div class="mt-4">
                    <form @submit.prevent="submitReview(destination.id)">
                      <h5>Submit Ulasan Baru</h5>

                      <div class="mb-3">
                        <label for="rating">Rating</label>
                        <star-rating v-model:rating="userReview.star"></star-rating>
                      </div>
                      <div class="mb-3">
                        <label for="nama">Nama</label>
                        <input
                          type="text"
                          id="nama"
                          v-model="userReview.nama"
                          class="form-control"
                        />
                      </div>
                      <div class="mb-3">
                        <label for="review">Ulasan</label>
                        <textarea
                          id="review"
                          v-model="userReview.review"
                          class="form-control"
                        ></textarea>
                      </div>
                      <button type="submit" class="btn btn-primary">
                        Kirim Ulasan
                      </button>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-4">
          <div class="card shadow-sm">
            <div class="card-body">
              <img
                :src="`http://localhost:8000/storage/${destination.img_lokasi}`"
                class="card-img-top img-fluid"
                style="width: 100%; height: auto"
              />
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <footer class="py-5 bg-primary">
    <div class="container">
      <p class="m-0 text-center text-white">
        Rekomendasi Destinasi Wisata Malang
      </p>
    </div>
  </footer>
</template>
<style>
.bg-hefo {
  background-color: #86b817;
}
</style>
