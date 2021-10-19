<template>
    <app-layout :title="$page.props.appname" :isloader="isloader">
<div class="row">
<div class="col-8">
<div class="card">
    <div class="card-header">
	<h3><i class=" fa fa-user-plus"></i> Tambah User <small id="loader" style="display: none;"><i><i class="fa fa-circle-o-notch fa-spin"></i> Processing... </i></small></h3>
</div>
<div class="card-body">
     <!-- content here -->
<div class="card-body">
  <div>
      <a class="btn bg-warning" :href="route('be.admin.user')"> <i class="fa fa-close"></i> Tutup</a>
      <button @click="saveUser" class="btn bg-primary" name="save"><i class="fa fa-save"></i> Simpan</button>
  </div>

<table class="table">
  <tbody>
  <tr>
    <td class="align-middle">Nama</td><td><input class="form-control" type="text" autocomplete="off" name="name" required="1" autofocus="" v-model="newUser.name"></td>
  </tr>
    <tr>
    <td class="align-middle">Email</td><td><input class="form-control" type="text" autocomplete="off" name="email" required="1" autofocus="" v-model="newUser.email"></td>
  </tr>
  <tr>
    <td class="align-middle">Password</td><td>
        <div class="input-group">
          <div class="input-group-11 col-box-10">
            <input class="group-item group-item-l" id="passUser" :type="`${showPassword ? 'text' : 'password'}`" name="pass" autocomplete="new-password" required="1" v-model="newUser.password">
          </div>
            <div class="input-group-1 col-box-2">
              <div class="group-item group-item-r pd-2p5 text-center">
              <input title="Show/Hide Password" type="checkbox" v-model="showPassword">
            </div>
            </div>
        </div>
		</td>
  </tr>
</tbody></table>

</div>
    <!-- end content -->
</div>
</div>
</div>
<!-- row 2 -->
<div class="col-4">
<div class="card">
    <div class="card-header">
	<h3><i class=" fa fa-book"></i> Catatan</h3>
</div>
<div class="card-body">
     <!-- content here -->
<table>
   <tbody><tr>
    <td colspan="2">
    <p style="padding:0px 5px;">

    Semua wajib diisi.<br>
    - Email wajib unik<br>
    - password minimal 8 karakter
    </p>
    </td>
  </tr>
</tbody></table>
    <!-- end content -->
</div>
</div>
</div>
<!-- end row 2 -->
</div>

    </app-layout>
</template>
<script>
import AppLayout from '@/Layouts/AppLayoutNet'
import ApiManager from '../API/ApiManager'
import BaseComponentVue from '../../Layouts/BaseComponent.vue'
export default {
    extends: BaseComponentVue,
    components: {
        AppLayout,
    },
    data(){
        return{
             isloader: false,
             newUser: {},
             showPassword: false,
        }
    },
    created() {

    },
    methods: {
        saveUser(){
            this.isloader = true
            ApiManager.postSubmitUser(this.newUser).then((response) => {
                this.isloader = false
               // console.log(JSON.stringify(response.data));
                 if(response.data.code == 0){
                     this.showToast('Create user success')
                     this.newUser = {}
                 }else{
                     this.showToast(response.data.message)
                 }
            })
            .catch((error) => {
                this.isloader = false
               // this.showToast(error.message)
                //console.log(JSON.stringify(error));
            });
        }
    }
}
</script>
