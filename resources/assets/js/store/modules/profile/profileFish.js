import api from '../../api/profile'

const state = {
	profileFishs: [],
	profileFishTops: null,
	profileFishRights: null,
	profileFishLefts: null,
	profileFishBottoms: null,
	topMeta: [],
	bottomMeta: [],
	middleFishMeta: [],
}

const getters = {
	allProfileFishs: state => {
		return state.profileFishs
	},
	allProfileFishRights: state => {
		return state.profileFishRights
	},
	allProfileFishLefts: state => {
		return state.profileFishLefts
	},
	allProfileFishTops: state => {
		return state.profileFishTops
	},
	allProfileFishBottoms: state => {
		return state.profileFishBottoms
	},
	allTopMeta: state => {
		return state.topMeta
	},
	allBottomMeta: state => {
		return state.bottomMeta
	},
	allMiddleFishMeta: state => {
		return state.middleFishMeta
	}
}

const actions = {
	getProfileFishs ({dispatch, commit, rootState}, payload) {
		api.getFishes(payload.profileDistrict, payload.style, payload.page).then((response) => {
			commit('setProfileFishs', response.data.data || [])
			commit('setMiddleFishMeta', response.data.meta)
		})
	},

	getProfileFishLefts ({dispatch, commit, rootState}, payload) {
		api.getFishes(payload.profileDistrict, payload.style, payload.page).then((response) => {
			commit('setProfileFishLefts', response.data.data || [])
		})
	}, 

	getProfileFishRights ({dispatch, commit, rootState}, payload) {
		api.getFishes(payload.profileDistrict, payload.style, payload.page).then((response) => {
			commit('setProfileFishRights', response.data.data || [])
		})
	},

	getProfileFishTops ({dispatch, commit, rootState}, payload) {
		api.getFishes(payload.profileDistrict, payload.style, payload.page).then((response) => {
			commit('setProfileFishTops', response.data.data || [])
			commit('setTopMeta', response.data.meta)
		})
	},

	getProfileFishBottoms ({dispatch, commit, rootState}, payload) {
		api.getFishes(payload.profileDistrict, payload.style, payload.page).then((response) => {
			commit('setProfileFishBottoms', response.data.data || [])
			commit('setBottomMeta', response.data.meta)
		})
	},

	getNextFish({commit, state, rootState}, payload){
			api.getFishes(payload.profileDistrict, payload.style, payload.page+1).then((response) => {
			commit('setProfileFishTops', state.profileFishs)
			commit('setProfileFishs', state.profileFishBottoms)
			commit('setProfileFishBottoms', response.data.data)
			commit('setTopMeta', state.middleFishMeta)
			commit('setMiddleFishMeta', state.bottomMeta)
			commit('setBottomMeta', response.data.meta)
		})
	},

	getPreviousFish({commit, state, rootState}, payload){
			api.getFishes(payload.profileDistrict, payload.style, payload.page-1).then((response) => {
			commit('setProfileFishBottoms', state.profileFishs)
			commit('setProfileFishs', state.profileFishTops)
			commit('setProfileFishTops', response.data.data)
			commit('setBottomMeta', state.middleFishMeta)
			commit('setMiddleFishMeta', state.topMeta)
			commit('setTopMeta', response.data.meta)
		})
	}
}

const mutations = {
	setProfileFishs (state, profileFishs) {
		state.profileFishs = profileFishs
	},
	setProfileFishLefts (state, profileFishLefts) {
		state.profileFishLefts = profileFishLefts
	},
	setProfileFishRights (state, profileFishRights) {
		state.profileFishRights = profileFishRights
	},
	setProfileFishTops (state, profileFishTops) {
		state.profileFishTops = profileFishTops
	},
	setProfileFishBottoms (state, profileFishBottoms) {
		state.profileFishBottoms = profileFishBottoms
	},
	setTopMeta (state, topMeta) {
		state.topMeta = topMeta
	},
	setBottomMeta (state, bottomMeta) {
		state.bottomMeta = bottomMeta
	},
	setMiddleFishMeta (state, middleFishMeta) {
		state.middleFishMeta = middleFishMeta
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
