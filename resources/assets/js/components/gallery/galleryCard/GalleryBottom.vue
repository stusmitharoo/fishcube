<template>
    <div>
        <div class="box hidden-xs words">
            <div v-for="headerBottom in headerBottoms">
            <a href="#" @click.prevent="click()">
                <img class="img-responsive image image-corners" :src="headerBottom.image">
                 <h4 class="words myh4">{{ headerBottom.name | capitalize }}</h4>
            </a>
            </div>
            <a href="/galleryChoice"
                v-if="headerBottoms.length < 1"
                class="words btn btn-warning">Create Gallery</a>
        </div>
    </div>
</template>

<script>
import { mapActions, mapGetters } from 'vuex'

    export default {
        props: {
            click: Function
        },

        computed: mapGetters({
            headerBottoms: 'allHeaderBottoms',
        }),

        methods: {
            ...mapActions([
                'getHeaderBottoms',
            ])
        },

        mounted() {
           this.getHeaderBottoms()
        }
    }
</script>