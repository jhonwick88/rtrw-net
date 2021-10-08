<template>
    <frontend-layout :isloader="isLoading" :title="$page.props.appname">
        <div class="container">
            <header-ads :ads_data="$page.props.ads_home" :setting="$page.props.setting_new"></header-ads>
            <promotion-table :promotions="promotions" :needheader="true"></promotion-table>
            <div class="row">
               <div class="col-12">
<!-- start tab -->
                        <div class="has-tabs">
                     <div class="tabs is-boxed is-large is-hidden-mobile">
                         <ul>
                             <li :class="{'is-active':coinsby=='today'}">
                                 <a href="javascript:" @click="getFilterData(1,'today')">
                                     <span class="icon is-small"><i class="far fa-clock"></i></span>
                                     <span>Today</span>
                                 </a>
                             </li>
                            <li :class="{'is-active':coinsby=='alltime'}">
                                   <a href="javascript:" @click="getFilterData(1,'alltime')">
                                     <span class="icon is-small"><i class="fas fa-fire"></i></span>
                                     <span>All Time</span>
                                 </a>
                             </li>
                             <li :class="{'is-active':coinsby=='new'}">
                                 <a href="javascript:" @click="getFilterData(1,'new')">
                                     <span class="icon is-small"><i class="fas fa-plus"></i></span>
                                     <span>New</span>
                                 </a>
                             </li>
                             <li :class="{'is-active':coinsby=='marketcap'}">
                                 <a href="javascript:" @click="getFilterData(1,'marketcap')">
                                     <span class="icon is-small"><i class='bx bx-coin-stack' ></i></span>
                                     <span>Marketcap</span>
                                 </a>
                             </li>
                             <li :class="{'is-active':coinsby=='presales'}">
                                 <a href="javascript:" @click="getFilterData(1,'presales')">
                                     <span class="icon is-small"><i class="fas fa-stopwatch"></i></span>
                                     <span>Presales</span>
                                 </a>
                             </li>
                         </ul>
                     </div>
                     <div class="tabs is-boxed is-hidden-tablet">
                         <ul>
                            <li :class="{'is-active':coinsby=='today'}">
                                 <a href="javascript:" @click="getFilterData(1,'today')">
                                     <span class="icon is-small"><i class="far fa-clock"></i></span>
                                     <span>Today</span>
                                 </a>
                             </li>
                            <li :class="{'is-active':coinsby=='alltime'}">
                                   <a href="javascript:" @click="getFilterData(1,'alltime')">
                                     <span class="icon is-small"><i class="fas fa-fire"></i></span>
                                     <span>All Time</span>
                                 </a>
                             </li>
                             <li :class="{'is-active':coinsby=='new'}">
                                 <a href="javascript:" @click="getFilterData(1,'new')">
                                     <span class="icon is-small"><i class="fas fa-plus"></i></span>
                                     <span>New</span>
                                 </a>
                             </li>
                             <li :class="{'is-active':coinsby=='marketcap'}">
                                 <a href="javascript:" @click="getFilterData(1,'marketcap')">
                                     <span class="icon is-small"><i class='bx bx-coin-stack' ></i></span>
                                     <span>Marketcap</span>
                                 </a>
                             </li>
                             <li :class="{'is-active':coinsby=='presales'}">
                                 <a href="javascript:" @click="getFilterData(1,'presales')">
                                     <span class="icon is-small"><i class="fas fa-stopwatch"></i></span>
                                     <span>Presales</span>
                                 </a>
                             </li>
                         </ul>
                     </div>
                 </div>
<!-- end tab -->
               </div>
               <div class="col-12 mb-5">
                  <div class="promoted d-flex flex-column">
                      <img src="/images/spinner.svg" class="spinner" v-if="isLoadfilter"/>
                      <filter-table :isidata="filterData" :query="coinsby" @clickPage="filterBy" v-else></filter-table>
                  </div>
               </div>
            </div>
            <coin-mis></coin-mis>
            <!-- <div class="page-content">                 
            </div>
            <div class="page-content" v-if="filterData.data.length > 0">
                <filter-table :isidata="filterData" :query="coinsby" @clickPage="filterBy"></filter-table>
            </div> -->
         </div>
      
    </frontend-layout>
</template>

<script>

import FrontendLayout from '../../Layouts/FrontendLayout.vue'
import CoinMis from '../Frontend/CoinMis.vue'
import ApiManager from '../API/ApiManager'
import FilterTable from '../Frontend/FilterTable.vue'
import { usePage } from '@inertiajs/inertia-vue3'
import PromotionTable from '../Frontend/PromotionTable.vue'
import HeaderAds from '../Frontend/HeaderAds.vue'
//import {onMounted, reactive/* onUpdated, onUnmounted */} from 'vue'

export default {
    components: {
        FrontendLayout,
        FilterTable,
        CoinMis,
        PromotionTable,
        HeaderAds,
    },
    data(){
        return{
            promotions: [],
            filterData: {
                data: [],
            },
            coinsby: usePage().props.value.coinsby,
            isLoading: true,
            isLoadfilter: true
        }
    },
    created() {
        this.getPromotionsList('alltime'), //default
        this.getFilterData(1,this.coinsby)
    },
    methods: {
        getPromotionsList(filter){
            this.isLoading = true
            ApiManager.getPromoted(filter)
             .then((response) => {
                 this.isLoading = false
                this.promotions = response.data.data
                //console.log(JSON.stringify(state.promotions))
            })
            .catch((error) => {
                console.log(error);
            });
        },
        getFilterData(page,filter){
            this.isLoadfilter = true
            this.coinsby = filter
            ApiManager.getFiltersCoins(page,filter)
                .then((response) => {
                    this.isLoadfilter = false
                    this.filterData = response.data.data
                    this.coinsby = response.data.option
                    //console.log(this.coinsby)
                })
                .catch((error) => {
                    console.log(error);
                });
        },
        filterBy(data){
             if(!data.page.includes('&'))
              this.getFilterData(data.page,data.query)         
        },
    //    openTab(id){
    //         console.log('click '+id)
    //     }
    }
    // setup(){
    //     const state = reactive({
    //         promotions: []
    //     })
        
    //     const getPromotionsList = () => {
    //         ApiManager.getPromoted()
    //          .then((response) => {
    //             state.promotions = response.data.data
    //             console.log(JSON.stringify(state.promotions))
    //         })
    //         .catch((error) => {
    //             console.log(error);
    //         });
    //     }

    //     const openTab = (id) => {
    //         console.log('click '+id)
    //     }
    //     onMounted(
    //         getPromotionsList,
    //     )
    //     return{
    //         state,
    //         openTab
    //     }
    // }
}
</script>