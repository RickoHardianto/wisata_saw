import { defineStore } from "pinia";
import { ref, computed } from "vue";
import axios from "axios";

export const useUserStore = defineStore("user", {
  state: () => ({
    destinations: [],
    destination: {},
    categories: [],
    regions: [],
    businesses: [],
    dataInput: [],
    loggedIn: localStorage.getItem("loggedIn") === "true",
    token: localStorage.getItem("token") || "",
    loginFailed: null,
  }),
  getters: {},
  actions: {
    async getToken() {
      axios.get("/sanctum/csrf-cookie");
    },
    async getUser() {
      const data = axios.get("/api/user");
      this.authUser = data.data;
    },
    async loginHandler(dataInput) {
      try {
        this.getToken();
        const { response } = await axios({
          method: "POST",
          url: "http://localhost:8000/api/login",
          data: dataInput,
        });

        if (response.data.success) {
          this.loggedIn = true;
          this.token = response.data.token;
          // Set localStorage
          localStorage.setItem("loggedIn", "true");
          localStorage.setItem("token", response.data.token);
          this.router.push("/admin");
        } else {
          // Set state login failed
          this.loginFailed = true;
        }
        console.log(response, "<<<");
      } catch (error) {
        console.log(error);
      }
    },
    async fetchDestination() {
      try {
        const { data } = await axios({
          method: "GET",
          url: "http://localhost:8000/api/destination",
        });

        console.log(data);
        this.destinations = data.data;
      } catch (error) {
        console.log(error);
      }
    },
    async fetchById(id) {
      try {
        let { data } = await axios.get(
          "http://localhost:8000/api/destination/" + id
        );
        this.destination = data.data;
      } catch (error) {
        console.log(error);
      }
    },
    async fetchCategories() {
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
    async fetchRegions() {
      try {
        const { data } = await axios({
          method: "GET",
          url: "http://localhost:8000/api/regions",
        });

        console.log(data);
        this.regions = data.data;
      } catch (error) {
        console.log(error);
      }
    },
    async fetchBusiness() {
      try {
        const { data } = await axios({
          method: "GET",
          url: "http://localhost:8000/api/business",
        });

        console.log(data);
        this.businesses = data.data;
      } catch (error) {
        console.log(error);
      }
    },
  },
});
