<template>
	<div>
		<div class="col-sm-8 col-sm-offset-2 col-xs-12">
		 	<videomodal v-if="showModal" @close="showModal = false"
	            video="https://s3.eu-west-2.amazonaws.com/video.fishcube.co.uk/profilepage.mp4">
	        </videomodal>
			<form action="#" @submit.prevent="send">
			<div class="box-still">
				<div class="margin-l" v-if="newGallery">
					<h3 class="words">Create a new gallery</h3>
				</div>
				<div class="margin-l" v-if="existingGallery">
					<h3 class="words">Link to existing gallery</h3>
				</div>
				<div class="col-xs-12 margin-s margin-b">
	                <button class="words btn btn-primary btn-sm" id="show-modal" @click.prevent="showModal = true">
	                    <span class="glyphicon glyphicon-info-sign"></span>
	                    <h6 class="links-zero">help</h6>
	                </button>
	            </div>
	            <div>
            		<h4 class="words col-xs-7" style="margin-top: 5px" v-if="newGallery && !createNew">use existing gallery</h4>
            		<h4 class="words col-xs-7" style="margin-top: 5px" v-if="existingGallery">create new gallery</h4>
            	</div>
            	<label v-if="!createNew" class="switch col-xs-2 margin-b">
				  <input type="checkbox" @click="toggle">
				  <span class="slider round"></span>
				</label>
	            <br>
	            <div v-if="existingGallery && !createNew" class="container col-xs-12">
	            	<div class="col-xs-6">
		            	<label class="words margin-b">Location</label>
		            	<select class="form-control margin-b"
								required=""
								v-model="profileDistrict">
							<option v-for="profileDistrict in profileDistricts"
									:value="profileDistrict">
									{{ profileDistrict.name }}
							</option>
						</select>
					</div>
					<div class="col-xs-12 margin-s" v-if="!userHeaders.length">
						<h4 class="words">No galleries exist for this location</h4>
					</div>
					<div v-for="userheader, index in userHeaders">
						<div class="box-still col-xs-12" style="padding: 0px">
							<div class="col-xs-4">
								<img class="img-responsive image-corners margin-ts" :src="userheader.image">
							</div>
							<div class="col-xs-5">
								<h4 class="hidden-xs words">{{ userheader.name }}</h4>
								<h5 class="visible-xs words">{{ userheader.name }}</h5>
							</div>
							<div class="col-xs-1">
								<a v-if="!selected" title="select" class=" btn btn-warning margin-s" @click.prevent="select(userheader.id)">
									<span class="glyphicon glyphicon-ok"></span>
								</a>
								<a v-if="selected" title="select" class=" btn btn-primary margin-s" @click.prevent="unselected">
									<span class="glyphicon glyphicon-remove"></span>
								</a>
							</div>
						</div>
					</div>
					<pagination v-if="userMeta.pagination && userMeta.pagination.links && userHeaders.length" :meta="userMeta.pagination" v-on:pagination:switched="getUserMeta"></pagination>
	            </div>
	            <div v-if="newGallery">
					<div class="row margin-s">
						<div class="col-xs-6">
							<label class="words">Location</label>
								<div class="row">
									<div class="selector-box col-xs-12 margin-b">
										<select class="form-control margin-b"
												required=""
												name="district_canal_id"
												v-model="profileDistrict">
											<option v-for="profileDistrict in profileDistricts"
													:value="profileDistrict">
													{{ profileDistrict.name }}
											</option>
										</select>
										<label
											for="name"
											class="words">Name of Gallery
										</label>
										<input
										  type="text"
										  class="form-control margin-b"
										  required=""
										  id="name"
										  v-model="name">
									</div>
								</div>
							</div>
							<div class="col-xs-6">
								<a  href="/galleryScenary" class="btn-block btn btn-primary margin-t"><h6>Add Scenary</h6>
								</a>
							</div>
						</div>
						<div class="col-xs-12">
							<div class="col-xs-6">
								<label for="title" class="words">Image name</label>
								<input type="text" id="title" class="form-control margin-b" v-model="headerTitle">
								<label for="gallery-header" class="words">Header Image</label>
									<select class="form-control margin-b"
											required=""
											name="gallery-header"
											v-model="galleryHeader">
										<option v-for="galleryCard in galleryCards"
												:value="galleryCard"
												class="words">
												{{ galleryCard.lbs }}lbs {{ galleryCard.ozs }}ozs {{ galleryCard.dr }}dr /{{ galleryCard.capture_date }} / {{ galleryCard.display_description }}

										</option>
									</select>
							</div>
							
							<div class="image-field col-xs-5 words box-panel right">
								<img class="img-responsive image-corners" v-if="galleryHeader.image" :src="galleryHeader.image"/>
								<span v-if="!galleryHeader.image">No image chosen</span>
							</div>
						</div>
							
						<div class="col-xs-12" v-for="field in arrayOfImageFields">
							<hr>
							<div class="col-xs-6">
								<label for="title" class="words">Image name</label>
								<input type="text" id="title" class="form-control margin-b" v-model="field.name">
								<label for="scenary-image" class="words">{{ field.type }} image</label>
									<select class="form-control margin-b"
											v-if="field.type === 'scenery'"
											v-model="field.image">
										<option v-for="scenaryImage in scenaryImages"
												:value="scenaryImage"
												class="words">
												{{ scenaryImage.date }} / {{ scenaryImage.name }}
										</option>
									</select>
									<select class="form-control margin-b"
											v-if="field.type === 'fish'"
											v-model="field.image">
										<option v-for="galleryCard in galleryCards"
											v-if="!galleryCard.gallery_header_id"
											:value="galleryCard"
											class="words">
											{{ galleryCard.capture_date }} / {{ galleryCard.display_description }}
										</option>
									</select>
							</div>
								<div class="image-field col-xs-5 words box-panel right">
									<img class="img-responsive image-corners" v-if="field.image" :src="field.image.image"/>
									<span v-if="!field.image">No image chosen</span>
								</div>
							</div>
						<hr>
						<div class="row margin-b">
							<div class="col-xs-6">
								<button
				    				type="button"
				    				class=" words btn btn-primary btn-block margin-t"  @click="createNewField('fish')">
				    					Add card image
				    			</button>
							</div>
							<div class="col-xs-6">
								<button
				    				type="button"
				    				class=" words btn btn-primary btn-block margin-t"  @click="createNewField('scenery')">
				    					Add scenery image
				    			</button>
							</div>
						</div>
					</div>
					<div class="margin-t margin-b">
		    			<button
		    				v-if="newGallery"
		    				type="submit"
		    				class=" words btn btn-warning btn-block">
		    					Create a new gallery
		    			</button>
		    			<button
		    				v-if="existingGallery"
		    				type="submit"
		    				class=" words btn btn-warning btn-block">
		    					Link to existing gallery
		    			</button>
	    			</div>
				</div>
			</form>
			<br>
		</div>
	</div>
