<script>
import SidebarComponent from "../../../components/admin/SidebarComponent.vue";
import TopbarComponent from "../../../components/admin/TopbarComponent.vue";
import { ref } from "vue";
import axios from "axios";

export default {
  components: {
    SidebarComponent,
    TopbarComponent,
  },
  name: "category",
  data() {
    return {
      categories: [],
    };
  },
  mounted() {
    this.fetchCategory();
  },
  methods: {
    async fetchCategory() {
      try {
        const { data } = await axios({
          method: "GET",
          url: "http://localhost:8000/api/categories",
        });

        console.log(data);
        this.categories = data.data;
      } catch (error) {
        console.log(error);
      }
    },
    deleteCategory(id){
      console.log(id);
      axios.delete(`http://localhost:8000/api/categories/${id}`)
      .then(res => {
        console.log(res);
        this.fetchCategory()
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
          <h1 class="h3 mb-4 text-gray-800">Kelola Kategori</h1>
          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <router-link
                to="/kelola-kategori/create"
                class="btn btn-primary btn-sm"
              >
                Tambah Kategori
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
                      <th>Nama Kategori</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <th style="width: 10px">#</th>
                    <th>Nama Kategori</th>
                    <th>Action</th>
                  </tfoot>
                  <tbody>
                    <tr
                      v-for="(category, index) in categories"
                      key="category.id"
                    >
                      <td>{{ index + 1 }}</td>
                      <td>{{ category.category }}</td>
                      <td>
                        <router-link
                        :to="{path: '/kelola-kategori/'+ category.id}"
                          class="btn btn-warning btn-sm"
                        >
                        <i class="fa fa-pen"></i>
                        </router-link>
                        <button
                          class="btn btn-sm btn-danger m-1"
                          @click="deleteCategory(category.id)"
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
