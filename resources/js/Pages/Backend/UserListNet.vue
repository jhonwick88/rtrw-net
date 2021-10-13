<template>
    <app-layout>
<div class="row">
<div class="col-12">
<div class="card">
    <div class="card-header">
	<h3><i class=" fa fa-money"></i> Users <small id="loader" style="display: none;"><i><i class="fa fa-circle-o-notch fa-spin"></i> Processing... </i></small></h3>
</div>
<div class="card-body">
     <!-- content here -->
<!-- header table -->
<div class="row">
<div class="col-12 mr-b-10">
    		<div style="padding-bottom: 5px; padding-top: 5px;">
                 <input type="text" class="form-control" v-model="query" placeholder="Search..." style="float:left; margin-top: 6px; max-width: 150px;">
                 <button name="help" class="btn bg-primary" onclick="location.href='#help';" title="Help"><i class="fa fa-question"></i> Help</button>
		</div>

</div>
</div>
<!-- end header table -->
<!-- start table -->
		  <div class="overflow box-bordered" style="max-height: 70vh">
			<table id="dataTable" class="table table-bordered table-hover text-nowrap">
				<thead class="thead-light">
				<tr>
				  <th colspan="4">Users oct 2021<b style="font-size:0;">,,,,</b></th>
				  <th style="text-align:right;">Total</th>
				  <th style="text-align:right;" id="total">Rp 0</th>
				</tr>
				<tr>
				  <th>№</th>
					<th>Name</th>
					<th>Email</th>
					<th>Roles</th>
					<th>Active</th>
					<th>Options</th>
				</tr>
				</thead>
				<tbody>
                    <tr v-for="(item,index) in filterData.data" :key="index">
      <th scope="row">
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
       <div class="d-flex justify-content-center" v-if="item.id != 1">
           <div class="dropdown">
  <span class="badge badge-pill badge-success p-2 m-1 dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    Edit
  </span>
  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
    <a class="dropdown-item" href="javascript:" @click="switchActive(index)">{{ item.is_active ? 'Blocked' : 'Activated'}}</a>
    <a class="dropdown-item" href="javascript:" @click="editUser(index)">Change Role</a>
  </div>
</div>
            </div></td>
    </tr>
				</tbody>
			</table>
		</div>
<!-- end table -->
    <!-- end content -->
</div>
</div>
<!-- modal -->
<div class="modal-window" id="help" aria-hidden="true">
  <div>
  	<header><h1>Header Modal</h1></header>
  	<a style="font-weight:bold;" href="#" title="Close" class="modal-close">X</a>
    <p>OK Modal</p>
  </div>
</div>
<!-- end modal -->
</div>
</div>

    </app-layout>
</template>
<script>
import AppLayout from '@/Layouts/AppLayoutNet'
import ApiManager from '../API/ApiManager'
// import JetConfirmationModal from '@/Jetstream/ConfirmationModal'
// import JetDangerButton from '@/Jetstream/DangerButton'
// import JetSecondaryButton from '@/Jetstream/SecondaryButton'
import BaseComponentVue from '../../Layouts/BaseComponent.vue'
export default {
    extends: BaseComponentVue,
    components: {
        AppLayout,
//         JetConfirmationModal,
// JetDangerButton,
// JetSecondaryButton,
    },
    data(){
        return{
            filterData: {
                data: [],
            },
            isloading: false,
            query:'',
            itemToChange: null,
            userItem:null,
            action:{
                title:'',
                message:'',
                option:''
            },
            bootstrap: null,
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
        editUser(index){
            console.log('edit user')
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
            this.bootstrap = $('#confirmModalAction')
            this.bootstrap.modal('toggle')
            }
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
            this.bootstrap = $('#confirmModalAction')
            this.bootstrap.modal('toggle')
        },
        updateUserAction(){
            if(this.action.option == 'role'){
                return this.updateUserRole()
            }
            return this.updateUserActive()
        },
        updateUserActive(){
            this.isloading = true
            let item = this.filterData.data[this.itemToChange]
            let active = item.is_active == 1 ? 0 : 1
            ApiManager.updateUser({id: item.id, is_active: active}).then((response)=>{
                this.isloading = false
                this.filterData.data.splice(this.itemToChange,1,response.data.data)
                this.showToast('User Updated')
                 this.bootstrap = $('#confirmModalAction')
            this.bootstrap.modal('toggle')
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
                  this.bootstrap = $('#confirmModalAction')
            this.bootstrap.modal('toggle')
            }).catch((error)=>{
                console.log(error)
                this.isloading = false
            })
        },
    }
}
</script>
