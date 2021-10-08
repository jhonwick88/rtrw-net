<template>
    <frontend-layout>
        <div class="container">
            <div class="row">
                Update Form
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