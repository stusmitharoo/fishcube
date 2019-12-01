import api from '../../api/districts'

const state = {
	districtSeaShores: [],
	seaShore: [],
	seaShorePages: [],
	seaShorePageLefts: [],
	seaShorePageRights: [],
	meta: null
}

const getters = {
	allDistrictSeaShores: state => {
		return state.districtSeaShores
	},
	allSeaShore: state => {
		return state.seaShore
	},
	allSeaShorePages: state => {
		return state.seaShorePages
	},
	allSeaShorePageLefts: state => {
		return state.seaShorePageLefts
	},
	allSeaShorePageRights: state => {
		return state.seaShorePageRights
	}
}

const actions = {
	getDistrictSeaShores ({dispatch, commit}, page) {
		api.getDistrictSeaShores().then((response) => {
			commit('setDistrictSeaShores', response.data.data)
		})
	},

	getSeaShore ({dispatch, commit}, districtSeaShore) {
		api.getSeaShore(districtSeaShore).then((response) => {
			commit('setSeaShore', response.data.data)
		})
	},

	getSeaShorePages ({dispatch, commit}, page) {
		api.getSeaShorePages(page).then((response) => {
			commit('setSeaShorePages', response.data.data)
		})
	},

	getSeaShorePageLefts ({dispatch, commit}, page) {
		api.getSeaShorePages(page).then((response) => {
			commit('setSeaShorePageLefts', response.data.data)
		})
	},

	getSeaShorePageRights ({dispatch, commit}, page) {
		api.getSeaShorePages(page).then((response) => {
			commit('setSeaShorePageRights', response.data.data)
		})
	},

	getNextDistrictSeaShore({commit, state}, page){
			api.getSeaShorePages(page+1).then((response) => {
			commit('setSeaShorePageLefts', state.seaShorePages)
			commit('setSeaShorePages', state.seaShorePageRights)
			commit('setSeaShorePageRights', response.data.data)
		})
	},
	
	getPreviousDistrictSeaShore({commit, state}, page){
		const nextPage = page-1
			api.getSeaShorePages(nextPage).then((response) => {
			commit('setSeaShorePageRights', state.seaShorePages)
			commit('setSeaShorePages', state.seaShorePageLefts)
			commit('setSeaShorePageLefts', response.data.data)
		})
	}
}

const mutations = {
	//selector
	setDistrictSeaShores (state, districtSeaShores) {
		state.districtSeaShores = districtSeaShores
	},
	setSeaShore (state, seaShore) {
		state.seaShore = seaShore
	},
	//water
	setSeaShorePages (state, seaShorePages) {
		state.seaShorePages = seaShorePages
	},
	setSeaShorePageLefts (state, seaShorePageLefts) {
		state.seaShorePageLefts = seaShorePageLefts
	},
	setSeaShorePageRights (state, seaShorePageRights) {
		state.seaShorePageRights = seaShorePageRights
	}
}


export default {
	state,
	getters,
	mutations,
	actions
}