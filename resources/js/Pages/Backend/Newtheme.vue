<template>
 <inertia-head>
    <title>{{ title }} - MyWebsite</title>
</inertia-head>
    <div>
        <div class="wrapper">
            <!-- navbar -->
            <div id="navbar" class="navbar">
  <div class="navbar-left">
    <a id="brand" class="text-center" href="./?session=PINTARMEDIA">RTRWNET</a>

<a id="openNav" class="navbar-hover" href="javascript:void(0)"><i class="fa fa-bars"></i></a>
<a id="closeNav" class="navbar-hover" href="javascript:void(0)"><i class="fa fa-bars"></i></a>
<a id="cpage" class="navbar-left" href="javascript:void(0)">Vouchers</a>
</div>
 <div class="navbar-right">
  <a id="logout" href="./?hotspot=logout&amp;session=PINTARMEDIA"><i class="fa fa-sign-out mr-1"></i> Logout</a>
  <select class="stheme ses text-right mr-t-10 pd-5">
    <option> Theme</option>
    <option value="/?hotspot=users-by-profile&amp;session=PINTARMEDIA&amp;set-theme=dark">Dark</option><option value="/?hotspot=users-by-profile&amp;session=PINTARMEDIA&amp;set-theme=light">Light</option><option value="/?hotspot=users-by-profile&amp;session=PINTARMEDIA&amp;set-theme=blue">Blue</option><option value="/?hotspot=users-by-profile&amp;session=PINTARMEDIA&amp;set-theme=green">Green</option><option value="/?hotspot=users-by-profile&amp;session=PINTARMEDIA&amp;set-theme=pink">Pink</option>  </select>
  <select class="connect optfa ses text-right mr-t-10 pd-5">
    <option id="MikhmonSession" value="PINTARMEDIA">PINTARMEDIA-NET</option>
      <option value="PINTARMEDIA">PINTARMEDIA ♦</option>
  </select>
  <a title="Idle Timeout" style="display:block;"><span style="width:70px;" class="pd-5 radius-3"><i class="fa fa-clock-o mr-1"></i>  <span class="mr-1" id="timer">9:40</span></span></a>
</div>
</div>
            <!-- end navbar -->
            <!-- sidenav -->
            <div id="sidenav" class="sidenav">
  <div class="menu text-center align-middle card-header" style="border-radius:0;"><h3>PAYMENTS</h3></div>
  <a href="./?session=PINTARMEDIA" class="menu "><i class="fa fa-dashboard"></i> Dashboard</a>
   <!--report-->
  <a href="./?report=selling&amp;idbl=oct2021&amp;session=PINTARMEDIA" class="menu "><i class="nav-icon fa fa-money"></i> Laporan</a>
  <!--pelanggan-->
  <div class="dropdown-btn "><i class=" fa fa-gear"></i> Pelanggan    <i class="fa fa-caret-down"></i> &nbsp;
  </div>
  <div class="dropdown-container ">
    <a href="./?system=scheduler&amp;session=PINTARMEDIA" class=""> <i class="fa fa-clock-o "></i> Daftar Pelanggan </a>
    <a href="./admin.php?id=reboot&amp;session=PINTARMEDIA" class=""> <i class="fa fa-power-off "></i> Tambah Pelanggan </a>
  </div>
