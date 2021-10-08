<template>
 <inertia-head>
    <title>{{ title }} - MyWebsite</title>
    <meta type="description" :content="description" />
    <!-- <meta name="twitter:title" content="Inertia Head Demo - Login page." /> -->
    <!-- <meta name="twitter:site" content="@ninjaparade" /> -->
    <!-- <meta name="twitter:creator" content="@ninjaparade" /> -->
    <!-- <meta name="twitter:description" content="Inertia Head Demo - Login page." /> -->
    <!-- <meta name="twitter:card" content="summary_large_image" /> -->
    <!-- <meta property="og:url" content="http://inertia-head-demo.test/login" /> -->
    <!-- <meta property="og:title" content="Inertia Head Demo - Login page." /> -->
    <!-- <meta property="og:description" content="Inertia Head Demo - Login page." /> -->
    <!-- <meta property="og:type" content="website" /> -->
    <!-- <meta property="og:image" content="https://www.biography.com/.image/t_share/MTQ3NTI2OTA4NzY5MjE2MTI4/drake_photo_by_prince_williams_wireimage_getty_479503454.jpg" /> -->
</inertia-head>
    <div>
        <frontend-header :setting="setting"/>
        <main id="main">
            <loader v-if="isloader" object="#ff9633" color1="#ffffff" color2="#17fd3d" size="5" speed="2" bg="#343a40" objectbg="#999793" opacity="80" name="circular"></loader>
        <slot></slot>
        </main>
        <frontend-footer :setting="setting"/>
    </div>
</template>
<script>
import FrontendFooter from './FrontendFooter.vue'
import FrontendHeader from './FrontendHeader.vue'
import { usePage } from '@inertiajs/inertia-vue3'
export default {
   props: {
       isloader: Boolean,
    title: String,
    description: String,
  },
  components: { FrontendHeader, FrontendFooter },
   data() {
        return{
           setting:{},
        }
    },
    created() {
          let insertMainCss = document.createElement("link");
    insertMainCss.setAttribute("href", "/css/main.css");
    insertMainCss.setAttribute("rel", "stylesheet");
    document.head.appendChild(insertMainCss);
    this.resultConfig(usePage().props.value.settings)
    $('body').append(`<style id=\"customoverridestyles\">
    body{background-color:${this.setting.body_bg_color};color:${this.setting.body_text_color}}
    #header{background-color:${this.setting.nav_bg_color};}
    .nav-menu a{color:${this.setting.nav_menu_color};}
    .nav-menu .active > a, .nav-menu a:hover, .nav-menu li:hover > a{color:${this.setting.nav_active_color}}
    .logo p span{color:${this.setting.site_title1_color}}
    .logo p{color:${this.setting.site_title2_color}}
    .cardxf{background-color:${this.setting.card_bg_color};}
    .footer-top{background-color:${this.setting.footer_top_bg};}
    .footer-nav a,.footer-top h3,.footer-top p,.footer-about p{color:${this.setting.footer_text_color};}
    #footer{background-color:${this.setting.footer_bottom_bg};}
    </style>`)
    },
    methods: {
      resultConfig: function(data){
          const result = data.reduce(
              (accumulator, target) => ({ ...accumulator, [target.key]: target.value }),
              {});
              let site_names = result.site_name.split(" ")
              this.setting = Object.assign(result,{'site_1': site_names[0],'site_2': site_names[1]})
              localStorage.setItem('setting',JSON.stringify(this.setting))
      },
    }
}
</script>
<style>

</style>