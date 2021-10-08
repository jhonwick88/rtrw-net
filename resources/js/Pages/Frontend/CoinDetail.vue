<template>
    <frontend-layout :isloader="isloading" :title="$page.props.appname">
        <div class="container">
            <!-- ads -->
            <header-ads :ads_data="$page.props.ads_detail" :setting="$page.props.setting_new" :ishome="false" :coins="coins"></header-ads>
            <!-- end ads -->
            <!-- start content detail -->
            <div class="row cardxf mt-4 p-3">
                <div class="col-md-12 text-white" :class="{ 'col-lg-6' : coins.twitter_link , 'col-lg-8' : !coins.twitter_link}">
                    <div class="d-flex">
                        <div class="img-logo">
                        <img class="img-fluid xsea" :src="coins.logo" alt="coin-logo"/>
                        </div>
                        <div class="content-header d-flex flex-column">
                            <div class="p-2 d-flex">
                                <h2 class="text-white">{{ coins.name }}</h2>
                                <div class="p-2 ml-2 rounded bg-dark text-white text-uppercase">${{coins.symbol}}</div>
                              <!-- <img src="" alt="small-logo" /> -->
                                <div class="starxs" @click="removeFromwatch" role="button" v-if="isOnWatchlist"><i class='bx bxs-star'></i></div>
                                <div class="starxs" @click="$page.props.user ? addTowatch() : goLogin()" role="button" v-else><i class='bx bx-star'></i></div>
                            </div>
                            <div class="d-flex" v-if="coins.ispresale">
                                <div class="p-2"><span class="p-2 badge badge-pill badge-warning mr-2">Presale</span>This project is in presale phase. Contract announced later.</div>
                            </div>
                            <div class="p-2 d-flex" v-else>
                                <div style="font-size:14px;"> 
                                BSC Contract Address: <strong>{{ coins.contract_address}}</strong>
                                </div>
                                <i class='bx bxs-copy bx-rotate-90' role="button" @click="copied"></i>
                            </div>
                        </div>
                       
                    </div>
                    <!-- status -->
                    <div class="d-flex justify-content-center fgsts">
                        <div class="p-2"><small>Status: </small><span class="p-2 badge badge-pill badge-success">{{coins.status_label}}</span></div>
                        <div class="p-2"><small>Votes for listing: </small><span class="p-2 badge badge-pill badge-success">{{coins.votes.all}}/500</span></div>
                        <div class="p-2"><small>Votes: </small><span class="p-2 badge badge-pill badge-dark">{{coins.votes.all}}</span></div>
                        <div class="p-2"><small>Votes Today: </small><span class="p-2 badge badge-pill badge-info">{{coins.votes.today}}</span></div>
                        <div class="p-2"><small>Network: </small><span class="p-2 badge badge-pill badge-secondary text-uppercase">{{coins.network.sort_name}}</span></div>
                    </div>
                    <!-- end status -->
                     <!-- start desc -->
                        <div class="content-body pt-3 pb-3">
                            {{coins.description}}
                        </div>
                        <!-- end desc -->
                        <div class="sjdhga">
                        <div class="font-weight-bold mt-3">Vote for {{coins.name}}</div>
                        <p>Vote for {{coins.name}} to increase its rank!</p>
                        <a :href="`/login?re=/coin/${coins.name}-${coins.id}`" class="btn btn-block btn-primary rounded text-uppercase" v-show="!$page.props.user">PLEASE LOGIN TO VOTE</a>
                        <div class="row" v-show="$page.props.user">
                            <div class="col-lg-6 col-md-12 col-sm-12">
                                  <vue-recaptcha v-if="showRecaptcha" class="mb-3" :siteKey="setting.google_captcha"
                            size="normal" 
                            theme="light"
                            :tabindex="0"
                            @verify="recaptchaVerified"
                            @expire="recaptchaExpired"
                            @fail="recaptchaFailed"
                            ref="vueRecaptcha">
                            </vue-recaptcha>
                            </div>
                            <div class="col-lg-6 col-md-12 col-sm-12">
                                <button class="btn btn-block p-4 btn-success rounded text-uppercase" :disabled="!isrecapt" @click="addToVote">{{isrecapt ? `Vote Now For ${coins.name}` : `Please Solve Captcha...`}}</button>
                            </div>
                        </div>
                        <div class="pb-3">You can vote once every 24 hours.</div>
                        </div>
                        <span class="font-italic">Information incorrect? Please report it to info@mycoint.net</span>

                </div>
                <!-- start right -->
                <div class="col text-white">
                     <vue-countdown :time="timer" @end="onCountdownEnd" v-slot="{ days, hours, minutes, seconds }">
         <div id="countdown" class="text-center bg-dark p-2 rounded-lg" :class="{'countdown-gradient' : !isTimeEnd }">
             <h4 class="mt-2">{{ textTitle }}</h4>
             <span>{{launchIn}}</span>
    <ul class="mt-2">
      <li><span id="days">{{ days }}</span>Days</li>
      <li><span id="hours">{{ hours }}</span>Hours</li>
      <li><span id="minutes">{{ minutes }}</span>Minutes</li>
      <li><span id="seconds">{{ seconds }}</span>Seconds</li>
    </ul>
  </div>
  </vue-countdown>

                    <table class="table">
                                                                <tbody><tr class="is-hidden-mobile">
                                    <th colspan="2">Popularity</th>
                                </tr>
                                <tr class="is-hidden-mobile">
                                    <td>Watchlists</td>
                                    <td>
                                        <i class="fa fa-star" style="color: gold;"></i> On
                                        <span class="watchlist-counter">{{ watchlist.length }}</span>
                                        watchlists
                                    </td>
                                </tr>
                                                                <tr>
                                    <th colspan="2">Links</th>
                                </tr>
                                <tr>
                                    <td>Website</td>
                                    <td>
                                        <i class="fa fa-globe"></i>&nbsp;
                                        <a :href="coins.website_link" target="_blank">Visit Website</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Telegram</td>
                                    <td>
                                        <i class="fab fa-telegram"></i>&nbsp;
                                        <a :href="coins.telegram_link" target="_blank">Join Telegram</a>
                                    </td>
                                </tr>
                                                                    <tr>
                                        <td>Twitter</td>
                                        <td>
                                            <i class="fab fa-twitter"></i>&nbsp;
                                            <a :href="coins.twitter_link" target="_blank">Follow Twitter</a>
                                        </td>
                                    </tr>
                                                                                                    <tr>
                                        <td>Discord</td>
                                        <td>
                                            <i class="fab fa-discord"></i>&nbsp;
                                            <a :href="coins.discord_link" target="_blank">Join Discord</a>
                                        </td>
                                    </tr>
                                
                                                                    <tr>
                                        <th colspan="2">Price</th>
                                    </tr>
                                                                            <tr>
                                            <td>Marketcap</td>
                                            <td class="price">{{ coins.marketcap!=null ? '$ '+coins.marketcap : `-`}}</td>
                                        </tr>
                                        <tr>
                                            <td>Price (USD)</td>
                                            <td class="price is-hidden-tablet">{{ coins.price_usd!=null ? '$ '+coins.price_usd : `-`}}</td>
                                            <td class="price is-hidden-mobile">{{ coins.price_usd!=null ? '$ '+coins.price_usd : `-`}}</td>
                                        </tr>
                                        <tr>
                                            <td>Price (BNB)</td>
                                            <td class="price">{{ coins.price_bnb!=null ? coins.price_bnb+' BNB' : `-`}}</td>
                                        </tr>
                                                                        <tr>
                                        <th colspan="2">Charts / Swap</th>
                                    </tr>
                                                                                                                <!-- <tr>
                                            <td>CoinGecko</td>
                                            <td>
                                                <a href="https://www.coingecko.com/en/coins/bimp-finance" target="_blank">
                                                    <img src="/assets/img/cg.png" alt="">
                                                    CoinGecko
                                                </a>
                                            </td>
                                        </tr> -->
                                                                                                                                                        <tr>
                                            <td>Poocoin</td>
                                            <td>
                                                <i class="fas fa-poo"></i>&nbsp;
                                                <a :href="`https://poocoin.app/tokens/${coins.contract_address}`" target="_blank">
                                                    Poocoin.app
                                                </a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Bogged</td>
                                            <td>
                                                <i class="fas fa-eye"></i>&nbsp;
                                                <a :href="`https://charts.bogged.finance/?token=${coins.contract_address}`" target="_blank">
                                                    Bogged.Finance
                                                </a>
                                            </td>
                                        </tr>
                                                                                                                                    <tr>
                                                    <td>Buy Now</td>
                                                    <td>
                                                        <a :href="`https://exchange.pancakeswap.finance/#/swap?outputCurrency=${coins.contract_address}`" target="_blank">
                                                            Buy On PancakeSwap
                                                        </a>
                                                    </td>
                                                </tr>
                                                                                                                                                <tr>
                                    <th colspan="2">Information</th>
                                </tr>
                                <tr>
                                    <td>Added</td>
                                    <td>{{coins.added}}</td>
                                </tr>
                                <tr>
                                    <td>Launch</td>
                                    <td>{{coins.launch_on}}</td>
                                </tr>
                            </tbody></table>
                </div>
                <!-- end right -->
                <!-- start col tweet -->
                <div class="col-lg-3 col-md-12 text-white" v-if="coins.twitter_link">
                        <!-- tweets -->
                        <div class="tweets">
                        <a class="twitter-timeline"
  :href="coins.twitter_link"
    data-width="100%" 
    data-theme="dark"
  data-height="875">
