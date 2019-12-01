<template>
    <v-touch v-on:swipeleft="districtRightClick" 
            v-on:swiperight="districtLeftClick" 
            v-on:swipeup="fishBottomClick" 
            v-on:swipedown="fishTopClick"> 
        <div class="col-xs-12 ">
        <videomodal v-if="showModal" @close="showModal = false"
            video="https://s3.eu-west-2.amazonaws.com/video.fishcube.co.uk/profilepage.mp4">
        </videomodal>
            <div class="base-menu col-xs-12 row visible-xs">
                <div class="col-xs-2" style="margin-left: -30px;">
                    <a v-if="water.id == 1 || water.id == 2" href="/map/district" class="words btn btn-sm" title="stillwater map">
                        <span class="glyphicon glyphicon-map-marker"></span>
                        <h6 class="links-zero">map</h6>
                    </a>
                    <a v-if="water.id == 3 || water.id == 4 || waterid == 7" href="/map/river" class="words btn btn-sm" title="river map">
                        <span class="glyphicon glyphicon-map-marker"></span>
                        <h6 class="links-zero">map</h6>
                    </a>
                    <a v-if="water.id == 5 || water.id == 6" href="/map/canal" class="words btn btn-sm" title="canal map">
                        <span class="glyphicon glyphicon-map-marker"></span>
                        <h6 class="links-zero">map</h6>
                    </a>
                    <a v-if="water.id == 8" href="/map/district" class="words btn btn-sm" title="sea map">
                        <span class="glyphicon glyphicon-map-marker"></span>
                        <h6 class="links-zero">map</h6>
                    </a>
                </div>
                <div class="col-xs-2">
                    <a class="words btn btn-sm" v-if="!isActive" @click="isActiveTrue">
                        <span class="glyphicon glyphicon-search"></span>
                        <h6 class="links-zero">search</h6>
                    </a>
                    <a class="words btn btn-sm" v-if="isActive" @click="isActiveFalse">
                        <span class="glyphicon glyphicon-search"></span>
                        <h6 class="links-zero">search</h6>
                    </a>
                </div>
                <div class="col-xs-2" style="margin-left: 10px;">
                    <a class="words btn btn-sm" id="show-modal" @click="showModal = true">
                        <span class="glyphicon glyphicon-info-sign"></span>
                        <h6 class="links-zero">help</h6>
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
                <div v-if="private" v-for="card in cards" class="col-xs-2">
                    <a :href="'/profileView/' + card.user_id" class="words btn btn-sm">
                        <span class="glyphicon glyphicon-user"></span><h6 class="links-zero">profile</h6>
                    </a>
                </div>
                <div class="col-xs-2" style="margin-left: 10px;">
                    <a class="words btn btn-sm" title="menu" v-if="!menuActive" @click="menuActiveTrue">
                        <span class="glyphicon glyphicon-menu-hamburger"></span><h6 class="links-zero">menu</h6>
                    </a>
                    <a class="words btn btn-sm" title="menu" v-if="menuActive" @click="menuActiveFalse">
                        <span class="glyphicon glyphicon-menu-hamburger"></span><h6 class="links-zero">menu</h6>
                    </a>
                </div>
            </div>
            <div class="row hidden-xs"> 
                <div class="col-sm-3">
                        <label class="words">Location</label>
                        <input 
                                placeholder="Type Here ..." 
                                type="text"
                                id="districts"
                                name="districts" 
                                class="col-xs-10 form-control margin-b">
                    <div v-for="card in cards" v-show="private
                    ">
                        <div class="col-xs-5 margin-b">
                            <a v-if="card.gallery_header_id" 
                                href="'/gallery/view/show/' + card.gallery_header_id" 
                                class="words btn btn-primary btn-sm" 
                                title="galleryp">
                                <span class="glyphicon glyphicon-camera"></span>
                                <h6 class="links-zero">gallery</h6>
                            </a>
                            <div v-else="" style="margin-bottom:43px;"></div>
                        </div>
                        <div v-for="card in cards" class="col-xs-5 right margin-b">
                            <a :href="'/profileView/' + card.user_id" 
                                class="words btn btn-primary btn-sm">
                                <span class="glyphicon glyphicon-user" style="padding: 0px 2px;"></span><h6 class="links-zero">profile</h6>
                            </a>
                        </div>
                        <div class="col-xs-5">
                            <a v-if="card.video_id" 
                                href="'/video/views/show/' + card.video_id" 
                                class="words btn btn-primary btn-sm" 
                                title="video">
                                <span class="glyphicon glyphicon-play"></span>
                                <h6 class="links-zero">video</h6>
                            </a>
                        </div>
                        <div class="col-xs-5 right" v-for="card in cards">
                            <a v-if="card.blog_id" 
                                :href="'/blog/view/show/' + card.blog_id" 
                                class="words btn btn-primary btn-sm" 
                                title="blog">
                                <span class="glyphicon glyphicon-pencil"></span>
                                <h6 class="links-zero">blog</h6>
                            </a>
                        </div>
                    </div>
                </div>       
                <div class="col-sm-6 hidden-xs">
                    <waterfishtop 
                        @click="fishTopClick"
                        :fishTop="fishTop"
                        :water="water">
                    </waterfishtop>
                </div>
                <div class="col-xs-3 hidden-xs">
                        <label class="words col-xs-8">Species</label>
                        <input 
                                placeholder="Type Here ..." 
                                type="text"
                                id="fishs"
                                name="fishs" 
                                class="col-xs-10 form-control margin-b">
                    
                    <div class="col-xs-5 margin-b">
                        <a href="/species/coarsefish" class="words btn btn-primary btn-sm" title="fish identification"><span class="glyphicon glyphicon-play"><h6 class="links-zero">spec.</h6></span></a>
                    </div>
                    <div class="col-xs-5 right margin-b">
                        <button class="words btn btn-primary btn-sm" title="Help" id="show-modal" @click="showModal = true">
                            <span class="glyphicon glyphicon-info-sign"></span>
                            <h6 class="links-zero">help</h6>
                        </button>
                    </div>
                </div>
                        
            </div>
            <br>
            <div class="row ">   

                    <div class="col-sm-3 hidden-xs">
                        <waterdistrictleft 
                            @click="districtLeftClick"
                            :water="water"
                            :districtLeft="districtLeft">
                        </waterdistrictleft>
                    </div>

                        <div class="box-card col-sm-6 col-xs-12">
                            <watercards
                                v-if="cardMeta && cards"
                                v-for="card in cards"
                                :card="card"
                                :fish="fish"
                                :district="district"
                                :water="water"
                                :pagination="cardMeta.pagination"
                                @next="next()"
                                @previous="previous()">
                            </watercards>
                            <div v-show="cards.length < 1">
                                <div class="row">
                                    <img 
                                        class="img-responsive image-card image-corners" 
                                        :src="'/images/index/defualt.jpg'">
                                </div>
                                <div class="box-text-top col-xs-12">
                                    <h5>
                                        <p class="words" v-if="fish">
                                            {{ fish.name | capitalize }}
                                        </p>
                                    </h5>
                                </div>
                                <div class="box-text-top col-xs-12">
                                    <h5 class="words">
                                        <p class="words" v-if="district">
                                            {{ district.name | capitalize }}
                                        </p>
                                    </h5>
                                </div>
                                <div class="margin-b box-text-top col-xs-12">
                                     <h5 class="words">No Data for this location and species</h5>
                                </div>
                                    <nav aria-label="...">
                                      <ul class="pager">
                                        <li class="previous">
                                            <a class="words" href="#" @click.prevent="getCards({payload: payload, page: 1})">
                                                <span aria-hidden="true">&larr;</span> First
                                            </a>
                                        </li>
                                      </ul>
                                    </nav>
                                </div>
                        </div>
                        <div class="col-sm-3 hidden-xs">
                            <waterdistrictright 
                                @click="districtRightClick"
                                :water="water"
                                :districtRight="districtRight">
                            </waterdistrictright>
                        </div>
                    </div>
                    <br>
                        
                    <div class="row hidden-xs">   

                        <div class="col-sm-3">
                        </div>

                        <div class="col-sm-6">
                            <waterfishbottom 
                                @click="fishBottomClick"
                                :water="water"
                                :fishBottom="fishBottom">   
                            </waterfishbottom>
                        </div>

                        <div class="col-sm-3">
                        </div>

                    </div>
                    <div class="visible-xs">
                        <watercardtop
                            id="card-top"
                            :waterCardTop="waterCardTop"
                            :fishTop="fishTop"
                            :district="district"
                            :cardtop="cardtop">
                        </watercardtop>
                        <watercardbottom
                            id="card-bottom"
                            :waterCardBottom="waterCardBottom"
                            :fishBottom="fishBottom"
                            :district="district"
                            :cardbottom="cardbottom">
                        </watercardbottom>
                        <watercardleft
                            id="card-left"
                            :waterCardLeft="waterCardLeft"
                            :fish="fish"
                            :districtLeft="districtLeft"
                            :cardleft="cardleft">
                        </watercardleft>
                        <watercardright
                            id="card-right"
                            :waterCardRight="waterCardRight"
                            :fish="fish"
                            :districtRight="districtRight"
                            :cardright="cardright">
                        </watercardright>
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
                    <watermobsearch
                        id="mob-search"
                        :isActive="isActive"
                        :water="water"
                        class="visible-xs">
                    </watermobsearch>
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
                    <div :class="{'media-order-menu': mediaActive}" 
                        id="media-menu" 
                        class="visible-xs row"
                        v-for="card in cards" >
                        <div class="words" v-if="!card.blog_id && !card.video_id && !card.gallery_header_id">
                            <h6>no media links for this card</h6>
                        </div>
                        <div v-if="private" class="row">
                            <div class="words col-xs-2">
                                <a v-if="card.gallery_header_id" 
                                    class="btn btn-sm words" 
                                    :href="'/gallery/view/show/' + card.gallery_header_id">
                                    <span class="glyphicon glyphicon-camera"></span>
                                    <h6 class="links-zero">gallery</h6>
                                </a>
                            </div>
                            <div class="words col-xs-2 col-xs-offset-1">
                                <a v-if="card.video_id" 
                                    class="words btn btn-sm" 
                                    :href="'/video/views/show/' + card.video_id">
                                    <span class="glyphicon glyphicon-play"></span>
                                    <h6 class="links-zero">video</h6>
                                </a>
                            </div>
                            <div class="words col-xs-2 col-xs-offset-1">
                                <a v-if="card.blog_id" 
                                    :href="'/blog/view/show/' + card.blog_id" 
                                    class="words btn btn-sm" 
                                    title="blog">
                                    <span class="glyphicon glyphicon-pencil"></span>
                                    <h6 class="links-zero">blog</h6>
                                </a>
                            </div>
                        </div>
                        <div v-if="!private" class="col-xs-12">
                            <h4 class="words">This section is private</h4>
                        </div>
                    </div>
                </div>
            </v-touch>
