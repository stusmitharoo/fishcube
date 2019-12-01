<template>
	<div>
		<h5 class="words">
			<p 
				class="words" 
				v-for="viewDistrict in viewDistricts">
				{{ viewDistrict.name | capitalize }} / {{styleName.name}} fishing
			</p>
		</h5>
	</div>
</template>

<script>
    import { mapActions, mapGetters } from 'vuex'
    import Vue2Filters from 'vue2-filters'

    export default {
        props:[
            'card'
        ],

        data() {
          return {
            styleName: null,
          }
        },

        computed: mapGetters({
           viewDistricts: 'allViewDistricts',
           styles: 'allStyles',
        }),

        methods: {
            ...mapActions([
                'getViewDistricts',
                'getStyles',
            ])
        },

        watch: {
            viewDistricts() {
                this.styles.some(style => {
                    if (style.id === this.viewDistricts[0].style_id) {
                        this.styleName = style
                        return true
                    } else {
                        return false
                    }
                })
            }
        },

        created() {
            this.getStyles()
        },

        mounted() {
           this.getViewDistricts(this.card[0].id)
        }
    }
</script>