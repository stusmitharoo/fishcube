<template>
	<transition name="modal">
	    <div class="modal-mask">
	      <div class="modal-wrapper">
	        <div class="modal-container">

	          <div class="modal-body">
	            <helpvideo :video-url="video"></helpvideo>
	          </div>

	          <div class="modal-footer">
	          		<slot name="button">
	          		</slot>
	              <button class="modal-default-button btn btn-warning" @click="$emit('close')">
	                <span class="glyphicon glyphicon-remove"></span>
	              </button>
	          </div>
	        </div>
	      </div>
	    </div>
	  </transition>
</template>

<script>
	export default {
		props: [
			'video',
		]
    }
</script>