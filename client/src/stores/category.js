import { defineStore } from "pinia";
import { ref, computed } from "vue";
import axios from "axios";

export const useCategoryStore = defineStore("category", {
  state: () => ({
    categories: [],
    formData: [],
    categoryData:[]
  }),
  getters: {},
  actions: {
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
    async addCategory(categoryData) {
      try {
        const { data } = await axios.post(
          "http://localhost:8000/api/categories",
          categoryData
        );
        this.categories.push(data.data);
      } catch (error) {
        console.error(error);
      }
    },
    async updateCategory(categoryData) {
      try {
        const { data } = await axios.put(
          `http://localhost:8000/api/categories/${this.editCategory.id}`,
          categoryData
        );
        const index = this.categories.findIndex(
          (category) => category.id === data.data.id
        );
        if (index !== -1) {
          this.categories[index] = data.data;
        }
      } catch (error) {
        console.error(error);
      }
    },
    async deleteCategory(categoryId) {
      try {
        await axios.delete(
          `http://localhost:8000/api/categories/${categoryId}`
        );
        this.categories = this.categories.filter(
          (category) => category.id !== categoryId
        );
      } catch (error) {
        console.error(error);
      }
    },
  },
});
