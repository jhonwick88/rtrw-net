<template>
<inertia-head>
    <title>{{ title }} - {{$page.props.setting_new.site_name}}</title>
</inertia-head>
    <div>
      <div class="wrapper">
        <!-- navbar -->
        <div id="navbar" class="navbar">
          <div class="navbar-left">
            <a id="brand" class="text-center" href="/admin">RTRWNET</a>
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
            <!-- <select class="stheme ses text-right mr-t-10 pd-5">
              <option> Theme</option>
              <option value="/?hotspot=users-by-profile&amp;session=PINTARMEDIA&amp;set-theme=dark">Dark</option>
              <option value="/?hotspot=users-by-profile&amp;session=PINTARMEDIA&amp;set-theme=light">Light</option>
              <option value="/?hotspot=users-by-profile&amp;session=PINTARMEDIA&amp;set-theme=blue">Blue</option>
              <option value="/?hotspot=users-by-profile&amp;session=PINTARMEDIA&amp;set-theme=green">Green</option>
              <option value="/?hotspot=users-by-profile&amp;session=PINTARMEDIA&amp;set-theme=pink">Pink</option>
            </select> -->
            <select class="connect optfa ses text-right mr-t-10 pd-5" disabled>
              <option :value="setting.site_name">{{ setting.site_name }}</option>
            </select>
            <a title="Idle Timeout" style="display:block;">
              <span style="width:70px;" class="pd-5 radius-3">
                <i class="fa fa-clock-o mr-1"></i>
                <span class="mr-1" id="timer"> &nbsp;{{ currentTime.timer }}</span>
              </span>
            </a>
          </div>
        </div>
        <!-- end navbar -->
        <!-- sidenav -->
        <div id="sidenav" class="sidenav" v-if="this.$page.props.isAdmin">
          <div class="menu text-center align-middle card-header" style="border-radius:0;">
            <h3>PAYMENTS</h3>
          </div>
          <jet-nav-link :href="route('be.admin.dashboard')" :active="route().current('be.admin.dashboard')">
            <i class="fa fa-dashboard"></i> Dashboard </jet-nav-link>
          <!--report-->
          <jet-nav-link :href="route('be.admin.payments')" :active="route().current('be.admin.dashboard')">
            <i class="nav-icon fa fa-money"></i> Laporan </jet-nav-link>
          <!--pelanggan-->
          <div class="dropdown-btn ">
            <i class="fa fa-user"></i> Pelanggan <i class="fa fa-caret-down"></i> &nbsp;
          </div>
          <div class="dropdown-container " :class="{'menu-open': route().current('be.admin.customers*')}">
               <jet-nav-link :href="route('be.admin.customers')" :active="route().current('be.admin.customers')" :ismenu="false">
            <i class="fa fa-list"></i> Daftar Pelanggan
            </jet-nav-link>
            <jet-nav-link :href="route('be.admin.customers.create')" :active="route().current('be.admin.customers.create')" :ismenu="false">
              <i class="fa fa-user-plus"></i> Tambah Pelanggan </jet-nav-link>
          </div>
          <!--system-->
          <div class="dropdown-btn">
            <i class="fa fa-wifi"></i> Sistem <i class="fa fa-caret-down"></i>
          </div>
          <div class="dropdown-container" :class="{'menu-open': checkCurrentRoute()}">
            <!--users-->
            <div class="dropdown-btn">
              <i class="fa fa-users"></i> Users <i class="fa fa-caret-down"></i>
            </div>
            <div class="dropdown-container" :class="{'menu-open': route().current('be.admin.user*')}">
                <jet-nav-link :href="route('be.admin.user')" :active="route().current('be.admin.user')" :ismenu="false">
                &nbsp;&nbsp;&nbsp;<i class="fa fa-list "></i> User List
                </jet-nav-link>
                <jet-nav-link :href="route('be.admin.user.create')" :active="route().current('be.admin.user.create')" :ismenu="false">
                &nbsp;&nbsp;&nbsp;<i class="fa fa-user-plus "></i> Add user
                </jet-nav-link>

            </div>
            <!-- server -->
            <div class="dropdown-btn">
              <i class="fa fa-users"></i> Server <i class="fa fa-caret-down"></i>
            </div>
            <div class="dropdown-container" :class="{'menu-open': route().current('be.admin.servers*')}">
                <jet-nav-link :href="route('be.admin.servers')" :active="route().current('be.admin.servers')" :ismenu="false">
             &nbsp;&nbsp;&nbsp; <i class="fa fa-list "></i> Daftar Server </jet-nav-link>
             <jet-nav-link :href="route('be.admin.servers.create')" :active="route().current('be.admin.servers.create')" :ismenu="false">
              &nbsp;&nbsp;&nbsp; <i class="fa fa-user-plus "></i> Tambah Server </jet-nav-link>

            </div>
            <!-- jaringan -->
            <div class="dropdown-btn ">
              <i class="fa fa-users"></i> Jaringan <i class="fa fa-caret-down"></i>
            </div>
            <div class="dropdown-container" :class="{'menu-open': route().current('be.admin.networks*')}">
                  <jet-nav-link :href="route('be.admin.networks')" :active="route().current('be.admin.networks')" :ismenu="false">
                  &nbsp;&nbsp;&nbsp; <i class="fa fa-list "></i> Daftar Jaringan </jet-nav-link>
                  <jet-nav-link :href="route('be.admin.networks.create')" :active="route().current('be.admin.networks.create')" :ismenu="false">
                  &nbsp;&nbsp;&nbsp; <i class="fa fa-user-plus "></i> Tambah Jaringan </jet-nav-link>
            </div>
            <!-- tipe jaringan -->
            <!-- <a :href="route('be.admin.networks')" class="menu ">
              <i class="fa fa-gear "></i> Tipe Jaringan </a> -->
            <div class="dropdown-btn ">
              <i class="fa fa-users"></i> Metoda Bayar <i class="fa fa-caret-down"></i>
            </div>
            <div class="dropdown-container" :class="{'menu-open': route().current('be.admin.payment-methods*')}">
                  <jet-nav-link :href="route('be.admin.payment-methods')" :active="route().current('be.admin.payment-methods')" :ismenu="false">
                  &nbsp;&nbsp;&nbsp; <i class="fa fa-list "></i> Daftar Metoda </jet-nav-link>
                  <jet-nav-link :href="route('be.admin.payment-methods.create')" :active="route().current('be.admin.payment-methods.create')" :ismenu="false">
                  &nbsp;&nbsp;&nbsp; <i class="fa fa-user-plus "></i> Tambah Metoda </jet-nav-link>
            </div>
          </div>
          <!--settings-->
           <jet-nav-link :href="route('be.admin.setting')" :active="route().current('be.admin.setting')">
              <i class="fa fa-gear"></i> Settings
            </jet-nav-link>

          <!--about-->
          <jet-nav-link :href="route('be.admin.about')" :active="route().current('be.admin.about')">
            <i class="fa fa-info-circle"></i> About
            <!-- {{ $page.props.user.roles[0].title  }} -->
            </jet-nav-link>
        </div>
        <!-- end sidenav -->
        <!-- start user -->
         <div id="sidenav" class="sidenav" v-else>
          <div class="menu text-center align-middle card-header" style="border-radius:0;">
            <h3>PAYMENTS</h3>
          </div>
             <jet-nav-link :href="route('be.admin.payments')" :active="route().current('be.admin.dashboard')">
            <i class="nav-icon fa fa-money"></i> Laporan </jet-nav-link>
         </div>
        <!-- end user -->
        <!-- main -->
        <div id="main">
            <loader v-if="isloader" object="#ff9633" color1="#ffffff" color2="#17fd3d" size="5" speed="2" bg="#343a40" objectbg="#999793" opacity="80" disableScrolling="false" name="box"></loader>
          <!-- <div id="loading" class="lds-dual-ring" style="display: none;"></div> -->
          <div class="main-container" style="">
                <slot :setting="setting" :currentTime="currentTime"></slot>
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
import moment from 'moment'

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
      currentTime: null,
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
       this.currentTime = {
           timer:moment().format("LTS"),
           dateView:moment().format('DD-MM-YYYY h:mm:ss A')
       }

    setInterval(() => this.updateCurrentTime(), 1 * 1000);
    //console.log('Settings '+JSON.stringify(this.$page.props))

  },
  methods: {
      updateCurrentTime() {
      this.currentTime = {
           timer:moment().format("LTS"),
           dateView:moment().format('DD-MM-YYYY h:mm:ss A')
      }
    },
    switchToTeam(team) {
      this.$inertia.put(route('current-team.update'), {
        'team_id': team.id
      }, {
        preserveState: false
      })
    },
    isAdmin(){
       // return this.$page.props.user.roles[0].title == 'Admin'
    },
    checkCurrentRoute(){
        let active = false
        if(route().current('be.admin.user*')||
        route().current('be.admin.servers*')||
        route().current('be.admin.networks*')||
        route().current('be.admin.payment-methods*'))
        {
            active = true
        }
        return active
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
