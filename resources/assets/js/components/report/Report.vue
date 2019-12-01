<template>
	<div class="col-sm-8 col-sm-offset-2 col-xs-12">
		<videomodal v-if="showModal" @close="showModal = false"
            video="https://s3.eu-west-2.amazonaws.com/video.fishcube.co.uk/profilepage.mp4">
        </videomodal>
		<br>
		<div class="box-still">
		<h3 class="words">Report predetor and prey from {{water.name}}</h3>
		<h5 class="words margin-s"> this report keeps no personal details and is for the collection of data to help with the future of our rivers. this data wil be made available to any organization that requires this.</h5>
		<br>
			<button class="margin-ll words btn btn-primary btn-sm" id="show-modal" @click="showModal = true">
                <span class="glyphicon glyphicon-info-sign"></span>
            </button>
			<div class="margin-s">
				<div class="col-xs-12">
            		<label for="districts" class="plan-words">{{water.name}} Location</label>
						<input 
                            placeholder="Type Here ..." 
                            type="text"
                            id="districts"
                            name="districts" 
                            class="col-xs-10 form-control margin-b">
				</div>
				<div class="col-sm-12">
					<h5 for="bankTime" class="plan-words col-sm-12">
						<strong>Time on the bank</strong>
					</h5>
					<div class="col-xs-6 col-sm-3">
						<label class="plan-words" for="hour">Hours</label>
						<input
						id="lbs"
						type="number"
						class="form-control"
						v-model="hours"
						required=""
						min="0"
						max="48">
					</div>
					<div class="col-xs-6 col-sm-3 margin-b">
						<label class="plan-words" for="minutes">Minutes</label>
						<select class="form-control"
							v-model="minutes">
							<option>15</option>
							<option>30</option>
							<option>45</option>
						</select>
					</div>

					<div class="col-sm-6 margin-b">
						<label
							for="date"
							class="words">Report date
						</label>
						<div class="form-control">
							<datepicker @selected="changeDate"></datepicker>
						</div>
					</div>
				</div>
			</div>
			<div class="col-xs-12" v-for="field in arrayOfPreyFields">
				<div class="col-xs-12"  v-if="field.type === 'fish'">
					<h4 class="words col-sm-12 margin-bs">
						<strong>Fish Species</strong>
					</h4>
					<h6 class="col-xs-12 words">Each section can have an input of 1 6lb chub or 20 2oz roach</h6>
					<div class="col-xs-8 margin-l">
						<label for="fishs" class="plan-words">Fish species</label>
							<input 
	                            placeholder="Type Here ..." 
	                            type="text"
	                            id="fishs"
	                            name="fishs" 
	                            v-model="field.fish"
	                            class="form-control margin-b">
	                </div>
		            <div class="col-xs-12"> 
		                <div class="col-xs-4">
		                    <label  for="lbs" class="plan-words">lbs</label>
		                    	<input type="number" 
		                    		name="lbs"
		                    		id="lbs"
		                    		v-model="field.lbs"
		                    		min="0"
		                    		required=""
		                    		class="form-control margin-b">
	            		</div>
	            		<div class="col-xs-4">
		                    <label  for="ozs" class="plan-words">ozs</label>
		                    	<input type="number" 
		                    		name="ozs"
		                    		id="ozs"
		                    		v-model="field.ozs"
		                    		min="0"
		                    		max="15" 
		                    		required=""
		                    		class="form-control margin-b">
		                </div>
		                <div class="col-xs-4">
		                    <label  for="qty" class="plan-words">qty</label>
		                    	<input type="number" 
		                    		name="qty"
		                    		id="qty"
		                    		v-model="field.fish_qty"
		                    		min="0"
		                    		required=""
		                    		class="form-control margin-b">
		                </div>
					</div>
					<div class="seperator"></div>
				</div>
				<div class="col-xs-12"  v-if="field.type === 'predetor'">
					<h4 class="words col-xs-12 margin-bs">
						<strong>Bird or mammall species</strong>
					</h4>
					<h6 class="col-xs-12 words">Each section can have an input of 1 Otter or 20 Blackheaded gulls</h6>
					<div class="row col-xs-12">
						<div class="col-xs-8">
							<label for="predetor" class="plan-words">Predetor species</label>
								<input 
		                            placeholder="Type Here ..." 
		                            type="text"
		                            id="predetor"
		                            name="predetor" 
		                            v-model="field.predetor"
		                            class="form-control margin-b">
		                </div>
			            <div class="col-xs-4">
		                    <label  for="qty" class="plan-words">qty</label>
		                    	<input type="number" 
		                    		name="qty"
		                    		id="qty"
		                    		v-model="field.predetor_qty"
		                    		min="0"
		                    		required=""
		                    		class="form-control margin-b">
		                </div>
		            </div>
		            <div class="seperator"></div>
				</div>
			</div>
			<div class="row margin-s">
				<div class="col-xs-6">
					<button
	    				type="button"
	    				class=" words btn btn-primary btn-block margin-t"  @click.prevent="createNewField('fish')">
	    					Add another fish
	    			</button>
				</div>
				<div class="col-xs-6">
					<button
	    				type="button"
	    				class=" words btn btn-primary btn-block margin-t"  @click.prevent="createNewField('predetor')">
	    					Add another predetor
	    			</button>
				</div>
			</div>

    		<div class="margin-t margin-s">
    			<button
    				@click.prevent="send"
    				class=" words btn btn-warning btn-block">
    					Create new card
    			</button>
    		</div>
			</div>
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
			'water',
		],

		data() {
			return {
				numberOfPreyFields: 2,
				arrayOfPreyFields: [],
				createFish:'',
				district: '',
				style_id: '',
				hours: 0,
				minutes: 15,
				report_date: '',
				showModal: false,
			}
		}, 

		computed: mapGetters({
		}),

		methods: {
			...mapActions([
				'createAllPrey'
				]),

			changeDate(date) {
				this.report_date = date
			},

			createNewField(type) {
				this.arrayOfPreyFields.push({
					type: type,
				})
			},
			send() {
				let preyLeft = this.arrayOfPreyFields.length

				// Returns a promise when all the prey is uploaded
				return new Promise((resolve, reject) => {

					// Iterates through prey
					this.arrayOfPreyFields.forEach((field, index) => {

						// Creates prey async
						this.createPrey(field, index)
							.then(response => {
								preyLeft--
								if (!preyLeft) resolve()
							})
							.then(response => {
								this.successMessage
							})
							.catch(error => {
								this.errorMessage
							})
					})
				})
			},

			createPrey(field, index) {

				return this.createAllPrey({
					style_id: this.style_id,
					district_id: this.district.id,
					report_date: this.report_date,
					hours: this.hours,
					minutes: this.minutes,
					fish_id: field.fish,
					lbs: field.lbs,
					ozs: field.lbs,
					fish_qty: field.fish_qty,
					predetor_qty: field.predetor_qty,
					predetor_id: field.predetor,

				})
				.catch(error => {
					this.errorMessage
				})

			},

			successMessage() {
				swal(
				  'Good job!',
				  'You have added a report',
				  'success'
				).then(function() {
			        window.location = "/";
			    });
			},

			errorMessage() {
				swal(
				  'Oops...',
				  'Report Failed try again',
				  'error'
				)
			},
		},

		mounted(){
			this.style_id = this.water.id

			if(this.water.id === 1) {
	            stillwaterautocomplete('#districts').on('autocomplete:selected', (e, selection) => {
	            	this.district = selection
	            }),
	            coarsefishautocomplete('#fishs').on('autocomplete:selected', (e, selection) => {
	                this.createFish = selection.id
	            })
	        }
	        if(this.water.id === 2) {
	            stillwaterlureautocomplete('#districts').on('autocomplete:selected', (e, selection) => { 
	            	this.district = selection
	            }),
	            coarsefishautocomplete('#fishs').on('autocomplete:selected', (e, selection) => {
	                  this.createFish = selection
	            })
	        }
	        if(this.water.id === 3) {
	            riverautocomplete('#districts').on('autocomplete:selected', (e, selection) => { 
	                this.district = selection
	            }),
	            coarsefishautocomplete('#fishs').on('autocomplete:selected', (e, selection) => {
	                  this.createFish = selection
	            })
	        }
	        if(this.water.id === 4) {
		        riverlureautocomplete('#districts').on('autocomplete:selected', (e, selection) => { 
		        this.district = selection
		        }),
		        coarsefishautocomplete('#fishs').on('autocomplete:selected', (e, selection) => {
		              this.createFish = selection
		        })
	        }
	        if(this.water.id === 5) {
	            canalautocomplete('#districts').on('autocomplete:selected', (e, selection) => { 
	            	this.district = selection
	            }),
	            coarsefishautocomplete('#fishs').on('autocomplete:selected', (e, selection) => {
	                  this.createFish = selection
	            })
	        }
	        if(this.water.id === 6) {
	            canallureautocomplete('#districts').on('autocomplete:selected', (e, selection) => { 
	            	this.district = selection
	            }),
	            coarsefishautocomplete('#fishs').on('autocomplete:selected', (e, selection) => {
	                  this.createFish = selection
	            })
	        }
	        if(this.water.id === 7) {
	            seaboatautocomplete('#districts').on('autocomplete:selected', (e, selection) => { 
	            	this.district = selection
	            }),
	            seafishautocomplete('#fishs').on('autocomplete:selected', (e, selection) => {
	                  this.createFish = selection
	            })
	        }
	        if(this.water.id === 8) {
	            seashoreautocomplete('#districts').on('autocomplete:selected', (e, selection) => { 
	            	this.district = selection
	            }),
	            seafishautocomplete('#fishs').on('autocomplete:selected', (e, selection) => {
	                  this.createFish = selection
	            })
	        }
		}
	}
</script>