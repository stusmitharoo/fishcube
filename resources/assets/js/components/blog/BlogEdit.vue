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
							for="excerpt"
							class="words myh4">Blog description (Max Length 50 Characters)
						</label>
						<textarea
							rows="3"
							id="excerpt"
							type="alphanum"
							class="form-control"
							v-model="excerpt"
							required=""
							maxlength="50">
						</textarea>	
					</div>
					<div class="margin-s">
						<label
							for="content"
							class="words myh4">Blog content (Max Length 5000 Characters)
						</label>
						<tiny-mce
							v-model="content"
							:content="content">
						</tiny-mce>
					</div>

		    		<div class="margin-t margin-s">
		    			<button
		    				type="submit"
		    				class=" words btn btn-warning btn-block">
		    					Edit Your'e blog
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
			'blog',
		],

		data() {
			return {
				showModal: false,
				type: '',
				style_id: null,
				profileDistrict: '',
				title: '',
				excerpt: '',
				content: '',
			}
		},

		computed: mapGetters({
		}),

		methods: {
			...mapActions([
			]),
			send() {
				axios.patch('update/' + this.blog.id, {
					title: this.title,
					excerpt: this.excerpt,
					content: this.content,
				}).then((response) => {
					this.successMessage()

				}).catch((error) => {
					this.errorMessage()
				})
			},
			successMessage() {
				swal(
				  'Good job!',
				  'You have edited youre blog',
				  'success'
				).then(function() {
			        window.location = "/blog/listChoice";
			    });
			},
			errorMessage() {
				swal(
				  'Oops...',
				  'Your blog failed try again',
				  'error'
				)
			}
		},

		created() {
			this.title = this.blog.title
			this.excerpt = this.blog.excerpt
			this.content = this.blog.content
		}
	}
	
</script>