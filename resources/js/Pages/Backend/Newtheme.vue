<template>
 <inertia-head>
    <title>{{ title }} - ok MyWebsite</title>
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
            <a id="cpage" class="navbar-left" href="javascript:void(0)">Vouchers</a>
          </div>
          <div class="navbar-right">
            <a id="logout" href="./?hotspot=logout&amp;session=PINTARMEDIA">
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
          <a href="./?report=selling&amp;idbl=oct2021&amp;session=PINTARMEDIA" class="menu ">
            <i class="nav-icon fa fa-money"></i> Laporan </a>
          <!--pelanggan-->
          <div class="dropdown-btn ">
            <i class=" fa fa-gear"></i> Pelanggan <i class="fa fa-caret-down"></i> &nbsp;
          </div>
          <div class="dropdown-container ">
            <a href="./?system=scheduler&amp;session=PINTARMEDIA" class="">
              <i class="fa fa-clock-o "></i> Daftar Pelanggan </a>
            <a href="./admin.php?id=reboot&amp;session=PINTARMEDIA" class="">
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
            <div class="dropdown-container ">
              <a href="./?hotspot=users&amp;profile=all&amp;session=PINTARMEDIA" class=""> &nbsp;&nbsp;&nbsp; <i class="fa fa-list "></i> User List </a>
              <a href="./?hotspot-user=add&amp;session=PINTARMEDIA" class=""> &nbsp;&nbsp;&nbsp; <i class="fa fa-user-plus "></i> Add User </a>
            </div>
            <!-- server -->
            <div class="dropdown-btn">
              <i class="fa fa-users"></i> Server <i class="fa fa-caret-down"></i>
            </div>
            <div class="dropdown-container ">
              <a href="./?hotspot=users&amp;profile=all&amp;session=PINTARMEDIA" class=""> &nbsp;&nbsp;&nbsp; <i class="fa fa-list "></i> Daftar Server </a>
              <a href="./?hotspot-user=add&amp;session=PINTARMEDIA" class=""> &nbsp;&nbsp;&nbsp; <i class="fa fa-user-plus "></i> Tambah Server </a>
            </div>
            <!-- jaringan -->
            <div class="dropdown-btn ">
              <i class="fa fa-users"></i> Jaringan <i class="fa fa-caret-down"></i>
            </div>
            <div class="dropdown-container ">
              <a href="./?hotspot=users&amp;profile=all&amp;session=PINTARMEDIA" class=""> &nbsp;&nbsp;&nbsp; <i class="fa fa-list "></i> Daftar Jaringan </a>
              <a href="./?hotspot-user=add&amp;session=PINTARMEDIA" class=""> &nbsp;&nbsp;&nbsp; <i class="fa fa-user-plus "></i> Tambah Jaringan </a>
            </div>
            <!-- tipe jaringan -->
            <a href="./admin.php?id=settings&amp;session=PINTARMEDIA" class="menu ">
              <i class="fa fa-gear "></i> Tipe Jaringan </a>
            <div class="dropdown-btn ">
              <i class="fa fa-users"></i> Pembayaran <i class="fa fa-caret-down"></i>
            </div>
            <div class="dropdown-container ">
              <a href="./?hotspot=users&amp;profile=all&amp;session=PINTARMEDIA" class=""> &nbsp;&nbsp;&nbsp; <i class="fa fa-list "></i> Daftar Metoda </a>
              <a href="./?hotspot-user=add&amp;session=PINTARMEDIA" class=""> &nbsp;&nbsp;&nbsp; <i class="fa fa-user-plus "></i> Tambah Metoda </a>
            </div>
          </div>
          <!--settings-->
          <a href="./?hotspot=about&amp;session=PINTARMEDIA" class="menu ">
            <i class="fa fa-gear"></i> Setting </a>
          <!--about-->
          <a href="./?hotspot=about&amp;session=PINTARMEDIA" class="menu ">
            <i class="fa fa-info-circle"></i> About </a>
        </div>
        <!-- end sidenav -->
        <!-- main -->
        <div id="main">
          <div id="loading" class="lds-dual-ring" style="display: none;"></div>
          <div class="main-container" style="">
            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h3>
                      <i class=" fa fa-users"></i> Vouchers &nbsp;&nbsp; | &nbsp;&nbsp; <i onclick="location.reload();" class="fa fa-refresh pointer" title="Reload data"></i>
                    </h3>
                  </div>
                  <div class="card-body">
                    <div class="overflow" style="max-height: 80vh">
                      <!-- content -->
                      <!-- end content -->
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- end main -->
      </div>
    </div>
</template>
<script>
//import BaseComponentVue from './BaseComponent.vue'
export default {
      //extends: BaseComponentVue,
     props: {
    title: String,
    isloader: Boolean,
  },
      created() {
          let insertMainCss = document.createElement("script");
    insertMainCss.setAttribute("src", "/js/mikhmon-ui.dark.min.js");
    document.head.appendChild(insertMainCss);
}
}
</script>
