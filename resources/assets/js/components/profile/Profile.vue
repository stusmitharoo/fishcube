<template>
    <v-touch v-on:swipeleft="swipeLeft" 
            v-on:swiperight="swipeRight"
            v-on:swipeup="swipeUp"
            v-on:swipedown="swipeDown">  
        <div class="col-xs-12">
        <videomodal v-if="showModal" @close="showModal = false"
            video="https://s3.eu-west-2.amazonaws.com/video.fishcube.co.uk/card.mp4">
        </videomodal>
            <div class="base-menu col-xs-12 row visible-xs">
                <div class="col-xs-2" style="margin-left: -30px;">
                    <a class="words btn btn-sm" v-if="!orderActive" @click="orderActiveTrue">
                        <span class="glyphicon glyphicon-th-list"></span><h6 class="links-zero">order</h6>
                    </a>
                    <a class="words btn btn-sm" v-if="orderActive" @click="orderActiveFalse">
                        <span class="glyphicon glyphicon-th-list"></span><h6 class="links-zero">order</h6>
                    </a>
                </div>

                <div class="col-xs-2" style="margin-left: 10px;">
                    <a :href="'/profileCards/edit/' + profileCard.id" class="words btn btn-sm" v-for="profileCard in profileCards">
                        <span class="glyphicon glyphicon-edit"></span><h6 class="links-zero">Edit</h6>
                    </a> 
                </div>
                <div class="col-xs-2" style="margin-left: 5px;">
                    <a class="words btn btn-sm" id="show-modal" @click="showModal = true">
                        <span class="glyphicon glyphicon-info-sign"></span><h6 class="links-zero">help</h6>
                    </a>
                </div>
                <div class="col-xs-2" style="margin-left: 5px;">
                    <a class="words btn btn-sm" v-if="shareActive" @click="shareActiveFalse">
                        <span class="glyphicon glyphicon-folder-open"></span><h6 class="links-zero">share</h6>
                    </a>
                    <a class="words btn btn-sm" v-if="!shareActive" @click="shareActiveTrue">
                        <span class="glyphicon glyphicon-folder-open"></span><h6 class="links-zero">share</h6>
                    </a>
                </div>
                <div class="col-xs-2" style="margin-left: 5px;">
                    <a class="words btn btn-sm" v-if="mediaActive" @click="mediaActiveFalse">
                        <span class="glyphicon glyphicon-picture"></span><h6 class="links-zero">media</h6>
                    </a>
                    <a class="words btn btn-sm" v-if="!mediaActive" @click="mediaActiveTrue">
                        <span class="glyphicon glyphicon-picture"></span><h6 class="links-zero">media</h6>
                    </a>
                </div>
                <div class="col-xs-2" style="margin-left: 5px;">
                    <a class="words btn btn-sm" title="menu" v-if="!menuActive" @click="menuActiveTrue">
                        <span class="glyphicon glyphicon-menu-hamburger"></span><h6 class="links-zero">menu</h6>
                    </a>
                    <a class="words btn btn-sm" title="menu" v-if="menuActive" @click="menuActiveFalse">
                        <span class="glyphicon glyphicon-menu-hamburger"></span><h6 class="links-zero">menu</h6>
                    </a>
                </div>
            </div>
            <modal v-if="showDescription"  @close="showDescription = false">
                <h3 slot="header">Profile description</h3>
                <p slot="body" v-for="profileCard in profileCards">{{ profileCard.profile_description }}</p>
            </modal>
            <div class="row hidden-xs">
                <div class="col-xs-3">
                    <div>
                        <button class="col-xs-5 margin-b btn btn-primary btn-lg" v-for="profileCard in profileCards">
                            <a class="words" 
                                :href="'/galleryConstructor/' + profileCard.id"
                                v-if="profileCard.gallery_header_id == null">
                                <span class="glyphicon glyphicon-camera"></span>
                                <h6 class="links-zero">create</h6>
                            </a>
                            <a v-else=""
                                class="words"
                                :href="'/gallery/view/show/' + profileCard.gallery_header_id">
                                <span class="glyphicon glyphicon-camera"></span>
                                <h6 class="links-zero">view</h6>
                            </a>
                        </button>
                        <button class="col-xs-5 margin-b right btn btn-primary btn-lg" v-for="profileCard in profileCards">
                            <a v-if="profileCard.video_id == null" 
                                class="words" 
                                :href="'/video/create/card/' + profileCard.id">
                                    <span class="glyphicon glyphicon-play"></span>
                                    <h6 class="links-zero">create</h6>
                                </a>
                                <a v-else="" 
                                    class="words" 
                                    :href="'/video/show/' + profileCard.video_id">
                                    <span class="glyphicon glyphicon-play"></span><h6 class="links-zero">watch</h6>
                                </a>
                        </button>
                        <button class="col-xs-5 btn btn-primary btn-lg" v-for="profileCard in profileCards">
                            <a v-if="profileCard.blog_id == null" 
                                class="words" 
                                :href="'/blog/create/card/' + profileCard.id">
                                    <span class="glyphicon glyphicon-pencil"></span>
                                    <h6 class="links-zero">create</h6>
                                </a>
                                <a v-else="" 
                                    class="words" 
                                    :href="'/blog/show/' + profileCard.blog_id">
                                    <span class="glyphicon glyphicon-pencil"></span><h6 class="links-zero">read</h6>
                                </a>
                        </button>
                        <button class="col-xs-5 margin-b right btn btn-primary btn-lg" v-for="profileCard in profileCards">
                            <a :href="'/profileCards/edit/' + profileCard.id"
                                class="words">
                                <span class="glyphicon glyphicon-edit"></span><h6 class="links-zero">edit</h6>
                            </a>
                        </button>
                    </div>
                </div>
                <div class="col-xs-6">
                    <profilecoarsetop
                        v-if="districts"
                        v-for="district in districts"
                        :district="district"
                        :pagination="topMeta.pagination">
                    </profilecoarsetop>
                </div>
                <div class="col-xs-3">
                    <button class="col-xs-5 btn btn-primary btn-lg margin-b"
                        id="show-descripton" 
                        @click="showDescription = true">
                            <a class="words">
                                <span title="Private Description" class="glyphicon glyphicon-folder-open"></span>
                                <h6 class="links-zero">descript..</h6>
                            </a>
                    </button>
                    <button class="col-xs-5 btn btn-primary btn-lg right margin-b"
                        id="show-modal" 
                        @click="showModal = true">
                            <a class="words" title="Help">
                                <span class="glyphicon glyphicon-info-sign"></span>
                                <h6 class="links-zero">help</h6>
                            </a>
                    </button>
                    <button class="col-xs-5 btn btn-primary btn-lg">
                            <a href="/orderFish" title="Order Fish" class="words">
                                <span class="glyphicon glyphicon-th-list"></span>
                                <h6 class="links-zero">fish</h6>
                            </a>
                    </button>
                    <button class="col-xs-5 btn btn-primary btn-lg right">
                            <a href="/orderDistrict" title="Order Districts" class="words">
                                <span class="glyphicon glyphicon-list"></span>
                                <h6 class="links-zero">location</h6>
                            </a>
                    </button>
                </div>

            </div>
                    <br>
                    <div class="row ">

                        <div class="col-xs-3 hidden-xs">
                            <profileleft
                                :pagination="leftMeta.pagination"
                                v-if="leftMeta">
                            </profileleft>

                        </div>

                        <div class="box-card col-xs-12 col-sm-6">
                            <profilecards
                                :pagination="profileCardMeta.pagination"
                                v-if="profileCardMeta">

                            </profilecards>
                        </div>

                        <div class="col-xs-3 hidden-xs">
                            <profileright
                                :pagination="rightMeta.pagination"
                                v-if="rightMeta"></profileright>
                        </div>

                    </div>
                    <br>
                    <div class="row hidden-xs">

                        <div class="col-xs-3">
                        </div>

                        <div class="col-xs-6">
                            <profilecoarsebottom
                                v-if="districts"
                                v-for="district in districts"
                                :district="district"
                                :pagination="bottomMeta.pagination">
                            </profilecoarsebottom>
                        </div>

                        <div class="col-xs-3">
                        </div>

                    </div>
                   <!--  <div class="visible-xs">
                        <profilecardtop
                            id="card-top"
                            :cardtop="cardtop">
                        </profilecardtop>
                        <profilecardbottom
                            id="card-bottom"
                            :cardbottom="cardbottom">
                        </profilecardbottom>
                        <profilecardleft
                            id="card-left"
                            :cardleft="cardleft">
                        </profilecardleft>
                        <profilecardright
                            id="card-right"
                            :cardright="cardright">
                        </profilecardright>
                    </div> -->
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
                    <div :class="{'active-order-menu': orderActive}" id="order-menu" class="col-xs-12 visible-xs">
                        <div class="col-xs-6" style="margin-left: -15px;">
                            <a href="/orderFish" class="words btn btn-sm">
                                <span class="glyphicon glyphicon-th-list"></span><h6 class="links-zero">fish</h6>
                            </a>
                        </div>
                        <div class="col-xs-6" style="margin-left: 10px;">
                            <a href="/orderDistrict" class="words btn btn-sm">
                                <span class="glyphicon glyphicon-list"></span><h6 class="links-zero">location</h6>
                            </a>
                        </div>
                    </div>
                    <div :class="{'share-order-menu': shareActive}" id="share-menu" class="col-xs-12 visible-xs">
                        <div class="col-xs-3" 
                            v-for="profileCard in profileCards" 
                            style="margin-left: -35px;">
                            <a :href="'/share/card/' + profileCard.id" class="words btn btn-sm">
                                <span class="glyphicon glyphicon-share"></span><h6 class="links-zero">facebook</h6>
                            </a>
                        </div>
                        <div class="col-xs-3 col-xs-offset-2">
                            <a class="words btn btn-sm" id="show-modal" @click="showDescription = true">
                                <span class="glyphicon glyphicon-folder-open"></span><h6 class="links-zero">display description</h6>
                            </a>
                        </div>
                    </div>
                    <div :class="{'media-order-menu': mediaActive}" id="media-menu" class="col-xs-12 visible-xs">
                        <div class="col-xs-2" style="margin-left: -20px;"
                            v-for="profileCard in profileCards">
                            <a class="btn btn-sm words" 
                                :href="'/galleryConstructor/' + profileCard.id"
                                v-if="profileCard.gallery_header_id == null">
                                <span class="glyphicon glyphicon-camera"></span><h6 class="links-zero">create</h6>
                            </a>
                            <a v-else="" 
                                class="btn btn-sm words" 
                                :href="'/gallery/flip/' + profileCard.gallery_header_id">
                                <span class="glyphicon glyphicon-camera"></span><h6 class="links-zero">view</h6>
                            </a>
                        </div>
                        <div class="col-xs-2 col-xs-offset-1"
                            v-for="profileCard in profileCards">
                            <a class="words btn btn-sm" 
                                :href="'/video/create/card/' + profileCard.id"
                                v-if="profileCard.video_id == null">
                                <span class="glyphicon glyphicon-play"></span><h6 class="links-zero">create</h6>
                            </a>
                            <a v-else="" 
                                class="words btn btn-sm" 
                                :href="'/video/show/' + profileCard.video_id">
                                <span class="glyphicon glyphicon-play"></span>
                                <h6 class="links-zero">watch</h6>
                            </a>
                        </div>
                        <div class="col-xs-2 col-xs-offset-2" 
                            v-for="profileCard in profileCards" >
                            <a v-if="profileCard.blog_id == null" 
                                class="words btn btn-sm" 
                                :href="'/blog/create/card/' + profileCard.id">
                                <span class="glyphicon glyphicon-pencil"></span><h6 class="links-zero">create</h6>
                            </a>
                            <a v-else="" 
                                class="words btn btn-sm" 
                                :href="'/blog/show/' + profileCard.blog_id">
                                <span class="glyphicon glyphicon-pencil"></span><h6 class="links-zero">read</h6>
                            </a>
                        </div>
                    </div>

                </div>

            </v-touch>
