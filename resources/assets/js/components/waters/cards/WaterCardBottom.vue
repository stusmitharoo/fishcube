<template>
    <div :class="{'active-card-bottom': cardbottom}">
        <img v-if="waterCardBottom" class="img-responsive image-card image-corners" :src="waterCardBottom.image" alt="Responsive image"/>
        <img v-if="!waterCardBottom" 
            class="img-responsive image-card image-corners"
            :src="'/images/index/defualt.jpg'" 
            alt="advertising"/>
            <div class="col-sm-12" v-if="waterCardBottom">
                <h5 class="words">
                    <p class="words">
                        {{ waterCardBottom.user.data.name | capitalize }}
                    </p>
                </h5>
            </div>

            <div class="box-text-top col-sm-12">
                <h5 class="words">
                    <p v-if="fishBottom" class="words">
                        {{ fishBottom.name | capitalize }}
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
                    <p v-if="waterCardBottom" class="words">
                        {{ waterCardBottom.lbs }} lbs {{ waterCardBottom.ozs }} ozs {{ waterCardBottom.dr }} dr
                    </p>
                    <p v-if="!waterCardBottom" class="words">
                        No data for this location
                    </p>
                </h5>
            </div>
            
            <div class="box-text-top col-sm-12" v-if="waterCardBottom">
                <h5 class="words">
                    <p class="words">
                        {{ waterCardBottom.capture_date }}
                    </p>
                </h5>
            </div>
            <div class="box-text-top col-sm-12" v-if="waterCardBottom">
                <h5 class="words">
                    <p class="words">
                        {{ waterCardBottom.display_description }}
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
            'waterCardBottom',
            'cardbottom',
            'fishBottom',
            'district',
        ]
    }
</script>