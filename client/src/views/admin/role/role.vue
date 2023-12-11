<script>
import SidebarComponent from "../../../components/admin/SidebarComponent.vue";
import TopbarComponent from "../../../components/admin/TopbarComponent.vue";
import axios from "axios";

export default {
  components: {
    SidebarComponent,
    TopbarComponent,
  },
  name: "role",
  data() {
    return {
      roles: [],
    };
  },
  mounted() {
    this.fetchRole();
  },
  methods: {
    async fetchRole() {
      try {
        const { data } = await axios({
          method: "GET",
          url: "http://localhost:8000/api/roles",
          headers:{
            
          }
        });

        console.log(data);
        this.roles = data.data;
      } catch (error) {
        console.log(error);
      }
    },
    deleteRole(id){
      console.log(id);
      axios.delete(`http://localhost:8000/api/roles/${id}`)
      .then(res => {
        console.log(res);
        this.fetchRole()
      })
      .catch(function(error){
        console.log(error);
      })
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
          <h1 class="h3 mb-4 text-gray-800">User Role</h1>

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <router-link
                to="/role/create"
                class="btn btn-primary btn-sm"
              >
                Tambah Role
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
                      <th>Nama Role</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th style="width: 10px">#</th>
                      <th>Nama Role</th>
                      <th>Action</th>
                    </tr>
                  </tfoot>
                  <tbody>
                    <tr v-for="(role, index) in roles"
                      key="role.id">
                      <td>{{ index + 1 }}</td>
                      <td>{{ role.name }}</td>
                      <td>
                        <router-link
                        :to="{path: '/role/'+ role.id}"
                          class="btn btn-warning btn-sm"
                        >
                        <i class="fa fa-pen"></i>
                        </router-link>
                        <button
                          class="btn btn-sm btn-danger m-1"
                          @click="deleteRole(role.id)"
                        >
                          <i class="fa fa-trash"></i>
                        </button>
                      </td>
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

  <!-- Logout Modal-->
  <div
    class="modal fade"
    id="logoutModal"
    tabindex="-1"
    role="dialog"
    aria-labelledby="exampleModalLabel"
    aria-hidden="true"
  >
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
          <button
            class="close"
            type="button"
            data-dismiss="modal"
            aria-label="Close"
          >
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          Select "Logout" below if you are ready to end your current session.
        </div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">
            Cancel
          </button>
          <a class="btn btn-primary" href="login.html">Logout</a>
        </div>
      </div>
    </div>
  </div>
</template>
