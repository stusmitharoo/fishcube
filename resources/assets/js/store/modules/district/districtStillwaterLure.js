import api from '../../api/districts'

const state = {
	districtStillwaterLures: [],
	stillwaterLure: [],
	stillwaterLurePages: [],
	stillwaterLurePageLefts: [],
	stillwaterLurePageRights: [],
	meta: null
}

const getters = {
	allDistrictStillwaterLures: state => {
		return state.districtStillwaterLures
	},
	allStillwaterLure: state => {
		return state.stillwaterLure
	},
	allStillwaterLurePages: state => {
		return state.stillwaterLurePages
	},
	allStillwaterLurePageLefts: state => {
		return state.stillwaterLurePageLefts
	},
	allStillwaterLurePageRights: state => {
		return state.stillwaterLurePageRights
	}
}

const actions = {
	getDistrictStillwaterLures ({dispatch, commit}, page) {
		api.getDistrictStillwaterLures().then((response) => {
			commit('setDistrictStillwaterLures', response.data.data)
		})
	},

	getStillwaterLure ({dispatch, commit}, districtStillwaterLure) {
		api.getStillwaterLure(districtStillwaterLure).then((response) => {
			commit('setStillwaterLure', response.data.data)
		})
	},

	getStillwaterLurePages ({dispatch, commit}, page) {
		api.getStillwaterLurePages(page).then((response) => {
			commit('setStillwaterLurePages', response.data.data)
		})
	},

	getStillwaterLurePageLefts ({dispatch, commit}, page) {
		api.getStillwaterLurePages(page).then((response) => {
			commit('setStillwaterLurePageLefts', response.data.data)
		})
	},

	getStillwaterLurePageRights ({dispatch, commit}, page) {
		api.getStillwaterLurePages(page).then((response) => {
			commit('setStillwaterLurePageRights', response.data.data)
		})
	},

	getNextDistrictStillwaterLure({commit, state}, page){
			api.getStillwaterLurePages(page+1).then((response) => {
			commit('setStillwaterLurePageLefts', state.stillwaterLurePages)
			commit('setStillwaterLurePages', state.stillwaterLurePageRights)
			commit('setStillwaterLurePageRights', response.data.data)
		})
	},
	
	getPreviousDistrictStillwaterLure({commit, state}, page){
		const nextPage = page-1
			api.getStillwaterLurePages(nextPage).then((response) => {
			commit('setStillwaterLurePageRights', state.stillwaterLurePages)
			commit('setStillwaterLurePages', state.stillwaterLurePageLefts)
			commit('setStillwaterLurePageLefts', response.data.data)
		})
	}
}

const mutations = {
	//selector
	setDistrictStillwaterLures (state, districtStillwaterLures) {
		state.districtStillwaterLures = districtStillwaterLures
	},
	setStillwaterLure (state, stillwaterLure) {
		state.stillwaterLure = stillwaterLure
	},
	//water
	setStillwaterLurePages (state, stillwaterLurePages) {
		state.stillwaterLurePages = stillwaterLurePages
	},
	setStillwaterLurePageLefts (state, stillwaterLurePageLefts) {
		state.stillwaterLurePageLefts = stillwaterLurePageLefts
	},
	setStillwaterLurePageRights (state, stillwaterLurePageRights) {
		state.stillwaterLurePageRights = stillwaterLurePageRights
	}
}


export default {
	state,
	getters,
	mutations,
	actions
}