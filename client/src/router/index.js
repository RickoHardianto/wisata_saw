import { createRouter, createWebHistory } from "vue-router";
import LandingView from "../views/landingView.vue";

import LoginView from "../views/admin/login.vue";
import AdminView from "../views/adminView.vue";
import UserView from "../views/admin/user.vue";
import kelolaTEmpatWisata from "../views/admin/user.vue";
import tempatWisata from "../views/admin/user.vue";
import manajemenWilayah from "../views/admin/user.vue";
import rekomendasiWIsata from "../views/admin/user.vue";

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: "/",
      name: "landing",
      component: LandingView,
    },
    {
      path: "/login",
      name: "login",
      component: LoginView,
    },
    {
      path: "/admin",
      name: "admin",
      component: AdminView,
      children: [
        {
          path: "/user",
          component: UserView,
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
          path: "/manajemen-wilayah",
          component: manajemenWilayah,
        },
        {
          path: "/rekomendasi-wisata",
          component: rekomendasiWIsata,
        },
      ],
    },
  ],
});

export default router;
