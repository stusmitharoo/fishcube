<template>
    <div>
        <div>
            <img class="img-responsive image-card image-corners"
                v-for="viewProfileCard in viewProfileCards" 
                :src="viewProfileCard.image" 
                alt="Responsive image"/>
            <img v-show="viewProfileCards.length < 1"
                class="img-responsive image-card image-corners" 
                :src="'/images/index/defualt.jpg'">
            <div class="col-xs-12">
                <h5 class="words">
                    <p class="words"
                        v-for="viewProfileCard in viewProfileCards">
                        {{ viewProfileCard.user.data.name | capitalize }}
                    </p>
                    <p class="words"
                        v-show="viewProfileCards.length < 1">
                        No Data for this location
                    </p>
                </h5>
            </div>
            <div class="box-text-top col-xs-12">
                <viewprofilecoarsemiddle
                    v-if="viewDistricts"
                    v-for="viewDistrict in viewDistricts"
                    :viewDistrict="viewDistrict"
                     :card="card">
                </viewprofilecoarsemiddle>
            </div>
            <div class="box-text-top col-xs-12">
                <viewprofilemiddle
                     :card="card">
                </viewprofilemiddle>
            </div>
            <div class="box-text-top col-xs-12">
                <h5 class="words">
                    <p class="words"
                        v-for="viewProfileCard in viewProfileCards">{{viewProfileCard.lbs}} lbs {{viewProfileCard.ozs}} ozs {{viewProfileCard.dr}} dr / Position {{ pagination.current_page }}{{ pagination.current_page | pluralize('st','nd','rd','th') }}
                    </p>
                    <p class="words"
                        v-show="viewProfileCards.length < 1">
                        No Data for this location
                    </p>
                </h5>
            </div>
            <div class="box-text-top col-xs-12">
                <h5 class="words">
                    <p class="words"
                        v-for="viewProfileCard in viewProfileCards">{{viewProfileCard.capture_date}}</p>
                </h5>
            </div>
                    
            <div class="box-text-top col-xs-12">
                <h5 class="words">
                    <p class="words"
                        v-for="viewProfileCard in viewProfileCards">{{viewProfileCard.display_description}}
                    </p>
                </h5>
            </div>
            <nav aria-label="...">
              <ul class="pager" v-if="pagination && pagination.links">
                <li class="previous" :class ="{ 'disabled': !pagination.links.previous }">
                    <a class="words" href="#" @click.prevent="getViewProfileCards({payload: payload, page: pagination.current_page-1, id: card})">
                        <span aria-hidden="true">&larr;</span> Prev
                    </a>
                </li>
               <li class="next" v-show="viewProfileCards.length > 0" >
                    <a class="words" href="#" @click.prevent="getViewProfileCards({payload: payload, page: pagination.current_page+1, id: card})">Next 
                        <span aria-hidden="true">&rarr;</span>
                    </a>
                </li>
              </ul>
            </nav>
        </div>
    </div>
</template>

<script>
import { mapActions, mapGetters } from 'vuex'
import Vue2Filters from 'vue2-filters'

    export default {
        props: [
            'pagination',
            'card'
        ],

        data() {
            return {
                payload: null
            }
        },

        computed: mapGetters({
            viewDistricts: 'allViewDistricts',
            viewProfileCards: 'allViewProfileCards',
            viewProfileFishs: 'allViewProfileFishs',
            viewProfileCardMeta: 'allViewProfileCardMeta'
        }),

        methods: {
            ...mapActions([
                'getViewProfileCards'
            ]),

        },
        
        watch: {
            viewProfileFishs() {
                if (!this.viewProfileFishs || !this.viewProfileFishs.length) return
                this.payload = {profileFish:this.viewProfileFishs[0].fish_id, profileDistrict:this.viewDistricts[0].district_id, style:this.viewDistricts[0].style_id, id: this.card[0].id}
                setTimeout(() => {
                    this.getViewProfileCards({payload: this.payload, page: 1})
                },500)
            }
        }
    }
</script>