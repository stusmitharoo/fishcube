<template>
    <div :class="{'active-card-top': cardtop}">
        <img v-if="waterCardTop" class="img-responsive image-card image-corners" :src="waterCardTop.image" alt="Responsive image"/>
        <img v-if="!waterCardTop" 
            class="img-responsive image-card image-corners"
            :src="'/images/index/defualt.jpg'" 
            alt="advertising"/>
            <div class="col-sm-12" v-if="waterCardTop">
                <h5 class="words">
                    <p class="words">
                        {{ waterCardTop.user.data.name | capitalize }}
                    </p>
                </h5>
            </div>

            <div class="box-text-top col-sm-12">
                <h5 class="words">
                    <p v-if="fishTop" class="words">
                        {{ fishTop.name | capitalize }}
                    </p>
                </h5>
            </div>
            <div class="box-text-top col-sm-12">
                <h5 class="words">
                    <p v-if="district" class="words">
                        {{ district.name | capitalize }}
                    </p>
                </h5>
            </div>
            
            <div class="box-text-top col-sm-12">
                <h5 class="words">
                    <p v-if="waterCardTop" class="words">
                        {{ waterCardTop.lbs }} lbs {{ waterCardTop.ozs }} ozs {{ waterCardTop.dr }} dr
                    </p>
                    <p v-if="!waterCardTop" class="words">
                        No data for this location
                    </p>
                </h5>
            </div>
            
            <div class="box-text-top col-sm-12" v-if="waterCardTop">
                <h5 class="words">
                    <p class="words">
                        {{ waterCardTop.capture_date }}
                    </p>
                </h5>
            </div>
            <div class="box-text-top col-sm-12" v-if="waterCardTop">
                <h5 class="words">
                    <p class="words">
                        {{ waterCardTop.display_description }}
                    </p>
                </h5>
            </div>
    </div>
</template>

<script>
import { mapActions, mapGetters } from 'vuex'
import Vue2Filters from 'vue2-filters'

    export default {
        props: [
            'cardtop',
            'waterCardTop',
            'fishTop',
            'district',
        ]
    }
</script>