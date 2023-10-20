import { createRouter, createWebHistory } from "vue-router";
import LandingView from "../views/landingView.vue";
import DetailwisataView from "../views/DetailwisataView.vue";


import LoginView from "../views/admin/login.vue";
import DashboardView from "../views/DashboardView.vue";
import UserView from "../views/admin/user/user.vue";
import kelolaKategori from "../views/admin/category/KelolaKategori.vue";
import kelolaTEmpatWisata from "../views/admin/destinasi/KelolaTempat.vue";

import tempatWisata from "../views/admin/bisnis/KelolaTempatUsaha.vue";
import formTempatWisata from "../views/admin/bisnis/formTempatUsaha.vue";

import manajemenWilayah from "../views/admin/wilayah/KelolaWilayah.vue";
import rekomendasiWIsata from "../views/admin/RekomendasiWisata.vue";

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: "/",
      name: "landing",
      component: LandingView,
    },
    {
      path: "/detail/:id",
      name: "detail",
      component: DetailwisataView,
    },
    {
      path: "/login",
      name: "login",
      component: LoginView,
    },
    {
      path: "/register",
      name: "register",
      component: LoginView,
    },
    {
      path: "/admin",
      name: "admin",
      component: DashboardView,
    },
    {
      path: "/user",
      component: UserView,
    },
    {
      path: "/kelola-kategori",
      component: kelolaKategori,
    },
    {
      path: "/kelola-tempat-wisata",
      component: kelolaTEmpatWisata,
    },
    {
      path: "/tempat-wisata-&-usaha",
      component: tempatWisata,
    },
    {
      path: "/form-tempat-wisata-&-usaha",
      component: formTempatWisata,
    },
    {
      path: "/manajemen-wilayah",
      component: manajemenWilayah,
    },
    {
      path: "/rekomendasi-wisata",
      component: rekomendasiWIsata,
    },
  ],
});

export default router;
