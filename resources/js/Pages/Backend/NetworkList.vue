<template>
<app-layout :title="$page.props.appname" :isloader="isloading">
<div class="row">
<div class="col-12">
<div class="card">
    <div class="card-header">
	<h3><i class=" fa fa-user"></i> {{ $page.props.appname }}
        <span style="font-size: 14px">
                 &nbsp; | &nbsp; <a :href="route('be.admin.networks.create')" title="Tambah Jaringan"><i class="fa fa-user-plus"></i> Tambah</a>
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
		  <div class="overflow mr-t-10 box-bordered" style="max-height: 75vh">
			<table class="table table-bordered table-hover text-nowrap">
				<thead class="thead-light">
				<tr>
				  <th colspan="5">{{ $page.props.title }}<b style="font-size:0;">,,,,</b></th>
				  <th style="text-align:right;">Total</th>
				  <th style="text-align:right;" id="total">{{ filterData.total }}</th>
				</tr>
				<tr>
				  <th class="text-center">№</th>
					<th class="pointer" title="Click to sort" @click="sort('name')"><i class="fa fa-sort"></i> Nama</th>
					<th class="pointer" title="Click to sort" @click="sort('rate_limit')"><i class="fa fa-sort"></i> Rate Limit</th>
					<th class="pointer" title="Click to sort" @click="sort('price')"><i class="fa fa-sort"></i> Harga</th>
					<th class="pointer" title="Click to sort" @click="sort('network_type')"><i class="fa fa-sort"></i> Tipe</th>
					<th class="pointer" title="Click to sort" @click="sort('created_at')"><i class="fa fa-sort"></i> Dibuat tgl</th>
					<th>Aksi</th>
				</tr>
				</thead>
				<tbody>
                    <tr v-for="(item,index) in filterData.data" :key="index">
      <th class="align-middle text-center">
          <i class="fa fa-minus-square text-danger pointer" @click="remove(index)"></i> &nbsp;&nbsp;
          {{ filterData.from+index }}
      </th>
      <td>{{ item.name }}</td>
      <td>{{ item.rate_limit }}</td>
      <td>{{ item.price }}</td>
      <td>{{ item.network_type_label }}</td>
      <td>{{ item.updated_at }}</td>
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
          <b>Penting</b><br>
        - Mengubah tipe jaringan dari PPPOE ke VOUCHER atau sebaliknya akan berdampak terhadap Pembayaran pelanggan anda!
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
        Edit {{networkItem.name}}
      </template>
      <template #content>
       <table class="table">
  <tbody>
  <tr>
    <td class="align-middle">Nama</td><td><input class="form-control" type="text" autocomplete="off" autofocus="" v-model="networkItem.name"></td>
  </tr>
    <tr>
    <td class="align-middle">Rate Limit</td><td><input class="form-control" type="text" v-model="networkItem.rate_limit"></td>
  </tr>
    <tr>
    <td class="align-middle">Price</td><td><input class="form-control" type="number" v-model="networkItem.price"></td>
  </tr>
  <tr>
    <td class="align-middle">Tipe</td><td>
       <select class="form-control" v-model="networkItem.network_type">
           <option v-for="(tipe,index) in types" :key="index" :value="tipe.id">{{ tipe.name}}</option>
       </select>
    </td>
  </tr>
  </tbody>
       </table>
      </template>

      <template #footer>
        <button class="btn bg-danger" @click="updateItem">
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
            currentSortDir: "asc",
            currentSortCol: "name",
            isloading: false,
            query:'',
            itemToChange: null,
            networkItem:{
                name:'',
                rate_limit:'',
                price:0,
                network_type:1
            },
            types:[{id:1,name:'PPPOE'},{id:2,name:'VOUCHER'}],
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
        getFilterData(page){
            this.isloading = true
            ApiManager.getNetworks(page)
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
            ApiManager.getSearchNetworks(this.query).then((response)=>{
                this.isloading = false
                this.filterData = response.data.data
            }).catch((error)=>{
                this.isloading = false
                console.log(error)
            })
        },
        remove(index){
            let item = this.filterData.data[index]
            this.action.title = `Hapus Jaringan ${item.name}`
            this.action.message = `Data yang sudah dihapus tidak dapat dikembalikan`
            this.action.option = 'remove'
            this.itemToChange = index
            this.showAlert()
        },
        editUser(index){
            let item = this.filterData.data[index]
            this.itemToChange = index
            this.networkItem = item
            location.href='#edit'
        },
        showAlert(){
                this.$swal.fire({
                title: this.action.title,
                text: this.action.message,
                showCancelButton: true,
                confirmButtonText: 'Ya',
                cancelButtonText: `Batal`,
                }).then((result) => {
                if (result.isConfirmed) {
                    this.updateUserAction()
                    //this.$swal.fire('Saved!', '', 'success')
                } else{
                    this.itemToChange = null
                }
                })
        },
        updateUserAction(){
if(this.action.option == 'remove'){
                return this.postRemoveItem()
            }
        },
        postRemoveItem(){
            this.isloading = true
            let item = this.filterData.data[this.itemToChange]
            ApiManager.postRemoveNetwork(item).then((response)=>{
                this.isloading = false
                this.filterData.data.splice(this.itemToChange,1)
                this.filterData.total -= 1
                this.showToast('Jaringan terhapus')
            }).catch((error)=>{
                this.showToast('Oops hapus dulu data pelanggan di server ini')
                //console.log('error '+error)
                this.isloading = false
            })
        },
        updateItem(){
            this.isloading = true
            ApiManager.postUpdateNetwork(this.networkItem).then((response)=>{
                this.isloading = false
                if(response.data.code ==0){
                    this.filterData.data.splice(this.itemToChange,1,response.data.data)
                    this.showToast('Jaringan Updated')
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
