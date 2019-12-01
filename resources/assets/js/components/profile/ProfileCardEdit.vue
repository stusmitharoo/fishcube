<template>
	<div class="col-sm-8 col-sm-offset-2 col-xs-12">
		<form @submit.prevent="send">
		<br>
		<div class="box-still">
		<h3 class="words">Edit this Card</h3>
		<br>
			<div class="margin-s row">
				<div class="col-sm-6">
					<imageupload :img-src="'/images/cards/' + data.image" @sendToParent="receiveImage"></imageupload>
				</div>

				<div class="col-sm-6 margin-b col-sm-6">
					<label
						for="capture_date"
						class="words">Date of Capture
					</label>
					<div class="form-control">
						<datepicker @selected="changeDate"></datepicker>
					</div>
				</div>
				<div class=" col-xs-4 col-sm-6 margin-b">
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
				<div class=" col-xs-4 col-sm-6 margin-b">
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
				<div class=" col-xs-4 col-sm-6 margin-b">
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
    					Edit this Card
    			</button>
    		</div>
			</div>
		</form>
	</div>
</template>
<script>
import { mapActions, mapGetters } from 'vuex'
import swal from 'sweetalert2'
import datepicker from 'vuejs-datepicker'

	export default {
		props:[
			'data'
		],

		data() {
			return {
				lbs: 0,
				ozs: 0,
				dr: 0,
				image: null,
				capture_date: '',
				display_description: '',
				profile_description: '',
			}
		},

		methods: {
			...mapActions([
				'getProfileDistricts',
				'getCreateFishs',
				'editCard',
				'editCardImage'
				]),

			changeDate(date) {
				this.capture_date = date
			},

			send(id){
				this.editCard({
					id: this.data.id,
					lbs: this.lbs,
					ozs: this.ozs,
					dr: this.dr,
					capture_date: this.capture_date,
					display_description: this.display_description,
					profile_description: this.profile_description,
				 })
			.then(response => {
					const savedCard = response.data;
					const cardId = savedCard.id;
					return this.sendImage(cardId);
				})
				.catch(error => {
					this.errorMessage()
				})
			},

			successMessage() {
				swal(
				  'Good job!',
				  'You have updated your Card',
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
				this.editCardImage({
					id: id,
					image: this.image
				})
				.then(response => {
					this.successMessage()
				})
				.catch(() => {
					this.errorMessage()
				})
			},

			// receives the image from the crop tool
			receiveImage(image) {
				this.image = image
			}
		},

		mounted () {
			this.lbs = this.data.lbs
			this.ozs = this.data.ozs
			this.dr = this.data.dr
			this.capture_date = this.data.capture_date
			this.profile_description = this.data.profile_description
			this.display_description = this.data.display_description
		}
	}
</script>