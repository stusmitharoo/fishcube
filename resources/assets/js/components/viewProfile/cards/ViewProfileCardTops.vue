<template>
    <div :class="{'active-card-top': cardtop}">
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
            'cardtop',
            'viewCard',
        ],
        data() {
            return {
                payload: null,
                fish: null,
                district: null,
                card: null,
                gotCardFirstTime: false,
            }
        },
        computed: mapGetters({
            viewProfileCardTops: 'allViewProfileCardTops',
            viewProfileCards: 'allViewProfileCards',
            viewProfileFishTops: 'allViewProfileFishTops',
            viewDistricts: 'allViewDistricts',
        }),
        methods: {
            ...mapActions([
                'getViewProfileCardTops',
            ]),

        },

        watch: {
            viewProfileFishTops() {
                if (!this.viewProfileFishTops || !this.viewProfileFishTops.length) return
                this.payload = {profileFish:this.viewProfileFishTops[0].fish_id, profileDistrict:this.viewDistricts[0].district_id, style:this.viewDistricts[0].style_id, id: this.viewCard[0].id}

                if(this.gotCardFirstTime) return
                this.fish = this.viewProfileFishTops[0].name
                this.district = this.viewDistricts[0].name
            },

            viewProfileCardTops() {
                this.gotCardFirstTime = true
                this.card = this.viewProfileCardTops[0]
            },

            viewProfileCards() {
                setTimeout(() => {
                    this.getViewProfileCardTops({payload: this.payload, page: 1})
                    this.gotCardFirstTime = false
                },1000)
            }
        }
    }
</script>