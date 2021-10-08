<template>
    <frontend-layout :isloader="isloading" :title="$page.props.appname">
        <div class="container">
            <header-ads :ads_data="$page.props.ads_home" :setting="$page.props.setting_new"></header-ads>
            <div class="row mt-3" v-show="public_link">
                <div class="col-lg-6 col-md-12 col-sm-12">
                    <div class="d-flex p-3 rounded bg-dark text-white">
                        <div class="gsdha"><i class='bx bx-link-external'></i></div>
                        <div class="ml-3">
                           <p class="m-0">Share your watchlist with this public link</p>
                           <p class="m-0"><a :href="public_link" target="_blank" alt="Share this to public" >{{ public_link }}</a> <i class='bx bxs-copy bx-rotate-90' role="button" @click="copiedz"></i></p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12 col-sm-12 text-right text-white">
                    <p class="m-0">Add projects to your watchlist by clicking on the golden star <i class="far fa-star" style="color:gold; margin-left:0.25rem;"></i></p>
                    <p class="m-0">Watchlisted projects are directly visible <i class="fas fa-star" style="color:gold; margin-left:0.25rem;"></i></p>
                    <p class="m-0">Remove from your watchlist by clicking on the red X <i class="fas fa-times" style="color:red; margin-left:0.45rem; margin-right:0.1rem; font-size: 1.1rem"></i></p>
                </div>
            </div>
            <!-- start row table -->
            <div class="row mt-3">
               <div class="col-12 mb-5">
                  <div class="promoted d-flex flex-column">
                    <img src="/images/spinner.svg" class="spinner mt-5" v-if="isloading"/>
                    <!-- start table -->
                    <table class="table is-fullwidth is-striped" v-else>
                     <thead>
                     <tr>
                         <th>#</th>
                         <th></th>
                         <th>Name</th>
                         <th class="is-hidden-mobile">Chain</th>
                         <th class="is-hidden-mobile">Symbol</th>
                         <th class="is-hidden-mobile ">Market Cap</th>
                         <th class="is-hidden-mobile">Price</th>
                         <th class="is-hidden-mobile">Launched</th>
                         <th class="is-hidden-mobile">Votes</th>
                         <th>Vote<span class="is-hidden-tablet">s</span></th>
                     </tr>
                     </thead>
                     <tbody>                      
<tr v-for="(item,index) in watchlist" :key="index">
   <td class="has-wishlist ignore">
      <span>
      {{ index+1}}
      </span>
      <div class="wishlist-button" v-show="public_link">
         <div class="wishlist-remove">
             <i class="fas fa-star"></i>
                 <i class="fas fa-times" @click="removeFromWatchlist(index,item.coin_id)"></i>    
             </div>
      </div>
   </td>
   <td class="ignore">
      <div class="flex">
         <img :src="item.coin.logo" alt="" height="24">
      </div>
   </td>
   <td>
      <b>{{ item.coin.name }}</b>
      <div class="is-hidden-tablet text-uppercase">
         ${{ item.coin.symbol }} <span class="network">{{ item.coin.network.sort_name }}</span>
         <br>
         <span class="presale" v-if="item.coin.ispresale">(Presale)</span>
      </div>
   </td>
   <td class="is-hidden-mobile"><span class="network text-uppercase">{{ item.coin.network.sort_name }}</span></td>
   <td class="is-hidden-mobile">
      {{ item.coin.symbol }}
   </td>
   <td class="is-hidden-mobile" v-if="item.coin.ispresale"><span class="presale">Presale</span></td>
   <td class="is-hidden-mobile price" v-else>{{ item.coin.marketcap!=null ? `$${item.coin.marketcap}` : `-`}}</td>
   <td class="is-hidden-mobile price" v-if="item.coin.ispresale"> - </td>
   <td class="is-hidden-mobile price" v-else>{{ item.coin.price_usd!=null ? `$${item.coin.price_usd}` : `-`}} </td>
   <td class="is-hidden-mobile">{{ item.coin.launch_on }}</td>
   <td class="is-hidden-mobile"><span class="votes">{{item.coin.votes.all}}</span></td>
   <td>
      <a :href="`/coin/${item.coin.name}-${item.coin.id}`" target="_blank" class="button is-success">
      <span class="votes is-hidden-tablet">{{item.coin.votes.all}}</span>
      <span>Vote</span>
      </a>
   </td>
</tr>               
                             </tbody>
                 </table>
                    <!-- end table -->
                  </div>
               </div>
            </div>
            <!-- end row table -->
        </div>
    </frontend-layout>
</template>
<script>
import FrontendLayout from '../../Layouts/FrontendLayout.vue'
import HeaderAds from './HeaderAds.vue'
import BaseComponentVue from '../../Layouts/BaseComponent.vue'
import ApiManager from '../API/ApiManager'
//import { usePage } from '@inertiajs/inertia-vue3'
export default {
    extends: BaseComponentVue,
    props: ['watchlist','public_link'],
  components: { FrontendLayout,HeaderAds },
    data() {
        return{
            isloading:false,
        }
    },
    created(){
        //console.log(JSON.stringify(usePage().props.value.watchlist))
    },
    methods: {
         copiedz(){
            navigator.clipboard.writeText(this.public_link);
            this.showToast('Link copied');
        },
        removeFromWatchlist(index,coinId){
            this.isloading = true
             ApiManager.postRemoveFromWatch(coinId)
            .then((response)=>{
                this.isloading=false
                this.watchlist.splice(index,1)
                this.showToast('Remove from Watchlist')
            }).catch((error)=>{
                console.log(error)
            })
        }
    },
   
}
</script>
<style scoped>
.gsdha{
    font-size: 2rem;
}
</style>   