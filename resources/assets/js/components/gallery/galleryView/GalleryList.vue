<template>
	<div class="col-sm-8 col-sm-offset-2 col-xs-12">
		<videomodal v-if="showModal" @close="showModal = false"
            video="https://s3.eu-west-2.amazonaws.com/video.fishcube.co.uk/profilepage.mp4">
        </videomodal>
        <div class="box-still container">
        	<h3 class="words">Your'e gallery listings</h3>
        	<h5 class="words">Manage your'e galleries</h5>
        	<button class="col-xs-2 margin-ll margin-b words btn btn-primary btn-sm" id="show-modal" @click="showModal = true">
                <span class="glyphicon glyphicon-info-sign"></span>
                <h6 class="links-zero">help</h6>
            </button>
            <div class="margin-s row">
				<div class="col-xs-12">
            		<label for="district_stillwater_id" class="words">Select a location</label>

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
			<div class="col-xs-12">
				<div v-for="userHeader, index in userHeaders">
					<div class="box-still col-xs-12 margin-ts" style="padding: 0px">
						<div class="col-xs-3 media-left">
							<a :href="'/gallery/flip/' + userHeader.id">
								<img :src="userHeader.image" :alt="userHeader.name" class="img-responsive img-corners margin-s media-object">
							</a>
						</div>
						<div class="col-xs-5">
							<a :href="'/gallery/flip/' + userHeader.id">
								<h4 class="words">{{ userHeader.name }}</h4>
							</a>
						</div>
						<div class="col-xs-1">
							<a title="select" class=" btn btn-primary margin-s" :href="'/blog/edit/' + userHeader.id">
								<span class="glyphicon glyphicon-edit"></span>
								<h6 class="links-zero">edit</h6>
							</a>
						</div>
						<div class="col-xs-1 col-xs-offset-1">
							<button title="select" class=" btn btn-warning margin-s" @click.prevent="blogDeleted(userHeader.id)">
								<span class="glyphicon glyphicon-remove"></span>
								<h6 class="links-zero">delete</h6>
							</button>
						</div>
					</div>
				</div>
				<pagination v-if="userMeta.pagination && userMeta.pagination.links" :meta="userMeta.pagination" v-on:pagination:switched="pageUserHeaders"></pagination>
            </div>
        </div>
    </div>
</template>
<script>
import { mapActions, mapGetters } from 'vuex'
import swal from 'sweetalert2'

	export default {
		props: [
			'water',
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
			userHeaders: 'allUserHeaders',
			userMeta: 'allUserMeta',
		}),

		methods: {
			...mapActions([
				'getProfileDistricts',
				'getUserHeaders',
				'getUserMeta'
			]),

			galleryDeleted(id) {
				swal({
					title: 'Are you sure?',
					text: "You won't be able to revert this!",
					type: 'warning',
					showCancelButton: true,
					confirmButtonColor: '#3085d6',
					cancelButtonColor: '#d33',
					confirmButtonText: 'Yes, delete it!'
					}).then(function () {
						return axios.delete(`/gallery/destroy/${id}`, {
						})
						.then((response) => {
							const gallId = response.data
							const id = gallId.id
							axios.patch(`/blog/link/update/${id}`, {
							})
						})
						.catch((error) => {
							this.errorMessage()
						})
						.then(function() {
					        window.location = "/gallery/list/choice";
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

        	pageUserHeaders(page) {
		     	this.getBlogLists({district:this.profileDistrict.district_id, style:this.style_id, page})
			}
		},

		watch: {
			profileDistrict() {
				this.getUserHeaders({district:this.profileDistrict.district_id, style:this.style_id, page:1})
			}
		},

		created() {
				this.style_id = this.water.id
		},

		mounted() {
			this.getProfileDistricts({style:this.style_id})
		}
	}
	
</script>