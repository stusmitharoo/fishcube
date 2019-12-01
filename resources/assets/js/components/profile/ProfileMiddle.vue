<template>
	<div>
		<h5 class="words">
			<p 
				class="words" 
				v-for="district in districts">
				{{district.name | capitalize }} / {{styleName.name}} fishing
			</p>
		</h5>
	</div>
</template>

<script>
    import { mapActions, mapGetters } from 'vuex'
    import Vue2Filters from 'vue2-filters'

    export default {
        data() {
          return {
            styleName: null,
          }
        },

        computed: mapGetters({
           districts: 'allDistricts',
           styles: 'allStyles',
        }),

        methods: {
            ...mapActions([
                'getDistricts',
                'getStyles',
            ])
        },

        watch: {
            districts() {
                if(!this.districts || !this.districts.length) return
                this.styles.some(style => {
                    if (style.id === this.districts[0].style_id) {
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
           this.getDistricts()
        }
    }
</script>