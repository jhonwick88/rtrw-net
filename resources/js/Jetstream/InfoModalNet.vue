<template>
<!-- modal -->
<div class="modal-window" :id="id" aria-hidden="true" :max-width="maxWidth">
  <div>
  	<header><h1>
          <slot name="title">
          </slot></h1>
          </header>
  	<a style="font-weight:bold;" href="#" title="Close" class="modal-close">X</a>
     <div class="modal-body">
        <slot name="content">
        </slot>
      </div>
       <div class="modal-footer text-right mr-t-10">
        <slot name="footer">
        </slot>
      </div>
  </div>
</div>
<!-- end modal -->
</template>
<script>
  export default {
    props: {
      id: {
        type: String,
        required: true
      },
      maxWidth: {
        default: '2xl'
      }
    }
  }
</script>
