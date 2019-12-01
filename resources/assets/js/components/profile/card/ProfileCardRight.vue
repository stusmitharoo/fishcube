<!-- <template>
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
            profileCardRights: 'allProfileCardRights',
            profileCards: 'allProfileCards',
            profileFishRights: 'allProfileFishRights',
            districtRights: 'allDistrictRights',
        }),
        methods: {
            ...mapActions([
                'getProfileCardRights',
                'getProfileFishRights',
            ]),
            getTheRightProfileFish(page = 2) {
              this.getProfileFishRights({profileDistrict:this.districtRights[0].id,style:this.districtRights[0].style_id, page: page})
            }
        },

        watch: {
            profileFishRights() {
                if (!this.didTryToGetFishFirst && (!this.profileFishRights || !this.profileFishRights.length)) {
                    this.didTryToGetFishFirst = true
                    this.getTheRightProfileFish(1)
                }else {
                    this.payload = {profileFish:this.profileFishRights[0].fish_id, profileDistrict:this.districtRights[0].district_id, style:this.districtRights[0].style_id}

                    if(this.gotCardFirstTime) return
                    this.fish = this.profileFishRights[0].name
                    this.district = this.districtRights[0].name
                    setTimeout(() => {
                        this.getProfileCardRights({payload: this.payload, page: 1})
                        this.didTryToGetFishFirst = false
                    },500)
                }
            },
            profileCardRights() {

                    this.card = this.profileCardRights[0]
                    this.gotCardFirstTime = true
            },
            profileCards() {
                this.gotCardFirstTime = false
                this.getTheRightProfileFish()
            }
        }
    }
</script> -->