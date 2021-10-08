<template>
    <frontend-layout :isloader="isloading" :title="$page.props.appname">
        <div class="container">
            <div class="page-header mb-4"><h1 class="page-title">Search Results</h1></div>
            <div class="row d-flex align-items-center mb-4">
                <div class="col-lg-7">
                    <p class="mb-lg-0 text-white" v-if="filterResults.total == 0"> No results were found for your search query "{{query}}"</p>
                    <p class="mb-lg-0 text-white" v-else>We found {{filterResults.total}} result(s) for your search query "{{query}}"</p>
                </div>
                <div class="col-lg-5">
                    <div class="search-form d-flex align-items-center"> 
                    <input type="text" v-model="query" placeholder="Search" title="Enter search keyword"> 
                    <button type="submit" title="Search"><i class='bx bx-search bx-flashing' ></i></button>
                    </div>
                </div>
            </div>

            <promotion-table :promotions="filterResults" :needheader="false"></promotion-table>

        </div>
    </frontend-layout>
</template>
<script>
import FrontendLayout from '../../Layouts/FrontendLayout.vue'
import BaseComponentVue from '../../Layouts/BaseComponent.vue'
import ApiManager from '../API/ApiManager'
import PromotionTable from '../Frontend/PromotionTable.vue'
export default {
    extends: BaseComponentVue,
    components: {
        FrontendLayout,
        PromotionTable
        },  
    data(){
        return {
            isloading:false,
            filterResults:[],
            query: ''
        }
    },
     watch: {
    query: function(newVal) {
      if (newVal.length >2) {
        this.searchResults();
      }
    }
  },
    created(){
    let urlParams = new URLSearchParams(window.location.search);
      if(urlParams.has('q')){
            this.query = urlParams.get('q')
            this.searchResults()
      }
    },
    methods: {
        searchResults(){
            this.isloading = true
            ApiManager.getSearchResult(this.query).then((response)=>{
                this.isloading = false
                this.filterResults = response.data.data
            }).catch((error)=>{
                this.isloading = false
                console.log(error)
            })
        }
    }

}
</script>