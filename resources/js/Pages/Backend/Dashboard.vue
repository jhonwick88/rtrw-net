<template>
    <app-layout :title="$page.props.appname" :isloader="isloading">
         <template v-slot="{ setting,currentTime }">
                <welcome :setting="setting" :currentTime="currentTime" :datarekap="datarekap" :filterData="filterData"/>
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
                filterData: {
                    data: [],
                },
                isloading:false,
                load:false
            }
        },
        async created() {
            await this.getDataRekap();
            await this.getNotes();
        },
        methods: {
            async getDataRekap(){
            this.isloading = true
            await ApiManager.getDashboard()
                .then((response) => {
                    this.isloading = false
                    this.datarekap = response.data.data
                })
                .catch((error) => {
                    console.log(error);
                });
            },
            async getNotes(){
                this.load = true
                await ApiManager.getNotes(1).then((response) =>{
                    this.load = false
                    this.filterData = response.data.data;
                    console.log(JSON.stringify(this.filterData))
                }).catch((error)=>{console.log(error);})
            }
        }
    }
</script>
