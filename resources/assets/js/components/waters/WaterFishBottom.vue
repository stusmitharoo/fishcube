<template>
    <div class="box-fish">
        <div v-if="fishBottom">
        <a href="#" @click.prevent="click()">
        <img class="img-responsive image image-corners" :src="fishBottom.image" title="select this species">
        <h4 class="words myh4">{{ fishBottom.name | capitalize }}</h4>
        </a>
        </div>
    </div>
</template>

<script>
import { mapActions, mapGetters } from 'vuex'
import Vue2Filters from 'vue2-filters'

    export default {
        props: [
            'fishBottom'
        ],

        methods: {
            click() {
                this.$emit('click')
            }
        }
    }
</script>

