import api from '../../api/viewProfile'

const state = {
	viewDistricts: null,
	viewDistrictLefts: {},
	viewDistrictRights: {},
	viewLeftMeta: [],
	viewRightMeta: [],
	viewMiddleMeta: [],
}

const getters = {
	allViewDistricts: state => {
		return state.viewDistricts
	},
	allViewDistrictLefts: state => {
		return state.viewDistrictLefts
	},
	allViewDistrictRights: state => {
		return state.viewDistrictRights
	},
	allViewLeftMeta: state => {
		return state.viewLeftMeta
	},
	allViewRightMeta: state => {
		return state.viewRightMeta
	},
	allViewMiddleMeta: state => {
		return state.viewMiddleMeta
	}
}

const actions = {
	getViewDistricts ({dispatch, commit},id, page) {
		api.getViewDistricts(id, 2).then((response) => {
			commit('setViewDistricts', response.data.data)
			commit('setViewMiddleMeta', response.data.meta)
		})
	},

	getViewDistrictLefts ({dispatch, commit},id, page) {
		api.getViewDistricts(id, 1).then((response) => {
			commit('setViewDistrictLefts', response.data.data)
			commit('setViewLeftMeta', response.data.meta)
		})
	},

	getViewDistrictRights ({dispatch, commit},id, page) {
		api.getViewDistricts(id, 3).then((response) => {
			commit('setViewDistrictRights', response.data.data)
			commit('setViewRightMeta', response.data.meta)
		})
	},

	getViewNextDistrict({commit, state},{id, page}){
			api.getViewDistricts(id, page+1).then((response) => {
			commit('setViewDistrictLefts', state.viewDistricts)
			commit('setViewDistricts', state.viewDistrictRights)
			commit('setViewDistrictRights', response.data.data)
			commit('setViewLeftMeta', state.viewMiddleMeta)
			commit('setViewMiddleMeta', state.viewRightMeta)
			commit('setViewRightMeta', response.data.meta)
		})
	},

	getViewPreviousDistrict({commit, state},{id, page}){
		const nextPage = page-1
			api.getViewDistricts(id, nextPage).then((response) => {
			commit('setViewDistrictRights', state.viewDistricts)
			commit('setViewDistricts', state.viewDistrictLefts)
			commit('setViewDistrictLefts', response.data.data)
			commit('setViewRightMeta', state.viewMiddleMeta)
			commit('setViewMiddleMeta', state.viewLeftMeta)
			commit('setViewLeftMeta', response.data.meta)
		})
	}
}

const mutations = {
	setViewDistricts (state, viewDistricts) {
		state.viewDistricts = viewDistricts
	},
	setViewDistrictLefts (state, viewDistrictLefts) {
		state.viewDistrictLefts = viewDistrictLefts
	},
	setViewDistrictRights (state, viewDistrictRights) {
		state.viewDistrictRights = viewDistrictRights
	},
	setViewLeftMeta (state, viewLeftMeta) {
		state.viewLeftMeta = viewLeftMeta
	},
	setViewRightMeta (state, viewRightMeta) {
		state.viewRightMeta = viewRightMeta
	},
	setViewMiddleMeta (state, viewMiddleMeta) {
		state.viewMiddleMeta = viewMiddleMeta
	}
}


export default {
	state,
	getters,
	mutations,
	actions
}