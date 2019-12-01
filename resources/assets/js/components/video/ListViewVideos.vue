<template>
	<div class="col-sm-8 col-sm-offset-2 col-xs-12">
		<videomodal v-if="showModal" @close="showModal = false"
            video="https://s3.eu-west-2.amazonaws.com/video.fishcube.co.uk/profilepage.mp4">
        </videomodal>
		<div class="box-still container">
			<div class="words margin-b">
				<h3>Search for a {{water.name}} video</h3>
			</div>
			<div class="col-xs-12 ">
				<a v-if="water.id == 1 || water.id == 2" title="stillwater map" href="/map/district" class=" margin-s words btn btn-primary btn-sm">
					<span class="glyphicon glyphicon-map-marker"></span>
					<h6 class="links-zero">still..</h6>
				</a>
				<a v-if="water.id == 3 || water.id == 4" title="river map" href="/map/river" class="margin-s words btn btn-primary btn-sm">
					<span class="glyphicon glyphicon-map-marker"></span>
					<h6 class="links-zero">river</h6>
				</a>
				<a v-if="water.id == 5 || water.id == 6" title="Canal map" href="/map/canal" class="margin-s words btn btn-primary btn-sm">
					<span class="glyphicon glyphicon-map-marker"></span>
					<h6 class="links-zero">canal</h6>
				</a>
				<a v-if="water.id == 7" title="sea map" href="/map/river" class=" margin-s words btn btn-primary btn-sm">
					<span class="glyphicon glyphicon-map-marker"></span>
					<h6 class="links-zero">boat</h6>
				</a>
				<a v-if="water.id == 8" title="sea map" href="/map/district" class=" margin-s words btn btn-primary btn-sm">
					<span class="glyphicon glyphicon-map-marker"></span>
					<h6 class="links-zero">shore</h6>
				</a>
				<button title="Help" class="margin-s words btn btn-primary btn-sm" id="show-modal" @click="showModal = true">
					<span class="glyphicon glyphicon-info-sign"></span>
					<h6 class="links-zero">help</h6>
				</button>
			</div>
			<br>
			<div class="col-xs-12 margin-ts">
		        <label class="plan-words col-xs-12"> Select a location</label>
		        <input 
		                placeholder="Type Here ..." 
		                type="text"
		                id="districtmob"
		                name="districtmob" 
		                class="col-xs-12 form-control margin-ts">
			</div>
			<div class="col-xs-12 media">
				<div v-for="videoList, index in videoLists">
					<div v-if="videoList.user.data.view == 1" class="box-still col-xs-12" style="padding: 0px">
						<div class="col-xs-3 media-left">
							<a :href="'/video/views/show/' + videoList.id">
								<img :src="videoList.thumbnail" :alt="videoList.title" class="img-responsive img-corners margin-s media-object">
							</a>
						</div>
						<div class="col-xs-7">
							<a :href="'/video/views/show/' + videoList.id">
								<h4 class="words">{{ videoList.title }}</h4>
							</a>
						</div>
					</div>
				</div>
				<div v-for="videoList in videoLists" v-if="!videoLists.length || (videoLists.length == 1 && videoList.user.data.view == 0)">
					<h4 class="words margin-s">You have no videos for this location</h4>
				</div>
				<pagination v-if="videoListMeta.pagination && videoListMeta.pagination.links" :meta="videoListMeta.pagination" v-on:pagination:switched="pageVideoLists"></pagination>
            </div>
		</div>
	</div>  
</template>
<script>
import { mapActions, mapGetters } from 'vuex'
import { stillwatermobautocomplete } from '../helpers/stillwatermobautocomplete.js'
import { stillwaterluremobautocomplete } from '../helpers/stillwaterluremobautocomplete.js'
import { rivermobautocomplete } from '../helpers/rivermobautocomplete.js'
import { riverluremobautocomplete } from '../helpers/riverluremobautocomplete.js'
import { canalmobautocomplete } from '../helpers/canalmobautocomplete.js'
import { canalluremobautocomplete } from '../helpers/canalluremobautocomplete.js'
import { seaboatmobautocomplete } from '../helpers/seaboatmobautocomplete.js'
import { seashoremobautocomplete } from '../helpers/seashoremobautocomplete.js'

    export default {
        props: [
            'water',
        ],

        data () {
      		return{
      			selectDistrict: null,
      			profileFish: null,
        		showModal: false,
        		fish: false,
      		}
      	},
    	computed: mapGetters({
    		videoLists: 'allVideoLists',
    		videoListMeta: 'allVideoListMeta'
    	}),
    	methods: {
        	...mapActions([
        		'getVideoList',
        		'getVideoListMeta'
        	]),

        	addSelectedDistrict(selectDistrict) {
        		this.selectDistrict = selectDistrict
        	},

        	pageVideoLists(page) {
		     	this.getVideoList({
		     		style: this.water.id, 
		     		district: this.selectDistrict.id,
		     		page})
			}
    	},

    	watch: {
    		selectDistrict() {
		     	this.getVideoList({
		     		style: this.water.id, 
		     		district: this.selectDistrict.id,
		     		page: 1})
		    }

    	},

    	mounted() {
	        if(this.water.id === 1) {
	            stillwatermobautocomplete('#districtmob').on('autocomplete:selected', (e, selection) => { 
		           		this.addSelectedDistrict(selection)
	            })
	        }
	        if(this.water.id === 2) {
	            stillwaterluremobautocomplete('#districtmob').on('autocomplete:selected', (e, selection) => { 
		           		this.addSelectedDistrict(selection)
	            })
	        }
	        if(this.water.id === 3) {
	            rivermobautocomplete('#districtmob').on('autocomplete:selected', (e, selection) => {
		           		this.addSelectedDistrict(selection) 
	            })
	        }
	        if(this.water.id === 4) {
	            riverluremobautocomplete('#districtmob').on('autocomplete:selected', (e, selection) => { 
		           		this.addSelectedDistrict(selection)
	            })
	        }
	        if(this.water.id === 5) {
	            canalmobautocomplete('#districtmob').on('autocomplete:selected', (e, selection) => {
		           		this.addSelectedDistrict(selection) 
	            })
	        }
	        if(this.water.id === 6) {
	            canalluremobautocomplete('#districtmob').on('autocomplete:selected', (e, selection) => { 
		           		this.addSelectedDistrict(selection)
	            })
	        }
	        if(this.water.id === 7) {
	            seaboatmobautocomplete('#districtmob').on('autocomplete:selected', (e, selection) => { 
		           		this.addSelectedDistrict(selection)
	            })
	        }
	        if(this.water.id === 8) {
	            seashoremobautocomplete('#districtmob').on('autocomplete:selected', (e, selection) => { 
	            		this.addSelectedDistrict(selection)
	            })
	        }
	    }
}

</script>