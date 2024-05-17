<script>
import SidebarComponent from "../components/admin/SidebarComponent.vue";
import TopbarComponent from "../components/admin/TopbarComponent.vue";
import axios from "axios";
export default {
  components: {
    TopbarComponent,
    SidebarComponent,
  },
  data() {
    return {
      //state loggedIn with localStorage
      loggedIn: localStorage.getItem("loggedIn"),
      //state token
      token: localStorage.getItem("token"),
      //state user logged In
      user: [],
      businessDestination: [],
      kriterias: [],
    };
  },
  created() {
    axios
      .get("http://localhost:8000/api/user", {
        headers: { Authorization: "Bearer " + this.token },
      })
      .then((response) => {
        // console.log(response);
        this.user = response.data; // assign response to state user
      });
    axios
      .get("http://localhost:8000/api/dashboard")
      .then((response) => {
        // Set data from backend to Vue component
        this.totalDestinations = response.data.total_destinations;
        this.totalCategories = response.data.total_categories;
        this.totalRegions = response.data.total_regions;
        this.validasiDestinations = response.data.validasi_destination;
        this.businessDestination = response.data.business_destination;
        this.kriterias = response.data.kriteria;
      })
      .catch((error) => {
        console.error("Error fetching data: ", error);
      });
  },
  methods: {
    logout() {
      axios.get("http://localhost:8000/api/logout").then(() => {
        //remove localStorage
        localStorage.removeItem("loggedIn");

        //redirect
        return this.$router.push({ name: "login" });
      });
    },
  },
  mounted() {
    if (!this.loggedIn) {
      return this.$router.push({ name: "login" });
    }
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
          <div
            class="d-sm-flex align-items-center justify-content-between mb-4"
          >
            <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
          </div>
          <!-- Content Row -->
          <div class="row">
            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div
                        class="text-xs font-weight-bold text-warning text-uppercase mb-1"
                      >
                        Validasi Destinasi wisata
                      </div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">
                        {{ validasiDestinations }}
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div
                        class="text-xs font-weight-bold text-info text-uppercase mb-1"
                      >
                        jumlah wisata
                      </div>
                    </div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                      {{ totalDestinations }}
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div
                        class="text-xs font-weight-bold text-success text-uppercase mb-1"
                      >
                        Jumlah Kategori
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                          {{ totalCategories }}
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Pending Requests Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-danger shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div
                        class="text-xs font-weight-bold text-danger text-uppercase mb-1"
                      >
                        Jumlah Wilayah
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                          {{ totalRegions }}
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Content Row -->
          <div class="row">
            <!-- Content Column -->
            <div class="col-lg-6 mb-4">
              <!-- Project Card Example -->
              <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">
                    Kategori Wisata & Usaha
                  </h6>
                </div>
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-6">
                      <div
                        v-for="business in businessDestination"
                        :key="business.business"
                      >
                        {{ business.business }}
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div
                        v-for="business in businessDestination"
                        :key="business.business"
                      >
                        <div v-if="business.total_destinations > 0">
                          {{ business.total_destinations }}
                        </div>
                        <div v-else>0</div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-lg-6 mb-4">
              <!-- Illustrations -->
              <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">Kriteria</h6>
                </div>
                <div class="card-body">
                  <div v-for="kriteria in kriterias" :key="kriteria.kriteria">
                    {{ kriteria.nama }}
                  </div>
                </div>
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
