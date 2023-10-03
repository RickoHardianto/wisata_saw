import { defineStore } from "pinia";
import { ref, computed } from "vue";
import axios from "axios";

export const useUserStore = defineStore("user", {
  state: () => ({
    destinations: [],
    categories: [],
    regions: [],
    businesses: [],
  }),
  getters: {},
  actions: {
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
