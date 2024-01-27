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
      decision_matrix: [],
      normalized_matrix: [],
      rankings: [],
      conclusion: "",
      loading: false,
      error: null,
    };
  },
  computed: {
    ...mapState(useUserStore, ["destinations", "categories", "kriterias"]),
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
    ...mapActions(useUserStore, [
      "fetchDestination",
      "fetchCategories",
      "fetchKriteria",
    ]),
    filterDestinations() {
      this.fetchDestination({
        filter: { category: this.selectedCategory },
      });
    },
    async calculateSAW() {
      try {
        this.loading = true;

        // Ambil kriteria yang dipilih
        const selectedCriteria = this.kriterias
          .filter((kriteria) => kriteria.selected)
          .map((kriteria) => kriteria.id);

        // Ambil destinasi yang dipilih
        const selectedDestinations = this.filteredDestinations
          .filter((destination) => destination.selected)
          .map((destination) => destination.id);

        // Pastikan ada destinasi dan kriteria yang dipilih
        if (
          selectedDestinations.length === 0 ||
          selectedCriteria.length === 0
        ) {
          this.error = "Pilih Kriteria dan Destinasi Wisata";
          return;
        }

        // if (selectedCriteria.length < 2) {
        //   this.error = "Pilih minimal dua kriteria";
        //   return;
        // }

        // Buat objek payload untuk dikirim ke server
        const payload = {
          criteria: selectedCriteria.join(","),
          destinations: selectedDestinations.join(","),
        };

        const response = await axios.get("http://localhost:8000/api/saw", {
          params: payload,
        });
        this.decision_matrix = response.data.data.decision_matrix;
        this.normalized_matrix = response.data.data.normalized_matrix;
        this.rankings = response.data.data.rankings;
        this.conclusion = response.data.data.conclusion;
        this.error = null;
      } catch (error) {
        console.error("Error fetching SAW results:", error);
      } finally {
        this.loading = false;
      }
    },
  },
  created() {
    this.fetchDestination();
    this.fetchKriteria();
    this.fetchCategories();
    this.calculateSAW();
  },
  components: { CardComponent },
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
            <router-link
              class="nav-link active"
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

    <div class="container mt-5">
      <div class="card bg-primary rounded">
        <div class="card-body text-white">
          <div class="container" v-if="filteredDestinations.length > 0">
            <label for="">Pilih Wisata</label>
            <div class="row">
              <label
                v-for="destination in filteredDestinations"
                :key="destination.id"
                class="col-md-3"
              >
                <input
                  type="checkbox"
                  v-model="destination.selected"
                  :value="destination.id"
                />
                {{ destination.wisata }}
              </label>
            </div>
          </div>
          <div class="container px-4 px-lg-5 mt-5" v-else>
            <div
              class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center"
            >
              <h4>Tidak ada destinasi yang tersedia.</h4>
            </div>
          </div>
          <!-- Add checkboxes for criteria -->
          <div class="container">
            <div class="card shadow mb-4">
              <div class="card-header">
                <h5 class="card-title text-black">Pilih Kriteria</h5>
              </div>
              <div class="card-body">
                <div class="row">
                  <div class="tabel-responsive">
                    <table class="table table-bordered">
                      <thead>
                        <tr>
                          <th></th>
                          <th>Kriteria</th>
                          <th>Type</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr v-for="kriteria in kriterias" :key="kriteria.id">
                          <td></td>
                          <td>{{ kriteria.nama }}</td>
                          <td>{{ kriteria.atribut }}</td>
                          <td>
                            <input
                              type="checkbox"
                              v-model="kriteria.selected"
                              :value="kriteria.id"
                            />
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                  <div class="d-flex justify-content-between">
                    <div class="container py-4 text-black">
                      <h5>Catatan</h5>
                      <p>- Benefit adalah Nilai Terbesar dari Kriteria</p>
                      <p>- Cost adalah Nilai Terkecil dari kriteria</p>
                    </div>
                    <div class="py-4">
                      <button
                        class="btn btn-primary"
                        @click="calculateSAW"
                        :disabled="loading"
                      >
                        {{ loading ? "Loading..." : "Hitung" }}
                      </button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div v-if="error" class="container py-4">
            <div class="card">
              <div class="card-body text-center">
                <p style="color: red">{{ error }}</p>
              </div>
            </div>
          </div>

          <!-- Tampilkan tabel detail perhitungan jika ada -->
          <section class="py-5">
            <div class="container text-black">
              <div class="card shadow">
                <div class="card-header">
                  <h2>Matrix Keputusan</h2>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table table-bordered">
                      <thead>
                        <tr>
                          <th>Wisata</th>
                          <th>Keunikan dan Daya Tarik</th>
                          <th>Harga Tiket Masuk</th>
                          <th>Aksesibilitas Wisata</th>
                          <th>Jumlah Penginapan</th>
                          <th>Jumlah Wisata Terdekat</th>
                        </tr>
                      </thead>
                      <tbody>
                        <!-- Loop melalui setiap detail perhitungan -->
                        <tr
                          v-for="(detail, index) in decision_matrix"
                          :key="index"
                        >
                          <td>{{ detail.wisata }}</td>
                          <td>{{ detail["Keunikan dan Daya Tarik"] }}</td>
                          <td>{{ detail["Harga Tiket Masuk"] }}</td>
                          <td>{{ detail["Aksesibilitas Wisata"] }}</td>
                          <td>{{ detail["Jumlah Penginapan"] }}</td>
                          <td>{{ detail["Jumlah Wisata terdekat"] }}</td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </section>

          <section class="py-5" >
            <div class="container text-black">
              <div class="card shadow">
                <div class="card-header">
                  <h2>Matrix Normalisasi</h2>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table table-bordered">
                      <thead>
                        <tr>
                          <th>Wisata</th>
                          <th>Keunikan dan Daya Tarik</th>
                          <th>Harga Tiket Masuk</th>
                          <th>Aksesibilitas Wisata</th>
                          <th>Jumlah Penginapan</th>
                          <th>Jumlah Wisata Terdekat</th>
                        </tr>
                      </thead>
                      <tbody>
                        <!-- Loop melalui setiap detail perhitungan -->
                        <tr
                          v-for="(detail, index) in normalized_matrix"
                          :key="index"
                        >
                          <td>{{ detail.wisata }}</td>
                          <td>{{ detail["Keunikan dan Daya Tarik"] }}</td>
                          <td>{{ detail["Harga Tiket Masuk"] }}</td>
                          <td>{{ detail["Aksesibilitas Wisata"] }}</td>
                          <td>{{ detail["Jumlah Penginapan"] }}</td>
                          <td>{{ detail["Jumlah Wisata terdekat"] }}</td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </section>

          <section class="py-5" v-if="rankings && rankings.length > 0">
            <div class="container text-black">
              <div class="card shadow">
                <div class="card-header">
                  <h5>Hasil Perhitungan SAW</h5>
                </div>
                <div class="card-body">
                  <table class="table table-bordered">
                    <thead>
                      <tr>
                        <th>ID</th>
                        <th>Wisata</th>
                        <th>Nilai Preferensi (V)</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr v-for="(result, index) in rankings" :key="index">
                        <td>{{ result.id }}</td>
                        <td>{{ result.wisata }}</td>
                        <td>{{ result.V }}</td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </section>

          <!-- Tampilkan pesan kesimpulan -->
          <div class="container py-4 text-black" v-if="conclusion">
            <div class="card shadow">
              <div class="card-header">
                <h5>Kesimpulan</h5>
              </div>
              <div class="card-body">
                <p>{{ conclusion }}</p>
              </div>
            </div>
          </div>
        </div>
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
.bg-hefo {
  background-color: #86b817;
}
</style>
