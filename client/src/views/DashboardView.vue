<script>
import SidebarComponent from "../components/admin/SidebarComponent.vue";
import TopbarComponent from "../components/admin/TopbarComponent.vue";
import axios from 'axios'
export default {
  components: {
    TopbarComponent,
    SidebarComponent,
  },
  data() {
        return {
            //state loggedIn with localStorage
            loggedIn: localStorage.getItem('loggedIn'),
            //state token
            token: localStorage.getItem('token'),
            //state user logged In
            user: []
        }
    },
  created() {
    axios
      .get("http://localhost:8000/api/user", {
        headers: { Authorization: "Bearer " + this.token },
      })
      .then((response) => {
        console.log(response);
        this.user = response.data; // assign response to state user
      });
  },
  methods: {
    logout() {
      axios.get("http://localhost:8000/api/logout").then(() => {
        //remove localStorage
        localStorage.removeItem("loggedIn");

        //redirect
        return this.$router.push({ name: "login" });
      });
    },
  },
  //check user logged in or not
  mounted() {
    if (!this.loggedIn) {
      return this.$router.push({ name: "login" });
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
          <h1 class="h3 mb-4 text-gray-800">Dashboard</h1>
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
