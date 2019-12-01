import api from '../../api/fish'

const state = {
	coarseFishs: [],
	coarseFishTops: [],
	coarseFishBottoms: [],
	meta: null
}

const getters = {
	allCoarseFishs: state => {
		return state.coarseFishs
	},
	allCoarseFishTops: state => {
		return state.coarseFishTops
	},
	allCoarseFishBottoms: state => {
		return state.coarseFishBottoms
	}
}

const actions = {
	getCoarseFishs ({dispatch, commit}, page) {
		api.getCoarseFishs(page).then((response) => {
			commit('setCoarseFishs', response.data.data)
		})
	},

	getCoarseFishTops ({dispatch, commit}, page) {
		api.getCoarseFishs(page).then((response) => {
			commit('setCoarseFishTops', response.data.data)
		})
	},

	getCoarseFishBottoms ({dispatch, commit}, page) {
		api.getCoarseFishs(page).then((response) => {
			commit('setCoarseFishBottoms', response.data.data)
		})
	},
	
	getNextCoarseFish({commit, state}, page){
			api.getCoarseFishs(page+1).then((response) => {
			commit('setCoarseFishTops', state.coarseFishs)
			commit('setCoarseFishs', state.coarseFishBottoms)
			commit('setCoarseFishBottoms', response.data.data)
		})
	},
	
	getPreviousCoarseFish({commit, state}, page){
		const nextPage = page-1
			api.getCoarseFishs(nextPage).then((response) => {
			commit('setCoarseFishBottoms', state.coarseFishs)
			commit('setCoarseFishs', state.coarseFishTops)
			commit('setCoarseFishTops', response.data.data)
		})
	}
}

const mutations = {
	setCoarseFishs (state, coarseFishs) {
		state.coarseFishs = coarseFishs
	},
	setCoarseFishTops (state, coarseFishTops) {
		state.coarseFishTops = coarseFishTops
	},
	setCoarseFishBottoms (state,coarseFishBottoms) {
		state.coarseFishBottoms = coarseFishBottoms
	}

}


export default {
	state,
	getters,
	mutations,
	actions
}