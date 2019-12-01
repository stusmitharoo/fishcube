<template>
	<div :class="{'active-mob-menu': menuActive}" class="col-xs-12">
		<div class="logo-box"  style="margin-left: 5px;">
            <a :href="'/'">
            <img class="img-responsive image image-corners" src="/images/index/logosmalldark.jpg">
            </a>
        </div>
        <div v-if="auth" style="padding: 0px; margin-right: -5px" class="pull-right">
            <a href="/profile" class="margin-ts words btn btn-sm pull-right">
                <span class="glyphicon glyphicon-user"></span>
                <h6 class="links-zero">{{auth.name}}</h6>
            </a>
        </div>
        <div class="col-xs-12">
        	<div v-if="!auth">
                <div>
                	<h5 class="words option">
                		<a :href="'/login'" class="words words-menu btn">Login</a>
                	</h5>
                </div>
                <div>
                	<h5 class="words option">
                		<a :href="'/register'" class="words words-menu btn">Register</a>
                	</h5>
                </div>
            </div>
            <div v-if="auth">
			    <div>
			    	<h5 v-if="!gallery" class="words option" @click="galleryOpen()">
			    		<a class="words words-menu btn">Gallery
			    		</a>
			    	</h5>
			    	<h5 v-if="gallery" class="words option" @click="galleryClose()">
			    		<a class="words words-menu btn">Gallery 
			    		</a>
			    	</h5>
			    </div>
                <div>
                    <h5 v-if="!blog" class="words option" @click="blogOpen()">
                        <a class="words words-menu btn">Blog
                        </a>
                    </h5>
                    <h5 v-if="blog" class="words option" @click="blogClose()">
                        <a class="words words-menu btn">Blog
                        </a>
                    </h5>
                </div>
                <div>
                    <h5 v-if="!video" class="words option" @click="videoOpen()">
                        <a class="words words-menu btn">Video
                        </a>
                    </h5>
                    <h5 v-if="video" class="words option" @click="videoClose()">
                        <a class="words words-menu btn">Video
                        </a>
                    </h5>
                </div>
                <div>
                    <h5 v-if="!profile" class="words option" @click="profileOpen()">
                        <a class="words words-menu btn">Profile
                        </a>
                    </h5>
                    <h5 v-if="profile" class="words option" @click="profileClose()">
                        <a class="words words-menu btn">Profile
                        </a>
                    </h5>
                </div>
                <div>
                    <h5 v-if="!user" class="words option" @click="userOpen()">
                        <a class="words words-menu btn">Settings
                        </a>
                    </h5>
                    <h5 v-if="user" class="words option" @click="userClose()">
                        <a class="words words-menu btn">Settings
                        </a>
                    </h5>
                </div>
            </div>
        </div>
	</div>
</template>

<script>
import { mapActions, mapGetters } from 'vuex'

    export default {
        props: [
            'menuActive',
            'auth',
            'gallery',
            'blog',
            'video',
            'profile',
            'user',
        ],
        data () {
            return{
            }
        },
    methods: {

        galleryOpen() {
            this.$emit('galleryOpen')
        },
        galleryClose() {
            this.$emit('galleryClose')
        },
        blogOpen() {
            this.$emit('blogOpen')
        },
        blogClose() {
            this.$emit('blogClose')
        },
        videoOpen() {
            this.$emit('videoOpen')
        },
        videoClose() {
            this.$emit('videoClose')
        },
        profileOpen() {
            this.$emit('profileOpen')
        },
        profileClose() {
            this.$emit('profileClose')
        },
        userOpen() {
            this.$emit('userOpen')
        },
        userClose() {
            this.$emit('userClose')
        },
    }
}

</script>