view 

<template>
  <div>
    <button @click="showCreateModal">Tambah Data</button>
    <table class="table">
      <thead>
        <tr>
          <th>ID</th>
          <th>Nama</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="item in data" :key="item.id">
          <td>{{ item.id }}</td>
          <td>{{ item.nama }}</td>
          <td>
            <button @click="showEditModal(item)">Edit</button>
            <button @click="deleteItem(item.id)">Hapus</button>
          </td>
        </tr>
      </tbody>
    </table>

    <!-- Modal Bootstrap untuk Tambah/Edit Data -->
    <div class="modal" v-if="showModal">
      <!-- Konten Modal -->
      <div class="modal-content">
        <h2>{{ modalTitle }}</h2>
        <form @submit.prevent="saveData">
          <input v-model="formData.nama" placeholder="Nama" />
          <button type="submit">Simpan</button>
        </form>
        <button @click="closeModal">Tutup</button>
      </div>
    </div>
  </div>
</template>

<script>
import { defineComponent, ref, computed } from 'vue';
import { useStore } from 'pinia';

export default defineComponent({
  setup() {
    const store = useStore();
    const data = store.state.data;
    const showModal = ref(false);
    const formData = ref({ id: null, nama: '' });

    const modalTitle = computed(() => {
      return formData.id ? 'Edit Data' : 'Tambah Data';
    });

    const showCreateModal = () => {
      formData.id = null;
      formData.nama = '';
      showModal.value = true;
    };

    const showEditModal = (item) => {
      formData.id = item.id;
      formData.nama = item.nama;
      showModal.value = true;
    };

    const closeModal = () => {
      showModal.value = false;
    };

    const saveData = () => {
      if (formData.id) {
        store.updateData(formData);
      } else {
        store.createData(formData);
      }
      closeModal();
    };

    const deleteItem = (id) => {
      store.deleteData(id);
    };

    return {
      data,
      showModal,
      formData,
      modalTitle,
      showCreateModal,
      showEditModal,
      closeModal,
      saveData,
      deleteItem,
    };
  },
});
</script>




import { defineStore } from 'pinia';

export const useDataStore = defineStore('dataStore', {
  state: () => ({
    data: [],
  }),
  actions: {
    async fetchData() {
      // Lakukan permintaan GET data dari REST API
      const response = await fetch('/api/data');
      const data = await response.json();
      this.data = data;
    },
    async createData(newData) {
      // Lakukan permintaan POST untuk menambahkan data baru ke REST API
      await fetch('/api/data', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify(newData),
      });
      this.fetchData();
    },
    async updateData(updatedData) {
      // Lakukan permintaan PUT untuk memperbarui data ke REST API
      await fetch(`/api/data/${updatedData.id}`, {
        method: 'PUT',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify(updatedData),
      });
      this.fetchData();
    },
    async deleteData(id) {
      // Lakukan permintaan DELETE untuk menghapus data dari REST API
      await fetch(`/api/data/${id}`, { method: 'DELETE' });
      this.fetchData();
    },
  },
});