</template>

<script>
import { mapActions, mapGetters } from 'vuex'
import { stillwaterautocomplete } from '../helpers/stillwaterautocomplete.js'
import { stillwaterlureautocomplete } from '../helpers/stillwaterlureautocomplete.js'
import { riverautocomplete } from '../helpers/riverautocomplete.js'
import { riverlureautocomplete } from '../helpers/riverlureautocomplete.js'
import { canalautocomplete } from '../helpers/canalautocomplete.js'
import { canallureautocomplete } from '../helpers/canallureautocomplete.js'
import { seaboatautocomplete } from '../helpers/seaboatautocomplete.js'
import { seashoreautocomplete } from '../helpers/seashoreautocomplete.js'
import { coarsefishautocomplete } from '../helpers/coarsefishautocomplete.js'
import { seafishautocomplete } from '../helpers/seafishautocomplete.js'
import Vue2Filters from 'vue2-filters'


    export default {
        props: [
            'auth',
            'water',
            'main',
            'admin',
        ],
          data () {
            return{
                payload: null,
                payloadleft: null,
                payloadright: null,
                payloadtop: null,
                payloadbottom: null,
                showModal: false,
                isActive: false,
                menuActive: false,
                fish: null,
                fishTop: null,
                fishBottom: null,
                districtLeft: null,
                districtRight: null,
                district: null,
                private: false,
                mediaActive: false,
                blog: false,
                gallery: false,
                video: false,
                user: false,
                profile: false,
                waterCardTop: null,
                waterCardBottom: null,
                waterCardLeft: null,
                waterCardRight: null,
                cardtop: false,
                cardbottom: false,
                cardleft: false,
                cardright: false,

            }
        },
    computed: mapGetters({
        cards: 'allCards',
        cardMeta: 'allCardMeta',
        waterCardTops: 'allWaterCardTops',
        waterCardBottoms: 'allWaterCardBottoms',
        waterCardLefts: 'allWaterCardLefts',
        waterCardRights: 'allWaterCardRights',
        //coarsefish
        coarseFishs: 'allCoarseFishs',
        coarseFishTops: 'allCoarseFishTops',
        coarseFishBottoms: 'allCoarseFishBottoms',
        //seafish
        seaFishs: 'allSeaFishs',
        seaFishTops: 'allSeaFishTops',
        seaFishBottoms: 'allSeaFishBottoms',
        //stillwater
        stillwaterPages: 'allStillwaterPages',
        stillwaterPageRights: 'allStillwaterPageRights',
        stillwaterPageLefts: 'allStillwaterPageLefts',
         //stillwaterLure
        stillwaterLurePages: 'allStillwaterLurePages',
        stillwaterLurePageRights: 'allStillwaterLurePageRights',
        stillwaterLurePageLefts: 'allStillwaterLurePageLefts',
         //river
        riverPages: 'allRiverPages',
        riverPageRights: 'allRiverPageRights',
        riverPageLefts: 'allRiverPageLefts',
         //riverLure
        riverLurePages: 'allRiverLurePages',
        riverLurePageRights: 'allRiverLurePageRights',
        riverLurePageLefts: 'allRiverLurePageLefts',
         //canal
        canalPages: 'allCanalPages',
        canalPageRights: 'allCanalPageRights',
        canalPageLefts: 'allCanalPageLefts',
         //canalLure
        canalLurePages: 'allCanalLurePages',
        canalLurePageRights: 'allCanalLurePageRights',
        canalLurePageLefts: 'allCanalLurePageLefts',
         //SeaBoat
        seaBoatPages: 'allSeaBoatPages',
        seaBoatPageRights: 'allSeaBoatPageRights',
        seaBoatPageLefts: 'allSeaBoatPageLefts',
        //SeaShore
        seaShorePages: 'allSeaShorePages',
        seaShorePageRights: 'allSeaShorePageRights',
        seaShorePageLefts: 'allSeaShorePageLefts',
    }),
    methods: {
        ...mapActions([
            'getCards',
            'getWaterCardTops',
            'getWaterCardBottoms',
            'getWaterCardLefts',
            'getWaterCardRights',
            // coarseFish
            'getCoarseFishs',
            'getCoarseFishTops',
            'getCoarseFishBottoms',
            'getNextCoarseFish',
            'getPreviousCoarseFish',
            'getThreeCoarseFishs',
            // seaFish
            'getSeaFishs',
            'getSeaFishTops',
            'getSeaFishBottoms',
            'getNextSeaFish',
            'getPreviousSeaFish',
            'getThreeSeaFishs',
            //stillwater
            'getStillwaterPages',
            'getStillwaterPageLefts',
            'getStillwaterPageRights',
            'getThreeStillwaterCoarseFishs',
            'getThreeStillwaters',
            'getNextDistrictStillwater',
            'getPreviousDistrictStillwater',
            //stillwaterLure
            'getStillwaterLurePages',
            'getStillwaterLurePageLefts',
            'getStillwaterLurePageRights',
            'getThreeStillwaterLureFishs',
            'getThreeStillwaterLures',
            'getNextDistrictStillwaterLure',
            'getPreviousDistrictStillwaterLure',
            //River
            'getRiverPages',
            'getRiverPageLefts',
            'getRiverPageRights',
            'getThreeRiverFishs',
            'getThreeRivers',
            'getNextDistrictRiver',
            'getPreviousDistrictRiver',
            //RiverLure
            'getRiverLurePages',
            'getRiverLurePageLefts',
            'getRiverLurePageRights',
            'getThreeRiverLureFishs',
            'getThreeRiverLures',
            'getNextDistrictRiverLure',
            'getPreviousDistrictRiverLure',
            //Canal
            'getCanalPages',
            'getCanalPageLefts',
            'getCanalPageRights',
            'getThreeCanalFishs',
            'getThreeCanals',
            'getNextDistrictCanal',
            'getPreviousDistrictCanal',
            //CanalLure
            'getCanalLurePages',
            'getCanalLurePageLefts',
            'getCanalLurePageRights',
            'getThreeCanalLureFishs',
            'getThreeCanalLures',
            'getNextDistrictCanalLure',
            'getPreviousDistrictCanalLure',
            //SeaBoat
            'getSeaBoatPages',
            'getSeaBoatPageLefts',
            'getSeaBoatPageRights',
            'getThreeSeaBoatFishs',
            'getThreeSeaBoats',
            'getNextDistrictSeaBoat',
            'getPreviousDistrictSeaBoat',
            //SeaShore
            'getSeaShorePages',
            'getSeaShorePageLefts',
            'getSeaShorePageRights',
            'getThreeSeaShoreFishs',
            'getThreeSeaShores',
            'getNextDistrictSeaShore',
            'getPreviousDistrictSeaShore',
        ]),

        next() {
            this.getCards({payload: this.payload, page: this.cardMeta.pagination.current_page+1})
        },

        previous() {
            this.getCards({payload: this.payload, page: this.cardMeta.pagination.current_page-1})
        },

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
            this.isActive = false
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

        isActiveFalse() {
            this.isActive = false
        },

        isActiveTrue() {
            this.isActive = true
            this.menuActive = false
            this.mediaActive = false
            this.gallery = false
            this.blog = false
            this.video = false
            this.user = false
            this.profile = false
        },

        mediaActiveFalse() {
            this.mediaActive = false
        },

        mediaActiveTrue() {
            this.mediaActive = true
            this.isActive = false
            this.menuActive = false
            this.gallery = false
            this.blog = false
            this.video = false
            this.user = false
            this.profile = false
        },

        districtRightClick() {
            // this.cardright = true
                if(this.water.id === 1) {
                    this.getNextDistrictStillwater(this.districtRight.id)
                }
                if(this.water.id === 2) {
                    this.getNextDistrictStillwaterLure(this.districtRight.id)
                }
                if(this.water.id === 3) {
                    this.getNextDistrictRiver(this.districtRight.id)
                }
                if(this.water.id === 4) {
                    this.getNextDistrictRiverLure(this.districtRight.id)
                }
                if(this.water.id === 5) {
                    this.getNextDistrictCanal(this.districtRight.id)
                }
                if(this.water.id === 6) {
                    this.getNextDistrictCanalLure(this.districtRight.id)
                }
                if(this.water.id === 7) {
                    this.getNextDistrictSeaBoat(this.districtRight.id)
                }
                if(this.water.id === 8) {
                    this.getNextDistrictSeaShore(this.districtRight.id)
                }
            },
        districtLeftClick(){
            // this.cardleft = true
                if(this.water.id === 1) {
                    this.getPreviousDistrictStillwater(this.districtLeft.id)
                }
                if(this.water.id === 2) {
                    this.getPreviousDistrictStillwaterLure(this.districtLeft.id)
                }
                if(this.water.id === 3) {
                    this.getPreviousDistrictRiver(this.districtLeft.id)
                }
                if(this.water.id === 4) {
                    this.getPreviousDistrictRiverLure(this.districtLeft.id)
                }
                if(this.water.id === 5) {
                    this.getPreviousDistrictCanal(this.districtLeft.id)
                }
                if(this.water.id === 6) {
                    this.getPreviousDistrictCanalLure(this.districtLeft.id)
                }
                if(this.water.id === 7) {
                    this.getPreviousDistrictSeaBoat(this.districtLeft.id)
                }
                if(this.water.id === 8) {
                    this.getPreviousDistrictSeaShore(this.districtLeft.id)
                }
        },
        fishBottomClick(){
            // this.cardbottom = true
                if(this.water.id <= 6) {
                this.getNextCoarseFish(this.fishBottom.id)
                }
                if(this.water.id > 6) {
                    this.getNextSeaFish(this.fishBottom.id)
                }

        },
        fishTopClick(){
            // this.cardtop = true
                if(this.water.id <= 6) {
                this.getPreviousCoarseFish(this.fishTop.id)
                }
                if(this.water.id > 6) {
                    this.getPreviousSeaFish(this.fishTop.id)
                }

        },

        gettingAllCards() {
            if(!this.fish && !this.district) return
            setTimeout(() => {
                this.payloadleft = {fish:this.fish.id, district:this.districtLeft.id, style:this.water.id}
                this.payloadright = {fish:this.fish.id, district:this.districtRight.id, style:this.water.id}
                this.payloadtop = {fish:this.fishTop.id, district:this.district.id, style:this.water.id}
                this.payloadbottom = {fish:this.fishBottom.id, district:this.district.id, style:this.water.id}
                this.getWaterCardLefts({payload: this.payloadleft, page: 1})
                this.getWaterCardRights({payload: this.payloadright, page: 1})
                this.getWaterCardTops({payload: this.payloadtop, page: 1})
                this.getWaterCardBottoms({payload: this.payloadbottom, page: 1})
            },1000)
        }
    },

    created() {
        if(this.water.id === 1) {
            this.payload = ({fish: 21, district: 86, style: this.water.id})
            this.payloadleft = ({fish: 21, district: 85, style: this.water.id})
            this.payloadright = ({fish: 21, district: 87, style: this.water.id})
            this.payloadtop = ({fish: 20, district: 86, style: this.water.id})
            this.payloadbottom = ({fish: 22, district: 86, style: this.water.id})
            this.getStillwaterPageLefts(85)
            this.getStillwaterPages(86)
            this.getCoarseFishTops(20)
            this.getCoarseFishs(21)
            this.getCoarseFishBottoms(22)
            this.getStillwaterPageRights(87)
            this.getCards({payload: this.payload, page: 1})
            this.getWaterCardLefts({payload: this.payloadleft, page: 1})
            this.getWaterCardRights({payload: this.payloadright, page: 1})
            this.getWaterCardTops({payload: this.payloadtop, page: 1})
            this.getWaterCardBottoms({payload: this.payloadbottom, page: 1})
        }
        if(this.water.id === 2) {
            this.payload = ({fish: 2, district: 91, style: this.water.id})
            this.payloadleft = ({fish: 2, district: 90, style: this.water.id})
            this.payloadright = ({fish: 2, district: 92, style: this.water.id})
            this.payloadtop = ({fish: 1, district: 91, style: this.water.id})
            this.payloadbottom = ({fish: 3, district: 91, style: this.water.id})
            this.getStillwaterLurePageLefts(90)
            this.getStillwaterLurePages(91)
            this.getCoarseFishTops(1)
            this.getCoarseFishs(2)
            this.getCoarseFishBottoms(3)
            this.getStillwaterLurePageRights(92)
            this.getCards({payload: this.payload, page: 1})
            this.getWaterCardLefts({payload: this.payloadleft, page: 1})
            this.getWaterCardRights({payload: this.payloadright, page: 1})
            this.getWaterCardTops({payload: this.payloadtop, page: 1})
            this.getWaterCardBottoms({payload: this.payloadbottom, page: 1})
        }
        if(this.water.id === 3) {
            this.payload = ({fish: 9, district: 1461, style: this.water.id})
            this.payloadleft = ({fish: 9, district: 1460, style: this.water.id})
            this.payloadright = ({fish: 9, district: 1462, style: this.water.id})
            this.payloadtop = ({fish: 8, district: 1461, style: this.water.id})
            this.payloadbottom = ({fish: 10, district: 1461, style: this.water.id})
            this.getRiverPageLefts(1460)
            this.getRiverPages(1461)
            this.getCoarseFishTops(8)
            this.getCoarseFishs(9)
            this.getCoarseFishBottoms(10)
            this.getRiverPageRights(1462)
            this.getCards({payload: this.payload, page: 1})
            this.getWaterCardLefts({payload: this.payloadleft, page: 1})
            this.getWaterCardRights({payload: this.payloadright, page: 1})
            this.getWaterCardTops({payload: this.payloadtop, page: 1})
            this.getWaterCardBottoms({payload: this.payloadbottom, page: 1})
        }
        if(this.water.id === 4) {  
            this.payload = ({fish: 4, district: 1317, style: this.water.id})
            this.payloadleft = ({fish: 4, district: 1316, style: this.water.id})
            this.payloadright = ({fish: 4, district: 1318, style: this.water.id})
            this.payloadtop = ({fish: 3, district: 1317, style: this.water.id})
            this.payloadbottom = ({fish: 5, district: 1317, style: this.water.id})
            this.getRiverLurePageLefts(1316)
            this.getRiverLurePages(1317)
            this.getCoarseFishTops(3)
            this.getCoarseFishs(4)
            this.getCoarseFishBottoms(5)
            this.getRiverLurePageRights(1318)
            this.getCards({payload: this.payload, page: 1})
            this.getWaterCardLefts({payload: this.payloadleft, page: 1})
            this.getWaterCardRights({payload: this.payloadright, page: 1})
            this.getWaterCardTops({payload: this.payloadtop, page: 1})
            this.getWaterCardBottoms({payload: this.payloadbottom, page: 1})
        }
        if(this.water.id === 5) {
            this.payload = ({fish: 38, district: 9, style: this.water.id})
            this.payloadleft = ({fish: 38, district: 8, style: this.water.id})
            this.payloadright = ({fish: 38, district: 10, style: this.water.id})
            this.payloadtop = ({fish: 37, district: 9, style: this.water.id})
            this.payloadbottom = ({fish: 39, district: 9, style: this.water.id})
            this.getCanalPageLefts(8)
            this.getCanalPages(9)
            this.getCoarseFishTops(37)
            this.getCoarseFishs(38)
            this.getCoarseFishBottoms(39)
            this.getCanalPageRights(10)
            this.getCards({payload: this.payload, page: 1})
            this.getWaterCardLefts({payload: this.payloadleft, page: 1})
            this.getWaterCardRights({payload: this.payloadright, page: 1})
            this.getWaterCardTops({payload: this.payloadtop, page: 1})
            this.getWaterCardBottoms({payload: this.payloadbottom, page: 1})
        }
        if(this.water.id === 6) {
            this.payload = ({fish: 12, district: 170, style: this.water.id})
            this.payloadleft = ({fish: 12, district: 169, style: this.water.id})
            this.payloadright = ({fish: 12, district: 171, style: this.water.id})
            this.payloadtop = ({fish: 11, district: 170, style: this.water.id})
            this.payloadbottom = ({fish: 13, district: 170, style: this.water.id})
            this.getCanalLurePageLefts(169)
            this.getCanalLurePages(170)
            this.getCoarseFishTops(11)
            this.getCoarseFishs(12)
            this.getCoarseFishBottoms(13)
            this.getCanalLurePageRights(171)
            this.getCards({payload: this.payload, page: 1})
            this.getWaterCardLefts({payload: this.payloadleft, page: 1})
            this.getWaterCardRights({payload: this.payloadright, page: 1})
            this.getWaterCardTops({payload: this.payloadtop, page: 1})
            this.getWaterCardBottoms({payload: this.payloadbottom, page: 1})
        }
        if(this.water.id === 7) {
            this.payload = ({fish: 13, district: 15, style: this.water.id})
            this.payloadleft = ({fish: 13, district: 14, style: this.water.id})
            this.payloadright = ({fish: 13, district: 16, style: this.water.id})
            this.payloadtop = ({fish: 12, district: 15, style: this.water.id})
            this.payloadbottom = ({fish: 14, district: 15, style: this.water.id})
            this.getSeaBoatPageLefts(14)
            this.getSeaBoatPages(15)
            this.getSeaFishTops(12)
            this.getSeaFishs(13)
            this.getSeaFishBottoms(14)
            this.getSeaBoatPageRights(16)
            this.getCards({payload: this.payload, page: 1})
            this.getWaterCardLefts({payload: this.payloadleft, page: 1})
            this.getWaterCardRights({payload: this.payloadright, page: 1})
            this.getWaterCardTops({payload: this.payloadtop, page: 1})
            this.getWaterCardBottoms({payload: this.payloadbottom, page: 1})
        }
        if(this.water.id === 8) {
            this.payload = ({fish: 21, district: 64, style: this.water.id})
            this.payloadleft = ({fish: 21, district: 63, style: this.water.id})
            this.payloadright = ({fish: 21, district: 65, style: this.water.id})
            this.payloadtop = ({fish: 20, district: 64, style: this.water.id})
            this.payloadbottom = ({fish: 22, district: 64, style: this.water.id})
            this.getSeaShorePageLefts(63)
            this.getSeaShorePages(64)
            this.getSeaFishTops(20)
            this.getSeaFishs(21)
            this.getSeaFishBottoms(22)
            this.getSeaShorePageRights(65)
            this.getCards({payload: this.payload, page: 1})
            this.getWaterCardLefts({payload: this.payloadleft, page: 1})
            this.getWaterCardRights({payload: this.payloadright, page: 1})
            this.getWaterCardTops({payload: this.payloadtop, page: 1})
            this.getWaterCardBottoms({payload: this.payloadbottom, page: 1})
        }
        
    },

    mounted() {

        this.waterCardRight = this.waterCardRights[0]
        this.waterCardLeft = this.waterCardLefts[0]
        this.waterCardTop = this.waterCardTops[0]
        this.waterCardBottom = this.waterCardBottoms[0]
        if(this.water.id === 1) {
            stillwaterautocomplete('#districts').on('autocomplete:selected', (e, selection) => { 
            setTimeout(() => { 
                    this.getThreeStillwaters(
                    { coarseFish: this.coarseFishs[0].id,
                    firstStillwater: selection.id-1,
                    secondStillwater: selection.id,
                    thirdStillwater:  selection.id+1,
                    style: this.water.id }
                    )}, 500)
            }),
            coarsefishautocomplete('#fishs').on('autocomplete:selected', (e, selection) => {
                setTimeout(() => { 
                    this.getThreeCoarseFishs(
                    { firstFish: selection.id-1,
                    secondFish: selection.id,
                    thirdFish:  selection.id+1,
                    district: this.stillwaterPages[0].id,
                    style: this.water.id}
                    )}, 500)
                })
        }
        if(this.water.id === 2) {
            stillwaterlureautocomplete('#districts').on('autocomplete:selected', (e, selection) => { 
            setTimeout(() => { 
                    this.getThreeStillwaterLures(
                    { coarseFish: this.coarseFishs[0].id,
                    firstStillwaterLure: selection.id-1,
                    secondStillwaterLure: selection.id,
                    thirdStillwaterLure:  selection.id+1,
                    style: this.style }
                    )}, 500)
            }),
            coarsefishautocomplete('#fishs').on('autocomplete:selected', (e, selection) => {
                  setTimeout(() => { 
                    this.getThreeCoarseFishs(
                    { firstFish: selection.id-1,
                    secondFish: selection.id,
                    thirdFish:  selection.id+1,
                    district: this.stillwaterLurePages[0].id,
                    style: this.style }
                    )}, 500)
            })
        }
        if(this.water.id === 3) {
            riverautocomplete('#districts').on('autocomplete:selected', (e, selection) => { 
            setTimeout(() => { 
                    this.getThreeRivers(
                    { coarseFish: this.coarseFishs[0].id,
                    firstRiver: selection.id-1,
                    secondRiver: selection.id,
                    thirdRiver:  selection.id+1,
                    style: this.style }
                    )}, 500)
            }),
            coarsefishautocomplete('#fishs').on('autocomplete:selected', (e, selection) => {
                  setTimeout(() => { 
                    this.getThreeCoarseFishs(
                    { firstFish: selection.id-1,
                    secondFish: selection.id,
                    thirdFish:  selection.id+1,
                    district: this.riverPages[0].id,
                    style: this.style }
                    )}, 500)
            })
        }
        if(this.water.id === 4) {
        riverlureautocomplete('#districts').on('autocomplete:selected', (e, selection) => { 
        setTimeout(() => { 
                this.getThreeRiverLures(
                { coarseFish: this.coarseFishs[0].id,
                firstRiverLure: selection.id-1,
                secondRiverLure: selection.id,
                thirdRiverLure:  selection.id+1,
                style: this.style }
                )}, 500)
        }),
        coarsefishautocomplete('#fishs').on('autocomplete:selected', (e, selection) => {
              setTimeout(() => { 
                this.getThreeCoarseFishs(
                { firstFish: selection.id-1,
                secondFish: selection.id,
                thirdFish:  selection.id+1,
                district: this.riverLurePages[0].id,
                style: this.style }
                )}, 500)
        })
        }
        if(this.water.id === 5) {
            canalautocomplete('#districts').on('autocomplete:selected', (e, selection) => { 
            setTimeout(() => { 
                    this.getThreeCanals(
                    { coarseFish: this.coarseFishs[0].id,
                    style: this.style,
                    firstCanal: selection.id-1,
                    secondCanal: selection.id,
                    thirdCanal:  selection.id+1,
                    style: this.style }
                    )}, 500)
            }),
            coarsefishautocomplete('#fishs').on('autocomplete:selected', (e, selection) => {
                  setTimeout(() => { 
                    this.getThreeCoarseFishs(
                    { firstFish: selection.id-1,
                    secondFish: selection.id,
                    thirdFish:  selection.id+1,
                    district: this.canalPages[0].id,
                    style: this.style }
                    )}, 500)
            })
        }
        if(this.water.id === 6) {
            canallureautocomplete('#districts').on('autocomplete:selected', (e, selection) => { 
            setTimeout(() => { 
                    this.getThreeCanalLures(
                    { coarseFish: this.coarseFishs[0].id,
                    firstCanalLure: selection.id-1,
                    secondCanalLure: selection.id,
                    thirdCanalLure:  selection.id+1,
                    style: this.style }
                    )}, 500)
            }),
            coarsefishautocomplete('#fishs').on('autocomplete:selected', (e, selection) => {
                  setTimeout(() => { 
                    this.getThreeCoarseFishs(
                    { firstFish: selection.id-1,
                    secondFish: selection.id,
                    thirdFish:  selection.id+1,
                    district: this.canalLurePages[0].id,
                    style: this.style }
                    )}, 500)
            })
        }
        if(this.water.id === 7) {
            seaboatautocomplete('#districts').on('autocomplete:selected', (e, selection) => { 
            setTimeout(() => { 
                    this.getThreeSeaBoats(
                    { seaFish: this.seaFishs[0].id,
                    firstSeaBoat: selection.id-1,
                    secondSeaBoat: selection.id,
                    thirdSeaBoat:  selection.id+1,
                    style: this.style }
                    )}, 500)
            }),
            seafishautocomplete('#fishs').on('autocomplete:selected', (e, selection) => {
                  setTimeout(() => { 
                    this.getThreeSeaFishs(
                    { firstFish: selection.id-1,
                    secondFish: selection.id,
                    thirdFish:  selection.id+1,
                    district: this.seaBoatPages[0].id,
                    style: this.style }
                    )}, 500)
            })
        }
        if(this.water.id === 8) {
            seashoreautocomplete('#districts').on('autocomplete:selected', (e, selection) => { 
            setTimeout(() => { 
                    this.getThreeSeaShores(
                    { seaFish: this.seaFishs[0].id,
                    firstSeaShore: selection.id-1,
                    secondSeaShore: selection.id,
                    thirdSeaShore:  selection.id+1,
                    style: this.style }
                    )}, 500)
            }),
            seafishautocomplete('#fishs').on('autocomplete:selected', (e, selection) => {
                  setTimeout(() => { 
                    this.getThreeSeaFishs(
                    { firstFish: selection.id-1,
                    secondFish: selection.id,
                    thirdFish:  selection.id+1,
                    district: this.seaShorePages[0].id,
                    style: this.style }
                    )}, 500)
            })
        }
    },

    watch: {
        waterCardRights() {
            this.waterCardRight = this.waterCardRights[0]
            this.waterCardLeft = this.waterCardLefts[0]
            this.waterCardTop = this.waterCardTops[0]
            this.waterCardBottom = this.waterCardBottoms[0]
            if(this.water.id === 1) {
                this.fishTop = this.coarseFishTops[0]
                this.fish = this.coarseFishs[0]
                this.fishBottom = this.coarseFishBottoms[0]
                this.districtRight = this.stillwaterPageRights[0]
                this.district = this.stillwaterPages[0]
                this.districtLeft = this.stillwaterPageLefts[0]
            }
            if(this.water.id === 2) {
                this.fishTop = this.coarseFishTops[0]
                this.fish = this.coarseFishs[0]
                this.fishBottom = this.coarseFishBottoms[0]
                this.districtRight = this.stillwaterLurePageRights[0]
                this.district = this.stillwaterLurePages[0]
                this.districtLeft = this.stillwaterLurePageLefts[0]
            }
            if(this.water.id === 3) {
                this.fishTop = this.coarseFishTops[0]
                this.fish = this.coarseFishs[0]
                this.fishBottom = this.coarseFishBottoms[0]
                this.districtRight = this.riverPageRights[0]
                this.district = this.riverPages[0]
                this.districtLeft = this.riverPageLefts[0]
            }
            if(this.water.id === 4) {
                this.fishTop = this.coarseFishTops[0]
                this.fish = this.coarseFishs[0]
                this.fishBottom = this.coarseFishBottoms[0]
                this.districtRight = this.riverLurePageRights[0]
                this.district = this.riverLurePages[0]
                this.districtLeft = this.riverLurePageLefts[0]
            }
            if(this.water.id === 5) {
                this.fishTop = this.coarseFishTops[0]
                this.fish = this.coarseFishs[0]
                this.fishBottom = this.coarseFishBottoms[0]
                this.districtRight = this.canalPageRights[0]
                this.district = this.canalPages[0]
                this.districtLeft = this.canalPageLefts[0]
            }
            if(this.water.id === 6) {
                this.fishTop = this.coarseFishTops[0]
                this.fish = this.coarseFishs[0]
                this.fishBottom = this.coarseFishBottoms[0]
                this.districtRight = this.canalLurePageRights[0]
                this.district = this.canalLurePages[0]
                this.districtLeft = this.canalLurePageLefts[0]
            }
            if(this.water.id === 7) {
                this.fishTop = this.seaFishTops[0]
                this.fish = this.seaFishs[0]
                this.fishBottom = this.seaFishBottoms[0]
                this.districtRight = this.seaBoatPageRights[0]
                this.district = this.seaBoatPages[0]
                this.districtLeft = this.seaBoatPageLefts[0]
            }
            if(this.water.id === 8) {
                this.fishTop = this.seaFishTops[0]
                this.fish = this.seaFishs[0]
                this.fishBottom = this.seaFishBottoms[0]
                this.districtRight = this.seaShorePageRights[0]
                this.district = this.seaShorePages[0]
                this.districtLeft = this.seaShorePageLefts[0]
            }

        },

        cards() {
            this.user = false
            this.isActive = false
            this.mediaActive = false
            this.gallery = false
            this.blog = false
            this.video = false
            this.profile = false
            if(this.cards[0]) {
                this.private = this.cards[0].user.data.view
            }
            setTimeout(() => {
                this.cardright = false
                this.cardleft = false
                this.cardtop = false
                this.cardbottom = false
                this.gettingAllCards()
            },1000)
                
        },

        seaFishs() {
            if(!this.fish && !this.district) return
            this.fish = this.seafishs[0]
            this.payload = {fish:this.fish.id, district:this.district.id, style:this.water.id}
            this.getCards({payload: this.payload, page: 1})
        },
        coarseFishs() {
            if(!this.fish && !this.district) return
            this.fish = this.coarseFishs[0]
            this.payload = {fish:this.fish.id, district:this.district.id, style:this.water.id}
            this.getCards({payload: this.payload, page: 1})
        },
        stillwaterPages() {
            if(!this.fish && !this.district) return
            this.district = this.stillwaterPages[0]
            this.payload = {fish:this.fish.id, district:this.district.id, style:this.water.id}
            this.getCards({payload: this.payload, page: 1})
        },
        stillwaterLurePages() {
            if(!this.fish && !this.district) return
            this.district = this.stillwaterLurePages[0]
            this.payload = {fish:this.fish.id, district:this.district.id, style:this.water.id}
            this.getCards({payload: this.payload, page: 1})
        },
        riverPages() {
            if(!this.fish && !this.district) return
            this.district = this.riverPages[0]
            this.payload = {fish:this.fish.id, district:this.district.id, style:this.water.id}
            this.getCards({payload: this.payload, page: 1})
        },
        riverLurePages() {
            if(!this.fish && !this.district) return
            this.district = this.riverLurePages[0]
            this.payload = {fish:this.fish.id, district:this.district.id, style:this.water.id}
            this.getCards({payload: this.payload, page: 1})
        },
        canalPages() {
            if(!this.fish && !this.district) return
            this.district = this.canalPages[0]
            this.payload = {fish:this.fish.id, district:this.district.id, style:this.water.id}
            this.getCards({payload: this.payload, page: 1})
        },
        canalLurePages() {
            if(!this.fish && !this.district) return
            this.district = this.canalLurePages[0]
            this.payload = {fish:this.fish.id, district:this.district.id, style:this.water.id}
            this.getCards({payload: this.payload, page: 1})
        },
        seaBoatPages() {
            if(!this.fish && !this.district) return
            this.district = this.seaShorePages[0]
            this.payload = {fish:this.fish.id, district:this.district.id, style:this.water.id}
            this.getCards({payload: this.payload, page: 1})
        },
        seaShorePages() {
            if(!this.fish && !this.district) return
            this.district = this.seaShorePages[0]
            this.payload = {fish:this.fish.id, district:this.district.id, style:this.water.id}
            this.getCards({payload: this.payload, page: 1})
        }
    }
}

</script>
