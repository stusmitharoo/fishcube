<template>
    <div class="box-fish">
        <div v-for="profileFishBottom in profileFishBottoms">
        <a href="#" @click.prevent="
           getNextFish({profileDistrict:district.id, style:district.style_id, page:pagination.current_page})">
        <img class="img-responsive image image-corners" :src="profileFishBottom.image" title="select this species">
        <h4 class="words myh4">{{ profileFishBottom.name | capitalize  }}</h4>
        </a>
        </div>
        <div v-if="profileFishBottoms && profileFishBottoms.length === 0"
            class="words">
            <h4 class="words myh4">No Fish species for this Location</h4>
            <a href="/locationChoice" class="words btn btn-warning">Add a Fish Species</a>
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
            profileFishBottoms: 'allProfileFishBottoms',
        }),
        methods: {
            ...mapActions([
                'getProfileFishBottoms',
                'getNextFish'
            ])
        },
        mounted() {
                this.getProfileFishBottoms({profileDistrict:this.district.id,
            style:this.district.style_id, page: 3})
        },
        watch: {
          district() {
            this.getProfileFishBottoms({profileDistrict:this.district.id,
              style:this.district.style_id, page: 3})
          }
        }
    }
</script>
