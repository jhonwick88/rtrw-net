<template>
<inertia-head>
    <title>{{ title }} - {{$page.props.setting_new.site_name}}</title>
</inertia-head>
    <div>
      <div class="wrapper">
        <!-- navbar -->
        <div id="navbar" class="navbar">
          <div class="navbar-left">
            <a id="brand" class="text-center" href="./?session=PINTARMEDIA">RTRWNET</a>
            <a id="openNav" class="navbar-hover" href="javascript:void(0)">
              <i class="fa fa-bars"></i>
            </a>
            <a id="closeNav" class="navbar-hover" href="javascript:void(0)">
              <i class="fa fa-bars"></i>
            </a>
            <a id="cpage" class="navbar-left" href="javascript:void(0)">{{ title }}</a>
          </div>
          <div class="navbar-right">
            <a id="logout" href="javascript:void(0)" @click="logout">
              <i class="fa fa-sign-out mr-1"></i> Logout </a>
            <select class="stheme ses text-right mr-t-10 pd-5">
              <option> Theme</option>
              <option value="/?hotspot=users-by-profile&amp;session=PINTARMEDIA&amp;set-theme=dark">Dark</option>
              <option value="/?hotspot=users-by-profile&amp;session=PINTARMEDIA&amp;set-theme=light">Light</option>
              <option value="/?hotspot=users-by-profile&amp;session=PINTARMEDIA&amp;set-theme=blue">Blue</option>
              <option value="/?hotspot=users-by-profile&amp;session=PINTARMEDIA&amp;set-theme=green">Green</option>
              <option value="/?hotspot=users-by-profile&amp;session=PINTARMEDIA&amp;set-theme=pink">Pink</option>
            </select>
            <select class="connect optfa ses text-right mr-t-10 pd-5">
              <option id="MikhmonSession" value="PINTARMEDIA">PINTARMEDIA-NET</option>
              <option value="PINTARMEDIA">PINTARMEDIA ♦</option>
            </select>
            <a title="Idle Timeout" style="display:block;">
              <span style="width:70px;" class="pd-5 radius-3">
                <i class="fa fa-clock-o mr-1"></i>
                <span class="mr-1" id="timer">9:40</span>
              </span>
            </a>
          </div>
        </div>
        <!-- end navbar -->
        <!-- sidenav -->
        <div id="sidenav" class="sidenav">
          <div class="menu text-center align-middle card-header" style="border-radius:0;">
            <h3>PAYMENTS</h3>
          </div>
          <a href="./?session=PINTARMEDIA" class="menu ">
            <i class="fa fa-dashboard"></i> Dashboard </a>
          <!--report-->
          <a :href="route('be.admin.payments')" class="menu ">
            <i class="nav-icon fa fa-money"></i> Laporan </a>
          <!--pelanggan-->
          <div class="dropdown-btn ">
            <i class=" fa fa-gear"></i> Pelanggan <i class="fa fa-caret-down"></i> &nbsp;
          </div>
          <div class="dropdown-container ">
               <jet-nav-link :href="route('be.admin.customers')" :active="route().current('be.admin.customers')" :ismenu="false">
            <i class="fa fa-clock-o "></i> Daftar Pelanggan
            </jet-nav-link>
            <a :href="route('be.admin.customers.create')" class="">
              <i class="fa fa-power-off "></i> Tambah Pelanggan </a>
          </div>
          <!--system-->
          <div class="dropdown-btn">
            <i class="fa fa-wifi"></i> Sistem <i class="fa fa-caret-down"></i>
          </div>
          <div class="dropdown-container">
            <!--users-->
            <div class="dropdown-btn">
              <i class="fa fa-users"></i> Users <i class="fa fa-caret-down"></i>
            </div>
            <div class="dropdown-container">
                <jet-nav-link :href="route('be.admin.user')" :active="route().current('be.admin.user')" :ismenu="false">
                <i class="fa fa-list "></i> User List
                </jet-nav-link>
                <jet-nav-link :href="route('be.admin.user.create')" :active="route().current('be.admin.user.create')" :ismenu="false">
                <i class="fa fa-user-plus "></i> Add user
                </jet-nav-link>

            </div>
            <!-- server -->
            <div class="dropdown-btn">
              <i class="fa fa-users"></i> Server <i class="fa fa-caret-down"></i>
            </div>
            <div class="dropdown-container ">
              <a :href="route('be.admin.servers')" class=""> &nbsp;&nbsp;&nbsp; <i class="fa fa-list "></i> Daftar Server </a>
              <a :href="route('be.admin.servers.create')" class=""> &nbsp;&nbsp;&nbsp; <i class="fa fa-user-plus "></i> Tambah Server </a>
            </div>
            <!-- jaringan -->
            <div class="dropdown-btn ">
              <i class="fa fa-users"></i> Jaringan <i class="fa fa-caret-down"></i>
            </div>
            <div class="dropdown-container ">
              <a :href="route('be.admin.networks')" class=""> &nbsp;&nbsp;&nbsp; <i class="fa fa-list "></i> Daftar Jaringan </a>
              <a :href="route('be.admin.networks.create')" class=""> &nbsp;&nbsp;&nbsp; <i class="fa fa-user-plus "></i> Tambah Jaringan </a>
            </div>
            <!-- tipe jaringan -->
            <!-- <a :href="route('be.admin.networks')" class="menu ">
              <i class="fa fa-gear "></i> Tipe Jaringan </a> -->
            <div class="dropdown-btn ">
              <i class="fa fa-users"></i> Pembayaran <i class="fa fa-caret-down"></i>
            </div>
            <div class="dropdown-container ">
              <a :href="route('be.admin.payment-methods')" class=""> &nbsp;&nbsp;&nbsp; <i class="fa fa-list "></i> Daftar Metoda </a>
              <a :href="route('be.admin.payment-methods.create')" class=""> &nbsp;&nbsp;&nbsp; <i class="fa fa-user-plus "></i> Tambah Metoda </a>
            </div>
          </div>
          <!--settings-->
           <jet-nav-link :href="route('be.admin.setting')" :active="route().current('be.admin.setting')">
              <i class="fa fa-gear"></i> Settings
            </jet-nav-link>

          <!--about-->
          <jet-nav-link :href="route('be.admin.about')" :active="route().current('be.admin.about')">
            <i class="fa fa-info-circle"></i> About
            </jet-nav-link>
        </div>
        <!-- end sidenav -->
        <!-- main -->
        <div id="main">
            <loader v-if="isloader" object="#ff9633" color1="#ffffff" color2="#17fd3d" size="5" speed="2" bg="#343a40" objectbg="#999793" opacity="80" disableScrolling="false" name="box"></loader>
          <!-- <div id="loading" class="lds-dual-ring" style="display: none;"></div> -->
          <div class="main-container" style="">
                <slot :setting="setting"></slot>
          </div>
        </div>
        <!-- end main -->
      </div>
    </div>
