<template>
	<div :class="{'active-mob-search': isActive}">
		<div class="col-xs-12 margin-ts">
	        <label class="words col-xs-4 margin-bs">Location</label>
	        <input 
	                placeholder="Type Here ..." 
	                type="text"
	                id="districtmob"
	                name="districtmob" 
	                class="col-xs-10 form-control margin-b">
		</div> 
		<div class="col-xs-12">
	        <label class="words col-xs-4 margin-bs">Species</label>
	        <input 
	                placeholder="Type Here ..." 
	                type="text"
	                id="fishmob"
	                name="fishmob" 
	                class="col-xs-10 form-control margin-b">
	    </div> 
	</div>  
</template>
<script>
import { mapActions, mapGetters } from 'vuex'
import { stillwatermobautocomplete } from '../helpers/stillwatermobautocomplete.js'
import { stillwaterluremobautocomplete } from '../helpers/stillwaterluremobautocomplete.js'
import { rivermobautocomplete } from '../helpers/rivermobautocomplete.js'
import { riverluremobautocomplete } from '../helpers/riverluremobautocomplete.js'
import { canalmobautocomplete } from '../helpers/canalmobautocomplete.js'
import { canalluremobautocomplete } from '../helpers/canalluremobautocomplete.js'
import { seaboatmobautocomplete } from '../helpers/seaboatmobautocomplete.js'
import { seashoremobautocomplete } from '../helpers/seashoremobautocomplete.js'
import { coarsefishmobautocomplete } from '../helpers/coarsefishmobautocomplete.js'
import { seafishmobautocomplete } from '../helpers/seafishmobautocomplete.js'

    export default {
        props: [
            'isActive',
            'water',
        ],
    computed: mapGetters({
        stillwaterPages: 'allStillwaterPages',
        stillwaterLurePages: 'allStillwaterLurePages',
        riverPages: 'allRiverPages',
        riverLurePages: 'allRiverLurePages',
        canalPages: 'allCanalPages',
        canalLurePages: 'allCanalLurePages',
        seaBoatPages: 'allSeaBoatPages',
        seaShorePages: 'allSeaShorePages',
        coarseFishs: 'allCoarseFishs',
        seaFishs: 'allSeaFishs',
        cardMeta: 'allCardMeta'
    }),
    methods: {
        ...mapActions([
            'getStillwaterPages',
            'getThreeCoarseFishs',
            'getThreeSeaFishs',
            'getThreeStillwaters',
            'getThreeStillwaterLures',
            'getThreeRivers',
            'getThreeCanalLures',
            'getThreeCanals',
            'getThreeSeaBoats',
            'getThreeSeaShores',
            'getThreeRiverLures',
        ]),

        mobSearch() {
            this.$emit('update:isActive', false)
        }
    },
    mounted() {
        if(this.water.id === 1) {
            stillwatermobautocomplete('#districtmob').on('autocomplete:selected', (e, selection) => { 
            setTimeout(() => { 
                    this.getThreeStillwaters(
                    { coarseFish: this.coarseFishs[0].id,
                    firstStillwater: selection.id-1,
                    secondStillwater: selection.id,
                    thirdStillwater:  selection.id+1,
                    style: this.water.id }
                    )}, 500)
                this.mobSearch()
            }),
            coarsefishmobautocomplete('#fishmob').on('autocomplete:selected', (e, selection) => {
                  setTimeout(() => { 
                    this.getThreeCoarseFishs(
                    { firstFish: selection.id-1,
                    secondFish: selection.id,
                    thirdFish:  selection.id+1,
                    district: this.stillwaterPages[0].id,
                    style: this.water.id }
                    )}, 500)
                this.mobSearch()
            })
        }
        if(this.water.id === 2) {
            stillwaterluremobautocomplete('#districtmob').on('autocomplete:selected', (e, selection) => { 
            setTimeout(() => { 
                    this.getThreeStillwaterLures(
                    { coarseFish: this.coarseFishs[0].id,
                    firstStillwaterLure: selection.id-1,
                    secondStillwaterLure: selection.id,
                    thirdStillwaterLure:  selection.id+1,
                    style: this.water.id }
                    )}, 500)
                this.mobSearch()
            }),
            coarsefishmobautocomplete('#fishmob').on('autocomplete:selected', (e, selection) => {
                  setTimeout(() => { 
                    this.getThreeCoarseFishs(
                    { firstFish: selection.id-1,
                    secondFish: selection.id,
                    thirdFish:  selection.id+1,
                    district: this.stillwaterLurePages[0].id,
                    style: this.water.id }
                    )}, 500)
                this.mobSearch()
            })
        }
        if(this.water.id === 3) {
            rivermobautocomplete('#districtmob').on('autocomplete:selected', (e, selection) => { 
            setTimeout(() => { 
                    this.getThreeRivers(
                    { coarseFish: this.coarseFishs[0].id,
                    firstRiver: selection.id-1,
                    secondRiver: selection.id,
                    thirdRiver:  selection.id+1,
                    style: this.water.id }
                    )}, 500)
                this.mobSearch()
            }),
            coarsefishmobautocomplete('#fishmob').on('autocomplete:selected', (e, selection) => {
                  setTimeout(() => { 
                    this.getThreeCoarseFishs(
                    { firstFish: selection.id-1,
                    secondFish: selection.id,
                    thirdFish:  selection.id+1,
                    district: this.riverPages[0].id,
                    style: this.water.id }
                    )}, 500)
                this.mobSearch()
            })
        }
        if(this.water.id === 4) {
            riverluremobautocomplete('#districtmob').on('autocomplete:selected', (e, selection) => { 
            setTimeout(() => { 
                    this.getThreeRiverLures(
                    { coarseFish: this.coarseFishs[0].id,
                    firstRiverLure: selection.id-1,
                    secondRiverLure: selection.id,
                    thirdRiverLure:  selection.id+1,
                    style: this.water.id }
                    )}, 500)
                this.mobSearch()
            }),
            coarsefishmobautocomplete('#fishmob').on('autocomplete:selected', (e, selection) => {
                  setTimeout(() => { 
                    this.getThreeCoarseFishs(
                    { firstFish: selection.id-1,
                    secondFish: selection.id,
                    thirdFish:  selection.id+1,
                    district: this.riverLurePages[0].id,
                    style: this.water.id }
                    )}, 500)
                this.mobSearch()
            })
        }
        if(this.water.id === 5) {
            canalmobautocomplete('#districtmob').on('autocomplete:selected', (e, selection) => { 
            setTimeout(() => { 
                    this.getThreeCanals(
                    { coarseFish: this.coarseFishs[0].id,
                    firstCanal: selection.id-1,
                    secondCanal: selection.id,
                    thirdCanal:  selection.id+1,
                    style: this.water.id }
                    )}, 500)
                this.mobSearch()
            }),
            coarsefishmobautocomplete('#fishmob').on('autocomplete:selected', (e, selection) => {
                  setTimeout(() => { 
                    this.getThreeCoarseFishs(
                    { firstFish: selection.id-1,
                    secondFish: selection.id,
                    thirdFish:  selection.id+1,
                    district: this.canalPages[0].id,
                    style: this.water.id }
                    )}, 500)
                this.mobSearch()
            })
        }
        if(this.water.id === 6) {
            canalluremobautocomplete('#districtmob').on('autocomplete:selected', (e, selection) => { 
            setTimeout(() => { 
                    this.getThreeCanalLures(
                    { coarseFish: this.coarseFishs[0].id,
                    firstCanalLure: selection.id-1,
                    secondCanalLure: selection.id,
                    thirdCanalLure:  selection.id+1,
                    style: this.water.id }
                    )}, 500)
                this.mobSearch()
            }),
            coarsefishmobautocomplete('#fishmob').on('autocomplete:selected', (e, selection) => {
                  setTimeout(() => { 
                    this.getThreeCoarseFishs(
                    { firstFish: selection.id-1,
                    secondFish: selection.id,
                    thirdFish:  selection.id+1,
                    district: this.canalLurePages[0].id,
                    style: this.water.id }
                    )}, 500)
                this.mobSearch()
            })
        }
        if(this.water.id === 7) {
            seaboatmobautocomplete('#districtmob').on('autocomplete:selected', (e, selection) => { 
            setTimeout(() => { 
                    this.getThreeSeaBoats(
                    { coarseFish: this.seaFishs[0].id,
                    firstSeaBoat: selection.id-1,
                    secondSeaBoat: selection.id,
                    thirdSeaBoat:  selection.id+1,
                    style: this.water.id }
                    )}, 500)
                this.mobSearch()
            }),
            seafishmobautocomplete('#fishmob').on('autocomplete:selected', (e, selection) => {
                  setTimeout(() => { 
                    this.getThreeSeaFishs(
                    { firstFish: selection.id-1,
                    secondFish: selection.id,
                    thirdFish:  selection.id+1,
                    district: this.seaBoatPages[0].id,
                    style: this.water.id }
                    )}, 500)
                this.mobSearch()
            })
        }
        if(this.water.id === 8) {
            seashoremobautocomplete('#districtmob').on('autocomplete:selected', (e, selection) => { 
            setTimeout(() => { 
                    this.getThreeSeaShores(
                    { coarseFish: this.seaFishs[0].id,
                    firstSeaShore: selection.id-1,
                    secondSeaShore: selection.id,
                    thirdSeaShore:  selection.id+1,
                    style: this.water.id }
                    )}, 500)
                this.mobSearch()
            }),
            seafishmobautocomplete('#fishmob').on('autocomplete:selected', (e, selection) => {
                  setTimeout(() => { 
                    this.getThreeSeaFishs(
                    { firstFish: selection.id-1,
                    secondFish: selection.id,
                    thirdFish:  selection.id+1,
                    district: this.seaShorePages[0].id,
                    style: this.water.id }
                    )}, 500)
                this.mobSearch()
            })
        }
    }
}

</script>