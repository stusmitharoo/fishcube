<template>
    <div>
        <div>
        <div class="box hidden-xs words">
            <div v-for="headerTop in headerTops">
            <a href="#" @click.prevent="click()">
                <img class="img-responsive image image-corners" :src="headerTop.image">
                 <h4 class="words myh4">{{ headerTop.name | capitalize }}</h4>
            </a>
            </div>
            <a href="/galleryChoice" 
                v-show="headerTops.length < 1"
                class="words btn btn-warning">Create Gallery</a>
        </div>
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
            headerTops: 'allHeaderTops',


        }),
        methods: {
            ...mapActions([
                'getHeaderTops',
            ])
        },
        created() {
           this.getHeaderTops()
        }
    }
</script>