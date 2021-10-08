<template>
    <app-layout :title="$page.props.appname" :isloader="isloader">
         <template #header>
             <div class="d-flex justify-content-between">
                <h2 class="h4 font-weight-bold">
                    Ads Page
                </h2>
                <button class="btn btn-dark rounded-lg" @click="addAds"><i class='bx bxs-plus-circle'></i> Add</button>
             </div>
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
              Ads Settings
            </h3>
            <!-- start search -->
             <div class="searchbar">
          <input class="search_input" type="text" v-model="query" placeholder="Search owner or phone">
          <a href="#" class="search_icon"><i class='bx bx-loader bx-spin' v-if="isloading"></i><i class="fas fa-search" v-else></i></a>
        </div>
            <!-- end search -->
            </div>
            <div class="row">
                <div class="col">
            <div class="text-muted mb-3">
                <p>Type Ads: </p>
                <ul>
                    <li><strong>Home</strong> :  Ads will be show on Home,Coin, Watchlist Page</li>
                    <li><strong>Detail</strong> :  Ads will be show on Detail Coin Page only</li>
                    <li><strong>Default</strong> :  If no ads in type 'Home' or 'Detail'. The site use 'Default' type automatically</li>
                </ul>
            </div>
                </div>
                <div class="col">
                                    <p>Status Ads: </p>
                <ul>
                    <li><strong>Active</strong> :  The Ads will show on site</li>
                    <li><strong>Expired</strong> :  The Ads ended based Start date and End date. This wil automatically update by system</li>
                    <li><strong>Disabled</strong> :  Block the ads Manually</li>
                </ul>
                </div>
                </div>
                <p><strong>Notes:</strong>Ads will appear and change automatically according to ads interval time setting</p>

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
        <th scope="col"></th>
        <th scope="col">Owner</th>
        <th scope="col">Phone</th>
        <th scope="col">Start</th>
        <th scope="col">End</th>
        <th scope="col">Type</th>
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
      <td><a :href="item.ads_link" alt="View Ads link" target="_blank" ><img :src="item.ads_image_url" alt="Ads image" class="img-fluid" /></a></td>      
      <td>{{ item.ads_owner_name }}</td>
      <td>{{ item.ads_owner_phone }}</td>
      <td>{{ item.start_date }}</td>
      <td>{{ item.end_date }}</td>
      <td>        
          <span class="badge badge-pill badge-dark p-2 m-1">{{ item.ads_type_label}}</span>
      </td>
      <td class="text-center">{{item.is_active == 1 ? 'Active': item.is_active == 3 ? 'Disabled' : 'Expired'}}</td>
   <td>            
       <div class="d-flex justify-content-center">
           <div class="dropdown">
  <span class="badge badge-pill badge-success p-2 m-1 dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    Edit
  </span>
  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
    <a class="dropdown-item" href="javascript:" @click="switchActive(index)">{{ item.is_active == 1 ? 'Disabled' : 'Activated'}}</a>
    <a class="dropdown-item" href="javascript:" @click="editData(index)">Change Data</a>
    <a class="dropdown-item" href="javascript:" @click="deleteAds(index)">Delete</a>
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

        <jet-danger-button class="ml-2" @click="action.option=='delete' ? deleteAdsConfirm() : updateActivatedAds()">
          {{ action.option=='delete' ? `Confirm` : `Change` }}
        </jet-danger-button>

      </template>
    </jet-confirmation-modal>
    <!-- Modal Add Update start -->
    <jet-dialog-modal id="adsAddUpdateModal">
      <template #title>
          {{ isEdit ? `Edit [${adsItem.ads_title}]` : `Add A Item Ads` }}
      </template>
      <template #content>
          <div>