<!--system-->
  <div class="dropdown-btn"><i class="fa fa-wifi"></i> Sistem
    <i class="fa fa-caret-down"></i>
  </div>
  <div class="dropdown-container">
   <!--users-->
  <div class="dropdown-btn"><i class="fa fa-users"></i> Users    <i class="fa fa-caret-down"></i>
  </div>
  <div class="dropdown-container ">
    <a href="./?hotspot=users&amp;profile=all&amp;session=PINTARMEDIA" class=""> &nbsp;&nbsp;&nbsp;<i class="fa fa-list "></i> User List </a>
    <a href="./?hotspot-user=add&amp;session=PINTARMEDIA" class=""> &nbsp;&nbsp;&nbsp;<i class="fa fa-user-plus "></i> Add User </a>
  </div>
  <!-- server -->
    <div class="dropdown-btn"><i class="fa fa-users"></i> Server    <i class="fa fa-caret-down"></i>
  </div>
  <div class="dropdown-container ">
    <a href="./?hotspot=users&amp;profile=all&amp;session=PINTARMEDIA" class=""> &nbsp;&nbsp;&nbsp;<i class="fa fa-list "></i> Daftar Server </a>
    <a href="./?hotspot-user=add&amp;session=PINTARMEDIA" class=""> &nbsp;&nbsp;&nbsp;<i class="fa fa-user-plus "></i> Tambah Server </a>
  </div>
   <!-- jaringan -->
    <div class="dropdown-btn "><i class="fa fa-users"></i> Jaringan    <i class="fa fa-caret-down"></i>
  </div>
  <div class="dropdown-container ">
    <a href="./?hotspot=users&amp;profile=all&amp;session=PINTARMEDIA" class=""> &nbsp;&nbsp;&nbsp;<i class="fa fa-list "></i> Daftar Jaringan </a>
    <a href="./?hotspot-user=add&amp;session=PINTARMEDIA" class=""> &nbsp;&nbsp;&nbsp;<i class="fa fa-user-plus "></i> Tambah Jaringan </a>
  </div>
<!-- tipe jaringan -->
<a href="./admin.php?id=settings&amp;session=PINTARMEDIA" class="menu "> <i class="fa fa-gear "></i> Tipe Jaringan </a>
    <div class="dropdown-btn "><i class="fa fa-users"></i> Pembayaran    <i class="fa fa-caret-down"></i>
  </div>
  <div class="dropdown-container ">
    <a href="./?hotspot=users&amp;profile=all&amp;session=PINTARMEDIA" class=""> &nbsp;&nbsp;&nbsp;<i class="fa fa-list "></i> Daftar Metoda </a>
    <a href="./?hotspot-user=add&amp;session=PINTARMEDIA" class=""> &nbsp;&nbsp;&nbsp;<i class="fa fa-user-plus "></i> Tambah Metoda </a>
  </div>

  </div>
  <!--settings-->
  <a href="./?hotspot=about&amp;session=PINTARMEDIA" class="menu "><i class="fa fa-gear"></i> Setting</a>
  <!--about-->
  <a href="./?hotspot=about&amp;session=PINTARMEDIA" class="menu "><i class="fa fa-info-circle"></i> About</a>

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
	<h3><i class=" fa fa-users"></i> Vouchers &nbsp;&nbsp; | &nbsp;&nbsp;<i onclick="location.reload();" class="fa fa-refresh pointer" title="Reload data"></i></h3>