Tweets by @{{ coins.twitter_link.split('.com/')[1] }}
</a>
                        </div>
                        <!-- end tweets -->
                </div>
                <!-- end col tweet -->
            </div>
            <!-- end contain detail -->
            <!-- start promotions -->
            <promotion-table :promotions="promotions" :needheader="true"></promotion-table>
            <!-- end promotions -->
        </div>
    </frontend-layout>
</template>
<script>
import FrontendLayout from '../../Layouts/FrontendLayout.vue'
import vueRecaptcha from 'vue3-recaptcha2'
import ApiManager from '../API/ApiManager'
import { usePage } from '@inertiajs/inertia-vue3'
import PromotionTable from '../Frontend/PromotionTable.vue'
import BaseComponentVue from '../../Layouts/BaseComponent.vue'
import HeaderAds from '../Frontend/HeaderAds.vue'
import VueCountdown from './Coundown'
// import { onMounted } from 'vue'

export default {
    extends: BaseComponentVue,
  props:['coins','watchlist'],
  components: { 
      FrontendLayout,
      vueRecaptcha,
      PromotionTable,
      VueCountdown,
      HeaderAds,
      },
  data(){
      const now = new Date();
      const launch = new Date(this.coins.launch_at.split(' ')[0]);
      return{
          isloading:false,
          isrecapt:false,
          showRecaptcha:true,
          isOnWatchlist:false,
          promotions:[],
          timer: launch - now,
          launchIn: launch.toString().split('(')[0],
          textTitle: 'Launch In',
          isTimeEnd: false,
          setting:{},
      }
  },
  created(){
      this.CheckWatchlist()
      this.getPromotionsList('alltime')
          let twitterFeed = document.createElement("script");
    twitterFeed.setAttribute("src", "https://platform.twitter.com/widgets.js");
    document.head.appendChild(twitterFeed);
    this.setting = JSON.parse(localStorage.getItem('setting')) 
  },
  methods: {
       recaptchaVerified(response) {
         this.isrecapt = true
	},
    onCountdownEnd(){
        this.textTitle = 'Launched'
        this.isTimeEnd = true
    },
    addTowatch(){
        this.isloading = true
        ApiManager.postAddToWatch(this.coins.id)
        .then((response)=>{
            this.isloading=false
            this.isOnWatchlist=true
            this.showToast('Added to Watchlist')

        }).catch((error)=>{
            console.log(error)
        })
    },
    addToVote(){
        this.isloading = true
        ApiManager.postAddToVote(this.coins.id)
        .then((response)=>{
            this.isloading=false
            this.showToast(response.data.message)
        }).catch((error)=>{
            console.log(error)
            this.isloading=false
            
        })
    },
    removeFromwatch(){
         ApiManager.postRemoveFromWatch(this.coins.id)
        .then((response)=>{
            this.isloading=false
            this.isOnWatchlist=false
            this.showToast('Remove from Watchlist')

        }).catch((error)=>{
            console.log(error)
        })
    },
    copied(){
        navigator.clipboard.writeText(this.coins.contract_address);
        this.showToast('Contract Address Copied!')
    },
    CheckWatchlist(){
        //console.log('check is on watchlist')
        let that = this
        if(usePage().props.value.user){
            if(this.watchlist!=null)
            this.watchlist.forEach((item,index)=>{
                if(item.user_id == usePage().props.value.user.id && item.coin_id == this.coins.id){
                    that.isOnWatchlist = true
                }
            })
        }
    },
    goLogin(){
        window.location.href=`/login?re=/coin/${this.coins.name}-${this.coins.id}`
    },
	recaptchaExpired() {
	  this.$refs.vueRecaptcha.reset();
       this.isloading = false
      this.isrecapt = false
	},
	recaptchaFailed() {
         this.isloading = false
        this.isrecapt = false
	},
    getPromotionsList(filter){
        this.isloading = true
        ApiManager.getPromoted(filter)
            .then((response) => {
                this.isloading = false
                this.promotions = response.data.data
        })
    .catch((error) => {
        console.log(error);
    });
},
  }
    // setup() {
    //     const state = usePage().props.value
    //     const getState = () => {
    //         console.log('staess '+ JSON.stringify(state))
    //     }
    //     onMounted(
    //         getState,
    //     )

    //     return {
    //         state,
    //     }
    // },
}
</script>
<style scoped>
#countdown li {
  display: inline-block;
  font-size: 0.6em;
  list-style-type: none;
  padding: 1.3em;
  text-transform: uppercase;
}
.countdown-gradient {
    background: linear-gradient(to right bottom,#681d77 0,#851876 21.35%,#b20e73 63.02%,#dd0071 86.98%);
        background-color: rgba(0, 0, 0, 0);
}

#countdown span{
    font-size: 12px;
}
#countdown li span {
  display: block;
  font-size: 1.2rem;
  font-weight: 800;
}

.cardxf{
   background-color: #111621;
   border-radius: 0.475rem;
   border: 0;
}
.fgsts, .sjdhga{
    border-top: 1px solid;
    border-bottom: 1px solid;
    margin: 16px 0px;
}
.hjshd{
    width: 100%;
    padding-left: 1rem;
}
.xsea{
    max-width: 100px;
    max-height: 100px;
}
.starxs{
color: gold;
font-size: 2rem;
margin-left: 1rem;
}
@media all and (max-width: 768px) {
#countdown h1 {
    font-size: 1.5rem;
  }
  
#countdown li {
    font-size: 0.7rem;
    padding: .75rem;
  }
  
#countdown li span {
    font-size: 1.375rem;
  }
}
</style>
