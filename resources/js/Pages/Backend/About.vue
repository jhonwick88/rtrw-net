<template>
    <app-layout :title="$page.props.appname">
    <div>
        <div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-header">
        <h3><i class="fa fa-info-circle"></i> About</h3>
      </div>
      <div class="card-body">
        <h3>RTRWNET PAYMENTS V1.0.0 30-10-2021</h3>
<p>
Aplikasi ini ditujukan untuk pengusaha hotspot di manapun Anda berada. Semoga makin sukses.
</p>
<p>
  </p><ul>
    <li>
      Author : Yuwono
    </li>
    <li>
      Technology: <a href="https://laravel.com/docs/8.x/starter-kits#breeze-and-inertia">Laravel, VUE and Inertia JS</a>
    </li>
    <li>
      Website : <a href="https://ismiportfolio.web.app">ismiportfolio.web.app</a>
    </li>
    <li>
      Facebook : <a href="https://www.facebook.com/Zhu10/">fb.com/Zhu10</a>
    </li>
  </ul>

<p>
  Terima kasih untuk semua yang telah mendukung pengembangan RTRWNET PAYMENTS.
</p>
<p>Terima kasih kepada Laksamadi Guko untuk template MIKHMON nya.</p>
<div>
    <i>Copyright © <i> 2021 Yuwono</i></i>
</div>
</div>
</div>
</div>
<div class="col-12">
<div class="card">
  <div class="card-header">
  <h3><i class="fa fa-info-circle"></i> installation</h3>
  </div>
  <div class="card-body">
  <div class="iFWrapper">
    <pre>$ mkdir YOUR_DIR

$ <span class="pl-c1">cd</span> YOUR_DIR

$ git clone -b masterDeni https://github.com/jhonwick88/rtrw-net.git

$ <span class="pl-c1">cd</span> rtrw-net

$ composer install

$ cp .env.example .env

$ php artisan key:generate

$ npm install

// 1.1 open .env file with NANO or VCS and setup your <span class="pl-k">local</span> db path
// 1.2 from .env change path api to <span class="pl-k">local</span> MIX_API_PATH (just comment) <span class="pl-k">then</span> save it
// 2. Download database from live and import to <span class="pl-k">local</span> db

$ php artisan serve

$ npm run watch

// after edit is final <span class="pl-k">&lt;</span>b<span class="pl-k">&gt;</span>CHANGE PATH MIX_API_PATH to LIVE Version<span class="pl-k">&lt;</span>/b<span class="pl-k">&gt;</span>, and <span class="pl-k">then</span> run <span class="pl-c1">:</span>

$ npm run prod

$ git add --all

$ git commit -m <span class="pl-s"><span class="pl-pds">"</span>what ever your change<span class="pl-pds">"</span></span>

$ git push origin masterDeni

// on SSH server goto domain document path

$ <span class="pl-c1">cd</span> /public_html

// make sure you<span class="pl-s"><span class="pl-pds">'</span>re in masterDeni branch</span>
<span class="pl-s"></span>
<span class="pl-s">$ git branch</span>
<span class="pl-s"></span>
<span class="pl-s">// update live version</span>
<span class="pl-s"></span>
<span class="pl-s">$ git pull</span>
<span class="pl-s"></span>
<span class="pl-s">// insert your git user and password</span>
<span class="pl-s"></span>
<span class="pl-s">// DONE :D</span></pre>
  </div>
  </div>
</div>
</div>
</div>
    </div>
    </app-layout>
</template>
<script>
import AppLayout from '@/Layouts/AppLayoutNet'

export default {
    components: {
        AppLayout,
    },
    data(){
        return{

        }
    },
    created() {

    },
    methods: {

    }
}
</script>
