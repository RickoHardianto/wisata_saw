<script>
import SidebarComponent from "../../../components/admin/SidebarComponent.vue";
import TopbarComponent from "../../../components/admin/TopbarComponent.vue";
import { ref, vModelRadio } from "vue";
import axios from "axios";

export default {
  components: {
    SidebarComponent,
    TopbarComponent,
  },
  name: "RoleUpdate",
  data() {
    return {
      model: {
        formInput: {
          role: "",
          permission: [],
        },
      },
      rolePermission: [],
      permissions: [],
    };
  },
  mounted() {
    this.roleId = this.$route.params.id;
    this.editPermission(this.$route.params.id);
  },
  methods: {
    editPermission() {
      axios
        .get(`http://localhost:8000/api/roles/${this.roleId}/edit`)
        .then((res) => {
          console.log("=========== dari res", res.data.data);
          if (res.status === 200) {
            this.model.formInput.role = res.data.data.role.name;
            this.permissions = res.data.data.permission;
            this.rolePermission = res.data.data.rolePermission;
          }
          console.log(res.data.message);
        })
        .catch(function (error) {
          console.log(error);
        });
    },
    isItemChecked(value, index) {
      if (value == this.rolePermission.value[value]) {
        formInput.value.permission[index] = value;
      } else {
        formInput.value.permission[index] = null;
      }
    },
    toogleCheckbox(index) {
      if (formInput.value.permission[index] != null) {
        this.rolePermission.value[formInput.value.permission[index]] = null;
        formInput.value.permission[index] = false;
      } else {
        this.rolePermission.value[formInput.value.permission[index]] =
          formInput.value.permission[index];
        formInput.value.permission[index] = formInput.value.permission[index];
      }
    },
    save() {
      axios
        .put("http://localhost:8000/api/roles/", this.model.formInput)
        .then((res) => {
          console.log(res);
          this.model.formInput = {
            name: formInput.value.name,
            permission: formInput.value.permission,
          };
          return this.$router.push("/role");
        })
        .catch(function (error) {
          console.log(error);
        });
    },
  },
};
</script>

<template>
  <!-- Page Wrapper -->
  <div id="wrapper">
    <SidebarComponent />

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">
      <!-- Main Content -->
      <div id="content">
        <TopbarComponent />

        <!-- Begin Page Content -->
        <div class="container-fluid">
          <!-- Page Heading -->
          <h1 class="h3 mb-4 text-gray-800">Kelola Role</h1>

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">Edit Role</div>
            <div class="card-body">
              <div class="mb-3">
                <label for="">Nama Role</label>
                <input
                  type="text"
                  v-model="model.formInput.role"
                  class="form-control"
                />
              </div>
              <div class="mb-3">
                <div class="col-md-6">
                  <span v-for="(item, index) in permissions" :key="index">
                    <label class="m-2">
                      <input
                        type="checkbox"
                        class="form-checkbox"
                        v-model="model.formInput.permission"
                        :value="item.id"
                        :checked="isItemChecked(item.id, index)"
                        @change="toogleCheckbox(index)"
                      />
                      {{ item.name }}
                    </label>
                  </span>
                </div>
              </div>
              <div class="mb-3">
                <button
                  type="submit"
                  @click="save"
                  class="btn btn-primary btn-sm"
                >
                  Save
                </button>
              </div>
            </div>
          </div>
        </div>

        <!-- /.container-fluid -->
      </div>
      <!-- End of Main Content -->
    </div>
    <!-- End of Content Wrapper -->
  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>
</template>
