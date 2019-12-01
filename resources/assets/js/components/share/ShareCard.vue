<template>
    <div class="padding-l">
        <div id="fb-root"></div>
    	<div id="fb-root"></div>
        <div class="box-share col-xs-12">
            <img class="img-responsive image-card image-corners"
                src="'/images/cards/' + data.image" 
                alt="Responsive image"/>
            <div class="col-xs-12">
                <h5 class="words">
                    <p class="words">{{user.name}} caught the 1st largest
                    </p>
                </h5>
            </div>
            <div class="box-text-top col-xs-12">
            	<h5 class="words">
                	<p class="words">{{fish}} from the {{district | capitalize }}</p>
                </h5>
            </div>
            <div class="box-text-top col-xs-12">
                <h5 class="words">
                    <p class="words">{{data.lbs}} lbs {{data.ozs}} ozs {{data.dr}} dr
                    </p>
                </h5>
            </div>
            <div class="box-text-top col-xs-12">
                <h5 class="words">
                    <p class="words">{{data.capture_date}}</p>
                </h5>
            </div>
                    
            <div class="box-text-top col-xs-12 margin-b">
                <h5 class="words">
                    <p class="words ">{{data.display_description}}
                    </p>
                </h5>
            </div>
        </div>
        <div class="col-xs-12 margin-t">
			<div class="col-xs-6">
				<div class="fb-share-button" 
                        data-href="https://fishcube.co.uk/share/card/&#123;card&#125;" 
                        data-layout="button" 
                        data-size="large" 
                        data-mobile-iframe="true">
                            <a class="fb-xfbml-parse-ignore" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Ffishcube.co.uk%2Fshare%2Fcard%2F%257Bcard%257D&amp;src=sdkpreparse">Share</a>
                </div>
			</div>
			<div class="col-sm-2 col-sm-offset-3 col-xs-3 col-xs-offset-3">
				<button class="btn btn-primary btn-block">
                    <a class="words" :href="'/profile'"><span class="glyphicon glyphicon-ok"></span></a>
                </button>
			</div>
		</div>
    </div>
</template>

<script>
import { mapActions, mapGetters } from 'vuex'
import Vue2Filters from 'vue2-filters'

    export default {
        props: [
            'data',
            'user',
        ],

        data() {
            return {
            	fish: null,
            	district: null,
                order: [],
                count: null,
                payload: [],
            }
        },

        computed: mapGetters({
            coarseFish: 'allCoarseFish',
            seaFish: 'allSeaFish',
            stillwater: 'allStillwater',
            stillwaterLure: 'allStillwaterLure',
            river: 'allRiver',
            riverLure: 'allRiverLure',
            canal: 'allCanal',
            seaShore: 'allSeaShore',
            seaBoat: 'allSeaBoat',
            canalLure: 'allCanalLure',
            riverLureCards: 'allRiverLureCards'
        }),

        methods: {
            ...mapActions([
                'getCoarseFish',
                'getSeaFish',
                'getStillwater',
                'getStillwaterLure',
                'getRiver',
                'getRiverLure',
                'getCanal',
                'getCanalLure',
                'getSeaBoat',
                'getSeaShore',
                'getRiverLureCards'
            ]),

        },

        created() {
            this.payload = {fish:this.data.fish_id, district:this.data.district_id, style:this.data.style_id}
        	if (this.data.style_id == 1) {
        		this.getStillwater(this.data.district_id)
        		this.getCoarseFish(this.data.fish_id)
        	}
        	if (this.data.style_id == 2) {
        		this.getStillwaterLure(this.data.district_id)
        		this.getCoarseFish(this.data.fish_id)
        	}
        	if (this.data.style_id == 3) {
				this.getRiver(this.data.district_id)
        		this.getCoarseFish(this.data.fish_id)
			}
        	if (this.data.style_id == 4) {
                this.getRiverLureCards({payload: this.payload, page: 1})
        		this.getRiverLure(this.data.district_id)
        		this.getCoarseFish(this.data.fish_id)
        	}
        	if (this.data.style_id == 5) {
        		this.getCanal(this.data.district_id)
        		this.getCoarseFish(this.data.fish_id)
        	}
        	if (this.data.style_id == 6) {
        		this.getCanalLure(this.data.district_id)
        		this.getCoarseFish(this.data.fish_id)
        	}
        	if (this.data.style_id == 7) {
        		this.getSeaBoat(this.data.district_id)
        		this.getSeaFish(this.data.fish_id)
        	}
        	if (this.data.style_id == 8) {
        		this.getSeaShore(this.data.district_id)
        		this.getSeaFish(this.data.fish_id)
        	}
        },

        watch: {
            order() {
                this.order.some(order => {
                    //count order then when ids match this.count = 
                    if (order.id === this.data.id) {
                        console.log(order)
                        return true
                    } else {
                        return false
                    }
                })
            },
	        seaFish() {
		        if (this.data.style_id == 7) {
	        		this.fish = this.seaFish[0].name
		        	this.district = this.seaBoat[0].name
	        	}
	        	if (this.data.style_id == 8) {
	        		this.fish = this.seaFish[0].name
		        	this.district = this.seaShore[0].name
	        	}
	        },
	        coarseFish() {
		        if (this.data.style_id == 1) {
	        		this.fish = this.coarseFish[0].name
	        		this.district = this.stillwater[0].name
	        	}
	        	if (this.data.style_id == 2) {
	        		this.fish = this.coarseFish[0].name
        			this.district = this.stillwaterLure[0].name
	        	}
	        	if (this.data.style_id == 3) {
					this.fish = this.coarseFish[0].name
        			this.district = this.river[0].name
				}
	        	if (this.data.style_id == 4) {
                    this.order = this.riverLureCards
	        		this.fish = this.coarseFish[0].name
        			this.district = this.riverLure[0].name
	        	}
	        	if (this.data.style_id == 5) {
	        		this.fish = this.coarseFish[0].name
        			this.district = this.canal[0].name
	        	}
	        	if (this.data.style_id == 6) {
	        		this.fish = this.coarseFish[0].name
        			this.district = this.canalLure[0].name
	        	}
	        }
	    }
    }
</script>