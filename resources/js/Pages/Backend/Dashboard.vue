<template>
    <app-layout :title="$page.props.appname">
         <template v-slot="{ setting }">
        <welcome :setting="setting"/>
         </template>
    </app-layout>
</template>

<script>
    import AppLayout from '@/Layouts/AppLayoutNet'
    import Welcome from '@/Jetstream/Welcome'

    export default {
        components: {
            AppLayout,
            Welcome,
        },
    }
</script>