</div>
<div class="card-body">
<div class="overflow" style="max-height: 80vh">
<div class="row">
      <div class="col-4">
        <div class="box bmh-75 box-bordered bg-light-blue">
          <div class="box-group">
            <div class="box-group-icon">
              <a title="Open User by profile " href="./?hotspot=users&amp;profile=all&amp;session=PINTARMEDIA">
              <i class="fa fa-ticket"></i></a>
            </div>
              <div class="box-group-area">
                <h3>Profile : all<br>
                123 Items</h3>

              <a title="Open User by profile all" href="./?hotspot=users&amp;profile=all&amp;session=PINTARMEDIA"><i class="fa fa-external-link"></i> Open</a>&nbsp;
              <a title="Generate User by profile " href="./?hotspot-user=generate&amp;session=PINTARMEDIA"><i class="fa fa-users"></i> Generate</a>&nbsp;
              </div>
            </div>

          </div>
        </div>
	     <div class="col-4">
        <div class="box bmh-75 box-bordered bg-green">
          <div class="box-group">
            <div class="box-group-icon">
              <a title="Open User by profile default" href="./?hotspot=users&amp;profile=default&amp;session=PINTARMEDIA">
            	<i class="fa fa-ticket"></i></a>
            </div>
              <div class="box-group-area">
                <h3>Profile : default<br>
                0 Item</h3>

              <a title="Open User by profile default" href="./?hotspot=users&amp;profile=default&amp;session=PINTARMEDIA"><i class="fa fa-external-link"></i> Open</a>&nbsp;
              <a title="Generate User by profile default" href="./?hotspot-user=generate&amp;genprof=default&amp;session=PINTARMEDIA"><i class="fa fa-users"></i> Generate</a>&nbsp;
              </div>
            </div>

          </div>
        </div>
        	     <div class="col-4">
        <div class="box bmh-75 box-bordered bg-indigo">
          <div class="box-group">
            <div class="box-group-icon">
              <a title="Open User by profile ADMIN" href="./?hotspot=users&amp;profile=ADMIN&amp;session=PINTARMEDIA">
            	<i class="fa fa-ticket"></i></a>
            </div>
              <div class="box-group-area">
                <h3>Profile : ADMIN<br>
                1 Item</h3>

              <a title="Open User by profile ADMIN" href="./?hotspot=users&amp;profile=ADMIN&amp;session=PINTARMEDIA"><i class="fa fa-external-link"></i> Open</a>&nbsp;
              <a title="Generate User by profile ADMIN" href="./?hotspot-user=generate&amp;genprof=ADMIN&amp;session=PINTARMEDIA"><i class="fa fa-users"></i> Generate</a>&nbsp;
              </div>
            </div>

          </div>
        </div>
        	     <div class="col-4">
        <div class="box bmh-75 box-bordered bg-purple">
          <div class="box-group">
            <div class="box-group-icon">
              <a title="Open User by profile MAKE" href="./?hotspot=users&amp;profile=MAKE&amp;session=PINTARMEDIA">
            	<i class="fa fa-ticket"></i></a>
            </div>
              <div class="box-group-area">
                <h3>Profile : MAKE<br>
                1 Item</h3>

              <a title="Open User by profile MAKE" href="./?hotspot=users&amp;profile=MAKE&amp;session=PINTARMEDIA"><i class="fa fa-external-link"></i> Open</a>&nbsp;
              <a title="Generate User by profile MAKE" href="./?hotspot-user=generate&amp;genprof=MAKE&amp;session=PINTARMEDIA"><i class="fa fa-users"></i> Generate</a>&nbsp;
              </div>
            </div>

          </div>
        </div>
        	     <div class="col-4">
        <div class="box bmh-75 box-bordered bg-indigo">
          <div class="box-group">
            <div class="box-group-icon">
              <a title="Open User by profile TRIAL" href="./?hotspot=users&amp;profile=TRIAL&amp;session=PINTARMEDIA">
            	<i class="fa fa-ticket"></i></a>
            </div>
              <div class="box-group-area">
                <h3>Profile : TRIAL<br>
                0 Item</h3>

              <a title="Open User by profile TRIAL" href="./?hotspot=users&amp;profile=TRIAL&amp;session=PINTARMEDIA"><i class="fa fa-external-link"></i> Open</a>&nbsp;
              <a title="Generate User by profile TRIAL" href="./?hotspot-user=generate&amp;genprof=TRIAL&amp;session=PINTARMEDIA"><i class="fa fa-users"></i> Generate</a>&nbsp;
              </div>
            </div>

          </div>
        </div>
        	     <div class="col-4">
        <div class="box bmh-75 box-bordered bg-green">
          <div class="box-group">
            <div class="box-group-icon">
              <a title="Open User by profile 2JAM" href="./?hotspot=users&amp;profile=2JAM&amp;session=PINTARMEDIA">
            	<i class="fa fa-ticket"></i></a>
            </div>
              <div class="box-group-area">
                <h3>Profile : 2JAM<br>
                17 Items</h3>

              <a title="Open User by profile 2JAM" href="./?hotspot=users&amp;profile=2JAM&amp;session=PINTARMEDIA"><i class="fa fa-external-link"></i> Open</a>&nbsp;
              <a title="Generate User by profile 2JAM" href="./?hotspot-user=generate&amp;genprof=2JAM&amp;session=PINTARMEDIA"><i class="fa fa-users"></i> Generate</a>&nbsp;
              </div>
            </div>

          </div>
        </div>
        	     <div class="col-4">
        <div class="box bmh-75 box-bordered bg-indigo">
          <div class="box-group">
            <div class="box-group-icon">
              <a title="Open User by profile 12JAM" href="./?hotspot=users&amp;profile=12JAM&amp;session=PINTARMEDIA">
            	<i class="fa fa-ticket"></i></a>
            </div>
              <div class="box-group-area">
                <h3>Profile : 12JAM<br>
                21 Items</h3>

              <a title="Open User by profile 12JAM" href="./?hotspot=users&amp;profile=12JAM&amp;session=PINTARMEDIA"><i class="fa fa-external-link"></i> Open</a>&nbsp;
              <a title="Generate User by profile 12JAM" href="./?hotspot-user=generate&amp;genprof=12JAM&amp;session=PINTARMEDIA"><i class="fa fa-users"></i> Generate</a>&nbsp;
              </div>
            </div>

          </div>
        </div>
        	     <div class="col-4">
        <div class="box bmh-75 box-bordered bg-red">
          <div class="box-group">
            <div class="box-group-icon">
              <a title="Open User by profile 1HARI" href="./?hotspot=users&amp;profile=1HARI&amp;session=PINTARMEDIA">
            	<i class="fa fa-ticket"></i></a>
            </div>
              <div class="box-group-area">
                <h3>Profile : 1HARI<br>
                24 Items</h3>

              <a title="Open User by profile 1HARI" href="./?hotspot=users&amp;profile=1HARI&amp;session=PINTARMEDIA"><i class="fa fa-external-link"></i> Open</a>&nbsp;
              <a title="Generate User by profile 1HARI" href="./?hotspot-user=generate&amp;genprof=1HARI&amp;session=PINTARMEDIA"><i class="fa fa-users"></i> Generate</a>&nbsp;
              </div>
            </div>

          </div>
        </div>
        	     <div class="col-4">
        <div class="box bmh-75 box-bordered bg-blue">
          <div class="box-group">
            <div class="box-group-icon">
              <a title="Open User by profile 3HARI" href="./?hotspot=users&amp;profile=3HARI&amp;session=PINTARMEDIA">
            	<i class="fa fa-ticket"></i></a>
            </div>
              <div class="box-group-area">
                <h3>Profile : 3HARI<br>
                25 Items</h3>

              <a title="Open User by profile 3HARI" href="./?hotspot=users&amp;profile=3HARI&amp;session=PINTARMEDIA"><i class="fa fa-external-link"></i> Open</a>&nbsp;
              <a title="Generate User by profile 3HARI" href="./?hotspot-user=generate&amp;genprof=3HARI&amp;session=PINTARMEDIA"><i class="fa fa-users"></i> Generate</a>&nbsp;
              </div>
            </div>

          </div>
        </div>
        	     <div class="col-4">
        <div class="box bmh-75 box-bordered bg-cyan">
          <div class="box-group">
            <div class="box-group-icon">
              <a title="Open User by profile MEMBER" href="./?hotspot=users&amp;profile=MEMBER&amp;session=PINTARMEDIA">
            	<i class="fa fa-ticket"></i></a>
            </div>
              <div class="box-group-area">
                <h3>Profile : MEMBER<br>
                5 Items</h3>

              <a title="Open User by profile MEMBER" href="./?hotspot=users&amp;profile=MEMBER&amp;session=PINTARMEDIA"><i class="fa fa-external-link"></i> Open</a>&nbsp;
              <a title="Generate User by profile MEMBER" href="./?hotspot-user=generate&amp;genprof=MEMBER&amp;session=PINTARMEDIA"><i class="fa fa-users"></i> Generate</a>&nbsp;
              </div>
            </div>

          </div>
        </div>
        	     <div class="col-4">
        <div class="box bmh-75 box-bordered bg-purple">
          <div class="box-group">
            <div class="box-group-icon">
              <a title="Open User by profile 7HARI" href="./?hotspot=users&amp;profile=7HARI&amp;session=PINTARMEDIA">
            	<i class="fa fa-ticket"></i></a>
            </div>
              <div class="box-group-area">
                <h3>Profile : 7HARI<br>
                24 Items</h3>

              <a title="Open User by profile 7HARI" href="./?hotspot=users&amp;profile=7HARI&amp;session=PINTARMEDIA"><i class="fa fa-external-link"></i> Open</a>&nbsp;
              <a title="Generate User by profile 7HARI" href="./?hotspot-user=generate&amp;genprof=7HARI&amp;session=PINTARMEDIA"><i class="fa fa-users"></i> Generate</a>&nbsp;
              </div>
            </div>

          </div>
        </div>
        	     <div class="col-4">
        <div class="box bmh-75 box-bordered bg-grey">
          <div class="box-group">
            <div class="box-group-icon">
              <a title="Open User by profile 30HARI" href="./?hotspot=users&amp;profile=30HARI&amp;session=PINTARMEDIA">
            	<i class="fa fa-ticket"></i></a>
            </div>
              <div class="box-group-area">
                <h3>Profile : 30HARI<br>
                1 Item</h3>

              <a title="Open User by profile 30HARI" href="./?hotspot=users&amp;profile=30HARI&amp;session=PINTARMEDIA"><i class="fa fa-external-link"></i> Open</a>&nbsp;
              <a title="Generate User by profile 30HARI" href="./?hotspot-user=generate&amp;genprof=30HARI&amp;session=PINTARMEDIA"><i class="fa fa-users"></i> Generate</a>&nbsp;
              </div>
            </div>

          </div>
        </div>
        	     <div class="col-4">
        <div class="box bmh-75 box-bordered bg-red">
          <div class="box-group">
            <div class="box-group-icon">
              <a title="Open User by profile TOKO" href="./?hotspot=users&amp;profile=TOKO&amp;session=PINTARMEDIA">
            	<i class="fa fa-ticket"></i></a>
            </div>
              <div class="box-group-area">
                <h3>Profile : TOKO<br>
                1 Item</h3>

              <a title="Open User by profile TOKO" href="./?hotspot=users&amp;profile=TOKO&amp;session=PINTARMEDIA"><i class="fa fa-external-link"></i> Open</a>&nbsp;
              <a title="Generate User by profile TOKO" href="./?hotspot-user=generate&amp;genprof=TOKO&amp;session=PINTARMEDIA"><i class="fa fa-users"></i> Generate</a>&nbsp;
              </div>
            </div>

          </div>
        </div>
        	     <div class="col-4">
        <div class="box bmh-75 box-bordered bg-green">
          <div class="box-group">
            <div class="box-group-icon">
              <a title="Open User by profile ULUL" href="./?hotspot=users&amp;profile=ULUL&amp;session=PINTARMEDIA">
            	<i class="fa fa-ticket"></i></a>
            </div>
              <div class="box-group-area">
                <h3>Profile : ULUL<br>
                1 Item</h3>

              <a title="Open User by profile ULUL" href="./?hotspot=users&amp;profile=ULUL&amp;session=PINTARMEDIA"><i class="fa fa-external-link"></i> Open</a>&nbsp;
              <a title="Generate User by profile ULUL" href="./?hotspot-user=generate&amp;genprof=ULUL&amp;session=PINTARMEDIA"><i class="fa fa-users"></i> Generate</a>&nbsp;
              </div>
            </div>

          </div>
        </div>
        	     <div class="col-4">
        <div class="box bmh-75 box-bordered bg-blue">
          <div class="box-group">
            <div class="box-group-icon">
              <a title="Open User by profile 5USER3M" href="./?hotspot=users&amp;profile=5USER3M&amp;session=PINTARMEDIA">
            	<i class="fa fa-ticket"></i></a>
            </div>
              <div class="box-group-area">
                <h3>Profile : 5USER3M<br>
                1 Item</h3>

              <a title="Open User by profile 5USER3M" href="./?hotspot=users&amp;profile=5USER3M&amp;session=PINTARMEDIA"><i class="fa fa-external-link"></i> Open</a>&nbsp;
              <a title="Generate User by profile 5USER3M" href="./?hotspot-user=generate&amp;genprof=5USER3M&amp;session=PINTARMEDIA"><i class="fa fa-users"></i> Generate</a>&nbsp;
              </div>
            </div>

          </div>
        </div>
              </div>
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
