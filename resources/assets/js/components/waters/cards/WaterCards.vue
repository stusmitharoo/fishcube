<template>
	<div>
		<img class="img-responsive image-card image-corners" :src="card.image" alt="Responsive image"/>
            <div class="col-sm-12">
                <h5 class="words">
                	<p class="words">{{ card.user.data.name | capitalize }}</p>
                </h5>
            </div>

            <div class="box-text-top col-sm-12">
                <waterfishmiddle
                    :fish="fish">
                </waterfishmiddle>
            </div>
            <div class="box-text-top col-sm-12">
                <waterdistrictmiddle
                    :district="district">
                </waterdistrictmiddle>
            </div>
            
            <div class="box-text-top col-sm-12">
                <h5 class="words">
                    <p class="words">{{ card.lbs }} lbs {{ card.ozs }} ozs {{ card.dr }} dr / Position {{ pagination.current_page }}{{ pagination.current_page | pluralize('st','nd','rd','th') }}</p>
                </h5>
            </div>
            
            <div class="box-text-top col-sm-12">
                <h5 class="words">
                	<p class="words">{{ card.capture_date }}</p>
                </h5>
            </div>
            <div class="box-text-top col-sm-12">
                <h5 class="words">
                	<p class="words">{{ card.display_description }}</p>
                </h5>
            </div>
            <nav v-if="card" aria-label="..." class="margin-txs">
              <ul class="pager" v-if="pagination && pagination.links">
                <li class="previous" v-if="pagination && pagination.links.previous">
                    <a class="words" href="#" @click.prevent="previous()">
                        <span aria-hidden="true">&larr;</span> prev
                    </a>
                </li>
               <li class="next">
                    <a class="words" href="#" @click.prevent="next()">Next 
                        <span aria-hidden="true">&rarr;</span>
                    </a>
                </li>
              </ul>
            </nav>
    </div>
</template>

<script>
import { mapActions, mapGetters } from 'vuex'
import Vue2Filters from 'vue2-filters'

    export default {
        props: [
            'card',
            'pagination',
            'water',
            'fish',
            'district',
        ],
        methods: {
            next() {
                this.$emit('next')
            },
            previous() {
                this.$emit('previous')
            },
        }
    }
</script>