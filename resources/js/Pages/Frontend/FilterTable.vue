<template>
                 <div class="promoted d-flex flex-column">
                    <!-- start table -->
                    <table class="table is-fullwidth is-striped">
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
                     <tbody v-if="isidata.data.length > 0">       
<template v-for="(item,index) in isidata.data" :key="index">            
<tr>                                       
   <td class="has-wishlist ignore">
      <span>
      {{ isidata.from+index }}
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
   <td class="is-hidden-mobile" @click="openDetail(item)" v-if="item.ispresale"><span class="presale">Presale</span></td>
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
                    <!-- pagination -->
                    <nav aria-label="Page navigation example" v-if="isidata.data.length > 0">
  <ul class="pagination">
    <li class="page-item" v-for="(item, i) in isidata.links" :key="i">
        <a class="page-link" href="javascript:" aria-label="Previous" v-if="i == 0">
        <span aria-hidden="true">&laquo;</span>
      </a>
      <a class="page-link" href="javascript:" aria-label="Next" v-else-if="i == isidata.links.length - 1">
        <span aria-hidden="true">&raquo;</span>
      </a>
       <a class="page-link" href="javascript:" @click="getPage(item.label, query)" v-else>{{item.label}}</a>
   </li>
  </ul>
</nav>
                    <!-- end pagination -->
                  </div>
</template>
<script>
//import ApiManager from '../API/ApiManager'
//import {reactive, onMounted} from 'vue'
export default {
    emits: ['clickPage'],
    props: ['isidata','query'],
    methods: {
            getPage(page,query){
               this.$emit('clickPage',{
                  'page':page,
                  'query': query
               })
            },
                   openDetail(item){
          return window.location.href = `/coin/${item.slug}`
       }
        },
    setup() {
      //   const state = reactive({
      //       filterData: []
      //   })
        
      //   const getCoins = () => {
      //       ApiManager.getFiltersCoins()
      //        .then((response) => {
      //           state.filterData = response.data.data
      //           //console.log(JSON.stringify(isidata))
      //       })
      //       .catch((error) => {
      //           console.log(error);
      //       });
      //   }

      //   onMounted(
      //       getCoins,
      //   )
        return{
            
        }
    },
}
</script>