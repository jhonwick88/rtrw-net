<template>
    <div>
              <footer id="footer">
         <div class="footer-top">
            <div class="container">
               <div class="row">
                  <div class="col-xl-4 col-lg-4 col-md-6 footer-about">
                     <a href="https://mydomain.com/" rel="home" title="Free Bootstrap Themes and Website Templates" class="logo d-flex align-items-center">
                        <img alt="my Logo" :src="setting.site_logo" width="31" height="30">                         
                        <p>{{ setting.site_1 }}<span>{{ setting.site_2 }}</span></p>
                     </a>
                     <p class="description"> {{ setting.site_description }}</p>
                     <div class="social-links d-flex mt-3">
                        <a :href="setting.twitter_url" target="_blank" title="Follow us on Twitter" rel="nofollow external noopener noreferrer">
                           <i class='bx bxl-twitter' ></i>
                        </a>
                        <a :href="setting.facebook_url" target="_blank" title="Follow us on Facebook" rel="nofollow external noopener noreferrer">
                            <i class='bx bxl-facebook' ></i>
                        </a>
                        <a :href="setting.telegram_url" target="_blank" title="Telegram" rel="nofollow external noopener noreferrer">
                           <i class='bx bxl-telegram' ></i>
                        </a>
                        <a :href="setting.whatsapp_url" title="Whatsapp App" target="_blank" rel="nofollow external noopener noreferrer">
                          <i class='bx bxl-whatsapp' ></i>
                        </a>
                     </div>
                  </div>
                  <div class="col-xl-4 col-lg-4 col-md-6">
                     <h3>Company</h3>
                     <nav class="footer-nav">
                        <ul>
                           <li>
<i class='bx bxs-chevron-right' ></i>
                              <a href="/about">About</a>
                           </li>
                           <li>
 <i class='bx bxs-chevron-right' ></i>
                              <a href="/contact">Advertise</a>
                           </li>
                           <li>
<i class='bx bxs-chevron-right' ></i>
                              <a href="/terms-of-service">Terms of service</a>
                           </li>
                           <li>
<i class='bx bxs-chevron-right' ></i>
                              <a href="/privacy-policy">Privacy policy</a>
                           </li>
                        </ul>
                     </nav>
                  </div>
                  <div class="col-xl-4 col-lg-4 col-md-6">
                     <h3>Help &amp Resources</h3>
                     <nav class="footer-nav">
                        <ul>
                           <li>
<i class='bx bxs-chevron-right' ></i>
                              <a href="/coin/filter/alltime">All time rangking</a>
                           </li>
                           <li>
<i class='bx bxs-chevron-right' ></i>
                              <a href="/coin/filter/today">Daily Rangking</a>
                           </li>
                           <li>
<i class='bx bxs-chevron-right' ></i>
                              <a href="/coin/filter/new">New Listing</a>
                           </li>
                           <li>
<i class='bx bxs-chevron-right' ></i>
                              <a href="/submit/coin">Submit Coin</a>
                           </li>
                        </ul>
                     </nav>
                  </div>
               </div>
            </div>
         </div>
         <div class="container">
            <div class="copyright text-center"> Copyright &copy; 2021 <a href="#">{{ setting.company_name }}</a></div>
         </div>
      </footer>
      <div title="Search" class="search-bar">
         <div class="container">
            <div class="row justify-content-center">
               <div class="col-lg-6">
                  <div class="search-form d-flex align-items-center">
                     <input type="text" value="" name="q" placeholder="Search" title="Enter search keyword"> 
                     <button type="submit" title="Search">
                                   
                <i class='icon icon-search bx bx-search' ></i>
           
                     </button>
                  </div>
               </div>
            
            </div>
         </div>
      </div>
      
      <a href="#" class="back-to-top text-white" title="Back to top">
         <i class='bx bxs-chevron-up' ></i>
      </a>
    </div>
</template>
<script>

export default {
   props:{
      setting: Object,
   }
   //  data() {
   //      return{
   //         setting:{},
   //         sitenames:[],
   //      }
   //  },
   //  created() {
   //     this.resultConfig(usePage().props.value.settings)
     
   //  },
   //  methods: {
   //    resultConfig: function(data){
   //        const result = data.reduce(
   //            (accumulator, target) => ({ ...accumulator, [target.key]: target.value }),
   //            {});
   //            this.setting = result;
   //            this.sitenames = this.setting.site_name.split(" ");
   //             console.log('Settings '+JSON.stringify(this.sitenames[0]))  
   //    },
   //  }
}
</script>