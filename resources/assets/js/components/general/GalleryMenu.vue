<template>
	<div :class="{'active-mob-search': gallery}">
		<div class="col-xs-12 margin-t">
	        <div>
            	<h5 class="words option">
            		<a :href="'/galleryChoice'" class="words words-menu btn">Create a gallery</a>
            	</h5>
            </div>
            <div>
            	<h5 class="words option">
            		<a :href="'/gallery/view/choice'" class="words words-menu btn">search all galleries</a>
            	</h5>
            </div>
            <div>
            	<h5 class="words option">
            		<a :href="'/gallery/list/choice'" class="words words-menu btn">List your galleries</a>
            	</h5>
            </div>
	    </div> 
	</div>  
</template>
<script>
	export default {
		props:[
			'gallery',
		]
	}
</script>