<template>
    <div class="box margin-tm">
        <div v-for="districtLeft in districtLefts">
        <a href="#" @click.prevent="
            getPreviousDistrict(pagination.current_page)">
            <img class="img-responsive image image-corners" :src="districtLeft.image" title="select this location">
            <h4 class="words myh4">{{ districtLeft.name | capitalize  }}</h4>
        </a>
        </div>
        <div v-show="districtLefts.length < 1"
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
            districtLefts: 'allDistrictLefts'
        }),
        methods: {
            ...mapActions([
                'getDistrictLefts',
                'getPreviousDistrict'
            ])
        },
        created() {
           this.getDistrictLefts()
        }
    }
</script>