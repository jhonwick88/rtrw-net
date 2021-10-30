<template>
    <app-layout :title="$page.props.appname" :isloader="isloading">
         <template v-slot="{ setting,currentTime }">
                <welcome :setting="setting" :currentTime="currentTime" :datarekap="datarekap"/>
         </template>
    </app-layout>
</template>
<script>
import AppLayout from '@/Layouts/AppLayoutNet'
import Welcome from '@/Jetstream/WelcomeNet'
import ApiManager from '../API/ApiManager'
    export default {
        components: {
            AppLayout,
            Welcome,
        },
        data() {
            return {
                datarekap: {
                    tot_pelanggan: 0,
                    tot_user: 0,
                    tot_server: 0,
                    tot_jaringan: 0
                },
                isloading:false,
            }
        },
        created() {
            this.getDataRekap()
        },
        methods: {
            getDataRekap(){
                  this.isloading = true
            ApiManager.getDashboard()
                .then((response) => {
                    this.isloading = false
                    this.datarekap = response.data.data
                })
                .catch((error) => {
                    console.log(error);
                });
            }
        }
    }
</script>
