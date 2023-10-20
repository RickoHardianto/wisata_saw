<script>
import SidebarComponent from "../../../components/admin/SidebarComponent.vue";
import TopbarComponent from "../../../components/admin/TopbarComponent.vue";
import { mapActions, mapState } from "pinia";
import { useUserStore } from "../../../stores/wisata";
export default {
  components: {
    SidebarComponent,
    TopbarComponent,
  },
  computed: {
    ...mapState(useUserStore, ["businesses"]),
  },
  methods: {
    ...mapActions(useUserStore, ["fetchBusiness"]),
  },
  created() {
    this.fetchBusiness();
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
          <h1 class="h3 mb-4 text-gray-800">Kelola Tempat Wisata & Usaha</h1>

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <router-link
                to="/form-tempat-wisata-&-usaha"
                class="btn btn-primary btn-sm"
              >
                Tambah Tempat Wisata & Usaha
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
                      <th>#</th>
                      <th>Kategori Usaha & Wisata</th>
                      <th>action</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th>#</th>
                      <th>Kategori Usaha & Wisata</th>
                      <th>action</th>
                    </tr>
                  </tfoot>
                  <tbody>
                    <tr
                      v-for="(business, index) in businesses"
                      key="business.id"
                      :business="business"
                    >
                      <td>{{ index + 1 }}</td>
                      <td>{{ business.business }}</td>
                      <td>
                        <button class="btn btn-sm btn-warning m-1"><i class="fa fa-pen"></i></button>
                        <button class="btn btn-sm btn-danger m-1"><i class="fa fa-trash"></i></button>
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
</template>
