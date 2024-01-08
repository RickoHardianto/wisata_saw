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
  name: "KriteriaCreate",
  data() {
    return {
      model: {
        formInput:{
            nama:'',
            bobot:'',
            atribut:''
        }
      },
    };
  },
  mounted() {
  },
  methods: {
    save(){
        axios.post('http://localhost:8000/api/kriteria/', this.model.formInput)
        .then(res => {
            console.log(res);
            this.model.formInput = {
                nama:'',
                bobot:'',
                atribut:''
            }
            return this.$router.push('/kriteria');
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
            <h1 class="h3 mb-4 text-gray-800">Kriteria</h1>
  
            <!-- DataTales Example -->
            <div class="card shadow mb-4">
              <div class="card-header py-3">
                Tambah Kriteria
              </div>
              <div class="card-body">
                <div class="mb-3">
                    <label for="">Nama</label>
                    <input type="text" v-model="model.formInput.nama" class="form-control">
                </div>
                <div class="mb-3">
                    <label for="">Bobot</label>
                    <input type="text" v-model="model.formInput.bobot" class="form-control">
                </div>
                <div class="mb-3">
                    <label for="">Atribut</label>
                    <input type="text" v-model="model.formInput.atribut" class="form-control">
                </div>
                <div class="mb-3">
                    <button type="submit" @click="save" class="btn btn-primary btn-sm">Save</button>
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