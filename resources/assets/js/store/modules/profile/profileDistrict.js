import api from '../../api/profile'

const state = {
	districts: null,
	districtLefts: {},
	districtRights: {},
	leftMeta: [],
	rightMeta: [],
	middleMeta: [],
}

const getters = {
	allDistricts: state => {
		return state.districts
	},
	allDistrictLefts: state => {
		return state.districtLefts
	},
	allDistrictRights: state => {
		return state.districtRights
	},
	allLeftMeta: state => {
		return state.leftMeta
	},
	allRightMeta: state => {
		return state.rightMeta
	},
	allMiddleMeta: state => {
		return state.middleMeta
	}
}

const actions = {
	getDistricts ({dispatch, commit}, page) {
		api.getDistricts(2).then((response) => {
			commit('setDistricts', response.data.data)
			commit('setMiddleMeta', response.data.meta)
		})
	},

	getDistrictLefts ({dispatch, commit}, page) {
		api.getDistricts(1).then((response) => {
			commit('setDistrictLefts', response.data.data)
			commit('setLeftMeta', response.data.meta)
		})
	},

	getDistrictRights ({dispatch, commit}, page) {
		api.getDistricts(3).then((response) => {
			commit('setDistrictRights', response.data.data)
			commit('setRightMeta', response.data.meta)
		})
	},

	getNextDistrict({commit, state}, page){
			api.getDistricts(page+1).then((response) => {
			commit('setDistrictLefts', state.districts)
			commit('setDistricts', state.districtRights)
			commit('setDistrictRights', response.data.data)
			commit('setLeftMeta', state.middleMeta)
			commit('setMiddleMeta', state.rightMeta)
			commit('setRightMeta', response.data.meta)
		})
	},

	getPreviousDistrict({commit, state}, page){
		const nextPage = page-1
			api.getDistricts(nextPage).then((response) => {
			commit('setDistrictRights', state.districts)
			commit('setDistricts', state.districtLefts)
			commit('setDistrictLefts', response.data.data)
			commit('setRightMeta', state.middleMeta)
			commit('setMiddleMeta', state.leftMeta)
			commit('setLeftMeta', response.data.meta)
		})
	}
}

const mutations = {
	setDistricts (state, districts) {
		state.districts = districts
	},
	setDistrictLefts (state, districtLefts) {
		state.districtLefts = districtLefts
	},
	setDistrictRights (state, districtRights) {
		state.districtRights = districtRights
	},
	setLeftMeta (state, leftMeta) {
		state.leftMeta = leftMeta
	},
	setRightMeta (state, rightMeta) {
		state.rightMeta = rightMeta
	},
	setMiddleMeta (state, middleMeta) {
		state.middleMeta = middleMeta
	}
}


export default {
	state,
	getters,
	mutations,
	actions
}
