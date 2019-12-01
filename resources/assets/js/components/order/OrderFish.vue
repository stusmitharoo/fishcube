<template>
	<div class="col-xs-12 col-sm-8 col-sm-offset-2 margin-b">
		<videomodal v-if="showModal" @close="showModal = false"
            video="https://s3.eu-west-2.amazonaws.com/video.fishcube.co.uk/profilepage.mp4">
        </videomodal>
		<div class=" box-still">
			<h2 class="words">Edit your Fish</h2>
			<br>
			<h4 class="hidden-xs words margin-b">Drag the image boxes to sort, district 1 will always be on the left of your profile page.</h4>
			<h5 class="visible-xs words margin-b">Drag the image boxes to sort, district 1 will always be on the left of your profile page.</h5>
			<div>
        		<label for="district_stillwater_id" class="words">Select a Location</label>
				<select class="form-control margin-b"
					required=""
					name="district_canal_id"
					v-model="orderDistrict">
					<option v-for="orderDistrict in orderDistricts"
							:value="orderDistrict">
							{{ orderDistrict.name | capitalize }} / {{orderDistrict.style.data.name}}
					</option>
				</select>
			</div>
			<draggablefish v-if="orderFishs" :fishs="orderFishs"></draggablefish>
		</div>

	</div>
</template>
<script>
	import { mapActions, mapGetters } from 'vuex' 
	import Vue2Filters from 'vue2-filters'

	export default {
		data () {
			return {
				orderDistrict: [],
				showModal: false,
			}
		},

		computed: mapGetters({
            orderDistricts: 'allOrderDistricts',
            orderFishs: 'allOrderFishs',
        }),

		methods: {
			...mapActions([
				'getOrderDistricts',
				'getOrderFishs'
            ])
        },

		watch: {
			orderDistrict() {
				this.getOrderFishs({orderDistrict:this.orderDistrict.id})
			}
		},

		 created() {
                this.getOrderDistricts()
        }
	}
</script>