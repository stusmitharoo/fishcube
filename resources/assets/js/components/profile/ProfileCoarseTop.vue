<template>
    <div class="box-fish">
        <div v-for="profileFishTop in profileFishTops">
        <a href="#" @click.prevent="
            getPreviousFish({profileDistrict:district.id, style:district.style_id, page:pagination.current_page})">
        <img class="img-responsive image image-corners" :src="profileFishTop.image" title="select this species">
        <h4 class="words myh4">{{ profileFishTop.name | capitalize  }}</h4>
        </a>
        </div>
        <div v-if="profileFishTops && profileFishTops.length === 0"
            class="words">
            <h4 class="words myh4">No Fish species for this Location</h4>
            <a href="/locationChoice" class="words btn btn-warning"> Add a Fish Species</a>
        </div>
    </div>
</template>

<script>
import { mapActions, mapGetters } from 'vuex'
import Vue2Filters from 'vue2-filters'

    export default {
        props: [
            'district',
            'pagination'
            ],
        computed: mapGetters({
            profileFishTops: 'allProfileFishTops'
        }),
        methods: {
            ...mapActions([
                'getProfileFishTops',
                'getPreviousFish'
            ])
        },
        mounted() {
          this.getProfileFishTops({profileDistrict:this.district.id,
            style:this.district.style_id, page: 1})
        },
        watch: {
          district() {
            this.getProfileFishTops({profileDistrict:this.district.id,
              style:this.district.style_id, page: 1})
          }
        }
    }
</script>
