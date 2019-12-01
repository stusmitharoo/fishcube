<template>
    <div class="box margin-tm">
        <div v-for="viewDistrictLeft in viewDistrictLefts">
        <a href="#" @click.prevent="
            getViewPreviousDistrict({id:card[0].id, page:pagination.current_page})">
            <img class="img-responsive image image-corners" :src="viewDistrictLeft.image" title="select this location">
            <h4 class="words myh4">{{ viewDistrictLeft.name | capitalize }}</h4>
        </a>
        </div>
        <div v-show="viewDistrictLefts.length < 1"
            class="words">
            <h4 class="words myh4">No  Location</h4>
        </div>
    </div>
</template>

<script>
    import { mapActions, mapGetters } from 'vuex'
    import Vue2Filters from 'vue2-filters'

    export default {
        props: [
            'pagination',
            'card'
        ],
        
        computed: mapGetters({
            viewDistrictLefts: 'allViewDistrictLefts'
        }),

        methods: {
            ...mapActions([
                'getViewDistrictLefts',
                'getViewPreviousDistrict'
            ])
        },

        created() {
           this.getViewDistrictLefts(this.card[0].id)
        }
    }
</script>