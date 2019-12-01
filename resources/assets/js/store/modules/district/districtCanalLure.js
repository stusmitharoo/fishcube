import api from '../../api/districts'

const state = {
	districtCanalLures: [],
	canalLure: [],
	canalLurePages: [],
	canalLurePageLefts: [],
	canalLurePageRights: [],
	meta: null
}

const getters = {
	allDistrictCanalLures: state => {
		return state.districtCanalLures
	},
	allCanalLure: state => {
		return state.canalLure
	},
	allCanalLurePages: state => {
		return state.canalLurePages
	},
	allCanalLurePageLefts: state => {
		return state.canalLurePageLefts
	},
	allCanalLurePageRights: state => {
		return state.canalLurePageRights
	}
}

const actions = {
	getDistrictCanalLures ({dispatch, commit}, page) {
		api.getDistrictCanalLures().then((response) => {
			commit('setDistrictCanalLures', response.data.data)
		})
	},

	getCanalLure ({dispatch, commit}, districtCanalLure) {
		api.getCanalLure(districtCanalLure).then((response) => {
			commit('setCanalLure', response.data.data)
		})
	},

	getCanalLurePages ({dispatch, commit}, page) {
		api.getCanalLurePages(page).then((response) => {
			commit('setCanalLurePages', response.data.data)
		})
	},

	getCanalLurePageLefts ({dispatch, commit}, page) {
		api.getCanalLurePages(page).then((response) => {
			commit('setCanalLurePageLefts', response.data.data)
		})
	},

	getCanalLurePageRights ({dispatch, commit}, page) {
		api.getCanalLurePages(page).then((response) => {
			commit('setCanalLurePageRights', response.data.data)
		})
	},

	getNextDistrictCanalLure({commit, state}, page){
			api.getCanalLurePages(page+1).then((response) => {
			commit('setCanalLurePageLefts', state.canalLurePages)
			commit('setCanalLurePages', state.canalLurePageRights)
			commit('setCanalLurePageRights', response.data.data)
		})
	},

	getPreviousDistrictCanalLure({commit, state}, page){
		const nextPage = page-1
			api.getCanalLurePages(nextPage).then((response) => {
			commit('setCanalLurePageRights', state.canalLurePages)
			commit('setCanalLurePages', state.canalLurePageLefts)
			commit('setCanalLurePageLefts', response.data.data)
		})
	}
}

const mutations = {
	setDistrictCanalLures (state, districtCanalLures) {
		state.districtCanalLures = districtCanalLures
	},
	setCanalLure (state, canalLure) {
		state.canalLure = canalLure
	},
	setCanalLurePages (state, canalLurePages) {
		state.canalLurePages = canalLurePages
	},
	setCanalLurePageLefts (state, canalLurePageLefts) {
		state.canalLurePageLefts = canalLurePageLefts
	},
	setCanalLurePageRights (state, canalLurePageRights) {
		state.canalLurePageRights = canalLurePageRights
	}
}


export default {
	state,
	getters,
	mutations,
	actions
}