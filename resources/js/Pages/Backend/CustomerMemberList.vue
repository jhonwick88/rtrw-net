<template>
<app-layout :title="$page.props.appname" :isloader="isloading">
<div class="row">
<div class="col-12">
<div class="card">
    <div class="card-header">
	<h3><i class=" fa fa-user"></i> {{ $page.props.appname }}
        <span style="font-size: 14px" v-if="$page.props.customer.network_type == 'VOUCHER'">
                 &nbsp; | &nbsp; <a href="javascript:" title="Tambah Member" @click="tambahUser"><i class="fa fa-user-plus"></i> Tambah</a>
                 &nbsp; | &nbsp; <a :href="route('be.admin.customers')" title="kembali ke pelanggan"><i class="fa fa-arrow-circle-left"></i> Kembali</a>
        </span>&nbsp;&nbsp;
        <small id="loader" v-if="isloading"><i><i class="fa fa-circle-o-notch fa-spin"></i> Processing... </i></small></h3>
</div>
<div class="card-body">
     <!-- content here -->
<!-- header table -->
<div class="row">
    <div class="col-6">
        <div class="box bg-blue bmh-75">
          <table class="table">
            <tbody>
            <tr>
                <td class="align-middle">Nama</td><td>{{$page.props.customer.name}}</td>
            </tr>
            <tr>
                <td class="align-middle">Alamat</td><td>{{$page.props.customer.adress}}</td>
            </tr>
            <tr>
                <td class="align-middle">Telp</td><td>{{$page.props.customer.phone}}</td>
            </tr>
             <tr>
                <td class="align-middle">Tipe Pelanggan</td><td>{{$page.props.customer.network_type}}</td>
            </tr>

            </tbody>
          </table>
        </div>
    </div>
    <div class="col-6">
        <div class="box bg-green bmh-75">
         <table class="table">
            <tbody>
                <tr>
                <td class="align-middle">Kecepatan</td><td>{{$page.props.customer.network.name}}</td>
            </tr>
           <tr>
                <td class="align-middle">Harga</td><td>{{$page.props.customer.network.price}}</td>
            </tr>
            <tr>
                <td class="align-middle">Diskon</td><td>{{$page.props.customer.discount}}</td>
            </tr>
            <tr>
                <td class="align-middle">Total Bayar</td><td>{{$page.props.customer.total_payment}}</td>
            </tr>
            </tbody>
          </table>
        </div>
    </div>
</div>
<!-- end header table -->
<!-- start table -->
		  <div class="overflow mr-t-10 box-bordered" style="max-height: 65vh" v-if="$page.props.customer.network_type == 'VOUCHER'">
			<table class="table table-bordered table-hover text-nowrap">
				<thead class="thead-light">
				<tr>
				  <th colspan="5">{{ $page.props.title }}<b style="font-size:0;">,,,,</b></th>
				  <th style="text-align:right;">Total</th>
				  <th style="text-align:right;" id="total">{{ $page.props.customer.customer_member.length }}</th>
				</tr>
				<tr>
				  <th class="text-center">№</th>
					<th class="pointer" title="Click to sort" @click="sort('name')"><i class="fa fa-sort"></i> Nama</th>
					<th>Password</th>
					<th>Tambahan Harga</th>
					<th>Catatan</th>
                    <th>Dibuat Tgl</th>
                    <th>Aksi</th>
				</tr>
				</thead>
				<tbody>
                    <tr v-for="(item,index) in $page.props.customer.customer_member" :key="index">
      <th class="align-middle text-center">
          <i class="fa fa-minus-square text-danger pointer" @click="remove(index)"></i> &nbsp;&nbsp;
          {{ index + 1 }}
      </th>
      <td>{{ item.name }}</td>
      <td>{{ item.password }}</td>
      <td>{{ item.extra_price }}</td>
      <td>{{ item.note }}</td>
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
    <!-- edit -->

       <jet-confirmation-modal id="help">
      <template #title>
        {{ isEdit ? 'Edit': 'Tambah Anggota'}} {{userItem.name}}
      </template>
      <template #content>
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
      </template>

      <template #footer>
        <button class="btn bg-danger" @click="isEdit ? updateMember() : addMember()">
          Simpan
        </button>
      </template>
    </jet-confirmation-modal>

    <!-- edit -->
</div>
</div>
</div>
</div>
    </app-layout>
</template>
<script>
import AppLayout from '@/Layouts/AppLayoutNet'
import ApiManager from '../API/ApiManager'
import BaseComponentVue from '../../Layouts/BaseComponent.vue'
import JetConfirmationModal from '@/Jetstream/InfoModalNet'
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
            isEdit: false,
            itemToChange: null,
            userItem:{
                name:'',
                password:'',
                extra_price:'',
                note:''
            },
            action:{
                title:'',
                message:'',
                option:''
            },
        }
    },
    created() {
        //this.getFilterData(1)
    },
    watch: {

    },
    methods: {
        sort(col){
             if (this.currentSortCol === col) {
        this.currentSortDir = this.currentSortDir === "asc" ? "desc" : "asc";
      } else {
        this.currentSortCol = col;
      }
      this.$page.props.customer.customer_member.sort(this.sortBy(col,this.currentSortDir));
    },
        remove(index){
            let item = this.$page.props.customer.customer_member[index]
            this.action.title = `Hapus anggota dengan nama ${item.name}`
            this.action.message = `Anggota yang sudah dihapus tidak dapat dikembalikan`
            this.action.option = 'remove'
            this.itemToChange = index
            this.showAlert()
        },
        editUser(index){
            this.isEdit = true

           this.userItem = this.$page.props.customer.customer_member[index]
           location.href='#help'
        },
        tambahUser(){
            this.isEdit = false
            this.userItem = this.resetUser();
            location.href = '#help'
        },
        resetUser(){
            return {
                name:'',
                password:'',
                extra_price:'',
                note:''
            }
        },
        addMember(){
             this.isloading = true
             this.userItem.customer_id = this.$page.props.customer.id
            ApiManager.postAddMemberCustomer(this.userItem).then((response)=>{
                this.isloading = false
                if(response.data.code == 0){
                    this.showToast('Tambah anggota sukses')
                    window.location.href="#"
                    this.userItem = this.resetUser()
                    this.$page.props.customer.customer_member.push(response.data.data)
                }else{
                    this.showToast(response.data.message)
                }
            }).catch((error)=>{
                console.log(error)
                this.isloading = false
            })
        },
        updateMember(){
            this.isloading = true
            ApiManager.postUpdateMemberCustomer(this.userItem).then((response)=>{
                this.isloading = false
                if(response.data.code == 0){
                    this.showToast('Anggota terupdate')
                    window.location.href="#"
                    this.userItem = this.resetUser()
                }
            }).catch((error)=>{
                console.log(error)
                this.isloading = false
            })
        },
        showAlert(){
                        this.$swal.fire({
  title: this.action.title,
  text: this.action.message,
 // showDenyButton: true,
  showCancelButton: true,
  cancelButtonText: 'Batal',
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
            let item = this.$page.props.customer.customer_member[this.itemToChange]
            ApiManager.postRemoveMemberCustomer(item).then((response)=>{
                this.isloading = false
                this.$page.props.customer.customer_member.splice(this.itemToChange,1)
                //this.filterData.total -= 1
                this.showToast('Member removed')
            }).catch((error)=>{
                console.log(error)
                this.isloading = false
            })
        }

    }
}
</script>
