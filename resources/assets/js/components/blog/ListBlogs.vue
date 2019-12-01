<template>
	<div class="col-sm-8 col-sm-offset-2 col-xs-12">
		<videomodal v-if="showModal" @close="showModal = false"
            video="https://s3.eu-west-2.amazonaws.com/video.fishcube.co.uk/profilepage.mp4">
        </videomodal>
        <div class="box-still container">
        	<h3 class="words">Your'e blog listing</h3>
        	<h5 class="words">Manage your'e blogs</h5>
        	<button class="margin-ll words btn btn-primary btn-sm" id="show-modal" @click="showModal = true">
                <span class="glyphicon glyphicon-info-sign"></span>
                <h6 class="links-zero">help</h6>
            </button>
            <div class="margin-s row">
				<div class="col-xs-12">
            		<label for="district_stillwater_id" class="words margin-ts">Select a location</label>

						<select class="form-control margin-b margin-ts"
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
				<div v-for="userBlog, index in userBlogs">
					<div class="box-still col-xs-12 margin-ts" style="padding: 0px">
						<div class="col-xs-3 media-left">
							<a :href="'/blog/show/' + userBlog.id">
								<img :src="userBlog.thumbnail" :alt="userBlog.title" class="img-responsive img-corners margin-s media-object">
							</a>
						</div>
						<div class="col-xs-7">
							<a :href="'/blog/show/' + userBlog.id">
								<h4 class="words">{{ userBlog.title }}</h4>
							</a>
						</div>
						<div class="col-xs-1">
							<a title="select" class=" btn btn-primary margin-s" :href="'/blog/edit/' + userBlog.id">
								<span class="glyphicon glyphicon-edit"></span>
								<h6 class="links-zero">edit</h6>
							</a>
						</div>
					</div>
				</div>
				<pagination v-if="blogMeta.pagination && blogMeta.pagination.links" :meta="blogMeta.pagination" v-on:pagination:switched="pageUserBlogs"></pagination>
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
			userBlogs: 'allUserBlogs',
			blogMeta: 'allBlogMeta',
		}),

		methods: {
			...mapActions([
				'getProfileDistricts',
				'getUserBlogs',
				'getBlogMeta'
			]),

			pageUserBlogs(page) {
				this.getUserBlogs({district:this.profileDistrict.district_id, style:this.style_id, page})
			}
		},

		watch: {
			profileDistrict() {
				this.getUserBlogs({district:this.profileDistrict.district_id, style:this.style_id, page:1})
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