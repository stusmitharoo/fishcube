<template>
    <div class="box margin-tm">
        <div v-for="districtRight in districtRights">
        <a href="#" @click.prevent="
            getNextDistrict(pagination.current_page)">
            <img class="img-responsive image image-corners" :src="districtRight.image" title="select this location">
            <h4 class="words myh4">{{ districtRight.name | capitalize }}</h4>
        </a>
        </div>
        <div v-show="districtRights.length < 1"
            class="words">
            <h4 class="words">No cards yet</h4>
                <a href="/createChoice" class="words btn btn-warning margin-b">Create a card</a>
        </div>
    </div>
</template>

<script>
    import { mapActions, mapGetters } from 'vuex'
    import Vue2Filters from 'vue2-filters'

    export default {
         props: [
            'pagination'
        ],
        computed: mapGetters({
            districtRights: 'allDistrictRights'
        }),
        methods: {
            ...mapActions([
                'getDistrictRights',
                'getNextDistrict'
            ])
        },
        created() {
           this.getDistrictRights()
        }
    }
</script>
