<template>
	<div class="col-sm-8 col-sm-offset-2 col-xs-12">
		<videomodal v-if="showModal" @close="showModal = false"
            video="https://s3.eu-west-2.amazonaws.com/video.fishcube.co.uk/profilepage.mp4">
        </videomodal>
		<form @submit.prevent="send">
		<br>
		<div class="box-still">
		<h3 class="words">Create a {{data.name}} Angling Card</h3>
		<br>
			<button class="margin-ll words btn btn-primary btn-sm" id="show-modal" @click.prevent="showModal = true">
                <span class="glyphicon glyphicon-info-sign"></span>
            </button>
				<div class="col-xs-12">
            		<label for="districts" class="plan-words col-xs-12 margin-s">{{data.name}} Location</label>
						<input 
                            placeholder="Type Here ..." 
                            type="text"
                            id="districts"
                            name="districts" 
                            class="col-xs-12 form-control margin-s">
				</div>
				<div class="col-xs-12">
					<label for="fishs" class="plan-words col-xs-12 margin-s">Fish Species</label>
						<input 
                            placeholder="Type Here ..." 
                            type="text"
                            id="fishs"
                            name="fishs" 
                            class="col-xs-12 form-control margin-s">
				</div>
				<div class="col-xs-12">
					<imageupload img-src="/images/index/defualt.jpg" @sendToParent="receiveImage"></imageupload>
				</div>

				<div class="margin-b col-xs-12">
					<label
						for="capture_date"
						class="plan-words margin-s col-xs-12">Date of Capture
					</label>
					<div class="col-xs-7 col-sm-5 date-min">
						<datepicker @selected="changeDate" class="form-control col-xs-6 padding-s"></datepicker>
					</div>
				</div>
				<div class=" col-xs-4 margin-b">
					<label
						for="lbs"
						class="words">lbs
					</label>
					<input
						id="lbs"
						type="number"
						class="form-control"
						v-model="lbs"
						required=""
						min="0">
				</div>
				<div class=" col-xs-4 margin-b">
					<label
						for="ozs"
						class="words">ozs
					</label>
					<input
						id="ozs"
						type="number"
						class="form-control"
						v-model="ozs"
						required=""
						min="0"
						max="15">
				</div>
				<div class=" col-xs-4 margin-b">
					<label
						for="dr"
						class="words">dr
					</label>
					<input
						id="dr"
						type="number"
						class="form-control"
						v-model="dr"
						required=""
						min="0"
						max="15">
				</div>
			<div class=" margin-s margin-t">
				<label
					for="display_description"
					class="words myh4">Display Description( This will be seen by All)
				</label>
				<input
					id="dr"
					type="alphanum"
					class="form-control"
					v-model="display_description"
					required=""
					maxlength="30">
			</div>
			<div class="margin-s margin-t">
				<label
					for="profile_description"
					class="words myh4">Profile Description (Max Length 500 Characters, Only you will see this)
				</label>
				<textarea
					rows="4"
					id="profile_description"
					class="form-control"
					type="alphanum"
					v-model="profile_description"
					required=""

					maxlength="500">
				</textarea>
			</div>

    		<div class="margin-t margin-s">
    			<button
    				type="submit"
    				class=" words btn btn-warning btn-block">
    					Create new card
    			</button>
    		</div>
			</div>
		</form>
	</div>
