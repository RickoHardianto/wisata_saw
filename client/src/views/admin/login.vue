<script>
import {mapActions} from 'pinia'
import {useUserStore} from '../../stores/wisata'
export default{
  data() {
    return {
      dataInput: {
        email: "",
        password: "",
      },
    };
  }, 
  methods:{
    ...mapActions(useUserStore,['loginHandler']),
    login(){
      this.loginHandler(this.dataInput)
    }
  }
}
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
                v-model="dataInput.email"
              />
            </div>
            <div class="form-group">
              <input
                type="password"
                class="form-control form-control-user"
                placeholder="Password"
                v-model="dataInput.password"
              />
            </div>
            <button type="submit" class="btn btn-primary btn-user btn-block">
              Login
            </button>
            <hr />
            <!-- <a
                          href="index.html"
                          class="btn btn-google btn-user btn-block"
                        >
                          <i class="fab fa-google fa-fw"></i> Login with Google
                        </a>
                        <a
                          href="index.html"
                          class="btn btn-facebook btn-user btn-block"
                        >
                          <i class="fab fa-facebook-f fa-fw"></i> Login with
                          Facebook
                        </a> -->
          </form>
          <hr />
        </div>
      </div>
    </div>
  </div>
</template>
