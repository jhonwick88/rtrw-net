<template>
    <div>
              <header id="header" class="fixed-top d-flex align-items-center">
         <div class="container d-flex align-items-center position-relative">
            <a href="/" rel="home" title="Sniper Website" class="logo d-flex me-auto align-items-center">
               <img alt="Snipper" :src="setting.site_logo" width="31" height="30">
               <p>{{ setting.site_1 }}<span>{{ setting.site_2 }}</span></p>
            </a>
            <nav class="nav-menu">
               <ul>
                  <li class="active"><a href="/"><i class='bx bx-home' ></i> Home</a></li>
                  <li class="nav-categories ">
                     <a href="#">
                        <i class='bx bx-chevron-down-circle' ></i>
                        Coins                        
                     </a>
                     <ul>
                        <li>
                           <i class='bx bx-chevrons-right' ></i>
                            <a href="/coin/filter/today" >Today's Best</a></li>
                        <li>
                            <i class='bx bx-chevrons-right' ></i>
                            <a href="/coin/filter/alltime" >All Time Best</a></li>
                        <li>
                           <i class='bx bx-chevrons-right' ></i>
                            <a href="/coin/filter/new" >New Listings</a></li>
                        <li>
                            <i class='bx bx-chevrons-right' ></i>
                            <a href="/coin/filter/marketcap" >By Marketcap</a></li>
                        <li>
                           <i class='bx bx-chevrons-right' ></i>
                            <a href="/coin/filter/presales" >Presales</a></li>
                            
                     </ul>
                  </li>
                
          
                  <li class="memberarea ">
                     <a :href="$page.props.user ? '/submit/coin' : '/login?re=/submit/coin'" class="btn btn-danger">
                        <span>Submit Coin</span>
                     </a>
                  </li>
                   <li class="nav-categories" v-if="$page.props.user">
                    <a href="#">
                       <span>{{ $page.props.user.name }}</span>
                    </a>
                 <ul>
                    <!-- <li>
                       <i class='bx bx-chevrons-right'></i>
                        <a href="/portfolio" >Portfolio</a></li> -->
                    <li>
                        <i class='bx bxs-star' ></i>
                        <a href="/watchlist" >Watchlist</a></li>
                        <li>
                            
                             <form @submit.prevent="logout">
                                <button type="submit" class="btn btn-primary">Logout</button>
                             </form>
                            </li>
                 </ul>
                 </li>
                  <li class="" v-else>
                    <a href="/login">
                       <span>Login</span>
                    </a>
                 </li>
               </ul>
            </nav>
            <div class="d-none d-xl-flex">
               <div class="search-form d-flex align-items-center">
                  <input type="text" v-model="keyword" name="q" placeholder="Search" title="Enter search keyword"> 
                  <button type="button" title="Search" @click="searchKeyword">
                     <i class='bx bx-search' ></i>
                  </button>
               </div>
            </div>
            <div class="icon icon-search search-bar-toggle d-block d-xl-none">
                <i class='bx bx-search' ></i>
            </div>
                        <a href="#" class="mobile-nav-toggle mobile-nav-show d-lg-none" title="Toggle Menu">
               <i class='bx bx-menu-alt-right' ></i>
            </a>
            <a href="#" class="mobile-nav-toggle mobile-nav-hide" title="Close Menu">
               <i class='bx bx-x'></i>
            </a>
           
         </div>
      </header>
    </div>
</template>
<script>
import Button from '../Jetstream/Button.vue';
export default {
      props:{
      setting: Object,
   },
  components: { Button },
  data(){
     keyword:''
  },
      created() {

      
       //document.getElementById("header").style.backgroundColor = "#fff";
       //document.header.style.backgroundColor = "#000";
    },
 methods: {
    logout() {
      this.$inertia.post(route('login.auth.logout'),{
         //tokenId: 44
      });
    },
    searchKeyword(){
       window.location.href = `/coin/search?q=${this.keyword}`
    }
  },
}
</script>