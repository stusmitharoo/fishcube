<template>
	<div class="col-sm-8 col-sm-offset-2 col-xs-12">
		<form @submit.prevent="send">
		<br>
		<div class="box-still">
		<h3 class="words">Create a Scenary Card</h3>
		<h5 class="words">A scenary card could be a picture of anything to do with you fishing trip.</h5>
		<br>
			<div v-if="errorMessage">
				{{errorMessage}}
			</div>

			<div class="margin-s row">
				<div class="col-sm-6">
					<imageupload img-src="/images/index/defualt.jpg" @sendToParent="receiveImage"></imageupload>
				</div>
			<div class="col-sm-6">
					<label
						for="name"
						class="words">Image name
					</label>
					<input
						id="capture_date"
						type="text"
						class="form-control margin-b"
						required=""
						v-model="display_description"

						>
				</div>
				<div class="col-sm-6">
					<label
						for="date"
						class="words">Date of Image
					</label>
					<input
						id="date"
						type="date"
						class="form-control margin-b"
						required=""
						v-model="capture_date">
				</div>
			</div>

    		<div class="margin-t margin-s">
    			<button
    				type="submit"
    				class=" words btn btn-warning btn-block">
    					Create a Scenary Card
    			</button>
    		</div>
			</div>
		</form>
	</div>
</template>
<script>
import { mapActions, mapGetters } from 'vuex'
import swal from 'sweetalert2'

	export default {
		data() {
			return {
				style_id: 9,
				image: null,
				capture_date: '',
				display_description: '',
				errorMessage: null
			}
		},
		methods: {
			...mapActions([
				'createScenary',
				'addScenaryImage'
				]),

			send(){
				this.errorMessage = null
				this.createScenary({
					 style_id: this.style_id,
					 capture_date: this.capture_date,
					 display_description: this.display_description,
				 })
			.then(response => {
					this.resetForm()
					const savedCard = response.data;
					const cardId = savedCard.id;
					return this.sendImage(cardId);
				})
				.catch(error => {
					this.errorMessage()
				})
			},
			resetForm() {
				this.lbs = 0
				this.ozs = 0
				this.dr = 0
				this.capture_date = []
				this.display_description = []
				this.profile_description = []
			},
			successMessage() {
				swal(
				  'Good job!',
				  'You have added a Scenary Card',
				  'success'
				)
			},
			errorMessage() {
				swal(
				  'Oops...',
				  'Scenary Card Failed try again image max size 5MB',
				  'error'
				)
			},

			sendImage(id) {
				this.addScenaryImage({
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
		}
	}
</script>