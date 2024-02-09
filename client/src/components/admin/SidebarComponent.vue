<script>
import axios from "axios";

export default {
  data() {
    return {
      //state loggedIn with localStorage
      loggedIn: localStorage.getItem("loggedIn"),
      //state token
      token: localStorage.getItem("token"),
      //state user logged In
      user: [],
    };
  },
  created() {
    axios
      .get("http://localhost:8000/api/user", {
        headers: { Authorization: "Bearer " + this.token },
      })
      .then((response) => {
        // console.log(response);
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
  <div>
    <!-- Sidebar -->
    <ul
      class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion"
      id="accordionSidebar"
    >
      <!-- Sidebar - Brand -->
      <router-link
        class="sidebar-brand d-flex align-items-center justify-content-center"
        to="/admin"
      >
        <div class="sidebar-brand-text mx-3">Destinasi Wisata</div>
      </router-link>

      <!-- Divider -->
      <hr class="sidebar-divider my-0" />

      <!-- Nav Item - Dashboard -->
      <li class="nav-item">
        <router-link to="/admin" class="nav-link">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dashboard</span></router-link
        >
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider" />

      <!-- Heading -->
      <div class="sidebar-heading">Admin</div>

      <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item">
        <a
          class="nav-link collapsed"
          href="#"
          data-toggle="collapse"
          data-target="#collapseOne"
          aria-expanded="true"
          aria-controls="collapseOne"
        >
          <i class="fas fa-fw fa-cog"></i>
          <span>Kelola Destinasi</span>
        </a>
        <div
          id="collapseOne"
          class="collapse"
          aria-labelledby="headingTwo"
          data-parent="#accordionSidebar"
        >
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Pengaturan :</h6>

            <router-link to="/kelola-kategori" class="collapse-item"
              >Kelola Kategori</router-link
            >
            <router-link to="/kelola-tempat-wisata" class="collapse-item"
              >Kelola Tempat Wisata</router-link
            >
            <router-link to="/tempat-wisata-&-usaha" class="collapse-item"
              >Tempat Wisata & Usaha</router-link
            >
            <router-link to="/manajemen-wilayah" class="collapse-item"
              >Kelola Wilayah</router-link
            >
          </div>
        </div>
      </li>

      <li class="nav-item">
        <a
          class="nav-link collapsed"
          href="#"
          data-toggle="collapse"
          data-target="#collapseTwo"
          aria-expanded="true"
          aria-controls="collapseTwo"
        >
          <i class="fas fa-fw fa-cog"></i>
          <span>User</span>
        </a>
        <div
          id="collapseTwo"
          class="collapse"
          aria-labelledby="headingTwo"
          data-parent="#accordionSidebar"
        >
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Pengaturan User:</h6>
            <router-link to="/user" class="collapse-item"
              >Kelola User</router-link
            >
            <router-link to="/role" class="collapse-item"
              >Peran User</router-link
            >
          </div>
        </div>
      </li>
      <!-- Divider -->
      <hr class="sidebar-divider" />

      <!-- PENGGUNA DESTINASI WISATA -->

      <!-- Heading -->
      <div class="sidebar-heading">Manajemen</div>

      <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item">
        <a
          class="nav-link collapsed"
          href="#"
          data-toggle="collapse"
          data-target="#collapse"
          aria-expanded="true"
          aria-controls="collapse"
        >
          <i class="fas fa-fw fa-cog"></i>
          <span>Kelola Wisata</span>
        </a>
        <div
          id="collapse"
          class="collapse"
          aria-labelledby="headingTwo"
          data-parent="#accordionSidebar"
        >
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Pengaturan :</h6>
            <a class="collapse-item" href="/dashboard">Dashboard</a>
            <a class="collapse-item" href="/kelola-wisata">Kelola Wisata</a>
          </div>
        </div>
      </li>

      <li class="nav-item">
        <a @click.prevent="logout" class="nav-link">
          <i class="fas fa-fw fa-arrow-left"></i>
          <span>Keluar</span></a
        >
      </li>
      <!-- Divider -->
      <hr class="sidebar-divider" />
    </ul>
    <!-- End of Sidebar -->
  </div>
</template>
