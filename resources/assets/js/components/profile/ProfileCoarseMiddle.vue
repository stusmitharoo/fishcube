<template>
    <div>
        <h5 v-for="profileFish in profileFishs">
        <p class="words">
            {{ profileFish.name | capitalize  }}
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
            'district'
            ],
        computed: mapGetters({
            profileFishs: 'allProfileFishs'
        }),
        methods: {
            ...mapActions([
                'getProfileFishs'
            ]),

            // A short cut so we don't need to copy-paste the method below
            getTheRightProfileFish(page = 2) {
              this.getProfileFishs({profileDistrict:this.district.id,style:this.district.style_id, page: page})
            }
          },
          mounted() {
            this.getTheRightProfileFish()
          },
          watch: {
          profileFishs() {
            if (!this.didTryToGetFirstCard && (!this.profileFishs || !this.profileFishs.length)) {
              this.didTryToGetFirstCard = true
              this.getTheRightProfileFish(1)
            }
          },

          district() {
            this.didTryToGetFirstCard = false
            this.getTheRightProfileFish()
          }

        }
    }
</script>
