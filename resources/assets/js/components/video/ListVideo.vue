<template>
	<div class="col-sm-8 col-sm-offset-2 col-xs-12">
		<videomodal v-if="showModal" @close="showModal = false"
            video="https://s3.eu-west-2.amazonaws.com/video.fishcube.co.uk/profilepage.mp4">
        </videomodal>
        <div class="box-still container">
        	<h3 class="words">Your'e video listings</h3>
        	<h5 class="words">Manage your'e videos</h5>
        	<div class="margin-s">
	        	<button class="margin-ll margin-s words btn btn-primary btn-sm" id="show-modal" @click="showModal = true">
	                <span class="glyphicon glyphicon-info-sign"></span>
	                <h6 class="links-zero">help</h6>
	            </button>
	        </div>
            <div class="margin-s row">
				<div class="col-xs-12">
            		<label for="district_stillwater_id" class="words margin-ts">Select a location</label>

						<select class="form-control margin-ts"
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
			<div class="col-xs-12 media">
				<div v-for="userVideo, index in userVideos">
					<div class="box-still col-xs-12 margin-ts" style="padding: 0px">
						<div class="col-xs-3 media-left">
							<a :href="'/video/show/' + userVideo.id">
								<img :src="userVideo.thumbnail" :alt="userVideo.title" class="img-responsive img-corners margin-s media-object">
							</a>
						</div>
						<div class="col-xs-5">
							<a :href="'/video/show/' + userVideo.id">
								<h4 class="words">{{ userVideo.title }}</h4>
							</a>
						</div>
						<div class="col-xs-1 margin-s">
							<a title="select" class=" btn btn-primary btn-sm" :href="'/video/edit/' + userVideo.id">
								<span class="glyphicon glyphicon-edit"></span>
								<h6 class="links-zero">edit</h6>
							</a>
						</div>
						<div class="col-xs-1">
							<button title="select" class=" btn btn-warning btn-sm margin-s" @click.prevent="videoDeleted(userVideo.id)">
								<span class="glyphicon glyphicon-remove"></span>
								<h6 class="links-zero">delete</h6>
							</button>
						</div>
					</div>
				</div>
				<div v-if="!userVideos.length && profileDistrict">
					<h5 class="words">You have no videos for this location</h5>
				</div>
				<pagination v-if="videoMeta.pagination && videoMeta.pagination.links" :meta="videoMeta.pagination" v-on:pagination:switched="pageVideos"></pagination>
            </div>
        </div>
    </div>
</template>
<script>
import { mapActions, mapGetters } from 'vuex'
import swal from 'sweetalert2'

	export default {
		props: [
			'data',
		],

		data() {
			return {
				showModal: false,
				type: '',
				style_id: null,
				profileDistrict: '',
			}
		},

		computed: mapGetters({
			profileDistricts: 'allProfileDistricts',
			userVideos: 'allUserVideos',
			videoMeta: 'allVideoMeta',
		}),

		methods: {
			...mapActions([
				'getProfileDistricts',
				'getUserVideos',
				'getVideoMeta'
			]), 

			videoDeleted(id) {
				swal({
					title: 'Are you sure?',
					text: "You won't be able to revert this!",
					type: 'warning',
					showCancelButton: true,
					confirmButtonColor: '#3085d6',
					cancelButtonColor: '#d33',
					confirmButtonText: 'Yes, delete it!'
					}).then(function () {
						return axios.delete(`/video/destroy/${id}`, {
						})
						.then((response) => {
							const vidId = response.data
							const id = vidId.id
							axios.patch(`/video/link/update/${id}`, {
							})
						})
						.catch((error) => {
							this.errorMessage()
						})
						.then(function() {
					        window.location = "/profile";
					    });
				})
			},

			errorMessage() {
				swal(
				  'Oops...',
				  'you failed to delete a video try again. ',
				  'error'
				)
			},

        	pageVideos(page) {
		     	this.getBlogLists({district:this.profileDistrict.district_id, style:this.style_id, page})
			}
		},

		watch: {
			profileDistrict() {
				this.getUserVideos({district:this.profileDistrict.district_id, style:this.style_id, page: 1})
			}
		},

		created() {
				this.style_id = this.data.id
		},

		mounted() {
			this.getProfileDistricts({style:this.style_id})
		}
	}
	
</script>