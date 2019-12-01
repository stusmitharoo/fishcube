<template>
    <div>
        <div>
            <img class="img-responsive image-card image-corners"
                v-for="profileCard in profileCards" 
                :src="profileCard.image" 
                alt="Responsive image"/>
            <div class="col-xs-12">
                <h5 class="words">
                    <p class="words"
                        v-for="profileCard in profileCards">
                        {{profileCard.user.data.name | capitalize }} 
                    </p>
                </h5>
                <div v-show="districtLefts.length < 1"
                    class="words margin-t">
                    <h4 class="words">No cards yet</h4>
                    <a href="/createChoice" class="words btn btn-warning margin-b">Create a card</a>
                </div>
            </div>
            <div class="box-text-top col-xs-12">
                <profilecoarsemiddle
                    v-if="districts"
                    v-for="district in districts"
                    :district="district">
                </profilecoarsemiddle>
            </div>
            <div class="box-text-top col-xs-12">
                <profilemiddle></profilemiddle>
            </div>
            <div class="box-text-top col-xs-12">
                <h5 class="words">
                    <p class="words"
                        v-for="profileCard in profileCards">{{profileCard.lbs}} lbs {{profileCard.ozs}} ozs {{profileCard.dr}} dr / Position {{ pagination.current_page }}{{ pagination.current_page | pluralize('st','nd','rd','th') }}
                    </p>
                </h5>
            </div>
            <div class="box-text-top col-xs-12">
                <h5 class="words">
                    <p class="words"
                        v-for="profileCard in profileCards">{{profileCard.capture_date}}</p>
                </h5>
            </div>
                    
            <div class="box-text-top col-xs-12">
                <h5 class="words">
                    <p class="words "
                        v-for="profileCard in profileCards">{{profileCard.display_description}}
                    </p>
                </h5>
            </div>
            <nav aria-label="..."  class="margin-txs">
              <ul class="pager" v-if="pagination && pagination.links">
                <li class="previous" v-if="pagination && pagination.links.previous">
                    <a class="words" href="#" @click.prevent="getProfileCards({payload: payload, page: pagination.current_page-1})">
                        <span aria-hidden="true">&larr;</span> Prev
                    </a>
                </li>
               <li class="next" v-if="pagination && pagination.links.next">
                    <a class="words" href="#" @click.prevent="getProfileCards({payload: payload, page: pagination.current_page+1})">Next 
                        <span aria-hidden="true">&rarr;</span>
                    </a>
                </li>
              </ul>
            </nav>
            <div class="row hidden-xs">
                <div class="col-xs-6 col-xs-offset-3">
                    <button class="btn btn-primary btn-block"
                        v-for="profileCard in profileCards">
                        <a class="words" :href="'/share/card/' + profileCard.id"><span class="glyphicon glyphicon-share"></span> share to facebook</a>
                    </button> 
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { mapActions, mapGetters } from 'vuex'
import Vue2Filters from 'vue2-filters'

    export default {
        props: [
            'pagination'
        ],
        
        data() {
            return {
                payload: null,
                videoLink: null,
            }
        },

        computed: mapGetters({
            districts: 'allDistricts',
            profileCards: 'allProfileCards',
            profileFishs: 'allProfileFishs',
            profileCardMeta: 'allProfileCardMeta',
            districtLefts: 'allDistrictLefts',
        }),

        methods: {
            ...mapActions([
                'getProfileCards',
            ]),

        },

        watch: {
            profileFishs() {
                if (!this.profileFishs || !this.profileFishs.length) return
                this.payload = {profileFish:this.profileFishs[0].fish_id, profileDistrict:this.districts[0].district_id, style:this.districts[0].style_id}
                    this.getProfileCards({payload: this.payload, page: 1})
            },
            profileCards() {
                if (!this.profileCards || !this.profileCards.length) return

            }
        }
    }
</script>