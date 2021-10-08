<template>
    <frontend-layout :isloader="isloading" :title="$page.props.appname">
        <div class="container">
            <header-ads :ads_data="$page.props.ads_home" :setting="$page.props.setting_new"></header-ads>
            <div class="d-flex justify-content-between align-items-end text-white mt-3 mb-3">
                <h3 class="text-white">Welcome, {{user.name}}</h3>
                <form @submit.prevent="logout">
                    <button type="submit" class="btn btn-danger">Logout</button>
                </form>
            </div>
            <div class="row mb-3">
                <div class="col-lg-4 col-md-12 col-sm-12">
                   
                        <!-- start -->
                        <div class="has-balance text-white">
                            <h3 class="text-white">Current Balance</h3>
                            <div class="balance">$ 0.00 <span class="bnb">~0.00 BNB</span></div>

                            <div class="is-hidden">
                                <div class="chart">
                                    Chart
                                </div>

                                <div class="buttons">
                                    <button class="button is-active">24h</button>
                                    <button class="button">7d</button>
                                    <button class="button">30d</button>
                                    <button class="button">90d</button>
                                    <button class="button">All</button>
                                </div>
                            </div>

                            <div class="assets is-hidden-mobile">
                                <h4 class="mt-4 text-white">Tracking Assets</h4>
                                <p class="small">Please select the coins you would like to track. The coin must be
                                    listed at CoinSniper.</p>

                                <div class="field has-search">
                                    <div class="control">
                                        <input class="input form-control" type="text" placeholder="Search coins to add them...">
                                    </div>

                                    <div class="results is-hidden">

                                    </div>
                                </div>

                                <div class="asset-list">
                                                                    </div>
                            </div>
                        </div>
                        <!-- end -->
                   
                </div>
                <div class="col-lg-8 col-md-12 col-sm-12">
                    <!-- assets -->
                    <div class="has-assets">

                            <div class="assets-title">
                                <h2 class="text-white">Your Assets</h2>
                                <div class="d-flex justify-content-between mb-3">
                                     <span class="adfaff">
                                        0x8855cfba493d8a22f924a5ce1b06efbcea68ffec
                                    </span>
                                    <form action="/portfolio/reset" method="POST" class="reset-pf-form ml-3">
                                        <input type="hidden" name="_token" value="KzZTowCyzUXA4eY8M5CkZClQjU9nVmwRNG7PFG1f">                                        
                                        <input type="submit" value="Reset Portfolio" class="btn btn-warning">
                                    </form>
                                   
                                </div>
                            </div>

                            <table class="table is-fullwidth">
                                <tbody><tr>
                                    <th>Name</th>
                                    <th>Price</th>
                                    <th>Holdings</th>
                                    <th>Value</th>
                                    <th>Value</th>
                                </tr>

                                
                            </tbody></table>
                        </div>
                    <!-- end assets -->
                </div>
            </div>
        </div>
    </frontend-layout>
</template>
<script>
import FrontendLayout from '../../Layouts/FrontendLayout.vue'
import BaseComponentVue from '../../Layouts/BaseComponent.vue'
import HeaderAds from './HeaderAds.vue'
export default {
    extends: BaseComponentVue,
    props:['user'],
    components: {
        FrontendLayout,
        HeaderAds,
        },
    data(){
        return {
            isloading:false,
        }
    },
    methods: {
            logout() {
      this.$inertia.post(route('login.auth.logout'),{
         //tokenId: 44
      });
    },
    }

}
</script>
<style scoped>

.has-assets,.has-balance {
    padding: 2rem;
    background: #111621;
    border-radius: 10px;
}
.adfaff{
    font-size: 1.5rem;
    color: #fff;
    font-style: italic;
}
.has-balance .balance {
    font-size: 1.5rem;
    font-weight: bold;
    display: flex;
}
.bnb{
    border-radius: 16px;
background-color: #1F2634;
padding: 4px 8px;
margin-left: 1.5rem;
}
</style>