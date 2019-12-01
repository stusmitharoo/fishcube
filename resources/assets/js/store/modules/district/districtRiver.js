import api from '../../api/districts'

const state = {
	districtRivers: [],
	river: [],
	riverPages: [],
	riverPageLefts: [],
	riverPageRights: [],
	meta: null
}

const getters = {
	allDistrictRivers: state => {
		return state.districtRivers
	},
	allRiver: state => {
		return state.river
	},
	allRiverPages: state => {
		return state.riverPages
	},
	allRiverPageLefts: state => {
		return state.riverPageLefts
	},
	allRiverPageRights: state => {
		return state.riverPageRights
	}
}

const actions = {
	getDistrictRivers ({dispatch, commit}, page) {
		api.getDistrictRivers().then((response) => {
			commit('setDistrictRivers', response.data.data)
		})
	},

	getRiver ({dispatch, commit}, districtRiver) {
		api.getRiver(districtRiver).then((response) => {
			commit('setRiver', response.data.data)
		})
	},

	getRiverPages ({dispatch, commit}, page) {
		api.getRiverPages(page).then((response) => {
			commit('setRiverPages', response.data.data)
		})
	},

	getRiverPageLefts ({dispatch, commit}, page) {
		api.getRiverPages(page).then((response) => {
			commit('setRiverPageLefts', response.data.data)
		})
	},

	getRiverPageRights ({dispatch, commit}, page) {
		api.getRiverPages(page).then((response) => {
			commit('setRiverPageRights', response.data.data)
		})
	},

	getNextDistrictRiver({commit, state}, page){
			api.getRiverPages(page+1).then((response) => {
			commit('setRiverPageLefts', state.riverPages)
			commit('setRiverPages', state.riverPageRights)
			commit('setRiverPageRights', response.data.data)
		})
	},

	getPreviousDistrictRiver({commit, state}, page){
		const nextPage = page-1
			api.getRiverPages(nextPage).then((response) => {
			commit('setRiverPageRights', state.riverPages)
			commit('setRiverPages', state.riverPageLefts)
			commit('setRiverPageLefts', response.data.data)
		})
	}
}

const mutations = {
	setDistrictRivers (state, districtRivers) {
		state.districtRivers = districtRivers
	},
	setRiver (state, river) {
		state.river = river
	},
	setRiverPages (state, riverPages) {
		state.riverPages = riverPages
	},
	setRiverPageLefts (state, riverPageLefts) {
		state.riverPageLefts = riverPageLefts
	},
	setRiverPageRights (state, riverPageRights) {
		state.riverPageRights = riverPageRights
	}
}


export default {
	state,
	getters,
	mutations,
	actions
}