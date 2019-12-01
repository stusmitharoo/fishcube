<!-- <template>
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
            profileCardLefts: 'allProfileCardLefts',
            profileCards: 'allProfileCards',
            profileFishLefts: 'allProfileFishLefts',
            districtLefts: 'allDistrictLefts',
        }),
        methods: {
            ...mapActions([
                'getProfileCardLefts',
                'getProfileFishLefts',
            ]),
            getTheRightProfileFish(page = 2) {
              this.getProfileFishLefts({profileDistrict:this.districtLefts[0].id,style:this.districtLefts[0].style_id, page: page})
            }
        },

        watch: {
            profileFishLefts() {
                if (!this.didTryToGetFishFirst && (!this.profileFishLefts || !this.profileFishLefts.length)) {
                  this.didTryToGetFishFirst = true
                  this.getTheRightProfileFish(1)
                }else {
                    this.payload = {profileFish:this.profileFishLefts[0].fish_id, profileDistrict:this.districtLefts[0].district_id, style:this.districtLefts[0].style_id}

                    if(this.gotCardFirstTime) return
                    this.fish = this.profileFishLefts[0].name
                    this.district = this.districtLefts[0].name
                    setTimeout(() => {
                        this.getProfileCardLefts({payload: this.payload, page: 1})
                        this.didTryToGetFishFirst = false
                    },500)
                }
            },
            profileCardLefts() {

                this.card = this.profileCardLefts[0]
                this.gotCardFirstTime = true
            },
            profileCards() {
                this.gotCardFirstTime = false
                this.getTheRightProfileFish()
            }
        }
    }
</script> -->