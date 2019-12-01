<template>
	<div :class="{'active-card-left': cardleft}">
		<img v-if="waterCardLeft" class="img-responsive image-card image-corners" :src="waterCardLeft.image" alt="Responsive image"/>
        <img v-if="!waterCardLeft" 
            class="img-responsive image-card image-corners"
            :src="'/images/index/defualt.jpg'" 
            alt="advertising"/>
            <div class="col-sm-12" v-if="waterCardLeft">
                <h5 class="words">
                	<p class="words">
                        {{ waterCardLeft.user.data.name | capitalize }}
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
                    <p v-if="districtLeft" class="words">
                        {{ districtLeft.name | capitalize }}
                    </p>
                </h5>
            </div>
            
            <div class="box-text-top col-sm-12">
                <h5 class="words">
                    <p v-if="waterCardLeft" class="words">
                        {{ waterCardLeft.lbs }} lbs {{ waterCardLeft.ozs }} ozs {{ waterCardLeft.dr }} dr
                    </p>
                    <p v-if="!waterCardLeft" class="words">
                        No data for this location
                    </p>
                </h5>
            </div>
            
            <div class="box-text-top col-sm-12" v-if="waterCardLeft">
                <h5 class="words">
                	<p class="words">
                        {{ waterCardLeft.capture_date }}
                    </p>
                </h5>
            </div>
            <div class="box-text-top col-sm-12" v-if="waterCardLeft">
                <h5 class="words">
                	<p class="words">
                        {{ waterCardLeft.display_description }}
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
            'cardleft',
            'waterCardLeft',
            'fish',
            'districtLeft',
        ]
    }
</script>