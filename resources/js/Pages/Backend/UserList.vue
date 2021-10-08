<template>
    <app-layout :title="$page.props.appname">
         <template #header>
            <h2 class="h4 font-weight-bold">
                UserList
            </h2>
        </template>
        <!-- start content -->
          <div class="row justify-content-center my-5">
    <div class="col-md-12">
      <div class="card shadow bg-light">
          <!-- head -->
                  <div class="card-body bg-white px-5 pt-3 pb-0 border-bottom rounded-topp">
          <div class="mx-3 mt-3">
            <div class="d-flex justify-content-between">
            <h3 class="h3 my-4">
              User list
            </h3>
            <!-- start search -->
             <div class="searchbar">
          <input class="search_input" type="text" v-model="query" placeholder="Search...">
          <a href="#" class="search_icon"><i class='bx bx-loader bx-spin' v-if="isloading"></i><i class="fas fa-search" v-else></i></a>
        </div>
            <!-- end search -->
            </div>

            <div class="text-muted mb-3">
             Lorem ipsum dolor sit amet consectetur adipisicing elit. Eos vel, eum consectetur dolor doloribus incidunt labore. Totam harum iste non libero nemo pariatur voluptates possimus neque. Itaque voluptate dignissimos pariatur.
            </div>
            <!-- pagination -->
            <div class="d-flex justify-content-center p-2">
                    <nav aria-label="Page navigation example" v-if="filterData.last_page > 1">
  <ul class="pagination">
    <li class="page-item" v-for="(item, i) in filterData.links" :key="i">
        <a class="page-link" href="javascript:" aria-label="Previous" v-if="i == 0">
        <span aria-hidden="true">&laquo;</span>
      </a>
      <a class="page-link" href="javascript:" aria-label="Next" v-else-if="i == filterData.links.length - 1">
        <span aria-hidden="true">&raquo;</span>
      </a>
       <a class="page-link" href="javascript:" @click="getPage(item.label)" v-else>{{item.label}}</a>
   </li>
  </ul>
</nav>
            </div>
                    <!-- end pagination -->
          </div>
        </div>
          <!-- end head -->
          <!-- content here -->
          <table class="table table-hover" v-if="filterData.data.length > 0">
  <thead class="thead-dark">
    <tr>
      <th scope="col">#</th>
        <th scope="col">Name</th>
        <th scope="col">Email</th>
        <th scope="col">Roles</th>
       <th scope="col" class="text-center">
            Active
        </th>
        <th scope="col" class="text-center">
            Options
        </th>
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
          <!-- end content -->
      </div>
    </div>
          </div>
                        <jet-confirmation-modal id="confirmModalAction">
      <template #title>
        {{ action.title }}
      </template>

      <template #content>
        {{ action.message }}
      </template>

      <template #footer>
        <jet-secondary-button @click="itemToChange = null" data-dismiss="modal">
          Cancel
        </jet-secondary-button>

        <jet-danger-button class="ml-2" @click="updateUserAction">
          Confirm
        </jet-danger-button>
      </template>
    </jet-confirmation-modal>
          <!-- end content -->
    </app-layout>
</template>
<script>
import AppLayout from '@/Layouts/AppLayout'
import ApiManager from '../API/ApiManager'
import JetConfirmationModal from '@/Jetstream/ConfirmationModal'
import JetDangerButton from '@/Jetstream/DangerButton'
import JetSecondaryButton from '@/Jetstream/SecondaryButton'
import BaseComponentVue from '../../Layouts/BaseComponent.vue'
export default {
    extends: BaseComponentVue,
    components: {
        AppLayout,
        JetConfirmationModal,
JetDangerButton,
JetSecondaryButton,
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
<style scoped>
 .searchbar{
    margin-bottom: auto;
    margin-top: auto;
    height: 60px;
    background-color: #353b48;
    border-radius: 30px;
    padding: 10px;
    }

    .search_input{
    color: white;
    border: 0;
    outline: 0;
    background: none;
    width: 0;
    caret-color:transparent;
    line-height: 40px;
    transition: width 0.4s linear;
    }

    .searchbar:hover > .search_input{
    padding: 0 10px;
    width: 450px;
    caret-color:red;
    transition: width 0.4s linear;
    }

    .searchbar:hover > .search_icon{
    background: white;
    color: #e74c3c;
    }
    .search_icon{
    height: 40px;
    width: 40px;
    float: right;
    display: flex;
    justify-content: center;
    align-items: center;
    border-radius: 50%;
    color:white;
    text-decoration:none;
    }
</style>