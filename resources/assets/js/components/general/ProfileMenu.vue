<template>
	<div :class="{'active-mob-search': profile}">
		<div class="col-xs-12 margin-t">
	        <div>
            	<h5 class="words option">
            		<a :href="'/createChoice'" class="words words-menu btn">Create a card</a>
            	</h5>
            </div>
            <div>
            	<h5 class="words option">
            		<a :href="'/locationChoice'" class="words words-menu btn">New location</a>
            	</h5>
            </div>
            <div>
            	<h5 class="words option">
            		<a :href="'/freinds'" class="words words-menu btn">Friends List</a>
            	</h5>
            </div>
            <div>
                  <h5 class="words option">
                        <a :href="'/tacklebox'" class="words words-menu btn">Tackle Box</a>
                  </h5>
            </div>
	    </div> 
	</div>  
</template>
<script>
	export default {
		props:[
			'profile',
		]
	}
</script>