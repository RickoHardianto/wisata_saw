<script>
import SidebarComponent from "../../../components/admin/SidebarComponent.vue";
import TopbarComponent from "../../../components/admin/TopbarComponent.vue";
import { ref } from "vue";
import axios from "axios";

export default{
    components: {
    SidebarComponent,
    TopbarComponent,
  },
  name: "Kriteria",
  data() {
    return {
      kriterias: [],
    };
  },
  mounted() {
    this.fetchKriteria();
  },
  methods: {
    async fetchKriteria() {
      try {
        const { data } = await axios({
          method: "GET",
          url: "http://localhost:8000/api/kriteria",
        });

        console.log(data);
        this.kriterias = data.data;
      } catch (error) {
        console.log(error);
      }
    },
    deleteKriteria(id){
      console.log(id);
      axios.delete(`http://localhost:8000/api/kriteria/${id}`)
      .then(res => {
        console.log(res);
        this.fetchKriteria()
      })
      .catch(function(error){
        console.log(error);
      })
    } 
  },
}
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
          <h1 class="h3 mb-4 text-gray-800">Kriteria</h1>

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <router-link
                to="/kriteria/create"
                class="btn btn-primary btn-sm"
              >
                Tambah Kriteria
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
                      <th>Nama</th>
                      <th>Bobot</th>
                      <th>Atribut</th>
                      <th>action</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th>#</th>
                      <th>Nama</th>
                      <th>Bobot</th>
                      <th>Atribut</th>
                      <th>action</th>
                    </tr>
                  </tfoot>
                  <tbody>
                    <tr
                      v-for="(kriteria, index) in kriterias"
                      :key="kriteria.id"
                      :kriteria="kriteria"
                    >
                      <td>{{ index + 1 }}</td>
                      <td>{{ kriteria.nama }}</td>
                      <td>{{ kriteria.bobot }}</td>
                      <td>{{ kriteria.atribut }}</td>
                      <td>
                        <router-link
                          :to="{path: '/editkriteria/'+ kriteria.id}"
                          class="btn btn-warning btn-sm"
                        >
                        <i class="fa fa-pen"></i>
                        </router-link>
                        <button
                          @click="deleteKriteria(kriteria.id)"
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
</template>