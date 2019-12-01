import api from '../../api/districts'

const state = {
	districtStillwaters: [],
	stillwater: [],
	stillwaterPages: [],
	stillwaterPageLefts: [],
	stillwaterPageRights: []
}

const getters = {
	allDistrictStillwaters: state => {
		return state.districtStillwaters
	},
	allStillwater: state => {
		return state.stillwater
	},
	allStillwaterPages: state => {
		return state.stillwaterPages
	},
	allStillwaterPageLefts: state => {
		return state.stillwaterPageLefts
	},
	allStillwaterPageRights: state => {
		return state.stillwaterPageRights
	}
}

const actions = {
	getDistrictStillwaters ({dispatch, commit}, page) {
		api.getDistrictStillwaters().then((response) => {
			commit('setDistrictStillwaters', response.data.data)
		})
	},

	getStillwater ({dispatch, commit}, districtStillwater) {
		api.getStillwater(districtStillwater).then((response) => {
			commit('setStillwater', response.data.data)
		})
	},

	getStillwaterPages ({dispatch, commit}, page) {
		api.getStillwaterPages(page).then((response) => {
			commit('setStillwaterPages', response.data.data)
		})
	},

	getStillwaterPageLefts ({dispatch, commit}, page) {
		api.getStillwaterPages(page).then((response) => {
			commit('setStillwaterPageLefts', response.data.data)
		})
	},

	getStillwaterPageRights ({dispatch, commit}, page) {
		api.getStillwaterPages(page).then((response) => {
			commit('setStillwaterPageRights', response.data.data)
		})
	},

	getNextDistrictStillwater({commit, state}, page){
			api.getStillwaterPages(page+1).then((response) => {
			commit('setStillwaterPageLefts', state.stillwaterPages)
			commit('setStillwaterPages', state.stillwaterPageRights)
			commit('setStillwaterPageRights', response.data.data)
		})
	},
	
	getPreviousDistrictStillwater({commit, state}, page){
		const nextPage = page-1
			api.getStillwaterPages(nextPage).then((response) => {
			commit('setStillwaterPageRights', state.stillwaterPages)
			commit('setStillwaterPages', state.stillwaterPageLefts)
			commit('setStillwaterPageLefts', response.data.data)
		})
	}
}

const mutations = {
	//selector
	setDistrictStillwaters (state, districtStillwaters) {
		state.districtStillwaters = districtStillwaters
	},
	setStillwater (state, stillwater) {
		state.stillwater = stillwater
	},
	//water
	setStillwaterPages (state, stillwaterPages) {
		state.stillwaterPages = stillwaterPages
	},
	setStillwaterPageLefts (state, stillwaterPageLefts) {
		state.stillwaterPageLefts = stillwaterPageLefts
	},
	setStillwaterPageRights (state, stillwaterPageRights) {
		state.stillwaterPageRights = stillwaterPageRights
	}
}


export default {
	state,
	getters,
	mutations,
	actions
}