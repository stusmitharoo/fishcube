<template>
	<div class="words">
		<form action="#" @submit.prevent="submit" v-if="sortedFish">
			<draggable :list="sortedFish" :options="{}" @start="drag=true" @end="drag=false" @change="update">
				<div v-for="fish, index in sortedFish">
					<div class="box-still margin-s col-xs-11">
						<div class="col-sm-5 col-xs-5">
							<h3 class="hidden-xs words">Species {{ index + 1 }}</h3>
							<h4 class="hidden-xs words">{{ fish.name }}</h4>
							<h4 class="visible-xs words">Species {{ index + 1 }}</h4>
							<h5 class="visible-xs words">{{ fish.name }}</h5>
						</div>
						<div class="col-sm-4 col-xs-4">
							<img class="img-responsive image-corners" :src="fish.image">
						</div>
						<div class="col-xs-1">
							<a href="#" title="delete" class=" btn btn-warning margin-s" @click.prevent="deleteFish(fish.id)">
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
    					Order Your Fish
    			</button>
			</div>
		</form>
	</div>
</template>
<script>
	import { mapActions, mapGetters } from 'vuex' 
	import draggable from 'vuedraggable'
	import swal from 'sweetalert2'
	import _ from 'lodash'

	export default {
		components: {
			draggable
		},
		props:[
			'fishs'
		],

		data () {
			return {
				sortedFish: null
			}
		},

		mounted() {
			const sortedFish = _.sortBy(this.fishs, ['sort_order'])
			this.sortedFish = sortedFish
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
				this.sortedFish.map((fish, index) => {
					fish.sort_order = index + 1
				})
			},
			updateAllSortOrder () {
				let fishsLeft = this.sortedFish.length

				// Returns a promise when all the fishs sort order is updated
				return new Promise((resolve, reject) => {

					// Iterates through fishs
					this.sortedFish.forEach((fish, index) => {

						// update sort order async
						this.updateSortOrder(fish, index)
							.then(response => {
								fishsLeft--
								if (!fishsLeft) resolve()
							})
							// TODO show a error message if one of the images failed
							.catch(response => {
								fishsLeft--
								if (!fishsLeft) resolve()
							})
					})
				})
			},
			updateSortOrder (fish, index) {

				if (!fish.sort_order) {
					return Promise.resolve()
				}

				return axios.patch(`/orderFish/update/${fish.id}`, {
					sort_order: index + 1,
				})
				.then((response) => {
				})
				.catch((error) => {
					this.errorMessage()
				})
			},
			deleteFish(id) {
				swal({
					title: 'Are you sure?',
					text: "You won't be able to revert this!",
					type: 'warning',
					showCancelButton: true,
					confirmButtonColor: '#3085d6',
					cancelButtonColor: '#d33',
					confirmButtonText: 'Yes, delete it!'
					}).then(function () {
						return axios.delete(`/orderFish/destroy/${id}`, {
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
			}
		}
	}	
</script>