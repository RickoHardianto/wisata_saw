<script>
import SidebarComponent from "../../../components/admin/SidebarComponent.vue";
import TopbarComponent from "../../../components/admin/TopbarComponent.vue";
import { ref, vModelRadio } from "vue";
import axios from "axios";

export default {
  components: {
    SidebarComponent,
    TopbarComponent,
  },
  name: "BusinessCreate",
  data() {
    return {
      model: {
        formInput: {
          wisata: "",
          deskripsi: "",
          price: "",
          penginapan: "",
          jarak: "",
          openTime: "",
          closeTime: "",
          access: [],
          address: "",
          kecamatan: "",
          numberPhone: "",
          img: null,
          img_lokasi: null,
          region_id: "",
          business_id: "",
          category_id: "",
        },
      },
      //state loggedIn with localStorage
      loggedIn: localStorage.getItem("loggedIn"),
      //state token
      token: localStorage.getItem("token"),
      //state user logged In
      user: [],
      regions: [],
      businesses: [],
      categories: [],
    };
  },
  mounted() {
    this.getBusines();
    this.getCategory();
    this.getRegion();
    this.getUserLogin().then(() => {
      console.log("User ID:", this.user.id); // Pastikan ID pengguna sudah tersedia sebelum menyimpan data
    });
  },
  methods: {
    getUserLogin() {
      return axios
        .get("http://localhost:8000/api/user", {
          headers: { Authorization: "Bearer " + this.token },
        })
        .then((response) => {
          this.user = response.data; // assign response to state user
        })
        .catch((error) => {
          console.error("Error fetching user data:", error);
        });
    },
    getRegion() {
      axios
        .get("http://localhost:8000/api/regions")
        .then((res) => {
          this.regions = res.data.data;
        })
        .catch(function (error) {
          console.log(error);
        });
    },
    getBusines() {
      axios
        .get("http://localhost:8000/api/business/")
        .then((res) => {
          this.businesses = res.data.data;
        })
        .catch(function (error) {
          console.log(error);
        });
    },
    getCategory() {
      axios
        .get("http://localhost:8000/api/categories/")
        .then((res) => {
          this.categories = res.data.data;
        })
        .catch(function (error) {
          console.log(error);
        });
    },
    handleImgUpload(event) {
      this.model.formInput.img = event.target.files[0];
    },
    handleLokasiUpload(event) {
      this.model.formInput.img_lokasi = event.target.files[0];
    },
    save() {
      let formData = new FormData();
      formData.append("img", this.model.formInput.img);
      formData.append("img_lokasi", this.model.formInput.img_lokasi);
      formData.append("wisata", this.model.formInput.wisata);
      formData.append("deskripsi", this.model.formInput.deskripsi);
      formData.append("price", this.model.formInput.price);
      formData.append("penginapan", this.model.formInput.penginapan);
      formData.append("jarak", this.model.formInput.jarak);
      formData.append("openTime", this.model.formInput.openTime);
      formData.append("closeTime", this.model.formInput.closeTime);
      formData.append("access", JSON.stringify(this.model.formInput.access));
      formData.append("address", this.model.formInput.address);
      formData.append("kecamatan", this.model.formInput.kecamatan);
      formData.append("numberPhone", this.model.formInput.numberPhone);
      formData.append("region_id", this.model.formInput.region_id);
      formData.append("business_id", this.model.formInput.business_id);
      formData.append("category_id", this.model.formInput.category_id);
      // Add user_id to the form data
      formData.append("user_id", this.user.id); // Assuming this.user contains the logged-in user's data
      axios
        .post("http://localhost:8000/api/destination", formData, {
          headers: {
            "Content-Type": "multipart/form-data",
            Authorization: "Bearer " + this.token,
          },
        })
        .then((res) => {
          console.log(res);
          this.model.formInput = {
            wisata: "",
            deskripsi: "",
            price: "",
            penginapan: "",
            jarak: "",
            openTime: "",
            closeTime: "",
            access: [],
            address: "",
            kecamatan: "",
            numberPhone: "",
            img: null,
            img_lokasi: null,
            region_id: "",
            business_id: "",
            category_id: "",
          };
          return this.$router.push("/kelola-tempat-wisata");
        })
        .catch(function (error) {
          console.log(error.message);
        });
    },
  },
};
</script>

