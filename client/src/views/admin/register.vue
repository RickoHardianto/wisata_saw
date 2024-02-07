<script>
import axios from "axios";

export default{
    data() {
    return {
      model: {
        form: {
          name: "",
          email: "",
          numberPhone: "",
          password: "",
          address: "",
        },
      },
    };
  },
  methods:{
    submitRegister() {
      axios
        .post("http://localhost:8000/api/register",this.model.form)
        .then((res) => {
          console.log(res);
          this.model.form = {
            name: "",
            email: "",
            password: "",
            numberPhone: "",
            address: "",
          };
          return this.$router.push("/login");
        })
        .catch(function (error) {
          console.log(error.message);
        });
    },
  }
}

</script>

<template>
  <div class="container">
    <div class="d-flex justify-content-center">
      <div class="col-lg-6">
        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="p-5">
              <div class="text-center">
                <h1 class="h4 text-gray-900 mb-4">Buat Akun!</h1>
              </div>
              <form class="user" @submit.prevent="submitRegister">
                <div class="form-group">
                  <input
                    type="text"
                    v-model="model.form.name"
                    class="form-control form-control-user"
                    id="exampleFirstName"
                    placeholder="Nama Lengkap"
                  />
                </div>
                <div class="form-group">
                  <input
                    type="email"
                    v-model="model.form.email"
                    class="form-control form-control-user"
                    id="exampleInputEmail"
                    placeholder="Alamat Email"
                  />
                </div>
                <div class="form-group">
                  <input
                    type="number"
                    v-model="model.form.numberPhone"
                    class="form-control form-control-user"
                    id="exampleInputPhone"
                    placeholder="628xxxxxxxxxxxx"
                  />
                </div>

                <div class="form-group">
                  <input
                    type="password"
                    v-model="model.form.password"
                    class="form-control form-control-user"
                    id="exampleInputPassword"
                    placeholder="Password"
                  />
                </div>
                <div class="form-group">
                  <input
                    type="text"
                    v-model="model.form.address"
                    class="form-control form-control-user"
                    id="exampleInputalamat"
                    placeholder="Alamat"
                  />
                </div>
                <button type="submit" class="btn btn-primary btn-user btn-block">
                  Daftarkan Akun
                </button>
              </form>
              <hr />
              <div class="text-center">
                <router-link class="small" to="/login">
                    Sudah mempunyai akun? Login!</router-link>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
