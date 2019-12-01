<template>
<div>
	<div class="base-menu col-xs-12 visible-xs">
		<div class="col-xs-1 col-xs-offset-2">
			<a title="Canal Lure map" href="/map/canal" class="words btn btn-sm">
				<span class="glyphicon glyphicon-map-marker"></span>
				<h6 class="links-zero">map</h6>
			</a>
		</div>
		<div class="col-xs-1 col-xs-offset-5">
			<a title="Help" class="words btn btn-sm" id="show-modal" @click="showModal = true">
				<span class="glyphicon glyphicon-info-sign"></span>
				<h6 class="links-zero">help</h6>
			</a>
		</div>
	</div>
	<div class="col-sm-8 col-sm-offset-2 col-xs-12">
		<videomodal v-if="showModal" @close="showModal = false"
            video="https://s3.eu-west-2.amazonaws.com/video.fishcube.co.uk/profilepage.mp4">
        </videomodal>
		<form action="#" @submit.prevent="send">
		<div class="box-still">
			<div class="margin-l">
				<h3 class="words">Select a New {{data.name}} Location</h3>
			</div>
				<div class="row margin-s">
					<div class="col-xs-6 margin-s">
							<h5 class="hidden-xs col-xs-7 words">Find your location </h5>
								<div class="hidden-xs ">
									<a title="Canal map" href="/map/canal" class=" margin-s words btn btn-primary btn-sm"><span class="glyphicon glyphicon-map-marker"></span></a>
									<a title="Help" class="words btn btn-primary btn-sm" id="show-modal" @click="showModal = true"><span class="glyphicon glyphicon-info-sign"></span></a>
								</div>
								<br>
							
							<label for="district_canal_id" class="words">Location</label>
							<div class="row">
								<div class="selector-box">
									<input 
									type="text"
									id="districts"
									name="districts" 
									class=" form-control margin-b"
									placeholder="Type Here ..." >
								</div>
							</div>
						</div>
						<div class="col-xs-4 col-xs-offset-1">
							<div class="box-panel margin-tm"
								v-if="selectDistrict">
								<img class="img-responsive image image-corners"
									:src="'/images/districts/'+selectDistrict.image">
								<h5 class="words">{{ selectDistrict.name }}</h5>
							</div>
						</div>
						<button class=" words btn btn-warning btn-block">
							Add a Canal Location
						</button>
				</div>
			</div>
			</form>
			<br>
			<fishselector :data="data"></fishselector>
		</div>	
	</div>
</template>			
<script>
import { mapActions, mapGetters } from 'vuex'
import { canalautocomplete } from '../helpers/canalautocomplete.js'
import { canallureautocomplete } from '../helpers/canallureautocomplete.js'
import { seaboatautocomplete } from '../helpers/seaboatautocomplete.js'
import { riverlureautocomplete } from '../helpers/riverlureautocomplete.js'
import { riverautocomplete } from '../helpers/riverautocomplete.js'
import { seashoreautocomplete } from '../helpers/seashoreautocomplete.js'
import { stillwaterlureautocomplete } from '../helpers/stillwaterlureautocomplete.js'
import { stillwaterautocomplete } from '../helpers/stillwaterautocomplete.js'
import swal from 'sweetalert2'

    export default {
    	props: [
    		'data',
    	],

   		data () {
      		return{
      			selectDistrict: null,
        		style_id: null,
        		showModal: false,
      		}
    	}, 

        methods: {
        	...mapActions ([
        		'submitLocation'
        		]),
        	
			send() {
				this.submitLocation({
					district_id: this.selectDistrict.id,
					name: this.selectDistrict.name,
					image: this.selectDistrict.image,
					style_id: this.style_id,
				})
				.then(response => {
					this.resetForm()
					this.successMessage()

				})
				.catch(error => {
					this.errorMessage 
				})
			},
			resetForm() {
				this.selectDistrict = null
			},
			successMessage() {
				swal(
				  'Good job!',
				  'You have added a Location now add a fish to that location',
				  'success'
				)
			},
			errorMessage() {
				swal(
				  'Oops...',
				  'district was not added no duplicates per style',
				  'error'
				)
			},
	        addSelectedDistrict(selectDistrict) {
	        	this.selectDistrict = selectDistrict
	        }
        },
        created() {
        	this.style_id = this.data.id
        },

        mounted() {
        	if(this.data.id === 1) {
	           	stillwaterautocomplete('#districts').on('autocomplete:selected', (e, selection) => {
	           		this.addSelectedDistrict(selection)
	           	})
            }
        	if(this.data.id === 2) {
	           	stillwaterlureautocomplete('#districts').on('autocomplete:selected', (e, selection) => {this.addSelectedDistrict(selection)
	           	})
            }
        	if(this.data.id === 3) {
	           	riverautocomplete('#districts').on('autocomplete:selected', (e, selection) => {
	           		this.addSelectedDistrict(selection)
	           	})
            }
        	if(this.data.id === 4) {
		      	riverlureautocomplete('#districts').on('autocomplete:selected', (e, selection) => {
		       		this.addSelectedDistrict(selection);
		       	})
            }
        	if(this.data.id === 5) {
          		canalautocomplete('#districts').on('autocomplete:selected', (e, selection) => {
           			this.addSelectedDistrict(selection)
           		})
            }
        	if(this.data.id === 6) {
	          	canallureautocomplete('#districts').on('autocomplete:selected', (e, selection) => {
	           		this.addSelectedDistrict(selection);
	           	})
            }
        	if(this.data.id === 7) {
	           	seaboatautocomplete('#districts').on('autocomplete:selected', (e, selection) => {
	           		this.addSelectedDistrict(selection)
	           	})
            }
        	if(this.data.id === 8) {
	           	seashoreautocomplete('#districts').on('autocomplete:selected', (e, selection) => {
	           		this.addSelectedDistrict(selection)
	           	})
            }
        }
    }
</script>