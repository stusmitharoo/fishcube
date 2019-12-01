<template>
	<div :class="{'active-mob-search': video}">
		<div class="col-xs-12 margin-t">
	        <div>
            	<h5 class="words option">
            		<a :href="'/video/choice'" class="words words-menu btn">Create a video</a>
            	</h5>
            </div>
            <div>
            	<h5 class="words option">
            		<a :href="'/video/views/choice'" class="words words-menu btn">Search for a video</a>
            	</h5>
            </div>
            <div>
            	<h5 class="words option">
            		<a :href="'/video/listChoice'" class="words words-menu btn">List your video</a>
            	</h5>
            </div>
	    </div> 
	</div>  
</template>
<script>
	export default {
		props:[
			'video',
		]
	}
</script>