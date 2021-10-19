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
          sortBy(property, order) {
      if (typeof order === "undefined") order = "asc";

      return function(a, b) {
        const varA =
          typeof a[property] === "string"
            ? a[property].toUpperCase()
            : a[property];
        const varB =
          typeof b[property] === "string"
            ? b[property].toUpperCase()
            : b[property];

        let comparison = 0;
        if (varA > varB) comparison = 1;
        else if (varA < varB) comparison = -1;
        return order === "desc" ? comparison * -1 : comparison;
      };
    },
    }
})
</script>
