<script>
import { defineComponent } from 'vue'
 
export default defineComponent({
    methods: {
        showToast(message){
          this.$toast.open({
        message: message,
        type: "default",
        duration: 2000,
        position: "bottom",
        dismissible: true
      })
    },
    }
})
</script>
