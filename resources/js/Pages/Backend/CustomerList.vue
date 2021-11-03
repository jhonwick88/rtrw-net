<template>
<app-layout :title="$page.props.appname" :isloader="isloading">
<div class="row">
<div class="col-12">
<div class="card">
    <div class="card-header">
	<h3><i class=" fa fa-user"></i> {{ $page.props.appname }}
        <span style="font-size: 14px">
                 &nbsp; | &nbsp; <a :href="route('be.admin.customers.create')" title="Tambah User"><i class="fa fa-user-plus"></i> Tambah</a>
        </span>&nbsp;&nbsp;
        <small id="loader" v-if="isloading"><i><i class="fa fa-circle-o-notch fa-spin"></i> Processing... </i></small></h3>
</div>
<div class="card-body">
     <!-- content here -->
<!-- header table -->
<div class="row">
<div class="col-12 mr-b-10">
    		<div style="padding-bottom: 5px; padding-top: 5px;">
                 <input type="text" class="form-control" v-model="query" placeholder="Pencarian..." style="float:left; margin-top: 6px; max-width: 150px;">
                 <button name="help" class="btn bg-primary" onclick="location.href='#help';" title="Help"><i class="fa fa-question"></i> Info</button>
		</div>
</div>
<!-- pagination -->
<div class="col-12 align-middle text-center" v-if="filterData.last_page > 1">
    <div class="pagination">
        <template v-for="(item, i) in filterData.links" :key="i">
            <a href="javascript:" aria-label="Previous" v-if="i == 0">
        <span aria-hidden="true">&laquo;</span>
      </a>
       <a class="page-link" href="javascript:" aria-label="Next" v-else-if="i == filterData.links.length - 1">
        <span aria-hidden="true">&raquo;</span>
      </a>
            <a :class="{'active': filterData.current_page == item.label}" href="javascript:" @click="getPage(item.label)" v-else>{{item.label}}</a>
        </template>
</div>
</div>
<!-- end pagination -->
</div>
<!-- end header table -->
<!-- start table -->
		  <div class="overflow mr-t-10 box-bordered" style="max-height: 65vh">
			<table class="table table-bordered table-hover text-nowrap">
				<thead class="thead-light">
				<tr>
				  <th colspan="9">{{ $page.props.title }}<b style="font-size:0;">,,,,</b></th>
				  <th style="text-align:right;">Total</th>
				  <th style="text-align:right;" id="total">{{ filterData.total }}</th>
				</tr>
				<tr>
				  <th class="text-center">№</th>
					<th class="pointer" title="Click to sort" @click="sort('name')"><i class="fa fa-sort"></i> Nama</th>
					<th> Alamat</th>
					<th>Telp</th>
					<th class="pointer" title="Click to sort" @click="sort('server_id')"><i class="fa fa-sort"></i> Server</th>
					<th class="pointer" title="Click to sort" @click="sort('network_type')"><i class="fa fa-sort"></i> Network</th>
					<th>Kecepatan</th>
					<th>Koneksi</th>
                    <th>Port</th>
                    <th>Diskon</th>
					<th>Aksi</th>
				</tr>
				</thead>
				<tbody>
                    <tr v-for="(item,index) in filterData.data" :key="index">
      <th class="align-middle text-center">
          <i class="fa fa-minus-square text-danger pointer" @click="remove(index)"></i> &nbsp;&nbsp;
          {{ filterData.from+index }}
      </th>
      <td><a :title="`Open ${item.name}`" :href="route('be.admin.customers.member',item.id)"><i class="fa fa-edit"></i> {{ item.name }} </a></td>
      <td>{{ item.adress }}</td>
      <td>{{ item.phone }}</td>
      <td>{{ item.server.location }}</td>
      <td>{{ item.network_type }}</td>
      <td>{{ item.network.name }}</td>
      <td>{{ item.connection }}</td>
      <td>{{ item.port }}</td>
      <td>{{ item.discount }}</td>
   <td>

    <a class="btn bg-primary" href="javascript:" @click="editUser(index)">Edit</a>
</td>
    </tr>
				</tbody>
			</table>
		</div>
<!-- end table -->
    <!-- end content -->
     <jet-confirmation-modal id="help">
      <template #title>
        Info
      </template>
      <template #content>
          <b>Limited</b><br>
        - Network tidak dapat di ubah
      </template>

      <template #footer>

        <button>
          Mengerti
        </button>
      </template>
    </jet-confirmation-modal>
    <!-- edit modal -->
     <jet-confirmation-modal id="edit">
     <template #title>
        Edit {{userItem.name}}
      </template>
      <template #content>
       <table class="table">
  <tbody>
  <tr>
    <td class="align-middle">Nama</td><td><input class="form-control" type="text" autocomplete="off" autofocus="" v-model="userItem.name"></td>
  </tr>
    <tr>
    <td class="align-middle">Alamat</td><td><input class="form-control" type="text" v-model="userItem.adress"></td>
  </tr>
    <tr>
    <td class="align-middle">Telp</td><td><input class="form-control" type="text" v-model="userItem.phone"></td>
  </tr>
      <tr>
    <td class="align-middle">Kecepatan</td><td>
       <select class="form-control" v-model="userItem.network_id">
           <option v-for="(tipe,index) in getNetworks(userItem.network_type == 'PPPOE' ? 1 : 2)" :key="index" :value="tipe.id">{{ tipe.name}}</option>
       </select>
    </td>
  </tr>
        <tr>
    <td class="align-middle">Port</td><td>
       <select class="form-control" v-model="userItem.port">
           <option v-for="(tipe,index) in ports" :key="index" :value="tipe.name">{{ tipe.name}}</option>
       </select>
    </td>
  </tr>
   <tr>
    <td class="align-middle">Koneksi</td><td>
       <select class="form-control" v-model="userItem.connection">
           <option v-for="(tipe,index) in connections" :key="index" :value="tipe.name">{{ tipe.name}}</option>
       </select>
    </td>
  </tr>
     <tr>
    <td class="align-middle">Parent</td><td>
       <select class="form-control" v-model="userItem.parent_id">
           <option v-for="(parent,index) in filterData.data" :key="index" :value="parent.id">{{ parent.name}}</option>
       </select>
    </td>
  </tr>
 <tr>
    <td class="align-middle">Diskon</td><td><input class="form-control" type="number" v-model="userItem.discount"></td>
  </tr>
  </tbody>
       </table>
      </template>

      <template #footer>
        <button class="btn bg-danger" @click="updateCustomer">
          Simpan
        </button>
      </template>
    </jet-confirmation-modal>
    <!-- end edit modal -->
