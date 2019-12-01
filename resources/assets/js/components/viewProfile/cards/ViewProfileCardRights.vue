<template>
    <div :class="{'active-card-right': cardright}">
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
            'cardright',
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
            viewProfileCardRights: 'allViewProfileCardRights',
            viewProfileCards: 'allViewProfileCards',
            viewProfileFishRights: 'allViewProfileFishRights',
            viewDistrictRights: 'allViewDistrictRights',
        }),
        methods: {
            ...mapActions([
                'getViewProfileCardRights',
                'getViewProfileFishRights',
            ]),
            getTheRightViewProfileFish(page = 2) {
                if(!this.viewDistrictRights || !this.viewDistrictRights.length) return
              this.getViewProfileFishRights({profileDistrict:this.viewDistrictRights[0].id, style:this.viewDistrictRights[0].style_id, id:this.viewCard[0].id, page: page})
            }
        },

        watch: {
            viewDistrictRights() {
                if (!this.didTryToGetFishFirst) {
                    this.didTryToGetFishFirst = true
                    this.getTheRightViewProfileFish()
                }
            },

            viewProfileFishRights() {
                if (!this.viewProfileFishRights || !this.viewProfileFishRights.length ) return
                 this.payload = {profileFish:this.viewProfileFishRights[0].fish_id, profileDistrict:this.viewDistrictRights[0].district_id, style:this.viewDistrictRights[0].style_id, id: this.viewCard[0].id}

                if(this.gotCardFirstTime) return
                    this.fish = this.viewProfileFishRights[0].name
                    this.district = this.viewDistrictRights[0].name
                    setTimeout(() => {
                        this.getViewProfileCardRights({payload: this.payload, page: 1})
                    },1000)

            },

            viewProfileCardRights() {
                this.card = this.viewProfileCardRights[0]
                this.gotCardFirstTime = true
            },
            viewProfileCards() {
                if (this.didTryToGetFishFirst && (!this.viewProfileFishRights || !this.viewProfileFishRights.length )) {
                    this.getTheRightViewProfileFish(1)
                }
                if(this.gotCardFirstTime && this.didTryToGetFishFirst) {}
                    this.getTheRightViewProfileFish()
                    this.gotCardFirstTime = false
                    this.didTryToGetFishFirst = false
                
            }
        }
    }
</script>