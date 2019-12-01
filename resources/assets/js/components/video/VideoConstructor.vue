<template>
	<div class="col-sm-8 col-sm-offset-2 col-xs-12">
		<videomodal v-if="showModal" @close="showModal = false"
            video="https://s3.eu-west-2.amazonaws.com/video.fishcube.co.uk/profilepage.mp4">
        </videomodal>
		<br>
		<div class="box-still container">
			<div v-if="!existingVideo">
				<h3 v-if="data" class="words">Create a {{data.name}} angling video</h3>
				<h3 v-if="card" class="words">Create a new video for this card </h3>
			</div>
			<div v-if="existingVideo">
				<h3 v-if="data" class="words">Link to existing {{data.name}} video</h3>
				<h3 v-if="card" class="words">Link this card to existing video</h3>
			</div>
			<br>
			<div class="margin-s">
				<button class="margin-ll words btn btn-primary btn-sm" id="show-modal" @click="showModal = true">
	                <span class="glyphicon glyphicon-info-sign"></span>
	                <h6 class="links-zero">help</h6>
	            </button>
	        </div>
            <div v-if="noVideo">
	            <div>
	        		<h4 class="words col-xs-7" style="margin-top: 5px" v-if="!existingVideo">use existing video</h4>
	        		<h4 class="words col-xs-7" style="margin-top: 5px" v-if="existingVideo">create new video</h4>
	        	</div>
	        	<label class="switch col-xs-2 margin-b">
				  <input type="checkbox" @click="toggle">
				  <span class="slider round"></span>
				</label>
			</div>
            <br>
            <div v-if="existingVideo">
            	<div class="margin-s row">
					<div class="col-xs-12">
						<div class="col-sm-6">
	            		<label v-if="data" for="district_stillwater_id" class="words">Select {{data.name}} location</label>
	            		<label v-if="card" for="district_stillwater_id" class="words">Location</label>

							<select class="form-control margin-b"
								required=""
								name="profile_district"
								v-model="profileDistrict">
								<option v-for="profileDistrict in profileDistricts"
										:value="profileDistrict">
										{{ profileDistrict.name }}
								</option>
							</select>
						</div>
					</div>
				</div>
				<div class="col-xs-12">
					<div v-if="(data || card) && existingVideo" class="col-sm-6">
	            		<label v-if="data" for="card_id" class="words">Link to {{data.name}} card</label>
	            		<label v-if="card" for="card_id" class="words">Link to below card</label>
							<select class="form-control margin-b"
									v-model="galleryCard">
								<option v-for="galleryCard in galleryCards"
									v-if="!galleryCard.video_id"
									:value="galleryCard"
									class="words">
									{{ galleryCard.capture_date }} / {{ galleryCard.display_description }}
								</option>
							</select>
					</div>
					<div v-if="(data || card) && existingVideo" class="image-field col-xs-5 words box-panel right">
						<img class="img-responsive image-corners" v-if="galleryCard.image" :src="galleryCard.image"/>
						<span v-if="!galleryCard.image">No image chosen</span>
					</div>
				</div>
				<div class="col-xs-12">
					<div v-for="userVideo, index in userVideos">
						<div class="box-still col-xs-12 margin-ts" style="padding: 0px">
							<div class="col-xs-10">
								<a :href="'/video/show/' + userVideo.id">
									<h4 class="words">{{ userVideo.title }}</h4>
								</a>
							</div>
							<div class="col-xs-1">
								<button title="select" class=" btn btn-warning margin-s" @click.prevent="videoId(userVideo.id)">
									<span class="glyphicon glyphicon-ok"></span>
									<h6 class="links-zero">select</h6>
								</button>
							</div>
						</div>
					</div>
					<pagination v-if="videoMeta.pagination && videoMeta.pagination.links" :meta="videoMeta.pagination" v-on:pagination:switched="getVideoMeta"></pagination>
	            </div>
	            <div class="margin-t margin-s">
	    			<button
	    				@click.prevent="linkVideoToCard()"
	    				class=" words btn btn-warning btn-block">
	    					Link to blog
	    			</button>
	    		</div>
            </div>
            <div v-if="!existingVideo" class="col-xs-12">
            	<div class="margin-s row">
					<div class="col-sm-6">
	            		<label v-if="data" for="district_stillwater_id" class="words">Select {{data.name}} location</label>
	            		<label v-if="card" for="district_stillwater_id" class="words"> Location</label>
						<select class="form-control margin-b"
							required=""
							name="district_canal_id"
							v-model="profileDistrict">
							<option v-for="profileDistrict in profileDistricts"
									:value="profileDistrict">
									{{ profileDistrict.name }}
							</option>
						</select>
					</div>
					<div v-if="data || card" class="col-sm-6">
	            		<label v-if="data" for="card_id" class="words">Link to {{data.name}} card</label>
	            		<label v-if="card" for="card_id" class="words">Link to below card</label>
							<select class="form-control margin-b"
									v-model="galleryCard">
								<option v-for="galleryCard in galleryCards"
										:value="galleryCard"
										class="words">
										{{ galleryCard.capture_date }} / {{ galleryCard.display_description }}
								</option>
							</select>
					</div>
					<div v-if="data || card" class="image-field col-xs-5 words box-panel right">
						<img class="img-responsive image-corners" v-if="galleryCard.image" :src="galleryCard.image"/>
						<span v-if="!galleryCard.image">No image chosen</span>
					</div>
					<div class="margin-s" v-if="!uploading && galleryCard">
						<label for="video" class="words margin-s">
							Choose a video to upload
						</label>
						<input class="words margin-s" type="file" name="video" id="video" @change="fileInputChange">
					</div>
				</div>
				<div v-if="uploading && galleryCard || !existingVideo && uploading || uploading && galleryCard && existingVideo">
					<div class="progress">
						<div class="progress-bar progress-bar-warning" :style="{width: fileProgress + '%'}">{{fileProgress}}% complete
						</div>
					</div>
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
							rows="3"
							id="description"
							type="alphanum"
							class="form-control"
							v-model="description"
							required=""
							maxlength="200">
						</textarea>	
					</div>
				</div>
	    		<div class="margin-t margin-s">
	    			<button
	    				@click.prevent="store()"
	    				class=" words btn btn-warning btn-block">
	    					Create new video
	    			</button>
	    		</div>
            </div>
			
			</div>
	</div>
