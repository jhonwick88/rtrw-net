<template>
    <frontend-layout :isloader="isLoading" title="Login">
                      <div class="container">
                        <!-- row -->
               <div class="row justify-content-center">
                  <div class="col-lg-6">
                    <img src="/images/smart.svg" alt="logo crypto" class="mt-5"/>
                  </div>
                  <div class="col-lg-6">
                        <div class="row justify-content-center my-5">
      <div class="col-12 my-4">
        <div class="d-flex flex-column text-white text-center mb-4">
          <h3 class="text-white">LOGIN</h3>
          <span>Continue login with CoinSnipper</span>
        </div>
        <div class="card shadow-sm px-3">
                        <div class="card-body">
                     <form @submit.prevent="submit">
      <div class="form-group">
          <jet-label for="email" value="Email" />
          <jet-input id="email" type="email" v-model="form.email" required autofocus />
        </div>

        <div class="form-group">
          <jet-label for="password" value="Password" />
          <jet-input id="password" type="password" v-model="form.password" required autocomplete="current-password" />
        </div>

        <div class="form-group">
          <div class="custom-control custom-checkbox">
            <jet-checkbox id="remember_me" name="remember" v-model:checked="form.remember" />
            <label class="custom-control-label" for="remember_me">
              Remember Me
            </label>
          </div>
        </div>
              <div class="mb-0">
          <div class="d-flex justify-content-end align-items-baseline">
            <inertia-link v-if="canResetPassword" :href="route('password.request')" class="text-muted mr-3">
              Forgot your password?
            </inertia-link>
          </div>
          <div class="d-flec flex-column justify-content-center">
            <jet-button class="btn-block btn-primary" :class="{ 'text-white-50': form.processing }" :disabled="form.processing">
              Log in
            </jet-button>
            <div class="mt-3 text-center">Don't have an account?</div>
             <inertia-link :href="route('register')" class="mt-3 btn-block btn-primary text-white text-center rounded">
              REGISTER
            </inertia-link>
           
          </div>
        </div>
      </form>
      </div>
                        </div>
      </div>
                        </div>
                  </div>

               </div>
               <!-- end row -->
           
        </div>
    
    </frontend-layout>
</template>
<script>
import FrontendLayout from '../../Layouts/FrontendLayout.vue'
import JetAuthenticationCard from '@/Jetstream/AuthenticationCard'
import JetButton from '@/Jetstream/Button'
import JetInput from '@/Jetstream/Input'
import JetCheckbox from '@/Jetstream/Checkbox'
import JetLabel from '@/Jetstream/Label'
// import { usePage } from '@inertiajs/inertia-vue3'
// import { onMounted } from 'vue'

export default {
  components: { 
    FrontendLayout,
    JetAuthenticationCard,
    JetButton,
JetInput,
JetCheckbox,
JetLabel, 
},
     data() {
    return {
      form: this.$inertia.form({
        email: '',
        password: '',
        remember: false,
        redirect_url:null
      }),
      isLoading: false

    }
  },
  created() {
      let urlParams = new URLSearchParams(window.location.search);
      if(urlParams.has('re')){
        this.form.redirect_url = urlParams.get('re')
      }
  },

  methods: {
    submit() {
        //console.log(JSON.stringify(this.form))
        this.isLoading = true
      this.form.post(this.route('login.auth.post'), {
            onSuccess: () => this.isLoading = false,
            //onFinish: () => this.form.reset('password'),
          })
    }
  }
}
</script>