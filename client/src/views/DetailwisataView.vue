<script>
import { mapActions, mapState } from "pinia";
import { useUserStore } from "../stores/wisata";
import StarRating from "vue-star-rating";
import axios from "axios";

export default {
  components: {
    StarRating,
  },
  data() {
    return {
      userReview: {
        id: null,
        rating: null,
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
          // Handle JSON parsing error, if any
          console.error("Error parsing 'access' JSON string:", error);
        }
      }
      return this.destination.access;
    },
    async submitReview() {
      const newReview = {
        destination_id: this.destination.id,
        nama: this.userReview.nama,
        rating: this.userReview.rating,
        review: this.userReview.review,
      };

      try {
        const response = await axios.post(
          "http://localhost:8000/api/reviews",
          newReview
        );
        // Lakukan sesuatu dengan respons dari permintaan POST, jika diperlukan
        console.log("Review submitted:", response.data);
        // Setelah berhasil, kosongkan input ulasan
        this.userReview.rating = null;
        this.userReview.review = "";
        this.userReview.nama = "";
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
          <p>Harga Tiket Masuk : {{ destination.price }}</p>
          <p>Jumlah Penginapan : {{ destination.penginapan }}</p>
          <p>Jam Buka : {{ destination.openTime }}</p>
          <p>Jam Tutup : {{ destination.closeTime }}</p>
          <p>Access Kendaraan: {{ displayAccess() }}</p>
          <p>Alamat : {{ destination.address }}</p>
          <p>Kecamatan : {{ destination.kecamatan }}</p>

          <!-- data detail end  -->

          <div class="row mt-4">
            <div class="col-md-12">
              <div class="card border-0 rounded shadow-sm">
                <div class="card-body">
                  <h5>
                    <i class="fa fa-comments"></i> ULASAN PRODUK (
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
                          <StarRating
                          v-if="review.rating !== undefined"
                            class="mb-2"
                            :rating="review.rating"
                            :star-size="20"
                            :read-only="true"
                            :show-rating="false"
                          >
                          </StarRating>
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
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="col-lg-4">
          <div class="card shadow-sm mt-5">
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

  <footer class="py-5 bg-hefo">
    <div class="container">
      <p class="m-0 text-center text-white">
        Copyright &copy; Your Website 2023
      </p>
    </div>
  </footer>
</template>
<style>
.bg-hefo {
  background-color: #86b817;
}

.rate {
  float: left;
  height: 46px;
  padding: 0 10px;
}

.rate:not(:checked) > input {
  position: absolute;
  display: none;
}

.rate:not(:checked) > label {
  float: right;
  width: 1em;
  overflow: hidden;
  white-space: nowrap;
  cursor: pointer;
  font-size: 30px;
  color: #ccc;
}

.rated:not(:checked) > label {
  float: right;
  width: 1em;
  overflow: hidden;
  white-space: nowrap;
  cursor: pointer;
  font-size: 30px;
  color: #ccc;
}

.rate:not(:checked) > label:before {
  content: "★ ";
}

.rate > input:checked ~ label {
  color: #ffc700;
}

.rate:not(:checked) > label:hover,
.rate:not(:checked) > label:hover ~ label {
  color: #deb217;
}

.rate > input:checked + label:hover,
.rate > input:checked + label:hover ~ label,
.rate > input:checked ~ label:hover,
.rate > input:checked ~ label:hover ~ label,
.rate > label:hover ~ input:checked ~ label {
  color: #c59b08;
}

.star-rating-complete {
  color: #c59b08;
}

.rating-container .form-control:hover,
.rating-container .form-control:focus {
  background: #fff;
  border: 1px solid #ced4da;
}

.rating-container textarea:focus,
.rating-container input:focus {
  color: #000;
}

.rated {
  float: left;
  height: 46px;
  padding: 0 10px;
}

.rated:not(:checked) > input {
  position: absolute;
  display: none;
}

.rated:not(:checked) > label {
  float: right;
  width: 1em;
  overflow: hidden;
  white-space: nowrap;
  cursor: pointer;
  font-size: 30px;
  color: #ffc700;
}

.rated:not(:checked) > label:before {
  content: "★ ";
}

.rated > input:checked ~ label {
  color: #ffc700;
}

.rated:not(:checked) > label:hover,
.rated:not(:checked) > label:hover ~ label {
  color: #deb217;
}

.rated > input:checked + label:hover,
.rated > input:checked + label:hover ~ label,
.rated > input:checked ~ label:hover,
.rated > input:checked ~ label:hover ~ label,
.rated > label:hover ~ input:checked ~ label {
  color: #c59b08;
}
</style>