</template>
<script>
import { mapActions, mapGetters } from 'vuex'
import swal from 'sweetalert2'

	export default {
		props:[
			'card',
			'data',
		],

		data() {
			return {
				profileDistrict: null,
				style_id: null,
				description: 'No description given',
				showModal: false,
				existingVideo: false,
				title: 'Untitled',
				galleryCard: '',
				selected: false,
				video_id: null,
				noVideo: true,
				uploading: false,
				fileProgress: 0,
			}
		},
		computed: mapGetters({
			profileDistricts: 'allProfileDistricts',
			galleryCards: 'allGalleryCards',
			userVideos: 'allUserVideos',
			videoMeta: 'allVideoMeta',
		}),
		methods: {
			...mapActions([
				'getProfileDistricts',
				'createVideo',
				'getGalleryCards',
				'getUserVideos',
				'getVideoMeta'
			]),

			fileInputChange() {
				this.uploading = true

				this.file = document.getElementById('video').files[0]
			},

			toggle() {
    			this.existingVideo = !this.existingVideo
    		},

			store(){
				this.createVideo({
					title: this.title,
					style_id: this.style_id,
					district_id: this.profileDistrict.district_id,
					description: this.description,
					extension: this.file.name.split('.').pop(),
				 })
				.then(response => {
					const savedVideo = response.data
					this.video_id = savedVideo.id
					this.uploadVideo()
				})
				.catch(error => {
					this.errorMessage()
				})
			},

			uploadVideo() {
				var form = new FormData()

				form.append('video', this.file)

				axios.post('/video/upload/' + this.video_id, form, {
					onUploadProgress: (e) => {
						if (e.lengthComputable) {
							console.log(e.loaded + ' ' + e.total)
							this.updateProgress(e)
						}
					}
				})
				.then((response) => {
					this.linkVideoToCard()

				})
				.catch((error) => {
					this.errorMessage()
				})
			},

			updateProgress(e) {
				e.percent = (e.loaded / e.total) * 100
				this.fileProgress = e.percent
			},

			videoId(id) {
				this.video_id = id
				this.galleryCard = this.galleryCards[0]
			},

			linkVideoToCard() {
				axios.patch('/video/link/' + this.galleryCard.id, {
						video_id: this.video_id,
					}).then((response) => {
						this.uploading = false
						this.successMessage()

					}).catch((error) => {
						this.errorMessage()
					})

			},

			successMessage() {
				swal(
				  'Good job!',
				  'You have uploaded a video',
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

		watch: {
			galleryCards() {
				if (this.card) {
			    	this.galleryCards.some(card => {
			    		if (card.id === this.card.id) {
			    			this.galleryCard = card
			    			return true
			    		} else {
			    			return false
			    		}
			    	})
			    }
			},
			profileDistricts() {
				if (this.card) {
			    	this.profileDistricts.some(district => {
			    		if (district.district_id === this.card.district_id) {
			    			this.profileDistrict = district
			    			return true
			    		} else {
			    			return false
			    		}
			    	})
			    }
			},

			profileDistrict() {
				if(this.getUserVideos({district:this.profileDistrict.district_id, style:this.style_id}))this.existingVideo = false
				this.getGalleryCards({district:this.profileDistrict.district_id, style:this.style_id})
			},
		},

		created(){
			if(this.data) {
				this.style_id = this.data.id
				this.existingVideo = false
				this.noVideo = false
			}
			if(this.card) {
				this.style_id = this.card.style_id
				this.existingVideo = true
			}
		},

		mounted() {
			this.getProfileDistricts({style:this.style_id})
			window.onbeforeunload = () => {
				if (this.uploading) {
					return 'Are you sure you want to leave this page?'
				}
			}
		},
	}
</script>