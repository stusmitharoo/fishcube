import api from '../../api/districts'

const state = {
	districtSeaBoats: [],
	seaBoat: [],
	seaBoatPages: [],
	seaBoatPageLefts: [],
	seaBoatPageRights: [],
	meta: null
}

const getters = {
	allDistrictSeaBoats: state => {
		return state.districtSeaBoats
	},
	allSeaBoat: state => {
		return state.seaBoat
	},
	allSeaBoatPages: state => {
		return state.seaBoatPages
	},
	allSeaBoatPageLefts: state => {
		return state.seaBoatPageLefts
	},
	allSeaBoatPageRights: state => {
		return state.seaBoatPageRights
	}
}

const actions = {
	getDistrictSeaBoats ({dispatch, commit}, page) {
		api.getDistrictSeaBoats().then((response) => {
			commit('setDistrictSeaBoats', response.data.data)
		})
	},

	getSeaBoat ({dispatch, commit}, districtSeaBoat) {
		api.getSeaBoat(districtSeaBoat).then((response) => {
			commit('setSeaBoat', response.data.data)
		})
	},

	getSeaBoatPages ({dispatch, commit}, page) {
		api.getSeaBoatPages(page).then((response) => {
			commit('setSeaBoatPages', response.data.data)
		})
	},

	getSeaBoatPageLefts ({dispatch, commit}, page) {
		api.getSeaBoatPages(page).then((response) => {
			commit('setSeaBoatPageLefts', response.data.data)
		})
	},

	getSeaBoatPageRights ({dispatch, commit}, page) {
		api.getSeaBoatPages(page).then((response) => {
			commit('setSeaBoatPageRights', response.data.data)
		})
	},

	getNextDistrictSeaBoat({commit, state}, page){
			api.getSeaBoatPages(page+1).then((response) => {
			commit('setSeaBoatPageLefts', state.seaBoatPages)
			commit('setSeaBoatPages', state.seaBoatPageRights)
			commit('setSeaBoatPageRights', response.data.data)
		})
	},
	
	getPreviousDistrictSeaBoat({commit, state}, page){
		const nextPage = page-1
			api.getSeaBoatPages(nextPage).then((response) => {
			commit('setSeaBoatPageRights', state.seaBoatPages)
			commit('setSeaBoatPages', state.seaBoatPageLefts)
			commit('setSeaBoatPageLefts', response.data.data)
		})
	}
}

const mutations = {
	//selector
	setDistrictSeaBoats (state, districtSeaBoats) {
		state.districtSeaBoats = districtSeaBoats
	},
	setSeaBoat (state, seaBoat) {
		state.seaBoat = seaBoat
	},
	//water
	setSeaBoatPages (state, seaBoatPages) {
		state.seaBoatPages = seaBoatPages
	},
	setSeaBoatPageLefts (state, seaBoatPageLefts) {
		state.seaBoatPageLefts = seaBoatPageLefts
	},
	setSeaBoatPageRights (state, seaBoatPageRights) {
		state.seaBoatPageRights = seaBoatPageRights
	}
}


export default {
	state,
	getters,
	mutations,
	actions
}