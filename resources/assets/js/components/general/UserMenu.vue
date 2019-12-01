<template>
	<div :class="{'active-mob-search': user}">
		<div class="col-xs-12 margin-t">
	        <div>
            	<h5 v-if="!main" class="words option">
            		<a :href="'/plans'" class="words words-menu btn">Subscriptions</a>
            	</h5>
            </div>
            <div>
            	<h5 v-if="main" class="words option">
            		<a :href="'/subscription'" class="words words-menu btn">Subscriptions</a>
            	</h5>
            </div>
            <div>
            	<h5 class="words option">
            		<a :href="'/auth/profileSettings'" class="words words-menu btn">Profile Settings</a>
            	</h5>
            </div>
            <div>
                  <h5 v-if="admin" class="words option">
                        <a :href="'/admin'" class="words words-menu btn">Admin Panel</a>
                  </h5>
            </div>
            <div>
                  <h5 class="words option">
                        <a @click="logout()" class="words words-menu btn">Logout</a>
                  </h5>
            </div>
	    </div>
	</div>  
</template>
<script>
	export default {
		props:[
			'user',
                  'main',
                  'admin',
		],

            methods: {
                  logout() {
                        axios({
                              url: `/logout`,
                              method: 'post'
                        })
                        .then((response) => {
                              window.location = "/";
                        })
                  }
            }
	}
</script>