<script>
import axios from "axios";

export default {
  name: "Login",

  data() {
    return {
      //state loggedIn with localStorage
      loggedIn: localStorage.getItem("loggedIn"),
      //state token
      token: localStorage.getItem("token"),

      user: localStorage.getItem("user"),
      //state user
      user: [],
      //state validation
      validation: [],
      //state login failed
      loginFailed: null,
    };
  },
  methods: {
    login() {
      if (this.user.email && this.user.password) {
        axios
          .get("http://localhost:8000/sanctum/csrf-cookie")
          .then((response) => {
            //debug cookie
            // console.log(response);
            axios
              .post("http://localhost:8000/api/login", {
                email: this.user.email,
                password: this.user.password,
              })
              .then((res) => {
                // console.log(res.data.user);
                Toastify({
                  text: res.data.message,
                  duration: 3000,
                }).showToast();

                if (res.data.success) {
                  localStorage.setItem("loggedIn", "true");
                  localStorage.setItem("token", res.data.token);
                  localStorage.setItem("user", JSON.stringify(res.data.user));
                  let userData = JSON.parse(localStorage.getItem("user"));
                  let userLevel = userData.level;
                  console.log(userLevel);
                  this.loggedIn = true;
                  if (userLevel === "admin") {
                    this.$router.push({ name: "admin" });
                  } else {
                    this.$router.push({ name: "dashboard" });
                  }
                } else {
                  this.loginFailed = true;
                }
              })
              .catch((error) => {
                // console.log(error);
                if (error.response.status === 401) {
                  Toastify({
                    text: "Password salah.",
                    duration: 3000,
                    style: { background: "red" },
                  }).showToast();
                } else if (error.response.status === 404) {
                  Toastify({
                    text: "Email tidak ditemukan.",
                    duration: 3000,
                    style: { background: "red" },
                  }).showToast();
                } else {
                  Toastify({
                    text: "Terjadi kesalahan: " + error.response.data.message,
                    duration: 3000,
                    style: { background: "red" },
                  }).showToast();
                }
              });
          });
      }

      this.validation = [];

      if (!this.user.email) {
        this.validation.email = true;
      }

      if (!this.user.password) {
        this.validation.password = true;
      }
    },
  },

  //check user already logged in
  mounted() {
    if (this.loggedIn) {
      return this.$router.push({ name: "dashboard" });
    }
  },
};
</script>

<template>
  <div class="container mt-5">
    <div class="col-md-6 m-auto">
      <div class="card">
        <div class="card-body">
          <div class="text-center">
            <h1 class="h4 text-gray-900 mb-4">Login</h1>
          </div>
          <form class="user" @submit.prevent="login">
            <div class="form-group">
              <input
                type="email"
                class="form-control form-control-user"
                id="exampleInputEmail"
                aria-describedby="emailHelp"
                placeholder="Enter Email Address..."
                v-model="user.email"
              />
            </div>
            <div class="form-group">
              <input
                type="password"
                class="form-control form-control-user"
                placeholder="Password"
                v-model="user.password"
              />
            </div>
            <button type="submit" class="btn btn-primary btn-user btn-block">
              Login
            </button>
            <hr />
          </form>
          <div class="text-center">
            <router-link class="small" to="/register">Buat Akun!</router-link>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