</template>

<script>
import BaseComponentVue from './BaseComponent.vue'
import JetNavLink from '@/Jetstream/NavLink'
import { usePage } from '@inertiajs/inertia-vue3'
export default {
  extends: BaseComponentVue,
     props: {
    title: String,
    isloader: Boolean,
  },
  components: {
      JetNavLink,
  },

  data() {
    return {
      form: {
        tokenId: 40,
      },
      setting:{},
      showingNavigationDropdown: false,
    }
  },
    created() {
           let insertMainCss = document.createElement("script");
    insertMainCss.setAttribute("src", "/js/mikhmon-ui.dark.min.js");
     let insertMainCss2 = document.createElement("script");
    insertMainCss2.setAttribute("src", "/js/mikhmon.js");

    document.head.appendChild(insertMainCss);
    document.head.appendChild(insertMainCss2);
       this.resultConfig(usePage().props.value.settings)

  },
  methods: {
    switchToTeam(team) {
      this.$inertia.put(route('current-team.update'), {
        'team_id': team.id
      }, {
        preserveState: false
      })
    },
     resultConfig: function(data){
          const result = data.reduce(
              (accumulator, target) => ({ ...accumulator, [target.key]: target.value }),
              {});
              let site_names = result.site_name.split(" ")
              this.setting = Object.assign(result,{'site_1': site_names[0],'site_2': site_names[1]})
             //console.log('Settings '+JSON.stringify(this.setting))
      },

    logout() {
      //console.log("testtt")
       this.$inertia.post(route('logout'));
    },
  },

  computed: {
    path() {
      return window.location.pathname
    }
  }
}
</script>
>
