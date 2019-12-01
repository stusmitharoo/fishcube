import api from '../../api/forms'

const state = {
	profileDistricts: [],
	createFishs: []
}

const getters = {
	allProfileDistricts: state => {
		return state.profileDistricts
	},
	allCreateFishs: state => {
		return state.createFishs
	}
}

const actions = {
	submitLocation ({dispatch, commit}, {district_id, name, image, style_id}) {
		return api.storeSelectDistrict({
		 	style_id: style_id,
		 	district_id: district_id,
		 	name: name,
		 	image: image,
		}).then((response) => {
			commit('appendToProfileDistricts', response.data)
			return response
		})
	},

	getProfileDistricts ({dispatch, commit, rootState}, payload){
		api.getSelectorDistricts(payload.style).then((response) => {
			commit('setProfileDistricts', response.data.data)
		})
	},

	getCreateFishs ({dispatch, commit, rootState}, payload){
		api.getSelectorFishs(payload.profileDistrict, payload.style).then((response) => {
			commit('setCreateFishs', response.data.data)
		})
	},

	submitFishes ({dispatch, commit}, {district_id, profile_district_id, style_id, fish_id, name, image}) {

		return api.storeSelectFish({
		 	district_id: district_id,
			profile_district_id: profile_district_id,
			style_id: style_id,
			fish_id: fish_id,
			name: name,
			image: image,
		})
		.then((response) => {
			return response
		})
	},
}

const mutations = {
	setProfileDistricts (state, profileDistricts) {
		state.profileDistricts = profileDistricts
	},
	setCreateFishs (state, createFishs) {
		state.createFishs = createFishs
	},
	appendToProfileDistricts (state,reply) {
		state.profileDistricts.unshift(reply)
	}
}

const modules = {
}

export default {
	state,
	getters,
	mutations,
	actions,
	modules
}
