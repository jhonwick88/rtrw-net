<template>
    <app-layout :title="$page.props.appname">
        <template #header>
            <h2 class="h4 font-weight-bold">
                Dashboard
            </h2>
        </template>
         <template v-slot="{ setting }">
        <welcome :setting="setting"/>
         </template>
    </app-layout>
</template>

<script>
    import AppLayout from '@/Layouts/AppLayout'
    import Welcome from '@/Jetstream/Welcome'

    export default {
        components: {
            AppLayout,
            Welcome,
        },
    }
</script>
