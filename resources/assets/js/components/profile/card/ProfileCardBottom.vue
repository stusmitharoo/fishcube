<!-- <template>
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
            profileCardBottoms: 'allProfileCardBottoms',
            profileCards: 'allProfileCards',
            profileFishBottoms: 'allProfileFishBottoms',
            districts: 'allDistricts',
        }),
        methods: {
            ...mapActions([
                'getProfileCardBottoms',
            ]),

        },

        watch: {
            profileFishBottoms() {
                if (!this.profileFishBottoms || !this.profileFishBottoms.length) return
                this.payload = {profileFish:this.profileFishBottoms[0].fish_id, profileDistrict:this.districts[0].district_id, style:this.districts[0].style_id}

                if(this.gotCardFirstTime) return
                this.fish = this.profileFishBottoms[0].name
                this.district = this.districts[0].name
            },
            profileCardBottoms() {
                this.gotCardFirstTime = true
                this.card = this.profileCardBottoms[0]
            },

            profileCards() {
                setTimeout(() => {
                    this.getProfileCardBottoms({payload: this.payload, page: 1})
                    this.gotCardFirstTime = false
                },1000)
            }
        }
    }
</script> -->