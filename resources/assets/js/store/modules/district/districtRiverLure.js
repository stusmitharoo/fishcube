import api from '../../api/districts'

const state = {
	districtRiverLures: [],
	riverLure: [],
	riverLurePages: [],
	riverLurePageLefts: [],
	riverLurePageRights: [],
	meta: null
}

const getters = {
	//selector
	allDistrictRiverLures: state => {
		return state.districtRiverLures
	},
	allRiverLure: state => {
		return state.riverLure
	},
	//waters
	allRiverLurePages: state => {
		return state.riverLurePages
	},
	allRiverLurePageLefts: state => {
		return state.riverLurePageLefts
	},
	allRiverLurePageRights: state => {
		return state.riverLurePageRights
	}
}

const actions = {
	getDistrictRiverLures ({dispatch, commit}, page) {
		api.getDistrictRiverLures().then((response) => {
			commit('setDistrictRiverLures', response.data.data)
		})
	},

	getRiverLure ({dispatch, commit}, districtRiverLure) {
		api.getRiverLure(districtRiverLure).then((response) => {
			commit('setRiverLure', response.data.data)
		})
	},

	getRiverLurePages ({dispatch, commit}, page) {
		api.getRiverLurePages(page).then((response) => {
			commit('setRiverLurePages', response.data.data)
		})
	},

	getRiverLurePageLefts ({dispatch, commit}, page) {
		api.getRiverLurePages(page).then((response) => {
			commit('setRiverLurePageLefts', response.data.data)
		})
	},

	getRiverLurePageRights ({dispatch, commit}, page) {
		api.getRiverLurePages(page).then((response) => {
			commit('setRiverLurePageRights', response.data.data)
		})
	},

	getNextDistrictRiverLure({commit, state}, page){
			api.getRiverLurePages(page+1).then((response) => {
			commit('setRiverLurePageLefts', state.riverLurePages)
			commit('setRiverLurePages', state.riverLurePageRights)
			commit('setRiverLurePageRights', response.data.data)
		})
	},
	
	getPreviousDistrictRiverLure({commit, state}, page){
		const nextPage = page-1
			api.getRiverLurePages(nextPage).then((response) => {
			commit('setRiverLurePageRights', state.riverLurePages)
			commit('setRiverLurePages', state.riverLurePageLefts)
			commit('setRiverLurePageLefts', response.data.data)
		})
	}
}

const mutations = {
	//selector
	setDistrictRiverLures (state, districtRiverLures) {
		state.districtRiverLures = districtRiverLures
	},
	setRiverLure (state, riverLure) {
		state.riverLure = riverLure
	},
	//water
	setRiverLurePages (state, riverLurePages) {
		state.riverLurePages = riverLurePages
	},
	setRiverLurePageLefts (state, riverLurePageLefts) {
		state.riverLurePageLefts = riverLurePageLefts
	},
	setRiverLurePageRights (state, riverLurePageRights) {
		state.riverLurePageRights = riverLurePageRights
	}
}


export default {
	state,
	getters,
	mutations,
	actions
}