<template>
    <div class="row">
    <div class="col-lg-6 col-md-12 text-white mt-5" v-if="ishome">
        <h1 class="text-white text-uppercase">{{ $page.props.header_title ? $page.props.header_title : 'Best Coins Today' }}</h1>
        <h5>{{ $page.props.sub_title ? $page.props.sub_title : 'Find the top voted coins of the last 24 hours' }}</h5>
    </div>
    <div class="col-lg-6 col-md-12 text-white mt-3 p-0" v-else>
        <!-- breadcrumb -->
        <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-transparent">
            <li class="breadcrumb-item"><a href="/">Home</a></li>
            <li class="breadcrumb-item"><a href="/coin">Coin</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ coins.name }}</li>
        </ol>
        </nav>
        <!-- end breadcrumb -->
    </div>
    <div class="col-lg-6 col-md-12 d-flex flex-column align-items-end" :class="{'mt-5' : ishome,'mt-3 p-0': !ishome}">
        <a href="/contact" alt="contact us">Advertise with us!</a>
        <a :href="currentAds.ads_link" target="_blank" alt="ads space"><img class="img-fluid" :src="currentAds.ads_image_url" alt="ads1" /></a>
    </div>
</div>
</template>
<script>
export default {
    props: {
        ads_data: Array,
        setting: Object,
        ishome: {
            type: Boolean,
            default: true
        },
        coins: Object,
    },
    data(){
        return {
            currentAds: this.ads_data[0],
        }
    },
    created() {
        let self = this
         //console.log('ads_data '+JSON.stringify(this.ads_data))
        setInterval(()=>{ 
            self.currentAds = self.ads_data[Math.floor(Math.random()*self.ads_data.length)];
        }, self.setting.ads_interval * 1000);    
    }

}
</script>