<template>
  <!-- Page Wrapper -->
  <div id="wrapper">
    <SidebarComponent />

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">
      <!-- Main Content -->
      <div id="content">
        <TopbarComponent />

        <!-- Begin Page Content -->
        <div class="container-fluid">
          <!-- Page Heading -->
          <h1 class="h3 mb-4 text-gray-800">Kelola Tempat Wisata</h1>

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">Tambah Tempat Wisata</div>
            <div class="card-body">
              <div class="mb-3">
                <label for="">Nama Wisata</label>
                <input
                  type="text"
                  v-model="model.formInput.wisata"
                  class="form-control"
                />
              </div>
              <div class="mb-3">
                <label for="">Deskripsi Wisata</label>
                <textarea
                  type="text"
                  v-model="model.formInput.deskripsi"
                  class="form-control"
                ></textarea>
              </div>
              <div class="mb-3">
                <label for="">Harga Tiket Masuk</label>
                <input
                  type="text"
                  v-model="model.formInput.price"
                  class="form-control"
                />
              </div>
              <div class="mb-3">
                <label for="">Jumlah Penginapan</label>
                <input
                  type="number"
                  v-model="model.formInput.penginapan"
                  class="form-control"
                />
              </div>
              <div class="mb-3">
                <label for="">Jumlah jarak Wisata Terdekat</label>
                <input
                  type="number"
                  v-model="model.formInput.jarak"
                  class="form-control"
                />
              </div>
              <div class="mb-3">
                <div class="row">
                  <div class="col-6">
                    <label for="">Jam Buka</label>
                    <input
                      type="time"
                      v-model="model.formInput.openTime"
                      class="form-control"
                    />
                  </div>
                  <div class="col-6">
                    <label for="">Jam Tutup</label>
                    <input
                      type="time"
                      v-model="model.formInput.closeTime"
                      class="form-control"
                    />
                  </div>
                </div>
              </div>
              <div class="mb-3">
                <p>Access Kendaraan</p>
                <input
                  type="checkbox"
                  v-model="model.formInput.access"
                  value="1"
                  checked
                />
                <label for="mobil"> Kendaraan Roda 4</label>
                <br /><br />
                <input
                  type="checkbox"
                  v-model="model.formInput.access"
                  value="2"
                  checked
                />
                <label for="motor"> Kendaraan Roda 2</label>
                <br /><br />
                <input
                  type="checkbox"
                  v-model="model.formInput.access"
                  value="3"
                  checked
                />
                <label for="motor"> Kendaraan Umum</label>
              </div>
              <div class="mb-3">
                <label for="">Alamat</label>
                <input
                  type="text"
                  v-model="model.formInput.address"
                  class="form-control"
                />
              </div>
              <div class="mb-3">
                <label for="">Kecamatan</label>
                <input
                  type="text"
                  v-model="model.formInput.kecamatan"
                  class="form-control"
                />
              </div>
              <div class="mb-3">
                <label for="">Nomor Telepon</label>
                <input
                  type="text"
                  v-model="model.formInput.numberPhone"
                  placeholder="ex:0891212121221"
                  class="form-control"
                />
              </div>
              <div class="mb-3">
                <label for="">Image</label>
                <input
                  type="file"
                  id="img"
                  class="form-control"
                  @change="handleImgUpload"
                />
              </div>
              <div class="mb-3">
                <label for="">Lokasi Maps</label>
                <input
                  type="file"
                  id="img_lokasi"
                  class="form-control"
                  @change="handleLokasiUpload"
                />
              </div>
              <div class="mb-5">
                <div class="row">
                  <div class="col-4">
                    <div class="mb-3">
                      <label for="">Wilayah</label>
                      <select
                        class="form-select"
                        name="region_id"
                        v-model="model.formInput.region_id"
                      >
                        <option disable value="" selected>
                          Open this select menu
                        </option>
                        <option v-for="region in regions" :value="region.id">
                          {{ region.region }}
                        </option>
                      </select>
                    </div>
                  </div>
                  <div class="col-4">
                    <div class="mb-3">
                      <label for="">Bisnis & Usaha</label>
                      <select
                        class="form-select"
                        name="business_id"
                        v-model="model.formInput.business_id"
                      >
                        <option disable value="" selected>
                          Open this select menu
                        </option>
                        <option
                          v-for="business in businesses"
                          :value="business.id"
                        >
                          {{ business.business }}
                        </option>
                      </select>
                    </div>
                  </div>
                  <div class="col-4">
                    <div class="mb-3">
                      <label for="">Kategori</label>
                      <select
                        class="form-select"
                        name="category_id"
                        v-model="model.formInput.category_id"
                      >
                        <option disable value="" selected>
                          Open this select menu
                        </option>
                        <option
                          v-for="category in categories"
                          :value="category.id"
                        >
                          {{ category.category }}
                        </option>
                      </select>
                    </div>
                  </div>
                </div>
              </div>

              <div class="mb-3">
                <button
                  type="submit"
                  @click="save"
                  class="btn btn-primary btn-sm"
                >
                  Save
                </button>
              </div>
            </div>
          </div>
        </div>

        <!-- /.container-fluid -->
      </div>
      <!-- End of Main Content -->
    </div>
    <!-- End of Content Wrapper -->
  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>
</template>
