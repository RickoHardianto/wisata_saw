<script>
export default {};
</script>

<template>
  <div>
    <!-- Sidebar -->
    <ul
      class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion"
      id="accordionSidebar"
    >
      <!-- Sidebar - Brand -->
      <a
        class="sidebar-brand d-flex align-items-center justify-content-center"
        href="index.html"
      >
        <div class="sidebar-brand-text mx-3">Destinasi Wisata</div>
      </a>

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
          data-target="#collapseTwo"
          aria-expanded="true"
          aria-controls="collapseTwo"
        >
          <i class="fas fa-fw fa-cog"></i>
          <span>Management</span>
        </a>
        <div
          id="collapseTwo"
          class="collapse"
          aria-labelledby="headingTwo"
          data-parent="#accordionSidebar"
        >
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Custom Management:</h6>
            <router-link to="/user" class="collapse-item"
              >Management User</router-link
            >
            <router-link to="/kelola-tempat-wisata" class="collapse-item"
              >Kelola Tempat Wisata</router-link
            >
            <router-link to="/tempat-wisata-&-usaha" class="collapse-item"
              >Tempat Wisata & Usaha</router-link
            >
            <router-link to="/manajemen-wilayah" class="collapse-item"
              >Manajemen Wilayah</router-link
            >
            <router-link to="/rekomendasi-wisata" class="collapse-item" href="#"
              >Rekomendasi Wisata</router-link
            >
          </div>
        </div>
      </li>
      <!-- Divider -->
      <hr class="sidebar-divider" />
      <!-- Divider -->
      <hr class="sidebar-divider" />

      <!-- Heading -->
      <div class="sidebar-heading">Manager</div>

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
          <span>Management Wisata</span>
        </a>
        <div
          id="collapse"
          class="collapse"
          aria-labelledby="headingTwo"
          data-parent="#accordionSidebar"
        >
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Custom Management:</h6>
            <a class="collapse-item" href="#">Rating Average</a>
            <a class="collapse-item" href="#">Count Like</a>
            <a class="collapse-item" href="#">All Comment</a>
          </div>
        </div>
      </li>
      <!-- Divider -->
      <hr class="sidebar-divider" />
    </ul>
    <!-- End of Sidebar -->
  </div>
</template>