</template>
<script>
    import { mapActions, mapGetters } from 'vuex'
    import Vue2Filters from 'vue2-filters'

    export default {
        props:[
            'auth',
            'main',
            'admin',
        ],

        data () {
            return{
                showModal: false,
                showDescription: false,
                menuActive: false,
                orderActive: false,
                shareActive: false,
                mediaActive: false,
                blog: false,
                gallery: false,
                video: false,
                user: false,
                profile: false,
                cardtop: false,
                cardbottom: false,
                cardleft: false,
                cardright: false,

            }
        },
        computed: mapGetters({
            profileFishBottoms: 'allProfileFishBottoms',
            profileFishTops: 'allProfileFishTops',
            rightMeta: 'allRightMeta',
            leftMeta: 'allLeftMeta',
            districts: 'allDistricts',
            topMeta: 'allTopMeta',
            bottomMeta: 'allBottomMeta',
            profileCardMeta: 'allProfileCardMeta',
            profileCards: 'allProfileCards',
            profileFishs: 'allProfileFishs',
        }),
        methods: {
            ...mapActions([
                'getProfileCards',
                'getNextFish',
                'getPreviousFish',
                'getNextDistrict',
                'getPreviousDistrict',
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
                this.orderActive = false
                this.shareActive = false
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
                this.orderActive = false
                this.shareActive = false
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
                this.orderActive = false
                this.shareActive = false
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
                this.orderActive = false
                this.shareActive = false
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
                this.orderActive = false
                this.shareActive = false
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
                this.orderActive = false
                this.shareActive = false
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
                this.orderActive = false
                this.shareActive = false
                this.menuActive = false
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
                this.orderActive = false
                this.menuActive = false
                this.mediaActive = false
                this.gallery = false
                this.blog = false
                this.video = false
                this.user = false
                this.profile = false
            },

            orderActiveFalse() {
                this.orderActive = false
            },

            orderActiveTrue() {
                this.orderActive = true
                this.menuActive = false
                this.shareActive = false
                this.mediaActive = false
                this.gallery = false
                this.blog = false
                this.video = false
                this.user = false
                this.profile = false
            },

            swipeLeft(){
                // this.cardright = true
                this.getNextDistrict(this.rightMeta.pagination.current_page)
            },
            swipeRight(){
                // this.cardleft = true
                this.getPreviousDistrict(this.leftMeta.pagination.current_page)
            },
            swipeUp(){
                // this.cardbottom = true
                this. getNextFish({profileDistrict:this.districts[0].id, style:this.districts[0].style_id, page:this.bottomMeta.pagination.current_page})
            },
            swipeDown(){ 
                // this.cardtop = true
                this.getPreviousFish({profileDistrict:this.districts[0].id, style:this.districts[0].style_id, page:this.topMeta.pagination.current_page})
            }
        },

        // watch: {
        //     profileCards() {
        //         setTimeout(()=>{
        //             this.cardright = false
        //             this.cardleft = false
        //         },1000) 
        //         setTimeout(()=>{
        //             this.cardtop = false
        //             this.cardbottom = false
        //         },1500) 
        //     }
        // }
    }
</script>
