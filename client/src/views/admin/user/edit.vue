<script>
import SidebarComponent from "../../../components/admin/SidebarComponent.vue";
import TopbarComponent from "../../../components/admin/TopbarComponent.vue";
import { ref, vModelRadio } from "vue";
import axios from "axios";
import Swal from "sweetalert2";

export default {
  components: {
    SidebarComponent,
    TopbarComponent,
  },
  name: "userEdit",
  data() {
    return {
      userId: "",
      model: {
        formInput: {
          name: "",
          email: "",
          numberPhone: "",
          address: "",
        },
      },
    };
  },
  mounted() {
    // console.log(this.$route.params.id);
    this.userId = this.$route.params.id;
    this.fetchuser(this.$route.params.id);
  },
  methods: {
    fetchuser(id) {
      axios
        .get(`http://localhost:8000/api/users/${id}`)
        .then((res) => {
          //  console.log(res.data.data);

          this.model.formInput = res.data.data;
        })
        .catch(function (error) {
          console.log(error);
        });
    },
    update() {
      axios
        .put(
          `http://localhost:8000/api/users/${this.userId}`,
          this.model.formInput
        )
        .then((res) => {
          Swal.fire({
            icon: "success",
            title: "Success",
            text: res.data.message,
          }).then(() => {
            this.$router.push("/user");
          });
        })
        .catch((error) => {
          let errorMessage = "Something went wrong!";
          if (
            error.response &&
            error.response.data &&
            error.response.data.message
          ) {
            errorMessage = error.response.data.message;
          }
          Swal.fire({
            icon: "error",
            title: "Oops...",
            text: errorMessage,
          });
          console.log(error);
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
          <h1 class="h3 mb-4 text-gray-800">Kelola User</h1>

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">Edit User</div>
            <div class="card-body">
              <div class="mb-3">
                <label for="">Nama</label>
                <input
                  type="text"
                  v-model="model.formInput.name"
                  class="form-control"
                />
              </div>
              <div class="mb-3">
                <label for="">Email</label>
                <input
                  type="email"
                  v-model="model.formInput.email"
                  class="form-control"
                />
              </div>
              <div class="mb-3">
                <label for="">Nomor Telepon</label>
                <input
                  type="text"
                  v-model="model.formInput.numberPhone"
                  class="form-control"
                />
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
                <button
                  type="submit"
                  @click="update"
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
