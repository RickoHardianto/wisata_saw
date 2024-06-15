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
  data() {
    return {
      Users: [],
    };
  },
  mounted() {
    this.fetchUser();
  },
  methods: {
    async fetchUser() {
      try {
        const { data } = await axios({
          method: "GET",
          url: "http://localhost:8000/api/users",
          headers: {
            Authorization: `Bearer ${localStorage.getItem("token")}`,
          },
        });

        console.log(data);
        this.Users = data.data;
      } catch (error) {
        console.log(error);
      }
    },
    deleteUser(id) {
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
            .delete(`http://localhost:8000/api/users/${id}`)
            .then(() => {
              this.fetchUser();
              Swal.fire("Terhapus!", "User telah dihapus.", "success");
            })
            .catch((error) => {
              this.error = "Gagal menghapus user.";
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
          <h1 class="h3 mb-4 text-gray-800">User</h1>

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Data User</h6>
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
                      <th>#</th>
                      <th>Nama</th>
                      <th>Email</th>
                      <th>Nomor Telepon</th>
                      <th>Alamat</th>
                      <th>Level</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="(user, index) in Users" key="user.id">
                      <td>{{ index + 1 }}</td>
                      <td>{{ user.name }}</td>
                      <td>{{ user.email }}</td>
                      <td>{{ user.numberPhone }}</td>
                      <td>{{ user.address }}</td>
                      <td>{{ user.level }}</td>
                      <td>
                        <router-link
                          :to="{ path: '/user/' + user.id }"
                          class="btn btn-warning btn-sm"
                        >
                          <i class="fa fa-pen"></i>
                        </router-link>
                        <button
                          class="btn btn-sm btn-danger m-1"
                          @click="deleteUser(user.id)"
                        >
                          <i class="fa fa-trash"></i>
                        </button>
                      </td>
                    </tr>
                  </tbody>
                  <tfoot>
                    <tr>
                      <th>#</th>
                      <th>Nama</th>
                      <th>Email</th>
                      <th>Nomor Telepon</th>
                      <th>Alamat</th>
                      <th>Level</th>
                      <th>Action</th>
                    </tr>
                  </tfoot>
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
