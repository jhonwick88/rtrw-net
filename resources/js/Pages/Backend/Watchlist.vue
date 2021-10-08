<template>
    <app-layout :title="$page.props.appname">
         <template #header>
            <h2 class="h4 font-weight-bold">
                Watchlist
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
              Watch list
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
       <a class="page-link" href="javascript:" @click="getPage(item.coin.label)" v-else>{{item.coin.label}}</a>
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
        <th scope="col">Name</th>
        <th scope="col">Chain</th>
        <th scope="col">Symbol</th>
        <th scope="col">MarketCap</th>
        <th scope="col">Price</th>
        <th scope="col">Launched</th>
        <th scope="col">Votes</th>
        <th scope="col">
            Options
        </th>
    </tr>
  </thead>
  <tbody>
    <tr v-for="(item,index) in filterData.data" :key="index">
      <th scope="row">
          {{ filterData.from+index }}
      </th>
      <td>
          <div class="flex">
         <img :src="item.coin.logo" alt="" height="24">
            </div>
      </td>
      <td>{{ item.coin.name }}</td>
      <td class="text-uppercase"><span class="badge badge-pill badge-secondary p-2">{{ item.coin.network.sort_name }}</span></td>
      <td class="text-uppercase">
      {{ item.coin.symbol }}
   </td>
      <td v-if="item.coin.ispresale"><span class="presale">Presale</span></td>
   <td v-else>{{ item.coin.marketcap!=null ? `$${item.coin.marketcap}` : `-`}}</td>
   <td v-if="item.coin.ispresale"> - </td>
   <td v-else>{{ item.coin.price_usd!=null ? `$${item.coin.price_usd}` : `-`}} </td>
   <td>{{ item.coin.launch_on }}</td>
   <td><span class="votes">{{item.coin.votes.all}}</span></td>
   <td>            <div class="d-flex justify-content-center">
                <a :href="`/coin/${item.coin.name}-${item.coin.id}`" target="_blank" class="badge badge-pill badge-primary p-2 m-1" role="button">View</a>
                <span class="badge badge-pill badge-warning p-2 m-1" role="button" @click="deleteWatchlist(index)">Delete</span>
            </div></td>
    </tr>
  </tbody>
</table>
          <!-- end content -->
      </div>
    </div>
          </div>
          <confirm-delete :itemData="coinItem" @actionDelete="actionDelete" ref="childDelete"/>
          <!-- end content -->
    </app-layout>
</template>
<script>
import AppLayout from '@/Layouts/AppLayout'
import ApiManager from '../API/ApiManager'
import ConfirmDelete from './ConfirmDelete'
import BaseComponentVue from '../../Layouts/BaseComponent.vue'
export default {
    extends: BaseComponentVue,
    components: {
        AppLayout,
        ConfirmDelete
    },
    data(){
        return{
            filterData: {
                data: [],
            },
            isloading: false,
            query:'',
            indexCoin: null,
            coinItem: null,
            
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
            ApiManager.getWatchlist(page)
                .then((response) => {
                    this.isloading = false
                    this.filterData = response.data.data
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
            ApiManager.getSearchWatchlist(this.query).then((response)=>{
                this.isloading = false
                let filters = response.data.data;
                this.filterData.data = []
                filters.data.forEach((item,index)=>{
                    if(item.coin != null){
                        this.filterData.data.push(item);
                    }
                })

                //this.filterData = response.data.data
            }).catch((error)=>{
                this.isloading = false
                console.log(error)
            })
        },
        deleteWatchlist(index){
            const item = this.filterData.data[index]
            this.coinItem = item
            this.indexCoin = index
            this.$refs.childDelete.showConfirmDelete()
        },
        actionDelete(item){
            this.isloading = true
            ApiManager.deleteWatchlist(item.id).then((response)=>{
                this.isloading = false
                    this.showToast('Watchlist item deleted')
                    this.filterData.data.splice(this.indexCoin,1)
                    this.$refs.childDelete.showConfirmDelete()
            }).catch((error)=>{
                 this.isloading = false
                console.log(error)
            })
        }
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