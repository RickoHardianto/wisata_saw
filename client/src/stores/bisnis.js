import { defineStore } from "pinia";
import { ref, computed } from "vue";
import axios from "axios";

export const useBisnisStore = defineStore("business", {
    state: () => ({
      businesses: [],
      dataInput: [],
      loggedIn: localStorage.getItem("loggedIn") === "true",
      token: localStorage.getItem("token") || "",
      loginFailed: null,
    }),
    getters: {},
    actions: {
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
      async formBusiness(dataInput) {
        try {
          const { data } = await axios({
            method: "POST",
            url: "http://localhost:8000/api/business",
            data:dataInput
          });
  
          console.log(data);
          // this.businesses = data.data;
          this.router.push('/tempat-wisata-&-usaha')
        } catch (error) {
          console.log(error);
        }
      },
    },
  });