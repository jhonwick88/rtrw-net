<template>
<app-layout :title="$page.props.appname" :isloader="isloading">
<div class="row">
<div class="col-12">
<div class="card">
    <div class="card-header">
	<h3><i class=" fa fa-user"></i> {{ $page.props.appname }}
        <span style="font-size: 14px">
                 &nbsp; | &nbsp; <a :href="route('be.admin.user.create')" title="Tambah User"><i class="fa fa-user-plus"></i> Tambah</a>
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
                 <button name="help" class="btn bg-primary" onclick="location.href='#help';" title="Help"><i class="fa fa-question"></i> Bantuan</button>
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
				  <th colspan="4">Pengguna<b style="font-size:0;">,,,,</b></th>
				  <th style="text-align:right;">Total</th>
				  <th style="text-align:right;" id="total">{{ filterData.total }} Pengguna</th>
				</tr>
				<tr>
				  <th class="text-center">№</th>
					<th class="pointer" title="Click to sort" @click="sort('name')"><i class="fa fa-sort"></i> Nama</th>
					<th class="pointer" title="Click to sort" @click="sort('email')"><i class="fa fa-sort"></i> Email</th>
					<th>Level</th>
					<th>Aktif</th>
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
      <td>{{ item.email }}</td>
      <td>
          <template v-if="item.roles.length > 0">
          <span class="badge badge-pill badge-dark p-2 m-1" v-for="(role,i) in item.roles" :key="i">{{role.title}}</span>
          </template>
      </td>
      <td class="text-center">{{item.is_active ? 'Active':'Blocked'}}</td>
   <td>

       <div v-if="item.id != 1" style="display: inline;">
           <a class="btn bg-warning" href="javascript:" @click="switchActive(index)">{{ item.is_active ? 'Blocked' : 'Activated'}}</a>
    <a class="btn bg-danger" href="javascript:" @click="editUser(index)">Change Role</a>
       </div>
                  <a class="btn bg-indigo" href="javascript:" @click="changeData(index)">Edit</a>
</td>
    </tr>
				</tbody>
			</table>
		</div>
<!-- end table -->
<!-- change Data -->
   <jet-confirmation-modal id="edit">
     <template #title>
        Edit {{userItem.name}}
      </template>
      <template #content>
       <table class="table">
 <tbody>
  <tr>
    <td class="align-middle">Nama</td><td><input class="form-control" type="text" name="name"  v-model="userItem.name"></td>
  </tr>
    <tr>
    <td class="align-middle">Email</td><td><input class="form-control" type="text" name="email"  v-model="userItem.email"></td>
  </tr>
  <tr>
    <td class="align-middle">Sandi Baru</td><td>
        <div class="input-group">
          <div class="input-group-11 col-box-10">
            <input class="group-item group-item-l" id="passUser" :type="`${showPassword ? 'text' : 'password'}`" name="pass" autocomplete="new-password" required="1" v-model="userItem.password_new">
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
      </template>

      <template #footer>
        <button class="btn bg-danger" @click="updateUser">
          Simpan
        </button>
      </template>
    </jet-confirmation-modal>
<!-- end change data -->
    <!-- end content -->
     <jet-confirmation-modal id="help">
      <template #title>
        Tips Pencarian User
      </template>
      <template #content>
        Pencarian user ini berdasarkan nama dan email
      </template>

      <template #footer>
        <button>
          Not
        </button>

        <button>
          Usefull
        </button>
      </template>
    </jet-confirmation-modal>
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
            userItem:{
                name: '',
                email: '',
                password_new: ''
            },
            action:{
                title:'',
                message:'',
                option:''
            },
            bootstrap: null,
            showPassword: false,
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
            ApiManager.getUsers(page)
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
            ApiManager.getSearchUsers(this.query).then((response)=>{
                this.isloading = false
                this.filterData = response.data.data
            }).catch((error)=>{
                this.isloading = false
                console.log(error)
            })
        },
        remove(index){
            let item = this.filterData.data[index]
            this.action.title = `Remove user ${item.name}`
            this.action.message = `This action can't be undo`
            this.action.option = 'remove'
            this.itemToChange = index
            this.showAlert()
        },
        editUser(index){
            let item = this.filterData.data[index]
            this.itemToChange = index
            if(item.roles.length > 0){
                let role = false
                item.roles.forEach((data,index)=>{
                    role = data.title == 'Admin' ? true : false
                })
                 if(role){
                this.action.title = `Action role for user ${item.name}`
                this.action.message = `This action make the member become USER`
                this.action.option = 'role'
                this.action.role = 2
            }else{
                this.action.title = `Action role for user ${item.name}`
                this.action.message = `This action make the member become ADMIN`
                this.action.option = 'role'
                this.action.role = 1
            }
           this.showAlert()
            }
        },
        changeData(index){
            let item = this.filterData.data[index]
            this.itemToChange = index
            this.userItem = item
            location.href='#edit'
        },
        switchActive(index){
            let item = this.filterData.data[index]
            this.itemToChange = index
            if(item.is_active == 1){
                this.action.title = `Block the user ${item.name}`
                this.action.message = `This action make the user can't login to the Website`
                this.action.option = 'switch'
            }else{
                this.action.title = `Activate the user ${item.name}`
                this.action.message = `This action make the user can login to the Website`
                this.action.option = 'switch'
            }
            this.showAlert()
        },
            updateUser(){
                this.isloading = true
                ApiManager.postUpdateUser(this.userItem).then((response)=>{
                    this.isloading = false
                    if(response.data.code == 0){
                    this.filterData.data.splice(this.itemToChange,1,response.data.data)
                    this.showToast('User Updated')
                    window.location.href="#"
                    if(this.userItem.id == this.$page.props.user.id){
                        window.location.href = route('login')
                    }
                }else{
                    this.showToast(response.data.message)
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
            if(this.action.option == 'role'){
                return this.updateUserRole()
            }else if(this.action.option == 'remove'){
                return this.postRemoveUser()
            }else{
            return this.updateUserActive()}
        },
        postRemoveUser(){
            this.isloading = true
            let item = this.filterData.data[this.itemToChange]
            ApiManager.postRemoveUser(item).then((response)=>{
                this.isloading = false
                this.filterData.data.splice(this.itemToChange,1)
                this.filterData.total -= 1
                this.showToast('User removed')
            }).catch((error)=>{
                console.log(error)
                this.isloading = false
            })
        },
        updateUserActive(){
            this.isloading = true
            let item = this.filterData.data[this.itemToChange]
            let active = item.is_active == 1 ? 0 : 1
            ApiManager.updateUser({id: item.id, is_active: active}).then((response)=>{
                this.isloading = false
                this.filterData.data.splice(this.itemToChange,1,response.data.data)
                this.showToast('User Updated')
            //      this.bootstrap = $('#confirmModalAction')
            // this.bootstrap.modal('toggle')
            }).catch((error)=>{
                console.log(error)
                this.isloading = false
            })
        },
        updateUserRole(){
            this.isloading = true
            let item = this.filterData.data[this.itemToChange]
            let roles = this.action.role
            ApiManager.updateUser({id: item.id, roles: roles}).then((response)=>{
                this.isloading = false
                this.filterData.data.splice(this.itemToChange,1,response.data.data)
                this.showToast('User Updated')
            //       this.bootstrap = $('#confirmModalAction')
            // this.bootstrap.modal('toggle')
            }).catch((error)=>{
                console.log(error)
                this.isloading = false
            })
        },
    }
}
</script>
