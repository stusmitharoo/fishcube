<template>
    <v-touch v-on:swipeleft="swipeLeft" 
            v-on:swiperight="swipeRight"
            v-on:swipeup="swipeUp"
            v-on:swipedown="swipeDown">
        <div class="col-xs-12">
            <videomodal v-if="showModal" @close="showModal = false"
                video="https://s3.eu-west-2.amazonaws.com/video.fishcube.co.uk/profilepage.mp4">
            </videomodal>
            
            <div class="base-menu col-xs-12 row visible-xs">
                <div class="col-xs-1 col-xs-offset-1">
                    <a class="words btn btn-sm" v-if="mediaActive" @click="mediaActiveFalse">
                        <span class="glyphicon glyphicon-picture"></span><h6 class="links-zero">media</h6>
                    </a>
                    <a class="words btn btn-sm" v-if="!mediaActive" @click="mediaActiveTrue">
                        <span class="glyphicon glyphicon-picture"></span><h6 class="links-zero">media</h6>
                    </a>
                </div>
                <div class="col-xs-1 col-xs-offset-3">
                    <a class="words btn btn-sm" id="show-modal" @click="showModal = true" style="margin-left: 15px;">
                        <span class="glyphicon glyphicon-info-sign"></span><h6 class="links-zero">help</h6>
                    </a>
                </div>
                <div class="col-xs-1 col-xs-offset-3">
                    <a class="words btn btn-sm" title="menu" v-if="!menuActive" @click="menuActiveTrue">
                        <span class="glyphicon glyphicon-menu-hamburger"></span><h6 class="links-zero">menu</h6>
                    </a>
                    <a class="words btn btn-sm" title="menu" v-if="menuActive" @click="menuActiveFalse">
                        <span class="glyphicon glyphicon-menu-hamburger"></span><h6 class="links-zero">menu</h6>
                    </a>
                </div>
            </div>
            <div class="row hidden-xs">
                <div class="col-xs-3 ">
                    <div v-show="!private"  
                        v-for="viewProfileCard in viewProfileCards">
                        <button class="col-xs-5 margin-b  btn btn-primary btn-lg"
                            v-if="viewProfileCard.gallery_header_id">
                            <a href="'/gallery/view/show/' + viewProfileCard.gallery_header_id" class="words">
                                <span class="glyphicon glyphicon-camera"></span>
                                <h6 class="links-zero">gallery</h6>
                            </a>
                        </button>
                        <button class="col-xs-5 margin-b right  btn btn-primary btn-lg"
                            v-if="viewProfileCard.video_id">
                            <a href="'/video/views/show/' + viewProfileCard.video_id" class="words">
                                <span class="glyphicon glyphicon-play"></span>
                                <h6 class="links-zero">video</h6>
                            </a>
                        </button>
                        <button class="col-xs-5  btn btn-primary btn-lg"
                            v-if="viewProfileCard.blog_id">
                            <a :href="'/blog/view/show/' + viewProfileCard.blog_id" class="words">
                                <span class="glyphicon glyphicon-pencil"></span>
                                <h6 class="links-zero">blog</h6>
                            </a>
                        </button>
                    </div>
                </div>
                <div class="col-xs-6">
                    <viewprofilecoarsetop
                        v-if="viewDistricts"
                        v-for="viewDistrict in viewDistricts"
                        :viewDistrict="viewDistrict"
                        :pagination="viewTopMeta.pagination"
                        :card="card">
                    </viewprofilecoarsetop>
                </div>
                <div class="col-xs-3">
                    <button class="col-xs-5 margin-b right btn btn-primary btn-lg"
                        id="show-modal" title="Help" 
                        @click="showModal = true">
                        <a class="words" title="Help">
                            <span class="glyphicon glyphicon-info-sign"></span>
                            <h6 class="links-zero">help</h6>
                        </a>
                    </button>
                </div>

            </div>
                    <br>
                    <div class="row ">

                        <div class="col-xs-3 hidden-xs">
                            <viewprofileleft
                                :pagination="viewLeftMeta.pagination"
                                v-if="viewLeftMeta"
                                :card="card">
                            </viewprofileleft>

                        </div>

                        <div class="box-card col-xs-12 col-sm-6">
                            <viewprofilecards
                                :pagination="viewProfileCardMeta.pagination"
                                v-if="viewProfileCardMeta"
                                :card="card">
                            </viewprofilecards>
                        </div>

                        <div class="col-xs-3 hidden-xs">
                            <viewprofileright
                                :pagination="viewRightMeta.pagination"
                                v-if="viewRightMeta"
                                :card="card">
                            </viewprofileright>
                        </div>

                    </div>
                    <br>
                    <div class="row hidden-xs">

                        <div class="col-xs-3">
                        </div>

                        <div class="col-xs-6">
                            <viewprofilecoarsebottom
                                v-if="viewDistricts"
                                v-for="viewDistrict in viewDistricts"
                                :viewDistrict="viewDistrict"
                                :pagination="viewBottomMeta.pagination"
                                :card="card">
                            </viewprofilecoarsebottom>
                        </div>

                        <div class="col-xs-3">
                        </div>

                    </div>
                </div> 

                <!-- <viewprofilecardlefts
                    id="card-left"
                    :cardleft="cardLeft"
                    :viewCard="card">
                </viewprofilecardlefts>

                <viewprofilecardrights
                    id="card-right"
                    :cardright="cardRight"
                    :viewCard="card">
                </viewprofilecardrights>

                <viewprofilecardtops
                    id="card-top"
                    :cardtop="cardTop"
                    :viewCard="card">
                </viewprofilecardtops>

                <viewprofilecardbottoms
                    id="card-bottom"
                    :cardbottom="cardBottom"
                    :viewCard="card">
                </viewprofilecardbottoms> -->

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
                <div :class="{'media-order-menu': mediaActive}" id="media-menu" class="col-xs-12 visible-xs">
                    <div v-if="!private">
                        <div v-if="viewProfileCards" v-for="viewProfileCard in viewProfileCards" class="words" v-show="!viewProfileCard.blog_id && !viewProfileCard.video_id && !viewProfileCard.gallery_header_id">
                            <h6>no media links for this card</h6>
                        </div>
                        <a class="words col-xs-2"  style="margin-left: -20px;" v-for="viewProfileCard in viewProfileCards">
                            <a v-if="viewProfileCard.gallery_header_id" 
                                class="btn btn-sm words" 
                                :href="'/gallery/view/show/' + viewProfileCard.gallery_header_id">
                                <span class="glyphicon glyphicon-camera"></span><h6 class="links-zero">gallery</h6>
                            </a>
                        </a>
                        <div class="col-xs-2 col-xs-offset-2" v-for="viewProfileCard in viewProfileCards">
                            <a v-if="viewProfileCard.video_id" 
                                class="words btn btn-sm" 
                                :href="'/video/show/' + viewProfileCard.video_id">
                                <span class="glyphicon glyphicon-play"></span><h6 class="links-zero">video</h6>
                            </a>
                        </div>
                        <div class="col-xs-2 col-xs-offset-2" v-for="viewProfileCard in viewProfileCards">
                            <a v-if="viewProfileCard.blog_id" 
                                :href="'/blog/show/' + viewProfileCard.blog_id" 
                                class="words btn btn-sm" 
                                title="blog">
                                <span class="glyphicon glyphicon-pencil"></span>
                                <h6 class="links-zero">blog</h6>
                            </a>
                        </div>
                    </div>
                    <div v-if="private">
                        <h5 class="words">This section is private</h5>
                    </div>
                </div>

            </v-touch>
