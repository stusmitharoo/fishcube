<template>
	<transition name="modal">
	    <div class="modal-mask">
	      <div class="modal-wrapper">
	        <div class="modal-container">

	          <div class="modal-header">
	            <slot name="header">
	            </slot>
	          </div>

	          <div class="modal-body">
	            <slot name="body">
	            </slot>
	          </div>

	          <div class="modal-footer">
	          		<slot name="button">
	          		</slot>
	              <button class="modal-default-button btn btn-warning" @click="$emit('close')">
	                OK
	              </button>
	          </div>
	        </div>
	      </div>
	    </div>
	  </transition>
</template>

<script>
	export default {
    }
</script>