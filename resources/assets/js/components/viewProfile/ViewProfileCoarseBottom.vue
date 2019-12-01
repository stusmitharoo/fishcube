<template>
    <div class="box-fish">
        <div v-for="viewProfileFishBottom in viewProfileFishBottoms">
        <a href="#" @click.prevent="
           getViewNextFish({profileDistrict:viewDistrict.id, style:viewDistrict.style_id, page:pagination.current_page, id: viewProfileFishBottom.user_id})">
        <img class="img-responsive image image-corners" :src="viewProfileFishBottom.image" title="select this species">
        <h4 class="words myh4">{{ viewProfileFishBottom.name | capitalize }}</h4>
        </a>
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
            viewProfileFishBottoms: 'allViewProfileFishBottoms',
        }),

        methods: {
            ...mapActions([
                'getViewProfileFishBottoms',
                'getViewNextFish'
            ])
        },

        mounted() {
                this.getViewProfileFishBottoms({profileDistrict:this.viewDistrict.id,
            style:this.viewDistrict.style_id, page: 3, id: this.card[0].id})
        },

    }
</script>
