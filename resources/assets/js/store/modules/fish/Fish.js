import api from '../../api/fish'

const state = {
	coarseFish: [],
	seaFish: [],
	meta: null
}

const getters = {
	allCoarseFish: state => {
		return state.coarseFish
	},
	allSeaFish: state => {
		return state.seaFish
	}

}

const actions = {
	getCoarseFish ({dispatch, commit}, coarseFish) {
		api.getCoarseFish(coarseFish).then((response) => {
			commit('setCoarseFish', response.data.data)
		})
	},
	
	getSeaFish ({dispatch, commit}, seaFish) {
		api.getSeaFish(seaFish).then((response) => {
			commit('setSeaFish', response.data.data)
		})
	}
}

const mutations = {
	setCoarseFish (state, coarseFish) {
		state.coarseFish = coarseFish
	},
	setSeaFish (state, seaFish) {
		state.seaFish = seaFish
	}

}


export default {
	state,
	getters,
	mutations,
	actions
}