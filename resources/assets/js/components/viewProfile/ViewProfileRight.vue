<template>
    <div class="box margin-tm">
        <div v-for="viewDistrictRight in viewDistrictRights">
        <a href="#" @click.prevent="
            getViewNextDistrict({id:card[0].id, page:pagination.current_page})">
            <img class="img-responsive image image-corners" :src="viewDistrictRight.image" title="select this location">
            <h4 class="words myh4">{{ viewDistrictRight.name | capitalize }}</h4>
        </a>
        </div>
        <div v-show="viewDistrictRights.length < 1"
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
            viewDistrictRights: 'allViewDistrictRights'
        }),

        methods: {
            ...mapActions([
                'getViewDistrictRights',
                'getViewNextDistrict'
            ])
        },
        
        created() {
           this.getViewDistrictRights(this.card[0].id)
        }
    }
</script>
