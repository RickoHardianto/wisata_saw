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
  name: "categoryEdit",
  data() {
    return {
      categoryId: '',
      model: {
        formInput:{
            category:''
        }
      },
    };
  },
  mounted() {
    // console.log(this.$route.params.id);
    this.categoryId = this.$route.params.id
    this.fetchcategory(this.$route.params.id);
  },
  methods: {
    fetchcategory(id){
        axios.get(`http://localhost:8000/api/categories/${id}`)
        .then(res => {
        //  console.log(res.data.data);

         this.model.formInput = res.data.data
        })
        .catch(function(error){
            console.log(error);
        })

    },
    update(){
        axios.put(`http://localhost:8000/api/categories/${this.categoryId}`, this.model.formInput)
        .then(res => {
            console.log(res.data);
            alert(res.data.message)
            return this.$router.push('/kelola-kategori');
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
                Edit  Kategori
              </div>
              <div class="card-body">
                <div class="mb-3">
                    <label for="">Category</label>
                    <input type="text" v-model="model.formInput.category" class="form-control">
                </div>
                <div class="mb-3">
                    <button type="submit" @click="update" class="btn btn-primary btn-sm">Save</button>
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