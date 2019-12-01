<template>
	<div class="box-still">
		<form action="#" @submit.prevent="sendFish">
			<div class="margin-l">
				<h3 class="words">Select a New {{data.name}} Fish</h3>
			</div>
				<div class="row margin-s">
					<div class="col-xs-7">
						<label for="district_stillwater_id" class="words">Canal Location</label>
							<select class="form-control margin-b"
									name="district_canal_id"
									v-model="profileDistrict">
								<option :value="district" v-for="district in profileDistricts">
										{{ district.name }}
								</option>
							</select>
						<label for="district_stillwater_id" class="words">Fish Species</label>
							<div>
								<input
								placeholder="Type Here ..."
								type="text"
								id="fishs"
								name="fishs"
								class="form-control margin-b">
							</div>
						</div>
						<div class="col-sm-4 col-sm-offset-1 col-xs-5">
							<div class="box-panel margin-tm"
								v-if="profileFish">
								<img class="img-responsive image image-corners"
									:src="'/images/fish/'+profileFish.image">
								<h5 class="words">{{ profileFish.name }}</h5>
							</div>
						</div>
					<button type="submit"
					name="Create canal selector"
					class=" words btn btn-warning btn-block">
							Add Canal Fish species
				</button>
			</div>
		</form>
	</div>
</template>
<script>
import { mapActions, mapGetters } from 'vuex'
import { coarsefishautocomplete } from '../helpers/coarsefishautocomplete.js'
import { seafishautocomplete } from '../helpers/seafishautocomplete.js'
import swal from 'sweetalert2'

	export default {
		props: [
			'data',
		],

   		data () {
      		return{
        		profileFish: null,
        		profileDistrict: null,
        		style_id: null,
			}
    	},
    	computed: {
				...mapGetters({
		        profileDistricts: 'allProfileDistricts'
		    })
			},
      methods: {
      	...mapActions ([
      		'getProfileDistricts',
      		'submitFishes'
      		]),

	    	sendFish() {
					this.submitFishes({
						district_id: this.profileDistrict.district_id,
						profile_district_id: this.profileDistrict.id,
						style_id: this.profileDistrict.style_id,
						fish_id: this.profileFish.id,
						name: this.profileFish.name,
						image: this.profileFish.image,
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
				this.profileFish = null
			},
			successMessage() {
				swal(
				  'Good job!',
				  'You have added a fish now create a card',
				  'success'
				)
			},
			errorMessage() {
				swal(
				  'Oops...',
				  'fish was not added no duplicates per style',
				  'error'
				)
			},
	      addProfileFish (profileFish) {
					this.profileFish = profileFish
				}

      },

		watch: {
			profileDistricts() {
				this.profileDistrict = this.profileDistricts[0]
			}
		},

      created (){
      	this.style_id = this.data.id
      },

      mounted (){
      	this.getProfileDistricts({style: this.style_id})
      	if(this.data.id <= 6) {
	           	coarsefishautocomplete('#fishs').on('autocomplete:selected', (e, selection) => {
         			this.addProfileFish(selection)
         		})
            }
        	if(this.data.id > 6) {
	           	seafishautocomplete('#fishs').on('autocomplete:selected', (e, selection) => {
			     	this.addProfileFish(selection)
			     })
            }
      }
    }

</script>