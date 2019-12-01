<template>
	<div class="col-sm-8 col-sm-offset-2 col-xs-12">
		<videomodal v-if="showModal" @close="showModal = false"
            video="https://s3.eu-west-2.amazonaws.com/video.fishcube.co.uk/profilepage.mp4">
        </videomodal>
		<div class="base-menu col-xs-12 row visible-xs">
            <div class="col-xs-2 col-xs-offset-5">
                <a class="words btn btn-sm" id="show-modal" @click="showModal = true">
                    <span class="glyphicon glyphicon-info-sign"></span>
                    <h6 class="links-zero">help</h6>
                </a>
            </div>
        </div>
        <div class="box-still container">
        	<form @submit.prevent="send">
	        	<div class="col-xs-12">
	    			<div class="margin-s">
						<label
							for="title"
							class="words myh4">Title
						</label>
						<input
							id="title"
							type="alphanum"
							class="form-control"
							v-model="title"
							required=""
							maxlength="30">  
					</div>
					<div class="margin-s">
						<label
							for="description"
							class="words myh4">Video description (Max Length 200 Characters)
						</label>
						<textarea
							rows="10"
							id="description"
							class="form-control"
							type="alphanum"
							v-model="description"
							required=""

							maxlength="200">
						</textarea>
					</div>

		    		<div class="margin-t margin-s">
		    			<button
		    				type="submit"
		    				class=" words btn btn-warning btn-block">
		    					Edit Your'e video
		    			</button>
		    		</div>
		        </div>
	    	</form>
        </div>	
    </div>
</template>
<script>
import { mapActions, mapGetters } from 'vuex'
import swal from 'sweetalert2'

	export default {
		props: [
			'video',
		],

		data() {
			return {
				showModal: false,
				type: '',
				style_id: null,
				profileDistrict: '',
				title: '',
				description: '',
			}
		},

		computed: mapGetters({
		}),

		methods: {
			...mapActions([
			]),
			send() {
				axios.patch('update/' + this.video.id, {
					title: this.title,
					description: this.description,
				}).then((response) => {
					this.successMessage()

				}).catch((error) => {
					this.errorMessage()
				})
			},
			successMessage() {
				swal(
				  'Good job!',
				  'You have edited youre video',
				  'success'
				).then(function() {
			        window.location = "/profile";
			    });
			},
			errorMessage() {
				swal(
				  'Oops...',
				  'Your video failed try again',
				  'error'
				)
			}
		},

		created() {
			this.title = this.video.title
			this.description = this.video.description
		}
	}
	
</script>