</template>
<script>
    import { mapActions, mapGetters } from 'vuex'
    import Vue2Filters from 'vue2-filters'

    export default {
        props:[
            'card',
            'auth',
            'main',
            'admin',
        ],

        data () {
            return{
                showModal: false,
                menuActive: false,
                mediaActive: false,
                private: false,
                blog: false,
                gallery: false,
                video: false,
                user: false,
                profile: false,
                cardLeft: false,
                cardRight: false,
                cardBottom: false,
                cardTop: false,
            }
        },
        
        computed: mapGetters({
            viewProfileFishBottoms: 'allViewProfileFishBottoms',
            viewProfileFishTops: 'allViewProfileFishTops',
            viewRightMeta: 'allViewRightMeta',
            viewLeftMeta: 'allViewLeftMeta',
            viewDistricts: 'allViewDistricts',
            viewTopMeta: 'allViewTopMeta',
            viewBottomMeta: 'allViewBottomMeta',
            viewProfileCardMeta: 'allViewProfileCardMeta',
            viewProfileCards: 'allViewProfileCards',
            viewProfileCards: 'allViewProfileCards',
            viewProfileFishs: 'allViewProfileFishs',
            viewDistrictLefts: 'allViewDistrictLefts',
            viewDistrictRights: 'allViewDistrictRights'
        }),

        methods: {
            ...mapActions([
                'getViewNextDistrict',
                'getViewPreviousDistrict',
                'getViewProfileCards',
                'getViewNextFish',
                'getViewPreviousFish',
            ]),

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
                this.mediaActive = false
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
            this.mediaActive = false
            this.gallery = false
            this.blog = false
            this.video = false
            this.profile = false
        },

            mediaActiveFalse() {
                this.mediaActive = false
            },

            mediaActiveTrue() {
                this.mediaActive = true
                this.menuActive = false
                this.gallery = false
                this.blog = false
                this.video = false
                this.user = false
                this.profile = false
            },

            swipeLeft(){
                // this.cardRight = true

                this.getViewNextDistrict({id:this.card[0].id, page:this.viewRightMeta.pagination.current_page})
            },

            swipeRight(){
                // this.cardLeft = true

                this.getViewPreviousDistrict({id:this.card[0].id, page:this.viewLeftMeta.pagination.current_page})
            },

            swipeUp(){
                // this.cardBottom = true
                this. getViewNextFish({profileDistrict:this.viewDistricts[0].id, style:this.viewDistricts[0].style_id, page:this.viewBottomMeta.pagination.current_page, id: this.viewProfileFishBottoms[0].user_id})
            },

            swipeDown(){
                // this.cardTop = true
                this.getViewPreviousFish({profileDistrict:this.viewDistricts[0].id, style:this.viewDistricts[0].style_id, page:this.viewTopMeta.pagination.current_page, id: this.viewProfileFishTops[0].user_id})
            },
        },

        watch: {
            viewProfileCards() {
                this.menuActive = false
                this.mediaActive = false
                this.gallery = false
                this.blog = false
                this.video = false
                this.user = false
                this.profile = false
                setTimeout(() => {
                    this.cardRight = false
                    this.cardLeft = false
                    this.cardTop = false
                    this.cardBottom = false
                },1500)
            }
        }
    }
</script>
