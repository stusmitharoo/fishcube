<template>
    <div>
        <div v-for="galleryPictureRight in galleryPictureRights">
        <a href="#" @click.prevent="
            getNextGalleryPicture({header:galleryLink, page:pagination.current_page})">
        <img class="img-responsive image-gallery image-corners" :src="galleryPictureRight.image">
        	<div class="box-text-top">
                <h4 class="words">
                        {{ galleryPictureRight.name | capitalize }}
                </h4>
            </div>
            <div class="box-text-bottom">
                <h4 class="words">
                        {{ galleryPictureRight.date }}
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
            galleryPictureRights: 'allGalleryPictureRights',
        }),

        methods: {
            ...mapActions([
                'getGalleryPictureRights',
                'getNextGalleryPicture',
            ])
        }, 

        watch: { 
            headers() {
                this.getGalleryPictureRights({header:this.headers[0].id, page: 3})
            }
        },

        created() {
            this.getGalleryPictureRights({header:this.galleryLink, page: 3})
        }
    }
</script>