</template>
<script>
import { mapActions, mapGetters } from 'vuex'
import swal from 'sweetalert2'

     export default {
		props:[
			'data',
			'choice'
		],
   		data () {
      		return{
				numberOfImageFields: 2,
				headerTitle: null,
				galleryHeader: {},
				arrayOfImageFields: [],
      			profileDistrict: null,
        		style: null,
        		name: null,
        		gallery_header_id: null,
				order_no_header: 1,
				order_no_start: 2,
				showModal: false,
				existingGallery: false,
				newGallery: false,
				card_id: null,
				header_id: null,
				selected: false,
				createNew: false,
      		}
    	},
    	computed: mapGetters({
			profileDistricts: 'allProfileDistricts',
			galleryCards: 'allGalleryCards',
			scenaryImages: 'allScenaryImages',
			userHeaders: 'allUserHeaders',
			userMeta: 'allUserMeta'
		}),

        methods: {
        	...mapActions ([
        		'getScenaryImages',
				'getProfileDistricts',
				'getGalleryCards',
        		'createHeader',
        		'createAllGallery',
        		'getUserHeaders',
    		]),

    		getUserMeta(page) {
				this.getUserHeaders({district:this.profileDistrict.district_id, style:this.style,page:page})
    		},

    		select(id) {
    			this.header_id = id
    			this.selected = true
    		},

    		unselected() {
    			this.header_id = null
    			this.selected = false
    		},

    		toggle() {
    			this.existingGallery = !this.existingGallery
    			this.newGallery = !this.newGallery
    		},

			send() {
				if(this.existingGallery) {
					return this.linkGalleryToCard()
				
					.then((response) => {
						this.successMessage()

					})
					.catch((error) => {
						this.errorMessage()
					})
				}
				if(this.newGallery) {
					this.createHeader({
						name: this.name,
						style_id: this.style,
						district_id: this.galleryHeader.district_id,
						date: this.galleryHeader.capture_date,
						image: this.galleryHeader.image_id,
					})
					.then(response => {
						const savedCard = response.data;
						this.gallery_header_id = savedCard.id;

						return this.createHeaderCard()
					})
					.then(response => {
						return this.createAllImages()
					})
					.then(response => {
							return this.linkGalleryToCard()
					})
					.then(response => {
						this.successMessage()
					})
					.catch(error => {
						this.errorMessage()
					})
				}
			},

			linkGalleryToCard() {
				axios.patch('update/' + this.card_id, {
						gallery_header_id: this.gallery_header_id,
					})
					.catch((error) => {
						this.errorMessage()
					})

			},

			createNewField(type) {
				this.arrayOfImageFields.push({
					type: type,
					image: null
				})
			},

			createHeaderCard() {
				this.createAllGallery({
					gallery_header_id: this.gallery_header_id,
					order_no: this.order_no_header,
					date: this.galleryHeader.capture_date,
					name: this.headerTitle,
					image: this.galleryHeader.image_id,
				})
				.catch(error => {
					this.errorMessage
				})
			},

			createAllImages() {
				let imagesLeft = this.arrayOfImageFields.length

				// Returns a promise when all the images are uploaded
				return new Promise((resolve, reject) => {

					// Iterates through iamges
					this.arrayOfImageFields.forEach((field, index) => {

						// Creates images async
						this.createImage(field, index)
							.then(response => {
								imagesLeft--
								if (!imagesLeft) resolve()
							})
							.catch(error => {
								this.errorMessage
							})
					})
				})
			},

			createImage(field, index) {
				if (!field.image) {
					return Promise.resolve()
				}

				return this.createAllGallery({
					gallery_header_id: this.gallery_header_id,
					order_no: index + this.order_no_start,
					date: field.image.capture_date ? field.image.capture_date : field.image.date,
					name: field.name,
					image: field.image.image_id,
				})
				.catch(error => {
					this.errorMessage
				})

			},

			successMessage() {
				swal(
				  'Good job!',
				  'You have created a gallery',
				  'success'
				).then(function() {
			        window.location = "/gallery";
			    });
			},

			errorMessage() {
				swal(
				  'Oops...',
				  'Gallery has not been created',
				  'error'
				)
			}
		},

    watch: {
			profileDistrict() {
				if(!this.profileDistrict && !this.style) return
				this.getUserHeaders({district:this.profileDistrict.district_id, style:this.style, page: 1})
				this.getGalleryCards({district:this.profileDistrict.district_id, style:this.style})
			},

			profileDistricts() {
				if (this.data) {
			    	this.profileDistricts.some(district => {
			    		if (district.district_id === this.data.district_id) {
			    			this.profileDistrict = district
			    			return true
			    		} else {
			    			return false
			    		}
			    	})
			    }
			},

			galleryCards() {
				if (this.data) {
			    	this.galleryCards.some(gallery => {
			    		if (gallery.district_id === this.data.district_id) {
			    			this.galleryHeader = gallery
			    			return true
			    		} else {
			    			return false
			    		}
			    	})
			    }
			}

		},

    mounted() {
    	if (this.data) {
    		this.style = this.data.style_id
    		this.headerTitle = this.data.display_description
    		this.card_id = this.data.id
    		this.newGallery = true
    	}	
    	if (this.choice) {
    		this.style = this.choice.id
    		this.createNew = true
    		this.newGallery = true
    	}
    	this.getProfileDistricts({style: this.style})
    	this.getScenaryImages({style: 9})


    }
  }
</script>