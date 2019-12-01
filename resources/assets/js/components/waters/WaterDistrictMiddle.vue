<template>
	<div>
		<h5 v-if="district">
			<p class="words">
				{{ district.name | capitalize }}
			</p>
		</h5>
	</div>
</template>

<script>
    import { mapActions, mapGetters } from 'vuex'
    import Vue2Filters from 'vue2-filters'

    export default {
        props: [
            'district',
        ],
    }
</script>