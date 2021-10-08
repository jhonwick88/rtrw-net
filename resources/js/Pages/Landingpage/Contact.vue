<template>
    <frontend-layout :title="$page.props.appname">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-12 col-sm-12 mt-5">
                    <div class="ahsHs">
                        <h1>Advertising</h1>
                        <p>
                            Want to promote your project? We offer Promoted Coin spots and Banner Ad spots.
                            For prices and information, please email us at:
                        </p>
                        <a class="email btn btn-primary rounded p-3" href="mailto:ads@mydomain.net">
                            <i class="fa fa-envelope"></i> ads@mydomain.net
                        </a>
                    </div>
                </div>
                 <div class="col-lg-6 col-md-12 col-sm-12 mt-5">
                     <div class="ahsHs">
                        <h1>General Inquiries</h1>
                        <p>
                            For anything else, please email us at:
                        </p>
                        <a class="email btn btn-primary rounded p-3" href="mailto:info@mydomain.net">
                            <i class="fa fa-envelope"></i> info@mydomain.net
                        </a>
                    </div>
                </div>
            </div>
            <div class="row mt-5">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="ahsHs">
                        <h1>Update Coin</h1>
                        <p>
                            Want to update your coin logo, contract address, description, launch date, or anything else?
                            The fastest way is to submit a request using our Update Request Form:
                        </p>
                        <a class="email btn btn-primary rounded p-3" ><i class="fas fa-share-square"></i> Submit Request</a>
                        <!-- :href="$page.props.user ? `/submit/update-form` : `/login?re=/submit/update-form`" -->
                        <br>
                        <p>
                            Your update request will be answered very quickly. You will be updated via email.
                        </p>
                    </div>
                </div>
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
<style scoped>
.ahsHs{
    border-radius: 16px;
    background-color: #111621;
    padding: 16px;
    color: #fff;
    text-align: center;
}
.ahsHs h1{
    color: #fff;
}
</style>