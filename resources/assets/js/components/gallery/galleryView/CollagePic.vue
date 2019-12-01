<template>
	<div>
        <div class="col-xs-6 margin-b relative-collage" v-if="type === 'small'">
    		<img class="img-responsive image-corners box-collage" :src="'/images/cards/'+ galleryPicture.image">
	    		<button class="words btn btn-primary btn-sm absolute-collage" id="show-modal" @click.prevent="type = 'large'">
	                <span class="glyphicon glyphicon-resize-full"></span>
	            </button>
	        </img>
	    </div>
	    <div class="col-xs-12 margin-b relative-collage" v-else="">
    		<img class="img-responsive image-corners box-collage" :src="'/images/cards/'+ galleryPicture.image">
    		<button class="words btn btn-primary btn-sm absolute-collage" id="show-modal" @click.prevent="type = 'small'">
                <span class="glyphicon glyphicon-resize-small"></span>
            </button>
	    </div>
	</div>
</template>
<script>
	export default {
		props: [
			'galleryPicture'
		],
		data() {
			return {
				type: 'small',

			}
		}
	}
</script>