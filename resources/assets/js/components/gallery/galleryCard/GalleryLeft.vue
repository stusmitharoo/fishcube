<template>
    <div>
        <div v-for="galleryPictureLeft in galleryPictureLefts">
        <a href="#" @click.prevent="
            getPreviousGalleryPicture({header:galleryLink, page:pagination.current_page})">
            <img class="img-responsive image-gallery image-corners" :src="galleryPictureLeft.image">
            <div class="box-text-top">
                <h4 class="words">
                        {{ galleryPictureLeft.name | capitalize }}
                </h4>
            </div>
            <div class="box-text-bottom">
                <h4 class="words">
                        {{ galleryPictureLeft.date }}
                </h4>
            </div>
        </a>
        </div>
    </div>
</template>

<script>
import { mapActions, mapGetters } from 'vuex'
import Vue2Filters from 'vue2-filters'

    export default {
        props: [
            'galleryLink',
            'pagination'
        ],

        computed: mapGetters({
            headers: 'allHeaders',
            galleryPictureLefts: 'allGalleryPictureLefts'
        }),

        methods: {
            ...mapActions([
                'getGalleryPictureLefts',
                'getPreviousGalleryPicture',
            ])
        },

         watch: { 
            headers() { 
                this.getGalleryPictureLefts({header:this.headers[0].id, page: 1}) 
            } 
        },

        created() {
            this.getGalleryPictureLefts({header:this.galleryLink, page: 1}) 
        } 
    }
</script>
