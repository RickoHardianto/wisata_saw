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

          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h4>Tambah Tempat Wisata & Usaha</h4>
            </div>
            <div class="card-body">
              <form action="" method="post">
                <div class="input-group mb-3">
                  <input
                    type="text"
                    class="form-control"
                    placeholder="Nama Kategori"
                    aria-label="Nama Kategori"
                    aria-describedby="button-addon2"
                  />
                  <button
                    class="btn btn-outline-success"
                    type="button"
                    id="button-addon2"
                  >
                    Tambah
                  </button>
                </div>
              </form>
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
