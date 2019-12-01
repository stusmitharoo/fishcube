import api from '../../api/fish'

const state = {
	seaFishs: [],
	seaFishTops: [],
	seaFishBottoms: [],
	meta: null
}

const getters = {
	allSeaFishs: state => {
		return state.seaFishs
	},
	allSeaFishTops: state => {
		return state.seaFishTops
	},
	allSeaFishBottoms: state => {
		return state.seaFishBottoms
	}
}

const actions = {
	getSeaFishs ({dispatch, commit}, page) {
		api.getSeaFishs(page).then((response) => {
			commit('setSeaFishs', response.data.data)
		})
	},

	getSeaFishTops ({dispatch, commit}, page) {
		api.getSeaFishs(page).then((response) => {
			commit('setSeaFishTops', response.data.data)
		})
	},

	getSeaFishBottoms ({dispatch, commit}, page) {
		api.getSeaFishs(page).then((response) => {
			commit('setSeaFishBottoms', response.data.data)
		})
	},
	
	getNextSeaFish({commit, state}, page){
			api.getSeaFishs(page+1).then((response) => {
			commit('setSeaFishTops', state.seaFishs)
			commit('setSeaFishs', state.seaFishBottoms)
			commit('setSeaFishBottoms', response.data.data)
		})
	},
	
	getPreviousSeaFish({commit, state}, page){
		const nextPage = page-1
			api.getSeaFishs(nextPage).then((response) => {
			commit('setSeaFishBottoms', state.seaFishs)
			commit('setSeaFishs', state.seaFishTops)
			commit('setSeaFishTops', response.data.data)
		})
	}
}

const mutations = {
	setSeaFishs (state, seaFishs) {
		state.seaFishs = seaFishs
	},
	setSeaFishTops (state, seaFishTops) {
		state.seaFishTops = seaFishTops
	},
	setSeaFishBottoms (state, seaFishBottoms) {
		state.seaFishBottoms = seaFishBottoms
	}

}


export default {
	state,
	getters,
	mutations,
	actions
}