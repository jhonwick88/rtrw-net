<template>
    <app-layout :title="$page.props.appname" :isloader="isloader">
<div class="row">
<div class="col-8">
<div class="card">
    <div class="card-header">
	<h3><i class=" fa fa-user-plus"></i> {{$page.props.appname}}
    <span style="font-size: 14px">
    &nbsp; | &nbsp; <a :href="route('be.admin.networks')" title="kembali ke server"><i class="fa fa-arrow-circle-left"></i> Kembali</a>
    &nbsp;&nbsp;
    </span>
    <small id="loader" style="display: none;"><i><i class="fa fa-circle-o-notch fa-spin"></i> Processing... </i></small></h3>
</div>
<div class="card-body">
     <!-- content here -->
<div class="card-body">
  <div>
      <a class="btn bg-warning" :href="route('be.admin.networks')"> <i class="fa fa-close"></i> Tutup</a>
      <button @click="submitServer" class="btn bg-primary" name="save"><i class="fa fa-save"></i> Simpan</button>
  </div>

<table class="table">
  <tbody>
   <tr>
    <td class="align-middle">Nama</td><td><input class="form-control" type="text" autocomplete="off" autofocus="" v-model="newNetwork.name"></td>
  </tr>
    <tr>
    <td class="align-middle">Rate Limit</td><td><input class="form-control" type="text" v-model="newNetwork.rate_limit"></td>
  </tr>
    <tr>
    <td class="align-middle">Price</td><td><input class="form-control" type="number" v-model="newNetwork.price"></td>
  </tr>
  <tr>
    <td class="align-middle">Tipe</td><td>
       <select class="form-control" v-model="newNetwork.network_type">
           <option v-for="(tipe,index) in types" :key="index" :value="tipe.id">{{ tipe.name}}</option>
       </select>
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
            newNetwork:{
                name:'',
                rate_limit:'',
                price:0,
                network_type:1
            },
            types:[{id:1,name:'PPPOE'},{id:2,name:'VOUCHER'}],
        }
    },
    created() {

    },
    methods: {
    submitServer(){
            this.isloader = true
            ApiManager.postAddNetwork(this.newNetwork).then((response) => {
                this.isloader = false
                 if(response.data.code == 0){
                     this.showToast('Buat jaringan success')
                     this.newNetwork = {   name:'',
                rate_limit:'',
                price:0,
                network_type:1}
                 }else{
                     this.showToast(response.data.message)
                 }
            })
            .catch((error) => {
                this.isloader = false
                //console.log(JSON.stringify(this.error));
            });
        }
    }
}
</script>
