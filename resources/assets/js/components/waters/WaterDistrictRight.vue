<template>
    <div class="box margin-tm">
        <div v-if="districtRight">
        <a href="#" @click.prevent="click()">
            <img class="img-responsive image image-corners" :src="districtRight.image" title="select this location">
             <h4 class="words myh4">{{ districtRight.name | capitalize }}</h4>
        </a>
        </div>
    </div>
</template>

<script>
    import { mapActions, mapGetters } from 'vuex'
    import Vue2Filters from 'vue2-filters'

    export default {
        props: [
            'districtRight',
        ],
        methods: {
            click() {
                this.$emit('click')
            }
        }
    }
</script>