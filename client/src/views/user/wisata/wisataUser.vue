<script>
import SidebarComponent from "../../../components/admin/SidebarComponent.vue";
import TopbarComponent from "../../../components/admin/TopbarComponent.vue";
import axios from "axios";
import Swal from "sweetalert2";

export default {
  components: {
    SidebarComponent,
    TopbarComponent,
  },
  name: "Destinations",
  data() {
    return {
      destinations: [],
      isLoading: false,
      error: null,
      //state loggedIn with localStorage
      loggedIn: localStorage.getItem("loggedIn"),
      //state token
      token: localStorage.getItem("token"),
      //state user logged In
      user: [],
    };
  },
  mounted() {
    this.getUserLogin().then(() => {
      console.log("User ID:", this.user.id); // Pastikan ID pengguna sudah tersedia sebelum menyimpan data
      this.fetchDestinations();
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
    async fetchDestinations() {
      this.isLoading = true;
      try {
        const token = localStorage.getItem("token");
        const user_id = this.user.id;
        const { data } = await axios({
          method: "GET",
          url: `http://localhost:8000/api/kelola-wisata?user_id=${user_id}`,
          headers: { Authorization: "Bearer " + token },
        });
        // console.log(data);
        this.destinations = data.data; // pastikan struktur data.data sesuai dengan respons dari backend
      } catch (error) {
        this.error = "Gagal memuat data destinasi."; // menangani kesalahan
        console.error(error);
      }
      this.isLoading = false;
    },
    deleteDestination(id) {
      Swal.fire({
        title: "Anda yakin?",
        text: "Anda tidak dapat mengembalikan data yang sudah dihapus!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#d33",
        cancelButtonColor: "#3085d6",
        confirmButtonText: "Ya, hapus!",
        cancelButtonText: "Batal",
      }).then((result) => {
        if (result.isConfirmed) {
          axios
            .delete(`http://localhost:8000/api/kelola-wisata/${id}`)
            .then(() => {
              this.fetchDestinations();
              Swal.fire("Terhapus!", "Destinasi telah dihapus.", "success");
            })
            .catch((error) => {
              this.error = "Gagal menghapus destinasi.";
              console.error(error);
              Swal.fire("Gagal!", "Terjadi kesalahan saat menghapus.", "error");
            });
        }
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
            <div class="card-header py-3">
              <router-link
                to="/kelola-wisata-create"
                class="btn btn-primary btn-sm"
              >
                Tambah Tempat Wisata
              </router-link>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table
                  class="table table-bordered"
                  id="dataTable"
                  width="100%"
                  cellspacing="0"
                >
                  <thead>
                    <tr>
                      <th style="width: 10px">#</th>
                      <th>Nama Wisata</th>
                      <th>Status</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <th style="width: 10px">#</th>
                    <th>Nama Wisata</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tfoot>
                  <tbody v-if="destinations.length > 0">
                    <tr
                      v-for="(destination, index) in destinations"
                      key="destination.id"
                      :destination="destination"
                    >
                      <td>{{ index + 1 }}</td>
                      <td>{{ destination.wisata }}</td>
                      <td>{{ destination.status }}</td>
                      <td class="d-flex align-items-center">
                        <router-link
                          :to="{
                            path:
                              '/kelola-tempat-wisata/' +
                              destination.id +
                              '/detail',
                          }"
                          class="btn btn-sm btn-info m-1"
                          ><i class="fa fa-eye"></i
                        ></router-link>
                        <router-link
                          :to="{
                            path: '/kelola-tempat-wisata/' + destination.id,
                          }"
                          class="btn btn-sm btn-warning m-1"
                          ><i class="fa fa-pen"></i
                        ></router-link>
                        <button
                          @click="deleteDestination(destination.id)"
                          class="btn btn-sm btn-danger m-1"
                        >
                          <i class="fa fa-trash"></i>
                        </button>
                      </td>
                    </tr>
                  </tbody>
                  <tbody v-else>
                    <tr>
                      <td colspan="4" class="text-center">Tidak ada data</td>
                    </tr>
                  </tbody>
                </table>
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
