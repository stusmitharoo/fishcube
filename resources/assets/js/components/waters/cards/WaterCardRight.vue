<template>
    <div :class="{'active-card-right': cardright}">
        <img v-if="waterCardRight" class="img-responsive image-card image-corners" :src="cardRight.image" alt="Responsive image"/>
        <img v-if="!waterCardRight" 
            class="img-responsive image-card image-corners"
            :src="'/images/index/defualt.jpg'" 
            alt="advertising"/>
            <div class="col-sm-12" v-if="waterCardRight">
                <h5 class="words">
                    <p class="words">
                        {{ waterCardRight.user.data.name | capitalize }}
                    </p>
                </h5>
            </div>

            <div class="box-text-top col-sm-12">
                <h5 class="words">
                    <p v-if="fish" class="words">
                        {{ fish.name | capitalize }}
                    </p>
                </h5>
            </div>
            <div class="box-text-top col-sm-12">
                <h5 class="words">
                    <p v-if="districtRight" class="words">
                        {{ districtRight.name | capitalize }}
                    </p>
                </h5>
            </div>
            
            <div class="box-text-top col-sm-12">
                <h5 class="words">
                    <p v-if="waterCardRight" class="words">
                        {{ waterCardRight.lbs }} lbs {{ waterCardRight.ozs }} ozs {{ waterCardRight.dr }} dr
                    </p>
                    <p v-if="!waterCardRight" class="words">
                        No data for this location
                    </p>
                </h5>
            </div>
            
            <div class="box-text-top col-sm-12" v-if="waterCardRight">
                <h5 class="words">
                    <p class="words">
                        {{ waterCardRight.capture_date }}
                    </p>
                </h5>
            </div>
            <div class="box-text-top col-sm-12" v-if="waterCardRight">
                <h5 class="words">
                    <p class="words">
                        {{ waterCardRight.display_description }}
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
            'cardright',
            'waterCardRight',
            'fish',
            'districtRight',
        ]
    }
</script>