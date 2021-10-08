<template>
    <div class="row justify-content-center pt-4">
        <div class="col-6">
            <div>
                <jet-authentication-card-logo :logoImage="$page.props.setting_new.site_logo"/>
            </div>

            <div class="card shadow-sm">
                <div v-html="terms" class="card-body">
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import JetAuthenticationCardLogo from '@/Jetstream/AuthenticationCardLogo'

export default {
    props: ['terms'],

    components: {
        JetAuthenticationCardLogo,
    },
}
</script>
