import api from '../../api/order'

const state = {
	orderDistricts: null,
	orderFishs: null,
}

const getters = {
	allOrderDistricts: state => {
		return state.orderDistricts
	},
	allOrderFishs: state => {
		return state.orderFishs
	}
}

const actions = {
	getOrderDistricts ({dispatch, commit}, page) {
		api.getOrderDistricts().then((response) => {
			commit('setOrderDistricts', response.data.data)
		})
	},

	getOrderFishs ({dispatch, commit, rootState}, payload) {
		api.getOrderFishs(payload.orderDistrict).then((response) => {
			commit('setOrderFishs', response.data.data)
		})
	}
}

const mutations = {
	setOrderDistricts (state, orderDistricts) {
		state.orderDistricts = orderDistricts
	},
	setOrderFishs (state, orderFishs) {
		state.orderFishs = orderFishs
	}
}


export default {
	state,
	getters,
	mutations,
	actions
}