</div>
</div>
</div>
</div>
    </app-layout>
</template>
<script>
import AppLayout from '@/Layouts/AppLayoutNet'
import ApiManager from '../API/ApiManager'
import JetConfirmationModal from '@/Jetstream/InfoModalNet'
import BaseComponentVue from '../../Layouts/BaseComponent.vue'
export default {
    extends: BaseComponentVue,
    components: {
        AppLayout,
        JetConfirmationModal
    },
    data(){
        return{
            filterData: {
                data: [],
            },
            ports:[
                { name:'A'},
                { name:'B'}
            ],
            connections:[{name:'Lan'},{name:'FO'}],
            currentSortDir: "asc",
            currentSortCol: "name",
            isloading: false,
            query:'',
            itemToChange: null,
            userItem:{
                name:'',
                adress:'',
                port:'',
                phone:'',
                network_type:'',
                network_id:'',
                connection:'',
                parent_id:'',
                discount:0,
            },
            action:{
                title:'',
                message:'',
                option:''
            },
        }
    },
    created() {
        this.getFilterData(1)
    },
    watch: {
        query: function(newVal) {
            if (newVal.length >2) {
                this.searchResults();
            }else{
                this.getFilterData(1)
            }
        }
    },
    methods: {
        sort(col){
             if (this.currentSortCol === col) {
        this.currentSortDir = this.currentSortDir === "asc" ? "desc" : "asc";
      } else {
        this.currentSortCol = col;
      }
      this.filterData.data.sort(this.sortBy(col,this.currentSortDir));
    },
    getNetworks(type){ //1 pppoe 2 voucher
        let networks = this.$page.props.networks
        networks = networks.filter((data)=>{
            return (data.network_type == type)
        })
        return networks
    },
        getFilterData(page){
            this.isloading = true
            ApiManager.getCustomers(page)
                .then((response) => {
                    this.isloading = false
                    this.filterData = response.data.data
                    //console.log(this.coinsby)
                })
                .catch((error) => {
                    console.log(error);
                });
        },
        getPage(page){
             if(!page.includes('&'))
              this.getFilterData(page)
        },
        searchResults(){
            this.isloading = true
            ApiManager.getSearchCustomers(this.query).then((response)=>{
                this.isloading = false
                this.filterData = response.data.data
            }).catch((error)=>{
                this.isloading = false
                console.log(error)
            })
        },
        remove(index){
            let item = this.filterData.data[index]
            this.action.title = `Hapus pelanggan ${item.name}`
            this.action.message = `Anggota & member juga akan di hapus. Data yang sudah dihapus tidak dapat dikembalikan`
            this.action.option = 'remove'
            this.itemToChange = index
            this.showAlert()
        },
        editUser(index){
            let item = this.filterData.data[index]
            this.itemToChange = index
            this.userItem = item
            location.href='#edit'
        },
        showAlert(){
                this.$swal.fire({
                title: this.action.title,
                text: this.action.message,
                // showDenyButton: true,
                showCancelButton: true,
                confirmButtonText: 'Ya',
                // denyButtonText: `Don't save`,
                }).then((result) => {
                if (result.isConfirmed) {
                    this.updateUserAction()
                    this.$swal.fire('Saved!', '', 'success')
                } else{
                    this.itemToChange = null
                }
                })
        },
        updateUserAction(){
if(this.action.option == 'remove'){
                return this.postRemoveUser()
            }
        },
        postRemoveUser(){
            this.isloading = true
            let item = this.filterData.data[this.itemToChange]
            ApiManager.postRemoveCustomer(item).then((response)=>{
                this.isloading = false
                this.filterData.data.splice(this.itemToChange,1)
                this.filterData.total -= 1
                this.showToast('Pelanggan terhapus')
            }).catch((error)=>{
                console.log(error)
                this.isloading = false
            })
        },
        updateCustomer(){
            this.isloading = true
            ApiManager.postUpdateCustomer(this.userItem).then((response)=>{
                this.isloading = false
                if(response.data.code == 0){
                this.filterData.data.splice(this.itemToChange,1,response.data.data)
                this.showToast('User Updated')
                window.location.href="#"
                }
            }).catch((error)=>{
                console.log(error)
                this.isloading = false
            })
        }

    }
}
</script>
