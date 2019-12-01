<template>
    <div :class="{'active-card-bottom': cardbottom}">
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
            'cardbottom',
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
            viewProfileCardBottoms: 'allViewProfileCardBottoms',
            viewProfileCards: 'allViewProfileCards',
            viewProfileFishBottoms: 'allViewProfileFishBottoms',
            viewDistricts: 'allViewDistricts',
        }),
        methods: {
            ...mapActions([
                'getViewProfileCardBottoms',
            ]),

        },

        watch: {

            viewProfileFishBottoms() {
                if (!this.viewProfileFishBottoms || !this.viewProfileFishBottoms.length) return
                this.payload = {profileFish:this.viewProfileFishBottoms[0].fish_id, profileDistrict:this.viewDistricts[0].district_id, style:this.viewDistricts[0].style_id, id: this.viewCard[0].id}

                if(this.gotCardFirstTime) return
                this.fish = this.viewProfileFishBottoms[0].name
                this.district = this.viewDistricts[0].name

            },

            viewProfileCardBottoms() {
                this.gotCardFirstTime = true
                this.card = this.viewProfileCardBottoms[0]
            },

            viewProfileCards() {
                setTimeout(() => {
                    this.getViewProfileCardBottoms({payload: this.payload, page: 1})
                    this.gotCardFirstTime = false
                },1000)
            }

        }
    }
</script>