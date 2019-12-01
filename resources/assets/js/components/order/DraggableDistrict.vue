<template>

<div>
	<form action="#" @submit.prevent="submit">
		<h2 class="words">Edit Your Districts</h2>
		<br>
		<h4 class="words margin-b">Drag the image boxes to sort, district 1 will always be on the left of your profile page.</h4>
		
		<draggable :list="districts" :options="{}" @start="drag=true" @end="drag=false" @change="update">
			<div v-for="district, index in districts">
				<div class="box-still col-xs-12 margin-b">
					<div class="col-xs-5 col-sm-5">
						<h3 class="hidden-xs words">District {{ index + 1 }}</h3>
						<h4 class="hidden-xs words">{{ district.name }}</h4>
						<h4 class="visible-xs words">District {{ index + 1 }}</h4>
						<h5 class="visible-xs words">{{ district.name }}</h5>
					</div>
					<div class="col-xs-2 box-panel">
						<img class="img-responsive image-corners" :src="district.image">
					</div>
					<div class="pull-right">
						<a href="#" title="delete" class="btn btn-warning margin-s" @click.prevent="districtDeleted(district.id)">
							<span class="glyphicon glyphicon-remove"></span>
						</a>
					</div>
				</div>
			</div>
		</draggable>
		<div class="margin-b">
			<button
				type="submit"
				class=" words btn btn-warning btn-block">
					Order Districts
			</button>
		</div>
	</form>
</div>
</template>
<script>
	import draggable from 'vuedraggable'
	import swal from 'sweetalert2'

	export default {
		components: {
			draggable
		},
		props:[
			'districts'
		],
		data () {
			return {
				name: null,
			}
		},
		methods: {
			submit () {
				return this.updateAllSortOrder ()

				.then(response => {
					this.successMessage()
				})
				.catch(error => {
					this.errorMessage()
				})
			},
			update (e) {
				this.districts.map((district, index) => {
					district.order_no = index + 1
				})
			},
			updateAllSortOrder () {
				let districtLeft = this.districts.length

				// Returns a promise when all the fishs sort order is updated
				return new Promise((resolve, reject) => {

					// Iterates through fishs
					this.districts.forEach((district, index) => {

						// update sort order async
						this.updateSortOrder(district, index)
							.then(response => {
								districtLeft--
								if (!districtLeft) resolve()
							})
							// TODO show a error message if one of the images failed
							.catch(response => {
								districtLeft--
								if (!districtLeft) resolve()
							})
					})
				})
			},
			updateSortOrder (district, index) {

				if (!district.order_no) {
					return Promise.resolve()
				}

				return axios.patch(`/orderDistrict/update/${district.id}`, {
					order_no: index + 1,
				})
				.then((response) => {
				})
				.catch((error) => {
					this.errorMessage()
				})
			},
			districtDeleted(id) {
				swal({
					title: 'Are you sure?',
					text: "You won't be able to revert this!",
					type: 'warning',
					showCancelButton: true,
					confirmButtonColor: '#3085d6',
					cancelButtonColor: '#d33',
					confirmButtonText: 'Yes, delete it!'
					}).then(function () {
						return axios.delete(`/orderDistrict/destroy/${id}`, {
						})
						.then((response) => {
							this.successMessage()
						})
						.catch((error) => {
							this.errorMessage()
						})
					})
			},
			successMessage() {
				swal(
				  'Good job!',
				  'You have changed your Districts',
				  'success'
				).then(function() {
			        window.location = "/profile";
			    });
			},
			errorMessage() {
				swal(
				  'Oops...',
				  'Gallery Update Failed',
				  'error'
				)
			},
		},
	}
</script>