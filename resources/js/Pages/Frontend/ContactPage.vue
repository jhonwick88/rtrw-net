<template>
    <frontend-layout :title="$page.props.appname">
        <div class="container">
            <div class="row">
                <!-- YOUR CONTENT HERE BRO -->
            </div>
        </div>
    </frontend-layout>
</template>
<script>
import FrontendLayout from '../../Layouts/FrontendLayout.vue'
import BaseComponentVue from '../../Layouts/BaseComponent.vue'
export default {
    extends: BaseComponentVue,
    components: {
        FrontendLayout,
        },
    data(){
        return {
            isloading:false,
        }
    },
    methods: {

    }

}
</script>