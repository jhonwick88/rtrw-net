<template>
    <frontend-layout :title="$page.props.appname" description="Description about page">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="d-flex flex-column align-items-center text-white mt-5">
                        <img class="mb-3 mt-4" src="/images/logo.svg" alt="logo">
                        <h1 class="text-white">My DOMAIN</h1>
                        <h3 class="text-white mb-3">Sub description about my company. Please fill this with sort desc</h3>
                        <hr>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Hic suscipit veritatis sit consequuntur quam architecto distinctio, laborum corrupti, quaerat sunt a pariatur, alias unde quae non cum. Voluptas, accusantium quasi.</p>
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Hic suscipit veritatis sit consequuntur quam architecto distinctio, laborum corrupti, quaerat sunt a pariatur, alias unde quae non cum. Voluptas, accusantium quasi.
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Hic suscipit veritatis sit consequuntur quam architecto distinctio, laborum corrupti, quaerat sunt a pariatur, alias unde quae non cum. Voluptas, accusantium quasi.
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Hic suscipit veritatis sit consequuntur quam architecto distinctio, laborum corrupti, quaerat sunt a pariatur, alias unde quae non cum. Voluptas, accusantium quasi.
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Hic suscipit veritatis sit consequuntur quam architecto distinctio, laborum corrupti, quaerat sunt a pariatur, alias unde quae non cum. Voluptas, accusantium quasi.
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Hic suscipit veritatis sit consequuntur quam architecto distinctio, laborum corrupti, quaerat sunt a pariatur, alias unde quae non cum. Voluptas, accusantium quasi.
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Hic suscipit veritatis sit consequuntur quam architecto distinctio, laborum corrupti, quaerat sunt a pariatur, alias unde quae non cum. Voluptas, accusantium quasi.</p>
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