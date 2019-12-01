<template>
<div class="col-xs-12 col-sm-8 col-sm-offset-2">
	<div class="base-menu col-xs-12 row visible-xs">
        <div class="col-xs-1 col-xs-offset-5 margin-ts">
            <button class="words btn btn-primary btn-sm" id="show-modal" @click="showModal = true">
                <span class="glyphicon glyphicon-info-sign"></span>
            </button>
        </div>
    </div>
	<videomodal v-if="showModal" @close="showModal = false">
        <h3 slot="header">Edit a gallery</h3>
        <video class="img-responsive image" slot="body" controls>
             <source :src="'/videos/help/your profile page.mp4'" type="video/mp4">
        </video>
    </videomodal>
	<div class=" box-still">
		<form action="#" @submit.prevent="submit">
			<h3 class="hidden-xs words">Edit {{ name }} Gallery</h3>
			<h4 class="visible-xs words">Edit {{ name }} Gallery</h4>
			<div class="col-xs-12">
				<h5 class="words pull-left">Delete this complete gallery 
					<button class="btn btn-sm btn-warning" @click.prevent="deleteHeader(data.id)"><span class="glyphicon glyphicon-remove"></span></button>
				</h5>
				<button title="Help" class="margin-s pull-right btn btn-primary btn-sm hidden-xs"
		            id="show-modal" 
		            @click.prevent="showModal = true">
		                <a class="words"><span class="glyphicon glyphicon-info-sign"></span></a>
		        </button>
		    </div>
			<div class="form-group padding-s">
				<label for="name" class="words">Name</label>
				<input type="text" id="name" required="" class="form-control" v-model="name">
			</div>
			<div class="form-group padding-s">
				<label for="date" class="words">Date</label>
				<input type="date" id="date" required="" class="form-control" v-model="date">
			</div>
			<draggable :list="pictures" :options="{}" @start="drag=true" @end="drag=false" @change="update">
				<div v-for="picture, index in pictures">
					<div class="box-still col-xs-12 margin-b">
						<div class="col-xs-6">
							<h4 class="hidden-xs words">Image {{ index + 1 }} ({{ picture.sort_order}})</h4>
							<h5 class="visible-xs words">Image {{ index + 1 }} ({{ picture.sort_order}})</h5>
							<div class="form-group">
								<label for="title" class="words">Title</label>
								<input class="form-control" type="text" v-model="pictures[index].name"></input>
							</div>
						</div>
						<div class="col-xs-4 box-panel margin-s">
							<img class="img-responsive image-corners" :src="'/images/cards/'+pictures[index].image">
						</div>
						<div class="pull-right">
							<a href="#" title="delete" class="btn btn-warning margin-s btn-sm" @click.prevent="pictureDeleted(picture.id)">
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
    					Update Gallery
    			</button>
			</div>
		</form>
	</div>
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
			'data'
		],

		data () {
			return {
				name: null,
				date: null,
				pictures: [],
				showModal: false,
			}
		},

		methods: {
			submit () {
				axios.patch('update/' + this.data.id, {
					name: this.name,
					date: this.date,
					galleryPictures: this.pictures,
				}).then((response) => {
					this.successMessage()

				}).catch((error) => {
					this.errorMessage()
				})
			},

			update (e) {
				this.pictures.map((picture, index) => {
					picture.sort_order = index + 1
				})
			},

			deleteHeader(id) {
				swal({
					title: 'Are you sure?',
					text: "You won't be able to revert this!",
					type: 'warning',
					showCancelButton: true,
					confirmButtonColor: '#3085d6',
					cancelButtonColor: '#d33',
					confirmButtonText: 'Yes, delete it!'
					}).then(function () {
						return axios.delete(`/editGallery/destroyHeader/${id}`, {
						})
						.then((response) => {
						})
						.catch((error) => {
							this.errorMessage()
						})
						.then(function() {
					        window.location = "/gallery";
					    });
					})
			},

			successMessage() {
				swal(
				  'Good job!',
				  'You have edited your Gallery',
				  'success'
				).then(function() {
			        window.location = "/gallery";
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

		mounted () {
			this.name = this.data.name
			this.id = this.data.id
			this.date = this.data.date
			this.pictures = this.data.gallery_pictures
		}
	}
</script>