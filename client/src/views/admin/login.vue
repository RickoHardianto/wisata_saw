<!-- <script>
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
</script> -->


<script>
    import axios from 'axios'

    export default {
        name: 'Login',

        data() {
            return {
                //state loggedIn with localStorage
                loggedIn: localStorage.getItem('loggedIn'),
                //state token
                token: localStorage.getItem('token'),
                //state user
                user: [],
                //state validation
                validation: [],
                //state login failed
                loginFailed: null
            }
        },
        methods: {

            login() {
                if (this.user.email && this.user.password) {
                    axios.get('http://localhost:8000/sanctum/csrf-cookie')
                        .then(response => {

                            //debug cookie
                            console.log(response)

                            axios.post('http://localhost:8000/api/login', {
                                email: this.user.email,
                                password: this.user.password
                            }).then(res => {

                                //debug user login
                                console.log(res)

                                if (res.data.success) {

                                    //set localStorage
                                    localStorage.setItem("loggedIn", "true")

                                    //set localStorage Token
                                    localStorage.setItem("token", res.data.token)

                                    //change state
                                    this.loggedIn = true

                                    //redirect dashboard
                                    return this.$router.push({ name: 'admin' })

                                } else {

                                    //set state login failed
                                    this.loginFailed = true

                                }

                            }).catch(error => {
                                console.log(error)
                            })

                        })
                }

                this.validation = []

                if (!this.user.email) {
                    this.validation.email = true
                }

                if (!this.user.password) {
                    this.validation.password = true
                }

            }
        },

        //check user already logged in
        mounted() {
            if (this.loggedIn) {
                return this.$router.push({ name: 'dashboard' })
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
