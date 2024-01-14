<template>
    <div>
      <h2>Hasil Perhitungan SAW</h2>
      <table>
        <thead>
          <tr>
            <th>Rank</th>
            <th>Nama Destinasi</th>
            <th>Nilai SAW</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="(result, index) in sawResults" :key="result.id">
            <td>{{ index + 1 }}</td>
            <td>{{ result.name }}</td>
            <td>{{ result.score }}</td>
          </tr>
        </tbody>
      </table>
    </div>
  </template>
  
  <script>
  export default {
    data() {
      return {
        sawResults: [],
      };
    },
    mounted() {
      this.fetchSAWResults();
    },
    methods: {
      async fetchSAWResults() {
        try {
          const response = await this.$axios.get('http://localhost:8000/api/saw');
          this.sawResults = response.data;
        } catch (error) {
          console.error('Error fetching SAW results', error);
        }
      },
    },
  };
  </script>