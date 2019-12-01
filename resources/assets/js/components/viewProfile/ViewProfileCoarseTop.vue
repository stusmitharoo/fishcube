<template>
    <div class="box-fish">
        <div v-for="viewProfileFishTop in viewProfileFishTops">
        <a href="#" @click.prevent="
            getViewPreviousFish({profileDistrict:viewDistrict.id, style:viewDistrict.style_id, page:pagination.current_page, id: viewProfileFishTop.user_id})">
        <img class="img-responsive image image-corners" :src="viewProfileFishTop.image" title="select this species">
        <h4 class="words myh4">{{ viewProfileFishTop.name | capitalize }}</h4>
        </a>
        </div>
        <div v-if="viewProfileFishTops.length > 1"
            class="words">
            <h4 class="words myh4">No Fish species for this Location</h4>
        </div>
    </div>
</template>

<script>
import { mapActions, mapGetters } from 'vuex'
import Vue2Filters from 'vue2-filters'

    export default {
        props: [
            'viewDistrict',
            'pagination',
            'card'
            ],
        computed: mapGetters({
            viewProfileFishTops: 'allViewProfileFishTops'
        }),

        methods: {
            ...mapActions([
                'getViewProfileFishTops',
                'getViewPreviousFish'
            ])
        },

        mounted() {
          this.getViewProfileFishTops({profileDistrict:this.viewDistrict.id,
            style:this.viewDistrict.style_id, page: 1, id: this.card[0].id})
        },
    }
</script>
