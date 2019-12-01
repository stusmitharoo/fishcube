<template>
    <div>
        <h5 v-for="viewProfileFish in viewProfileFishs">
        <p class="words">
            {{ viewProfileFish.name | capitalize }}
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
            didTryToGetFirstCard: false
          }
        },
         props: [
            'viewDistrict',
            'card'
            ],
        computed: mapGetters({
            viewProfileFishs: 'allViewProfileFishs'
        }),
        methods: {
            ...mapActions([
                'getViewProfileFishs'
            ]),

            getTheRightViewProfileFish(page = 2) {
              this.getViewProfileFishs({profileDistrict:this.viewDistrict.id,
          style:this.viewDistrict.style_id, page: page, id: this.card[0].id})
            }
        },

        mounted() {
          this.getTheRightViewProfileFish()
        },
        
        watch: {
          viewProfileFishs() {
            if (!this.didTryToGetFirstCard && (!this.viewProfileFishs || !this.viewProfileFishs.length)) {
              this.didTryToGetFirstCard = true
              this.getTheRightViewProfileFish(1)
            }
          },

          viewDistrict() {
            this.didTryToGetFirstCard = false
            this.getTheRightViewProfileFish()
          }

        }
    }
</script>
