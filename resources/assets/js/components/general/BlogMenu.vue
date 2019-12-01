<template>
	<div :class="{'active-mob-search': blog}">
		<div class="col-xs-12 margin-t">
	        <div>
            	<h5 class="words option">
            		<a :href="'/blog/choice'" class="words words-menu btn">Create a blog</a>
            	</h5>
            </div>
            <div>
            	<h5 class="words option">
            		<a :href="'/blog/view/choice'" class="words words-menu btn">Search for a blog</a>
            	</h5>
            </div>
            <div>
            	<h5 class="words option">
            		<a :href="'/blog/list/choice'" class="words words-menu btn">List your blogs</a>
            	</h5>
            </div>
	    </div> 
	</div>  
</template>
<script>
	export default {
		props:[
			'blog',
		]
	}
</script>