<!-- start input -->
 <label>Ads Image* ( Size must (WxH) 730px * 90px )</label>
                                <input type="file" ref="myFile" @change="updatePhotoPreview" accept="image/*" hidden>
                                <div class="photo mt-3" v-show="imgpreview" @click="uploadImage" role="button">
                                    <img :src="imgpreview" class="img-fluid sfdsf"/>
                                   
                                </div>
                                <div class="photo mt-3 text-center" v-show="!imgpreview" @click="uploadImage" role="button">
                                    <img :src="adsItem.ads_image_url" class="img-fluid"/>
                                    <i class='bx bxs-camera-plus' style="font-size:4em;color: red" v-if="!adsItem.ads_image_url"></i>
                                </div>
                                <div class="form-group mt-2">
                                    <jet-label for="ads_title" value="Ads Name*" />
                                    <jet-input id="ads_title" type="text" required v-model="adsItem.ads_title" placeholder="Ads 1"/>
                                </div>
                                <div class="form-group">
                                    <jet-label for="ads_link" value="Ads Link"/>
                                    <jet-input id="ads_link" type="text" v-model="adsItem.ads_link" placeholder="eg. Http://....." />
                                </div>
                                   <div class="row">
                                <div class="col">
                                <div class="form-group">
                                    <jet-label for="ads_price" value="Ads Price (Rp)"/>
                                    <jet-input id="ads_price" type="number" v-model="adsItem.ads_price" placeholder="200000" />
                                </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                    <jet-label for="ads_type" value="Type Ads"/>
                                    <select class="form-control" id="ads_type" v-model="adsItem.ads_type">
                                        <option v-for="(item,index) in adstypes" :value="item.id" :key="index">
                                            {{ item.value }}
                                        </option>
                                    </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                <div class="form-group">
                                    <jet-label for="start_date" value="Start Date"/>
                                    <jet-input id="start_date" type="date" v-model="adsItem.start_date" placeholder="200000" />
                                </div>
                                </div>
                                <div class="col">
                                   <div class="form-group">
                                    <jet-label for="end_date" value="End Date"/>
                                    <jet-input id="end_date" type="date" v-model="adsItem.end_date" placeholder="200000" />
                                </div>
                                </div>
                            </div>
                             <div class="form-group">
                                    <jet-label for="is_active" value="Is Active*" />
                                     <select class="form-control" id="ads_type" v-model="adsItem.is_active">
                                        <option :value="1">Active</option>
                                        <option :value="0">Expired</option>
                                    </select>
                                </div>     
                                <!-- ads owner -->
                                <div class="card rounded shadow text-white p-2 bg-dark">
<h3 class="text-center">Owner</h3>
                            
                                <div class="form-group">
                                    <jet-label for="ads_owner_name" value="Ads Owner Name*" />
                                    <jet-input id="ads_owner_name" type="text" required v-model="adsItem.ads_owner_name" placeholder="Mr Run"/>
                                </div>
                                <div class="row">
                                <div class="col">
                               <div class="form-group">
                                    <jet-label for="ads_owner_email" value="Ads Owner Email*" />
                                    <jet-input id="ads_owner_email" type="email" required v-model="adsItem.ads_owner_email" placeholder="myemail@example.com"/>
                                </div>
                                </div>
                                <div class="col">
                                  <div class="form-group">
                                    <jet-label for="ads_owner_phone" value="Ads Owner Phone*" />
                                    <jet-input id="ads_owner_phone" type="text" required v-model="adsItem.ads_owner_phone" placeholder="+6282132935169"/>
                                </div>
                                </div>
                            </div>     
                                <div class="form-group">
                                    <jet-label for="ads_address" value="Ads Address" />
                                    <jet-input id="ads_address" type="text" required v-model="adsItem.ads_address" placeholder="Insert owner address here"/>
                                </div>
                                </div>
                            <!-- end ads owner -->
                                 
