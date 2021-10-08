<template>
                <div class="row">
               <div class="col-12 mb-5">
            <div class="page-header d-flex justify-content-between" id="featured-templates" v-show="needheader">
               <p class="page-title">Promoted</p>
               <a href="/contact" class="mt-2" alt="contact us">Your coin here? Contact us!</a>
            </div>
                  <div class="promoted d-flex flex-column">
                    <img src="/images/spinner.svg" class="spinner mt-5" v-if="isLoading"/>
                    <!-- start table -->
                    <table class="table is-fullwidth is-striped" v-else>
                     <thead>
                     <tr>
                         <th>#</th>
                         <th></th>
                         <th>Name</th>
                         <th class="is-hidden-mobile">Chain</th>
                         <th class="is-hidden-mobile">Symbol</th>
                         <th class="is-hidden-mobile ">Market Cap</th>
                         <th class="is-hidden-mobile">Price</th>
                         <th class="is-hidden-mobile">Launched</th>
                         <th class="is-hidden-mobile">Votes</th>
                         <th>Vote<span class="is-hidden-tablet">s</span></th>
                     </tr>
                     </thead>
                     <tbody>
                        <template v-for="(item,index) in promotions.data" :key="index">            
<tr>
   <td class="has-wishlist ignore">
      <span>
      {{index+1}}
      </span>
      <div class="wishlist-button">
         <div class="wishlist-add"><i class="far fa-star"></i></div>
      </div>
   </td>
   <td class="ignore" @click="openDetail(item)">
      <div class="flex">
         <img :src="item.logo" alt="" height="24">
      </div>
   </td>
   <td @click="openDetail(item)">
      <b>{{ item.name }}</b>
      <div class="is-hidden-tablet text-uppercase">
         ${{ item.symbol }} <span class="network">{{ item.network.sort_name }}</span>
         <br>
         <span class="presale" v-if="item.ispresale">(Presale)</span>
      </div>
   </td>
   <td class="is-hidden-mobile" @click="openDetail(item)"><span class="network text-uppercase">{{ item.network.sort_name }}</span></td>
   <td class="is-hidden-mobile text-uppercase" @click="openDetail(item)">
      {{ item.symbol }}
   </td>
   <td class="is-hidden-mobile" v-if="item.ispresale" @click="openDetail(item)"><span class="presale">Presale</span></td>
   <td class="is-hidden-mobile price" @click="openDetail(item)" v-else>{{ item.marketcap!=null ? `$${item.marketcap}` : `-`}}</td>
   <td class="is-hidden-mobile price" @click="openDetail(item)" v-if="item.ispresale"> - </td>
   <td class="is-hidden-mobile price" @click="openDetail(item)" v-else>{{ item.price_usd!=null ? `$${item.price_usd}` : `-`}} </td>
   <td class="is-hidden-mobile" @click="openDetail(item)">{{ item.launch_on }}</td>
   <td class="is-hidden-mobile" @click="openDetail(item)"><span class="votes">{{item.votes.all}}</span></td>
   <td>
      <a :href="$page.props.user ? `/coin/${item.slug}` : `/login?re=/coin/${item.slug}`" target="_blank" class="button is-success">
      <span class="votes is-hidden-tablet">{{item.votes.all}}</span>
      <span>Vote</span>
      </a>
   </td>
</tr>
                        </template>     
                             </tbody>
                 </table>
                    <!-- end table -->
                  </div>
               </div>
            </div>
</template>
<script>
export default {
    props:['promotions','needheader'],
    methods:{
       openDetail(item){
          return window.location.href = `/coin/${item.slug}`
       }
    }
}
</script>