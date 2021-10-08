<template>
    <app-layout>
         <template #header :title="$page.props.appname">
            <h2 class="h4 font-weight-bold">
                CoinList
            </h2>
        </template>
          <!-- head -->
                  <div class="card-body bg-white px-5 py-3 border-bottom rounded-top">
          <div class="mx-3 my-3">
            <h3 class="h3 my-4">
              Coin list
            </h3>

            <div class="text-muted">
             Lorem ipsum dolor sit amet consectetur adipisicing elit. Eos vel, eum consectetur dolor doloribus incidunt labore. Totam harum iste non libero nemo pariatur voluptates possimus neque. Itaque voluptate dignissimos pariatur.
            </div>
          </div>
        </div>
          <!-- end head -->
        <!-- start content -->
          <div class="row justify-content-center my-5">
    <div class="col-md-12">
      <div class="card shadow bg-light">
          <!-- content here -->
      </div>
    </div>
          </div>
          <!-- end content -->
    </app-layout>
</template>
<script>
import AppLayout from '@/Layouts/AppLayout'

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