</template>
<script>
import { stillwaterautocomplete } from '../helpers/stillwaterautocomplete.js'
import { stillwaterlureautocomplete } from '../helpers/stillwaterlureautocomplete.js'
import { riverautocomplete } from '../helpers/riverautocomplete.js'
import { riverlureautocomplete } from '../helpers/riverlureautocomplete.js'
import { canalautocomplete } from '../helpers/canalautocomplete.js'
import { canallureautocomplete } from '../helpers/canallureautocomplete.js'
import { seaboatautocomplete } from '../helpers/seaboatautocomplete.js'
import { seashoreautocomplete } from '../helpers/seashoreautocomplete.js'
import { coarsefishautocomplete } from '../helpers/coarsefishautocomplete.js'
import { seafishautocomplete } from '../helpers/seafishautocomplete.js'
import { mapActions, mapGetters } from 'vuex'
import swal from 'sweetalert2'
import datepicker from 'vuejs-datepicker'

	export default {
		props:[
			'data',
		],
		data() {
			return {
				createFish:'',
				profileDistrict: null,
				style_id: null,
				lbs: 0,
				ozs: 0,
				dr: 0,
				image: null,
				capture_date: '',
				display_description: '',
				profile_description: '',
				showModal: false,
			}
		},
		computed: mapGetters({
			createFishs: 'allCreateFishs',
			profileDistricts: 'allProfileDistricts',
		}),
		methods: {
			...mapActions([
				'getProfileDistricts',
				'getCreateFishs',
				'createCard',
				'addCardImage',
				'submitLocation',
				'submitFishes',
				]),

			changeDate(date) {
				this.capture_date = date
			},

			addFish(id) {
					console.log(id,'fish')
				this.submitFishes({
					district_id: this.profileDistrict.id,
					profile_district_id: id,
					style_id: this.style_id,
					fish_id: this.createFish.id,
					name: this.createFish.name,
					image: this.createFish.image,
				})
				.catch(error => {
					this.errorMessage 
				})
			},

			addLocation() {
				this.submitLocation({
					district_id: this.profileDistrict.id,
					name: this.profileDistrict.name,
					image: this.profileDistrict.image,
					style_id: this.style_id,
				})
				.then(response => {
					console.log(response,'loc')
					const distCard = response.data;
					const distId = distCard.id;
					this.addFish(distId);
				})
				.catch(error => {
					this.errorMessage 
				})
			},

			send(){
				this.createCard({
					 style_id: this.style_id,
					 district_id: this.profileDistrict.id,
					 fish_id: this.createFish.id,
					 lbs: this.lbs,
					 ozs: this.ozs,
					 dr: this.dr,
					 capture_date: this.capture_date,
					 display_description: this.display_description,
					 profile_description: this.profile_description,
				 })
				.then(response => {
					return this.addLocation()
					// const savedCard = response.data;
					// const cardId = savedCard.id;
					// return this.sendImage(cardId);
				})
				.catch(error => {
					this.errorMessage()
				})
			},

			successMessage() {
				swal(
				  'Good job!',
				  'You have added a Card',
				  'success'
				).then(function() {
			        window.location = "/profile";
			    });
			},

			errorMessage() {
				swal(
				  'Oops...',
				  'Stillwater Failed try again image max size 5MB',
				  'error'
				)
			},

			sendImage(id) {
				this.addCardImage({
					id: id,
					image: this.image
				})
				.then(response => {
					this.successMessage()
				})
				.catch(error => {
					this.errorMessage()
				})
			},

			// receives the image from the crop tool
			receiveImage(image) {
				this.image = image
			}
		},

		mounted(){
			this.style_id = this.data.id

			if(this.data.id === 1) {
	            stillwaterautocomplete('#districts').on('autocomplete:selected', (e, selection) => {
	            	this.profileDistrict = selection
	            }),
	            coarsefishautocomplete('#fishs').on('autocomplete:selected', (e, selection) => {
	                this.createFish = selection
	            })
	        }
	        if(this.data.id === 2) {
	            stillwaterlureautocomplete('#districts').on('autocomplete:selected', (e, selection) => { 
	            	this.profileDistrict = selection
	            }),
	            coarsefishautocomplete('#fishs').on('autocomplete:selected', (e, selection) => {
	                  this.createFish = selection
	            })
	        }
	        if(this.data.id === 3) {
	            riverautocomplete('#districts').on('autocomplete:selected', (e, selection) => { 
	                this.profileDistrict = selection
	            }),
	            coarsefishautocomplete('#fishs').on('autocomplete:selected', (e, selection) => {
	                  this.createFish = selection
	            })
	        }
	        if(this.data.id === 4) {
		        riverlureautocomplete('#districts').on('autocomplete:selected', (e, selection) => { 
		        this.profileDistrict = selection
		        }),
		        coarsefishautocomplete('#fishs').on('autocomplete:selected', (e, selection) => {
		              this.createFish = selection
		        })
	        }
	        if(this.data.id === 5) {
	            canalautocomplete('#districts').on('autocomplete:selected', (e, selection) => { 
	            	this.profileDistrict = selection
	            }),
	            coarsefishautocomplete('#fishs').on('autocomplete:selected', (e, selection) => {
	                  this.createFish = selection
	            })
	        }
	        if(this.data.id === 6) {
	            canallureautocomplete('#districts').on('autocomplete:selected', (e, selection) => { 
	            	this.profileDistrict = selection
	            }),
	            coarsefishautocomplete('#fishs').on('autocomplete:selected', (e, selection) => {
	                  this.createFish = selection
	            })
	        }
	        if(this.data.id === 7) {
	            seaboatautocomplete('#districts').on('autocomplete:selected', (e, selection) => { 
	            	this.profileDistrict = selection
	            }),
	            seafishautocomplete('#fishs').on('autocomplete:selected', (e, selection) => {
	                  this.createFish = selection
	            })
	        }
	        if(this.data.id === 8) {
	            seashoreautocomplete('#districts').on('autocomplete:selected', (e, selection) => { 
	            	this.profileDistrict = selection
	            }),
	            seafishautocomplete('#fishs').on('autocomplete:selected', (e, selection) => {
	                  this.createFish = selection
	            })
	        }
		}
	}
</script>