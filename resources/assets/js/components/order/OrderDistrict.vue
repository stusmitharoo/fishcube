<template>
<div class="col-xs-12 col-sm-8 col-sm-offset-2 margin-b">
	<videomodal v-if="showModal" @close="showModal = false"
        video="https://s3.eu-west-2.amazonaws.com/video.fishcube.co.uk/profilepage.mp4">
    </videomodal>
	<div class=" box-still">
		<draggabledistrict v-if="orderDistricts" :districts="orderDistricts"></draggabledistrict>
	</div>
</div>
</template>
<script>
	import { mapActions, mapGetters } from 'vuex' 

	export default {
		data() {
			return {
				showModal: false,
			}
		},

		computed: mapGetters({
            orderDistricts: 'allOrderDistricts',
        }),

		methods: {
			...mapActions([
				'getOrderDistricts',
            ])
        },
        
		 mounted() {
                this.getOrderDistricts()
        }
	}
</script>