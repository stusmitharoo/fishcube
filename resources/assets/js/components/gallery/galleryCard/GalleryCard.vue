<template>
    <div>
        <div v-for="galleryPicture in galleryPictures">
	        <img class="img-responsive image-gallery image-corners" :src="galleryPicture.image">
	        <div class="box-text-top">
                <h4 class="words">
                        {{galleryPicture.name}}
                </h4>
            </div>
            <div class="box-text-bottom">
                <h4 class="words">
                        {{galleryPicture.date}}
                </h4>
            </div>
        </div>
    </div>
</template>

<script>
import { mapActions, mapGetters } from 'vuex'

    export default {

        props: [
            'galleryLink'
        ],

        computed: mapGetters({
            headers: 'allHeaders',
            galleryPictures: 'allGalleryPictures',
        }),

        methods: {
            ...mapActions([
                'getGalleryPictures',
                'getHeaders',
            ])
        }, 

        watch: {
            headers() { 
                this.getGalleryPictures({header:this.headers[0].id, page: 2})
            }
        },

        created() {
            this.getHeaders()
            this.getGalleryPictures({header:this.galleryLink, page: 2})
        }
    }
</script>