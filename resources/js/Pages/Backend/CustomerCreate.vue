<template>
    <app-layout :title="$page.props.appname" :isloader="isloader">
<div class="row">
<div class="col-8">
<div class="card">
    <div class="card-header">
	<h3><i class=" fa fa-user-plus"></i> {{$page.props.appname}}  <span style="font-size: 14px">
    &nbsp; | &nbsp; <a :href="route('be.admin.customers')" title="kembali ke customers"><i class="fa fa-arrow-circle-left"></i> Kembali</a>
    &nbsp;&nbsp;
    </span><small id="loader" style="display: none;"><i><i class="fa fa-circle-o-notch fa-spin"></i> Processing... </i></small></h3>
</div>
<div class="card-body">
     <!-- content here -->
<div class="card-body">
  <div>
      <a class="btn bg-warning" :href="route('be.admin.customers')"> <i class="fa fa-close"></i> Tutup</a>
      <button @click="submitCustomer" class="btn bg-primary" name="save"><i class="fa fa-save"></i> Simpan</button>
  </div>

<table class="table">
  <tbody>
  <tr>
    <td class="align-middle">Nama</td><td><input class="form-control" type="text" v-model="newCustomer.name"></td>
  </tr>
    <tr>
    <td class="align-middle">Alamat</td><td><input class="form-control" type="text" v-model="newCustomer.adress"></td>
  </tr>
      <tr>
    <td class="align-middle">Telp</td><td><input class="form-control" type="number" v-model="newCustomer.phone"></td>
      </tr>
     <td class="align-middle">Tipe</td>
     <td>
       <select class="form-control" v-model="type">
           <option v-for="(tipe,index) in types" :key="index" :value="tipe.id">{{ tipe.name}}</option>
       </select>
    </td>
<tr>
    <td class="align-middle">Kecepatan</td><td>
       <select class="form-control" v-model="newCustomer.network_id">
           <option v-for="(tipe,index) in getNetworks(type)" :key="index" :value="tipe.id">{{ tipe.name}}</option>
       </select>
    </td>
  </tr>
        <tr>
    <td class="align-middle">Port</td><td>
       <select class="form-control" v-model="newCustomer.port">
           <option v-for="(tipe,index) in ports" :key="index" :value="tipe.name">{{ tipe.name}}</option>
       </select>
    </td>
  </tr>
   <tr>
    <td class="align-middle">Koneksi</td><td>
       <select class="form-control" v-model="newCustomer.connection">
           <option v-for="(tipe,index) in connections" :key="index" :value="tipe.name">{{ tipe.name}}</option>
       </select>
    </td>
  </tr>
  <tr>
      <td class="align-middle">Lokasi server</td><td>
       <select class="form-control" v-model="newCustomer.server_id">
           <option v-for="(server,index) in $page.props.servers" :key="index" :value="server.id">{{ server.name}}</option>
       </select>
    </td>
  </tr>
     <tr>
    <td class="align-middle">Parent</td><td>
       <select class="form-control" v-model="newCustomer.parent_id">
           <option v-for="(parent,index) in $page.props.customers" :key="index" :value="parent.id">{{ parent.name}}</option>
       </select>
    </td>
  </tr>
</tbody></table>
<!-- tabel member -->
<div class="card mr-t-10" v-if="members.length>0">
    <div class="card-header">
        Daftar Anggota
    </div>
    <div class="card-body">
<table class="table table-bordered table-hover text-nowrap" >
				<thead class="thead-light">
				<tr>
				  <th class="text-center">№</th>
					<th>Nama</th>
					<th>Password</th>
					<th>Tambahan Harga</th>
					<th>Catatan</th>
				</tr>
				</thead>
				<tbody>
                    <tr v-for="(item,index) in members" :key="index">
      <th class="align-middle text-center">
          <i class="fa fa-minus-square text-danger pointer" @click="removeMember(index)"></i> &nbsp;&nbsp;
          {{ index + 1 }}
      </th>
      <td>{{ item.name }}</td>
      <td>{{ item.password }}</td>
      <td>{{ item.extra_price }}</td>
      <td>{{ item.note }}</td>
    </tr>
				</tbody>
			</table>
    </div>
</div>
<!-- end tabel member -->
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
<!-- colom add member -->
<div class="card" v-if="type==2">
    <div class="card-header">
	<h3><i class=" fa fa-book"></i> Tambah Anggota Voucher</h3>
</div>
<div class="card-body">
     <!-- content here -->
 <table class="table">
  <tbody>
  <tr>
    <td class="align-middle">Nama</td><td><input class="form-control" type="text" autocomplete="off" autofocus="" v-model="userItem.name"></td>
  </tr>
    <tr>
    <td class="align-middle">Password</td><td><input class="form-control" type="text" v-model="userItem.password"></td>
  </tr>
    <tr>
    <td class="align-middle">Tambahan harga</td><td><input class="form-control" type="number" v-model="userItem.extra_price"></td>
  </tr>
      <tr>
    <td class="align-middle">Catatan</td><td><input class="form-control" type="text" v-model="userItem.note"></td>
  </tr>
  </tbody>
       </table>
        <div class="text-right">
      <button @click="tambahAnggota" class="btn bg-primary" name="save"><i class="fa fa-save"></i> Tambah</button>
  </div>
    <!-- end content -->
</div>
</div>
<!-- end colom add member -->
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
            newCustomer: {
                members:[]
            },
            ports:[{ name:'A'},{ name:'B'}],
            connections:[{name:'Lan'},{name:'FO'}],
            types:[{id:1,name:'PPPOE'},{id:2,name:'VOUCHER'}],
            type:1, //default
            userItem:{
                name:'',
                password:'',
                extra_price: 0,
                note:''
            },
            members:[],
        }
    },
    created() {

    },
    methods: {
         getNetworks(type){ //1 pppoe 2 voucher
        let networks = this.$page.props.networks
        networks = networks.filter((data)=>{
            return (data.network_type == type)
        })
        return networks
    },
    tambahAnggota(){
        if(this.userItem.name.length > 4 && this.userItem.password.length > 4){
            this.members.push(this.userItem)
            this.userItem = {
                name:'',
                password:'',
                extra_price: 0,
                note:''}
        }else{
            this.showToast('Nama & Password harus lebih dari 4 karakter')
        }
    },
    removeMember(index){
        this.members.splice(index,1)
    },
    submitCustomer(){
            if(this.type == 2){
                if(this.members.length < 1){
                    this.showToast('Isi Dulu Anggota Voucher')
                    return
                }
                 this.newCustomer.members = this.members
            }
           // console.log(JSON.stringify(this.newCustomer))
              this.isloader = true
            ApiManager.postSubmitCustomer(this.newCustomer).then((response) => {
                this.isloader = false
                 if(response.data.code == 0){
                     this.showToast('Create user success')
                     this.newCustomer = {}
                     this.members = []
                 }else{
                     this.showToast(response.data.message)
                 }
            })
            .catch((error) => {
                this.isloader = false
                //this.showToast(error.message)
                console.log(JSON.stringify(this.error));
            });
        }
    }
}
</script>