<!-- end input -->
          </div>
      </template>
      <template #footer>
        <jet-secondary-button data-dismiss="modal">
          Cancel
        </jet-secondary-button>

        <jet-button class="ml-2" @click="saveData">
          Save
        </jet-button>
      </template>
    </jet-dialog-modal>
    <!-- Modal Ads Update End -->
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
import JetDialogModal from '@/Jetstream/DialogModal'
import JetButton from '@/Jetstream/Button'
import JetInput from '@/Jetstream/Input'
import JetLabel from '@/Jetstream/Label'
export default {
    extends: BaseComponentVue,
    components: {
        AppLayout,
        JetConfirmationModal,
JetDangerButton,
JetSecondaryButton,
JetDialogModal,
JetButton,
JetInput,
JetLabel,
    },
    data(){
        return{
            filterData: {
                data: [],
            },
            isloading: false,
            isloader: false,
            query:'',
            itemToChange: null,
            imgpreview: null,
            userItem:null,
            action:{
                title:'',
                message:'',
                option:''
            },
            bootstrap: null,
            adsItem: this.resetItem(),
            adstypes:[
                { id : 1, value: 'Home' },
                { id : 2, value: 'Detail' },
                { id : 3, value: 'Default' },
            ],
            isEdit:false,
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
            ApiManager.getAds(page)
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
            ApiManager.getSearchAds(this.query).then((response)=>{
                this.isloading = false
                this.filterData = response.data.data
            }).catch((error)=>{
                this.isloading = false
                console.log(error)
            })
        },
        addAds(){
            this.isEdit = false
            this.adsItem = this.resetItem()
            this.bootstrap = $('#adsAddUpdateModal')
            this.bootstrap.modal('toggle')  

        },
        editData(index){
            this.adsItem  = this.filterData.data[index]
            this.itemToChange = index
            this.isEdit = true
            this.bootstrap = $('#adsAddUpdateModal')
            this.bootstrap.modal('toggle')  
        },
         uploadImage(){
            this.$refs.myFile.click();
        },
        updatePhotoPreview() {
      const reader = new FileReader();

      reader.onload = (e) => {
        this.imgpreview = e.target.result;
      };

      reader.readAsDataURL(this.$refs.myFile.files[0]);
    },
    resetItem(){
        return {
             //adsItem:{
                ads_title : '',
                ads_price : '',
                ads_type : 1,
                ads_owner_name : '',
                ads_owner_email : '',
                ads_owner_phone : '',
                ads_address : '',
                ads_image_url : '',
                ads_link : '',
                is_active : 1,
                start_date : '',
                end_date : '',
           // }
        }     
    },
    saveData(){
        if (this.$refs.myFile) {
            this.adsItem.ads_image_url = this.$refs.myFile.files[0]
            //console.log('Update myFile '+JSON.stringify(this.adsItem.ads_image_url))
        }
        //console.log('datas '+JSON.stringify(this.form))
        let formData = new FormData();
        formData.append('ads_title',this.adsItem.ads_title);
        formData.append('ads_price',this.adsItem.ads_price);
        formData.append('ads_type',this.adsItem.ads_type);
        formData.append('ads_owner_name',this.adsItem.ads_owner_name);
        formData.append('ads_owner_email',this.adsItem.ads_owner_email);
        formData.append('ads_owner_phone',this.adsItem.ads_owner_phone);
        formData.append('ads_address',this.adsItem.ads_address);
        formData.append('ads_image_url',this.adsItem.ads_image_url);
        formData.append('ads_link',this.adsItem.ads_link);
        formData.append('is_active',this.adsItem.is_active);
        formData.append('start_date',this.adsItem.start_date);
        formData.append('end_date',this.adsItem.end_date);
            if(this.isEdit){
                //console.log('Update data ads')
                formData.append('_method', 'PUT');
                this.saveEdit(formData)
            }else{
                //console.log('Add data ads')
                this.saveAdd(formData)
            }
              
        },
        saveEdit(formData){
            this.isloader = true
                               this.bootstrap = $('#adsAddUpdateModal')
                    this.bootstrap.modal('toggle')
            ApiManager.updateAds(this.adsItem.id,formData).then((response) => {
                this.isloader = false
                 if(response.data.code == 0){
                    this.filterData.data.splice(this.itemToChange,1,response.data.data)
                     this.showToast('Ads Item Updated')
                 }
            })
            .catch((error) => {
                console.log(JSON.stringify(error));
            });
        },
        saveAdd(formData){
            this.isloader = true
                               this.bootstrap = $('#adsAddUpdateModal')
                    this.bootstrap.modal('toggle')
            ApiManager.postSaveAds(formData).then((response) => {
                this.isloader = false
                 if(response.data.code == 0){
                    this.filterData.data.push(response.data.data)
                     this.showToast('Ads Item Added')
                 }
            })
            .catch((error) => {
                console.log(JSON.stringify(error));
            });
        },
        deleteAds(index){
            this.adsItem  = this.filterData.data[index]
            this.itemToChange = index
             this.action.title = `Are you sure to delete the ads ${this.adsItem.ads_title}?`
            this.action.message = `TOnce your item is deleted, all of its resources and data will be permanently deleted`
            this.action.option = 'delete'
            this.bootstrap = $('#confirmModalAction')
            this.bootstrap.modal('toggle')       
        },
        deleteAdsConfirm(){
             this.isloading = true
                this.bootstrap = $('#confirmModalAction')
                    this.bootstrap.modal('toggle')  
            ApiManager.deleteAds(this.adsItem).then((response)=>{
                this.isloading = false
                    this.showToast(response.data.data.ads_title+ ' deleted')
                    this.filterData.data.splice(this.itemToChange,1)
                  
            }).catch((error)=>{
                 this.isloading = false
                console.log(error)
            })
        },
        switchActive(index){
            let item = this.filterData.data[index]
            this.itemToChange = index
            if(item.is_active == 1){
                this.action.title = `Block the ads ${item.ads_title}`
                this.action.message = `This action make the ads not visible`
                this.action.option = 'switch'                
            }else{
                this.action.title = `Activate the ads ${item.ads_title}`
                this.action.message = `This action make the ads visible but make sure the date to show is correct`
                this.action.option = 'switch'
            }
            this.bootstrap = $('#confirmModalAction')
            this.bootstrap.modal('toggle')
        },
        updateActivatedAds(){
           this.isloader = true
              this.showToast('Ads Updated')
                 this.bootstrap = $('#confirmModalAction')
            let item = this.filterData.data[this.itemToChange]
            let active = item.is_active == 1 ? 3 : 1
            ApiManager.updateActiveAds({id: item.id, is_active: active}).then((response)=>{
                this.isloader = false
                this.filterData.data.splice(this.itemToChange,1,response.data.data)
             
            this.bootstrap.modal('toggle')
            }).catch((error)=>{
                console.log(error)
                this.isloader = false
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