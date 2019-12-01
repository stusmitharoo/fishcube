import api from '../../api/districts'

const state = {
	districtCanals: [],
	canalPages: [],
	canalPageLefts: [],
	canalPageRights: [],
	canal: {},
}

const getters = {
	allDistrictCanals: state => {
		return state.districtCanals
	},
	allCanal: state => {
		return state.canal
	},
	allCanalPages: state => {
		return state.canalPages
	},
	allCanalPageLefts: state => {
		return state.canalPageLefts
	},
	allCanalPageRights: state => {
		return state.canalPageRights
	}
}

const actions = {
	getDistrictCanals ({dispatch, commit}, page) {
		api.getDistrictCanals().then((response) => {
			commit('setDistrictCanals', response.data.data)
		})
	},

	getCanal ({dispatch, commit}, districtCanal) {
		api.getCanal(districtCanal).then((response) => {
			commit('setCanal', response.data.data)
		})
	},

	getCanalPages ({dispatch, commit}, page) {
		api.getCanalPages(page).then((response) => {
			commit('setCanalPages', response.data.data)
		})
	},

	getCanalPageLefts ({dispatch, commit}, page) {
		api.getCanalPages(page).then((response) => {
			commit('setCanalPageLefts', response.data.data)
		})
	},

	getCanalPageRights ({dispatch, commit}, page) {
		api.getCanalPages(page).then((response) => {
			commit('setCanalPageRights', response.data.data)
		})
	},
	getNextDistrictCanal({commit, state}, page){
			api.getCanalPages(page+1).then((response) => {
			commit('setCanalPageLefts', state.canalPages)
			commit('setCanalPages', state.canalPageRights)
			commit('setCanalPageRights', response.data.data)
		})
	},
	
	getPreviousDistrictCanal({commit, state}, page){
		const nextPage = page-1
			api.getCanalPages(nextPage).then((response) => {
			commit('setCanalPageRights', state.canalPages)
			commit('setCanalPages', state.canalPageLefts)
			commit('setCanalPageLefts', response.data.data)
		})
	}
}

const mutations = {
	//selector
	setDistrictCanals (state, districtCanals) {
		state.districtCanals = districtCanals
	},
	setCanal (state, canal) {
		state.canal = canal
	},
	//water
	setCanalPages (state, canalPages) {
		state.canalPages = canalPages
	},
	setCanalPageLefts (state, canalPageLefts) {
		state.canalPageLefts = canalPageLefts
	},
	setCanalPageRights (state, canalPageRights) {
		state.canalPageRights = canalPageRights
	}
}


export default {
	state,
	getters,
	mutations,
	actions
}