<template>
    <div>
        <transition name="box">
        <div class="box margin-tm hidden-xs">
            <div v-if="districtLeft">
            <a href="#" @click.prevent="click()" title="select this location">
                <img class="img-responsive image image-corners" :src="districtLeft.image">
                 <h4 class="words myh4">{{ districtLeft.name | capitalize }}</h4>
            </a>
            </div>
        </div>
        </transition>
    </div>
</template>

<script>
    import { mapActions, mapGetters } from 'vuex'
    import Vue2Filters from 'vue2-filters'

    export default {
        props: [
            'districtLeft'
        ],
        methods: {
            click() {
                this.$emit('click')
            }
        },
    }
</script>