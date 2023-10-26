<script>
import SidebarComponent from "../../../components/admin/SidebarComponent.vue";
import TopbarComponent from "../../../components/admin/TopbarComponent.vue";
import axios from "axios";

export default {
  components: {
    SidebarComponent,
    TopbarComponent,
  },
  name: "Destinations",
  data() {
    return {
      destinations: [],
    };
  },
  mounted() {
    this.fetchDestinations();
  },
  methods: {
    async fetchDestinations() {
      try {
        const { data } = await axios({
          method: "GET",
          url: "http://localhost:8000/api/destination",
        });

        console.log(data);
        this.destinations = data.data;
      } catch (error) {
        console.log(error);
      }
    },
    deleteDestination(id) {
      console.log(id);
      axios
        .delete(`http://localhost:8000/api/destination/${id}`)
        .then((res) => {
          console.log(res);
          this.fetchDestinations();
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
          <h1 class="h3 mb-4 text-gray-800">Kelola Tempat Wisata</h1>
          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <router-link
                to="/kelola-tempat-wisata/create"
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
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <th style="width: 10px">#</th>
                    <th>Nama Wisata</th>
                    <th>Action</th>
                  </tfoot>
                  <tbody>
                    <tr
                      v-for="(destination, index) in destinations"
                      key="destination.id"
                      :destination="destination"
                    >
                      <td>{{ index + 1 }}</td>
                      <td>{{ destination.wisata }}</td>
                      <td>
                        <button class="btn btn-sm btn-info m-1">
                          <i class="fa fa-eye"></i>
                        </button>
                        <router-link
                        :to="{path: '/kelola-tempat-wisata/'+ destination.id}"
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
