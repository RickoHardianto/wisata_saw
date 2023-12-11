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
  name: "categoryCreate",
  data() {
    return {
      model: {
        formInput: {
          name: "",
          permission: [],
        },
      },
      permissions: [],
    };
  },
  mounted() {
    this.fetchPermission();
  },
  methods: {
    fetchPermission() {
      axios
        .get("http://localhost:8000/api/roles/create")
        .then((res) => {
          // console.log("ini permission", res.data.data);
          this.permissions = res.data.data;
        })
        .catch(function (error) {
          console.log(error);
        });
    },
    save() {
      axios
        .post("http://localhost:8000/api/roles/", this.model.formInput)
        .then((res) => {
          console.log(res);
          this.model.formInput = {
            name: "",
            permission: "",
          };
          return this.$router.push("/role");
        })
        .catch(function (error) {
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
          <h1 class="h3 mb-4 text-gray-800">Kelola Role</h1>

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">Tambah Role</div>
            <div class="card-body">
              <div class="mb-3">
                <label for="">Nama Role</label>
                <input
                  type="text"
                  v-model="model.formInput.name"
                  class="form-control"
                />
              </div>
              <div class="mb-3">
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
                            <th>Pilih Permission</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr v-for="(item, index) in permissions" :key="index">
                            <td>{{ index + 1 }}</td>
                            <td>
                              <input
                                type="checkbox"
                                :value="item.id"
                                :id="'permission_' + item.id"
                                v-model="model.formInput.permission"
                              />
                              {{ item.name }}
                            </td>
                          </tr>
                        </tbody>
                      </table>
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
