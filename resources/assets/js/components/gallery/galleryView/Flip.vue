<template>
<div>
	<div class="base-menu col-xs-12 row">
        <videomodal v-if="showModal" @close="showModal = false"
            video="https://s3.eu-west-2.amazonaws.com/video.fishcube.co.uk/profilepage.mp4">
        </videomodal>
        <div class="col-xs-2"> 
            <a v-if="auth" class="words"> 
                <a class="words btn btn-sm" :href="'/gallery/flip/' + galleryHeader.id"> 
                    <span class="glyphicon glyphicon-repeat"></span><h6 class="links-zero">carousel</h6> 
                </a> 
            </a>
            <a v-else="" class="words"> 
                <a class="words btn btn-sm" :href="'/gallery/view/show/' + galleryHeader.id"> 
                    <span class="glyphicon glyphicon-repeat"></span><h6 class="links-zero">carousel</h6> 
                </a> 
            </a> 
        </div> 
		<div class="col-xs-2"> 
            <a v-if="!auth" class="words"> 
                <a class="words btn btn-sm" :href="'/gallery/collage/show/' + galleryHeader.id">    <span class="glyphicon glyphicon-th"></span><h6 class="links-zero">collage</h6> 
                </a> 
            </a> 
            <a v-else="" class="words"> 
                <a class="words btn btn-sm" :href="'/gallery/collage/' + galleryHeader.id"> 
                    <span class="glyphicon glyphicon-th"></span><h6 class="links-zero">collage</h6> 
                </a> 
            </a> 
        </div> 
        <div class="col-xs-2"> 
            <a v-if="!auth" class="words"> 
                <a class="words btn btn-sm" :href="'/water/' + galleryHeader.style_id"> 
                    <span class="glyphicon glyphicon-arrow-left"></span><h6 class="links-zero">back</h6> 
                </a> 
            </a> 
            <a v-else="" class="words"> 
                <a class="words btn btn-sm" :href="'/profile'"> 
                    <span class="glyphicon glyphicon-arrow-left"></span><h6 class="links-zero">back</h6> 
                </a> 
            </a> 
        </div> 
        <div class="col-xs-2">
            <a class="words btn btn-sm" id="show-modal" @click="showModal = true">
                <span class="glyphicon glyphicon-info-sign"></span><h6 class="links-zero">help</h6>
            </a>
        </div>
        <div v-if="auth" class="col-xs-2">
            <a class="words btn btn-sm" v-if="shareActive" @click="shareActiveFalse">
                <span class="glyphicon glyphicon-folder-open"></span><h6 class="links-zero">share</h6>
            </a>
            <a class="words btn btn-sm" v-if="!shareActive" @click="shareActiveTrue">
                <span class="glyphicon glyphicon-folder-open"></span><h6 class="links-zero">share</h6>
            </a>
        </div>
        <div class="col-xs-2">
            <a class="words btn btn-sm" title="menu" v-if="!menuActive" @click="menuActiveTrue">
                <span class="glyphicon glyphicon-menu-hamburger"></span><h6 class="links-zero">menu</h6>
            </a>
            <a class="words btn btn-sm" title="menu" v-if="menuActive" @click="menuActiveFalse">
                <span class="glyphicon glyphicon-menu-hamburger"></span><h6 class="links-zero">menu</h6>
            </a>
        </div>
    </div> 
        <mobmenu
            id="mob-menu" 
            :menuActive="menuActive"
            :auth="auth"
            :gallery="gallery"
            :blog="blog"
            :video="video"
            :profile="profile"
            :user="user"
            @galleryOpen="galleryTrue()"
            @galleryClose="galleryFalse()"
            @blogOpen="blogTrue()"
            @blogClose="blogFalse()"
            @videoOpen="videoTrue()"
            @videoClose="videoFalse()"
            @profileOpen="profileTrue()"
            @profileClose="profileFalse()"
            @userOpen="userTrue()"
            @userClose="userFalse()"
            class="visible-xs">
        </mobmenu>
        <gallerymenu
            id="mob-search" 
            :gallery="gallery"
            class="visible-xs">
        </gallerymenu>
        <blogmenu
            id="mob-search" 
            :blog="blog"
            class="visible-xs">
        </blogmenu>
        <videomenu
            id="mob-search" 
            :video="video"
            class="visible-xs">
        </videomenu>
        <profilemenu
            id="mob-search" 
            :profile="profile"
            class="visible-xs">
        </profilemenu>
        <usermenu
            id="mob-search" 
            :user="user"
            :main="main"
            :admin="admin"
            class="visible-xs">
        </usermenu>
        <div :class="{'share-order-menu': shareActive}" id="share-menu" class="col-xs-12 visible-xs">
            <div class="col-xs-3" 
                style="margin-left: -35px;">
                <a :href="'/share/card/' + profileCard.id" class="words btn btn-sm">
                    <span class="glyphicon glyphicon-share"></span><h6 class="links-zero">facebook</h6>
                </a>
            </div>
        </div>
    </div>
</template>
<script>
	export default {
        props:[
            'galleryPictures',
            'galleryHeader',
            'admin',
            'auth',
            'main',
        ],

        data () {
            return{
                showModal: false,
                menuActive: false,
                shareActive: false,
                blog: false,
                gallery: false,
                video: false,
                user: false,
                profile: false,
                profileCard: '',

            }
        },

        methods: {

        	menuActiveFalse() {
                this.menuActive = false
                this.gallery = false
                this.blog = false
                this.video = false
                this.user = false
                this.profile = false
            },

            menuActiveTrue() {
                this.menuActive = true
                this.shareActive = false
                this.gallery = false
                this.blog = false
                this.video = false
                this.user = false
                this.profile = false
            },

            shareActiveFalse() {
                this.shareActive = false
            },

            shareActiveTrue() {
                this.shareActive = true
                this.menuActive = false
                this.gallery = false
                this.blog = false
                this.video = false
                this.user = false
                this.profile = false
            },

        galleryFalse() {
            this.gallery = false
        },

        galleryTrue() {
            this.gallery = true
            this.isActive = false
            this.mediaActive = false
            this.blog = false
            this.video = false
            this.user = false
            this.profile = false
        },
        blogFalse() {
            this.blog = false
        },

        blogTrue() {
            this.blog = true
            this.isActive = false
            this.mediaActive = false
            this.gallery = false
            this.video = false
            this.user = false
            this.profile = false
        },
        videoFalse() {
            this.video = false
        },

        videoTrue() {
            this.video = true
            this.isActive = false
            this.mediaActive = false
            this.gallery = false
            this.blog = false
            this.user = false
            this.profile = false
        },
        profileFalse() {
            this.profile = false
        },

        profileTrue() {
            this.profile = true
            this.isActive = false
            this.mediaActive = false
            this.gallery = false
            this.blog = false
            this.video = false
            this.user = false
        },
        userFalse() {
            this.user = false
        },

        userTrue() {
            this.user = true
            this.isActive = false
            this.mediaActive = false
            this.gallery = false
            this.blog = false
            this.video = false
            this.profile = false
        },
        }
    }
</script>