<template>
    <div class="box-fish">
        <div>
        <a href="#" @click.prevent="click()" v-if="fishTop">
        <img class="img-responsive image image-corners" :src="fishTop.image" title="select this species">
        <h4 class="words myh4">{{ fishTop.name | capitalize  }}</h4>
        </a>
        </div>
    </div>
</template>

<script>
import { mapActions, mapGetters } from 'vuex'
import Vue2Filters from 'vue2-filters'

    export default {
        props: [
            'fishTop',
        ],
        
        methods: {
            click() {
                this.$emit('click')
            }
        }
    }
</script>
