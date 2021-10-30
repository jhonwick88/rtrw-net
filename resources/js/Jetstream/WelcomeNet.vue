<template>
<!-- start content -->
    <div>
<!-- start row top -->
<div id="r_1" class="row">
      <div class="col-4">
        <div class="box bmh-75 box-bordered">
          <div class="box-group">
            <div class="box-group-icon"><i class="fa fa-calendar"></i></div>
              <div class="box-group-area">
              <span>System date &amp; time<br>
                    {{currentTime.dateView}}  <br>
                     </span>
              </div>
            </div>
          </div>
        </div>
      <div class="col-4">
        <div class="box bmh-75 box-bordered">
          <div class="box-group">
          <div class="box-group-icon"><i class="fa fa-info-circle"></i></div>
              <div class="box-group-area">
                <span>
                    App Name : RTRWNET<br>
                    version : 1.0.0 (stable)<br>
                    Created by : PINTARMEDIA              </span>
              </div>
            </div>
          </div>
        </div>
    <div class="col-4">
      <div class="box bmh-75 box-bordered">
        <div class="box-group">
          <div class="box-group-icon"><i class="fa fa-server"></i></div>
              <div class="box-group-area">
                <span>
                    Vue : 61,5%<br>
                    PHP : 38,3%<br>
                    Other : 0,2%               </span>
                </div>
              </div>
            </div>
          </div>
      </div>
<!-- end row top -->

<!-- start row middle -->
<div class="row" v-if="this.$page.props.isAdmin">
          <div class="col-8">
            <div id="r_2" class="row"><div id="r_2" class="card">
              <div class="card-header"><h3><i class="fa fa-wifi"></i> System</h3></div>
                <div class="card-body">
                  <div class="row">
                    <div class="col-3 col-box-6">
                      <div class="box bg-blue bmh-75">
                        <a :href="route('be.admin.customers')">
                          <h1>{{ datarekap.tot_pelanggan }}                              <span style="font-size: 15px;">items</span>
                            </h1>
                          <div>
                            <i class="fa fa-wifi"></i> Pelanggan                      </div>
                        </a>
                      </div>
                    </div>
                    <div class="col-3 col-box-6">
                    <div class="box bg-green bmh-75">
                      <a :href="route('be.admin.user')">
                            <h1>{{ datarekap.tot_user }}                               <span style="font-size: 15px;">items</span>
                            </h1>
                      <div>
                            <i class="fa fa-laptop"></i> Pengguna                         </div>
                      </a>
                    </div>
                  </div>
                    <div class="col-3 col-box-6">
                    <div class="box bg-purple bmh-75">
                      <a :href="route('be.admin.servers')">
                            <h1>{{ datarekap.tot_server }}                               <span style="font-size: 15px;">items</span>
                            </h1>
                      <div>
                            <i class="fa fa-users"></i> Server                         </div>
                      </a>
                    </div>
                  </div>
                    <div class="col-3 col-box-6">
                    <div class="box bg-indigo bmh-75">
                      <a :href="route('be.admin.networks')">
                            <h1>{{ datarekap.tot_jaringan }}                               <span style="font-size: 15px;">items</span>
                            </h1>
                      <div>
                            <i class="fa fa-users"></i> Jaringan                         </div>
                      </a>
                    </div>
                  </div>
                  <div class="col-3 col-box-6">
                    <div class="box bg-teal bmh-75">
                      <a :href="route('be.admin.customers.create')">
                        <div>
                          <h1><i class="fa fa-user-plus"></i>
                              <span style="font-size: 15px;">Tambah</span>
                          </h1>
                        </div>
                        <div>
                            <i class="fa fa-user-plus"></i> Pelanggan</div>
                      </a>
                    </div>
                  </div>
                   <div class="col-3 col-box-6">
                    <div class="box bg-orange bmh-75">
                      <a :href="route('be.admin.user.create')">
                        <div>
                          <h1><i class="fa fa-user-plus"></i>
                              <span style="font-size: 15px;">Tambah</span>
                          </h1>
                        </div>
                        <div>
                            <i class="fa fa-user-plus"></i> Pengguna </div>
                      </a>
                    </div>
                  </div>
                   <div class="col-3 col-box-6">
                    <div class="box bg-pink bmh-75">
                      <a :href="route('be.admin.servers.create')">
                        <div>
                          <h1><i class="fa fa-user-plus"></i>
                              <span style="font-size: 15px;">Tambah</span>
                          </h1>
                        </div>
                        <div>
                            <i class="fa fa-user-plus"></i> Server                        </div>
                      </a>
                    </div>
                  </div>
                  <div class="col-3 col-box-6">
                    <div class="box bg-red bmh-75">
                      <a :href="route('be.admin.networks.create')">
                        <div>
                          <h1><i class="fa fa-user-plus"></i>
                              <span style="font-size: 15px;">Tambah</span>
                          </h1>
                        </div>
                        <div>
                            <i class="fa fa-user-plus"></i> Jaringan                        </div>
                    </a>
                  </div>
                </div>
              </div>
            </div>
          </div></div>
            <!-- <div class="card">
              <div class="card-header"><h3><i class="fa fa-area-chart"></i> Traffic </h3></div>

                <div class="card-body">
                  body
                </div>
              </div> -->
            </div>
            <div class="col-4">
            <div id="r_4" class="row">
              <div style="display:none;" class="box bmh-75 box-bordered">
                <div class="box-group">
                  <div class="box-group-icon"><i class="fa fa-money"></i></div>
                    <div class="box-group-area">
                      <span>
                        <div id="reloadLreport">
                          <div id="loader"><i><span> <i class="fa fa-circle-o-notch fa-spin"></i> Processing... </span></i></div>
                        </div>
                    </span>
                </div>
              </div>
            </div>
            </div>
            <div id="r_3" class="row"><div id="r_3" class="row">
              <div class="card">
                <div class="card-header">
                  <h3><a href="/admin" title="Open Catatan"><i class="fa fa-align-justify"></i> Catatan</a></h3></div>
                    <div class="card-body">
                      <div style="padding: 5px; height: 200px ;" class="mr-t-10 overflow">

                    </div>
                  </div>
                </div>
                </div></div>
            </div>
</div>
<!-- end row middle -->
    </div>
    <!-- end content -->
</template>
<script>
export default {
     props: ['currentTime','datarekap'],
}
</script>
