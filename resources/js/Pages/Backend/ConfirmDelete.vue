<template>
    <jet-dialog-modal id="confirmDelete" >
      <template #title>
        Confirm Delete
      </template>

      <template #content>
          <div>
<!-- start input -->
 Are you sure you want to delete your item? Once your item is deleted, all of its resources and data will be permanently deleted.
<!-- end input -->
          </div>
          
      </template>

      <template #footer>
        <jet-secondary-button data-dismiss="modal">
          Cancel
        </jet-secondary-button>

        <jet-danger-button class="ml-2" @click="deleteItem">
          Delete
        </jet-danger-button>
      </template>
    </jet-dialog-modal>
</template>
<script>
import JetDialogModal from '@/Jetstream/DialogModal'
import JetDangerButton from '@/Jetstream/DangerButton'
import JetSecondaryButton from '@/Jetstream/SecondaryButton'
export default {
    emits: ['actionDelete'],
    props: {
        itemData: Object,
    },
    components: {
        JetDialogModal,
        JetSecondaryButton,
        JetDangerButton,
    },
    data(){
        return{
            bootstrap: null,
            isloading: false,
        }
    },
    methods:{
        deleteItem(){
             this.$emit('actionDelete',this.itemData)
        },
        showConfirmDelete(){
            this.bootstrap = $('#confirmDelete')
            this.bootstrap.modal('toggle')
        },
    }

}
</script>