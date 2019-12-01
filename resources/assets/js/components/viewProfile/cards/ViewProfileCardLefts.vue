<template>
    <div :class="{'active-card-left': cardleft}">
        <div>
            <img v-if="card" 
                class="img-responsive image-card image-corners"
                :src="card.image" 
                alt="Responsive image"/>
            <img v-if="!card" 
                class="img-responsive image-card image-corners"
                :src="'/images/index/defualt.jpg'" 
                alt="advertising"/>
            <div class="col-xs-12">
                <h5 class="words">
                    <p class="words"
                        v-if="card">
                        {{card.user.data.name | capitalize }} 
                    </p>
                    <p class="words"
                        v-if="!card">
                        No data for this district  
                    </p>
                </h5>
            </div>
            <div class="box-text-top col-xs-12">
                <h5 class="words">
                    <p class="words">
                        {{fish | capitalize }} 
                    </p>
                </h5>
            </div>
            <div class="box-text-top col-xs-12">
                <h5 class="words">
                    <p class="words">
                        {{district | capitalize }} 
                    </p>
                </h5>
            </div>
            <div class="box-text-top col-xs-12">
                <h5 class="words"
                    v-if="card">
                    <p class="words"
                        v-if="card">
                        {{card.lbs}} lbs {{card.ozs}} ozs {{card.dr}} dr
                    </p>
                    <p class="words"
                        v-if="!card">
                        No data for this district  
                    </p>
                </h5>
            </div>
            <div class="box-text-top col-xs-12">
                <h5 class="words">
                    <p class="words"
                        v-if="card">
                        {{card.capture_date}}
                    </p>
                    <p class="words"
                        v-if="!card">
                        No data for this district  
                    </p>
                </h5>
            </div>
                    
            <div class="box-text-top col-xs-12">
                <h5 class="words">
                    <p class="words "
                        v-if="card">
                        {{card.display_description}}
                    </p>
                    <p class="words"
                        v-if="!card">
                        No data for this district  
                    </p>
                </h5>
            </div>
        </div>
    </div>
</template>

<script>
import { mapActions, mapGetters } from 'vuex'
import Vue2Filters from 'vue2-filters'

    export default {
        props: [
            'cardleft',
            'viewCard',
        ],
        data() {
            return {
                payload: null,
                fish: null,
                district: null,
                didTryToGetFishFirst: false,
                gotCardFirstTime: false,
                card: null,
            }
        },
        computed: mapGetters({
            viewProfileCardLefts: 'allViewProfileCardLefts',
            viewProfileCards: 'allViewProfileCards',
            viewProfileFishLefts: 'allViewProfileFishLefts',
            viewDistrictLefts: 'allViewDistrictLefts',
        }),
        methods: {
            ...mapActions([
                'getViewProfileCardLefts',
                'getViewProfileFishLefts',
            ]),
            getTheRightViewProfileFish(page = 2) {
                if(!this.viewDistrictLefts || !this.viewDistrictLefts.length) return
              this.getViewProfileFishLefts({profileDistrict:this.viewDistrictLefts[0].id, style:this.viewDistrictLefts[0].style_id, id:this.viewCard[0].id, page: page})
            }
        },

        watch: {
            viewDistrictLefts() {
                if (!this.didTryToGetFishFirst) {
                    this.didTryToGetFishFirst = true
                    this.getTheRightViewProfileFish()
                }
            },

            viewProfileFishLefts() {
                if (!this.viewProfileFishLefts || !this.viewProfileFishLefts.length ) return
                 this.payload = {profileFish:this.viewProfileFishLefts[0].fish_id, profileDistrict:this.viewDistrictLefts[0].district_id, style:this.viewDistrictLefts[0].style_id, id: this.viewCard[0].id}

                if(this.gotCardFirstTime) return
                    this.fish = this.viewProfileFishLefts[0].name
                    this.district = this.viewDistrictLefts[0].name
                    setTimeout(() => {
                        this.getViewProfileCardLefts({payload: this.payload, page: 1})
                    },500)
            },

            viewProfileCardLefts() {
                this.card = this.viewProfileCardLefts[0]
                this.gotCardFirstTime = true
            },
            viewProfileCards() {
                if (this.didTryToGetFishFirst && (!this.viewProfileFishLefts || !this.viewProfileFishLefts.length )) {
                    this.getTheRightViewProfileFish(1)
                }
                if(this.gotCardFirstTime && this.didTryToGetFishFirst) {
                    this.gotCardFirstTime = false
                    this.didTryToGetFishFirst = false
                }
            }
        }
    }
</script>
