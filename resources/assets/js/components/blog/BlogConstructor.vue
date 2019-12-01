<template>
	<div class="col-sm-8 col-sm-offset-2 col-xs-12">
		<videomodal v-if="showModal" @close="showModal = false"
            video="https://s3.eu-west-2.amazonaws.com/video.fishcube.co.uk/profilepage.mp4">
        </videomodal>
		<form @submit.prevent="send">
		<br>
		<div class="box-still container">
			<div v-if="!existingBlog">
				<h3 v-if="data" class="words">Create a {{data.name}} angling blog</h3>
				<h3 v-if="card" class="words">Create a new blog for this card </h3>
			</div>
			<div v-if="existingBlog">
				<h3 v-if="data" class="words">Link to existing {{data.name}} blog</h3>
				<h3 v-if="card" class="words">Link this card to existing blog</h3>
			</div>
			<br>
			<div class="margin-s">
				<button class="margin-ll words btn btn-primary btn-sm" id="show-modal" @click.prevent="showModal = true">
	                <span class="glyphicon glyphicon-info-sign"></span>
	                <h6 class="links-zero">help</h6>
	            </button>
	        </div>
            <div v-if="noBlog">
	            <div>
	        		<h4 class="words col-xs-7" style="margin-top: 5px" v-if="!existingBlog">use existing blog</h4>
	        		<h4 class="words col-xs-7" style="margin-top: 5px" v-if="existingBlog">create new blog</h4>
	        	</div>
	        	<label class="switch col-xs-2 margin-b">
				  <input type="checkbox" @click="toggle">
				  <span class="slider round"></span>
				</label>
			</div>
            <br>
            <div v-if="existingBlog">
            	<div class="margin-s row">
					<div class="col-xs-12">
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
				<div v-if="(data || card) && existingBlog" class="col-sm-6">
            		<label v-if="data" for="card_id" class="words">Link to {{data.name}} card</label>
            		<label v-if="card" for="card_id" class="words">Link to the card below</label>
						<select class="form-control margin-b"
								v-model="galleryCard">
							<option v-for="galleryCard in galleryCards"
								v-if="!galleryCard.blog_id"
								:value="galleryCard"
								class="words">
								{{ galleryCard.capture_date }} / {{ galleryCard.display_description }}
							</option>
						</select>
				</div>
				<div v-if="galleryCard.image" class="image-field col-xs-5 words box-panel right">
					<img class="img-responsive image-corners" :src="galleryCard.image"/>
					<span v-if="!galleryCard.image">No image chosen</span>
				</div>
				<div class="col-xs-12">
					<div v-for="userBlog, index in userBlogs">
						<div class="box-still col-xs-12 margin-ts" style="padding: 0px">
							<div class="col-xs-10">
								<a :href="'/blog/show/' + userBlog.id">
									<h4 class="words">{{ userBlog.title }}</h4>
								</a>
							</div>
							<div class="col-xs-1">
								<button data-toggle="button" aria-pressed="false" class=" btn btn-warning btn-sm margin-s" @click.prevent="blogId(userBlog.id)">
									<span class="glyphicon glyphicon-ok"></span>
									<h6 class="links-zero">select</h6>
								</button>
							</div>
						</div>
					</div>
					<pagination v-if="blogMeta.pagination && blogMeta.pagination.links" :meta="blogMeta.pagination" v-on:pagination:switched="getBlogMeta"></pagination>
	            </div>
	            <div class="margin-t margin-s">
	    			<button
	    				@click.prevent="linkBlogToCard()"
	    				class=" words btn btn-warning btn-block">
	    					Link to blog
	    			</button>
	    		</div>
            </div>
            <div v-if="!existingBlog" class="col-xs-12">
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
	            		<label v-if="card" for="card_id" class="words">Link to the card below</label>
							<select class="form-control margin-b"
									v-model="galleryCard">
								<option v-for="galleryCard in galleryCards"
									v-if="!galleryCard.blog_id"
									:value="galleryCard"
									class="words">
									{{ galleryCard.capture_date }} / {{ galleryCard.display_description }}
								</option>
							</select>
					</div>
					<div v-if="galleryCard.image" class="image-field col-xs-5 words box-panel right">
						<img class="img-responsive image-corners" :src="galleryCard.image"/>
						<span v-if="!galleryCard.image">No image chosen</span>
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
						v-model="content">
					</tiny-mce>
				</div>

	    		<div class="margin-t margin-s">
	    			<button
	    				type="submit"
	    				class=" words btn btn-warning btn-block">
	    					Create new blog
	    			</button>
	    		</div>
            </div>
			
			</div>
		</form>
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
				excerpt: '',
				content: '',
				showModal: false,
				existingBlog: false,
				title: '',
				galleryCard: '',
				selected: false,
				blog_id: null,
				noBlog: true,
			}
		},
		computed: mapGetters({
			profileDistricts: 'allProfileDistricts',
			galleryCards: 'allGalleryCards',
			userBlogs: 'allUserBlogs',
			blogMeta: 'allBlogMeta',
		}),
		methods: {
			...mapActions([
				'getProfileDistricts',
				'createBlog',
				'getGalleryCards',
				'getUserBlogs',
				'getBlogMeta'
			]),

			toggle() {
    			this.existingBlog = !this.existingBlog
    		},

			send(){
				this.createBlog({
					 style_id: this.style_id,
					 district_id: this.profileDistrict.district_id,
					 title: this.title,
					 excerpt: this.excerpt,
					 content: this.content,
				 })
				.then(response => {
					const savedBlog = response.data;
					this.blog_id = savedBlog.id;

					this.linkBlogToCard()
				})
				.catch(error => {
					this.errorMessage()
				})
			},

			blogId(id) {
				this.blog_id = id
				this.galleryCard =this.galleryCards[0]
			},

			linkBlogToCard() {
				axios.patch('update/' + this.galleryCard.id, {
						blog_id: this.blog_id,
					}).then((response) => {
						this.successMessage()

					}).catch((error) => {
						this.errorMessage()
					})

			},

			successMessage() {
				swal(
				  'Good job!',
				  'You have created a blog',
				  'success'
				).then(function() {
			        window.location = "/profile";
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
				if(this.getUserBlogs({district:this.profileDistrict.district_id, style:this.style_id}))this.existingBlog = false
				this.getGalleryCards({district:this.profileDistrict.district_id, style:this.style_id})
			},
		},

		created(){
			if(this.data) {
				this.style_id = this.data.id
				this.existingBlog = false
				this.noBlog = false
			}
			if(this.card) {
				this.style_id = this.card.style_id
				this.existingBlog = true
			}
		},

		mounted() {
			this.getProfileDistricts({style:this.style_id})
		}
	}
</script>