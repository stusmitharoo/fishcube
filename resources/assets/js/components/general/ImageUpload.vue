<template>
	<div class="image-upload-wrapper image-upload">
		<div id="croppie">
		</div>
		<button type="button" class="btn btn-primary btn-sm" @click.prevent="changeOrientation(false)">
            <a class="words" >Rotate left</a>
        </button>
        <button type="button" class="btn btn-primary btn-sm right" @click.prevent="changeOrientation(true)">
            <a class="words" >Rotate right</a>
        </button>
		<div class="upload-wrapper words">
			<div class="croppie-modal">
				<h4>Upload an Image</h4>
				<div class="input-file margin-s words">
					<input class="words form-control" type="file" id="upload-image" v-on:change="setUpFileUploader">
				</div>
			</div>
		</div>
	</div>
</template>
<script>
import Croppie from 'croppie'
import ImageDataConverter from '../helpers/ImageDataConverter.js'

	export default {
		props: ['imgSrc'],

		data() {
			return {
				croppie: null,
				image: null,
			}
		},
		methods: {
			setUpCroppie() {
				let el = document.getElementById('croppie')
				this.croppie = new Croppie(el, {
					viewport: {width: 240, height: 170, type: 'square'},
					boundary: {width: 250, height: 180},
					showZoomer: true,
					enableOrientation: true,
					update: () => {
						this.uploadFile()
					}
				})

				this.croppie.bind({
					url: this.image,
					orientation: 0,
				})
			},

			setUpFileUploader(e) {
				let files = e.target.files || e.dataTransfer.files;
				if (!files.length) {
					return
				}
				this.createImage(files[0])
			},

			createImage(file) {
				var image = new Image()
				var reader = new FileReader()
				var vm = this

				reader.onload = (e) => {
					this.croppie.destroy()
					this.image = e.target.result
					this.setUpCroppie()
				}

				reader.readAsDataURL(file)
			},

			uploadFile() {
				this.croppie.result({
					type: 'canvas',
					size: {width: 640, height: 435},
					format: 'jpeg'
				}).then(response => {
					this.image = response
					this.sendToParent()
				})
			},

			sendToParent() {
				const blob = new ImageDataConverter(this.image).dataURItoBlob()
				const file = new File([blob], 'imageToUpload.jpeg')
				this.$emit('sendToParent', file)
			},
			changeOrientation(right){
				this.croppie.rotate(right ? 90 : -90)
			}
		},

		mounted() {
			this.image = this.imgSrc
			this.setUpCroppie()
		}
	}
</script>
