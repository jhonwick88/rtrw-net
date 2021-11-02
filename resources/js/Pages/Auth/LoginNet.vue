<template>
    <inertia-head>
        <title>{{ $page.props.appname }} - {{$page.props.setting_new.site_name}}</title>
    </inertia-head>
    <div>
        <!-- start -->
        <div class="wrapper">
<div style="padding-top: 5%;" class="login-box">
  <div class="card">
    <div class="card-header">
      <h3>Please Login</h3>
    </div>
    <div class="card-body">
      <div class="text-center pd-5">
        <img :src="$page.props.setting_new.site_logo" height="100" :alt="`${$page.props.setting_new.site_name} Logo`">
      </div>
      <div class="text-center">
      <span style="font-size: 25px; margin: 10px;">{{ $page.props.setting_new.site_name }}</span>
      </div>
      <center>
      <form autocomplete="off" @submit.prevent="submit">
      <table class="table" style="width:90%">
        <tbody><tr>
          <td class="align-middle text-center">
            <input style="width: 100%; height: 35px; font-size: 16px;" class="form-control" type="text" name="user" id="_username" placeholder="Email" v-model="form.email" required="1" autofocus="">
          </td>
        </tr>
        <tr>
          <td class="align-middle text-center">
            <input style="width: 100%; height: 35px; font-size: 16px;" class="form-control" type="password" name="pass" placeholder="Password" v-model="form.password" required="1">
          </td>
        </tr>
        <tr>
          <td class="align-middle text-center">
            <input style="width: 100%; margin-top:20px; height: 35px; font-weight: bold; font-size: 17px;" class="btn-login bg-primary pointer" type="submit" name="login" value="Login" :class="{ 'text-white-50': form.processing }" :disabled="form.processing">
          </td>
        </tr>
        <tr>
            <td>
                        <div class="form-group">
          <div class="custom-control custom-checkbox">
            <jet-checkbox id="remember_me" name="remember" v-model:checked="form.remember" />

            <label class="custom-control-label" for="remember_me">
              Remember Me
            </label>
          </div>
        </div>
            </td>
        </tr>
        <tr>
          <td class="align-middle text-center">
                      </td>
        </tr>
      </tbody></table>
      </form>
      </center>
    </div>
  </div>
</div>
</div>
        <!-- end -->
    </div>
</template>
<script>
import JetCheckbox from '@/Jetstream/Checkbox'
export default {
    components:{
        JetCheckbox,
    },
     props: {
    canResetPassword: Boolean,
    status: String,
  },

  data() {
    return {
      form: this.$inertia.form({
        email: '',
        password: '',
        remember: false
      })
    }
  },
//   created() {
//       console.log(this.$page.props)
//   },

  methods: {
    submit() {
      this.form
          .transform(data => ({
            ... data,
            remember: this.form.remember ? 'on' : ''
          }))
          .post(this.route('login'), {
            onFinish: () => this.form.reset('password'),
          })
    }
  }

}
</script>
