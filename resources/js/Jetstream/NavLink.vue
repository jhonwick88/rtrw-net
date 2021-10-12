<template>
    <inertia-link :href="href" :class="classes">
      <slot></slot>
    </inertia-link>
</template>

<script>
  export default {
    props: {
        href: {
        type: String,
      },
      active: {
        type: Boolean,
      },
          ismenu: {
        type: Boolean,
        default: false,
      }
      },

    computed: {
      classes() {
          if (this.ismenu){
            return this.active
                ? 'menu active'
                : 'menu'
          }else{
            return this.active
                ? 'active'
                : ''
          }
      }
    }
  }
</script>
