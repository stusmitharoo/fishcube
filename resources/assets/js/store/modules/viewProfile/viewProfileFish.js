import api from '../../api/viewProfile'

const state = {
	viewProfileFishs: null,
	viewProfileFishTops: [],
	viewProfileFishBottoms: [],
	viewProfileFishLefts: [],
	viewProfileFishRights: [],
	viewTopMeta: [],
	viewBottomMeta: [],
	viewMiddleFishMeta: [],
}

const getters = {
	allViewProfileFishs: state => {
		return state.viewProfileFishs
	},
	allViewProfileFishTops: state => {
		return state.viewProfileFishTops
	},
	allViewProfileFishBottoms: state => {
		return state.viewProfileFishBottoms
	},
	allViewProfileFishLefts: state => {
		return state.viewProfileFishLefts
	},
	allViewProfileFishRights: state => {
		return state.viewProfileFishRights
	},
	allViewTopMeta: state => {
		return state.viewTopMeta
	},
	allViewBottomMeta: state => {
		return state.viewBottomMeta
	},
	allViewMiddleFishMeta: state => {
		return state.viewMiddleFishMeta
	}
}

const actions = {
	getViewProfileFishs ({dispatch, commit, rootState}, payload) {
		api.getViewFishes(payload.profileDistrict, payload.style,payload.id, payload.page).then((response) => {
			commit('setViewProfileFishs', response.data.data)
			commit('setViewMiddleFishMeta', response.data.meta)
		})
	},

	getViewProfileFishTops ({dispatch, commit, rootState}, payload) {
		api.getViewFishes(payload.profileDistrict, payload.style,payload.id, payload.page).then((response) => {
			commit('setViewProfileFishTops', response.data.data)
			commit('setViewTopMeta', response.data.meta)
		})
	},

	getViewProfileFishBottoms ({dispatch, commit, rootState}, payload) {
		api.getViewFishes(payload.profileDistrict, payload.style,payload.id, payload.page).then((response) => {
			commit('setViewProfileFishBottoms', response.data.data)
			commit('setViewBottomMeta', response.data.meta)
		})
	},

	getViewProfileFishLefts ({dispatch, commit, rootState}, payload) {
		api.getViewFishes(payload.profileDistrict, payload.style,payload.id, payload.page).then((response) => {
			commit('setViewProfileFishLefts', response.data.data)
			commit('setViewBottomMeta', response.data.meta)
		})
	},

	getViewProfileFishRights ({dispatch, commit, rootState}, payload) {
		api.getViewFishes(payload.profileDistrict, payload.style,payload.id, payload.page).then((response) => {
			commit('setViewProfileFishRights', response.data.data)
			commit('setViewBottomMeta', response.data.meta)
		})
	},

	getViewNextFish({commit, state, rootState}, {profileDistrict, style, id, page}){
			api.getViewFishes(profileDistrict, style, id, page+1).then((response) => {
			commit('setViewProfileFishTops', state.viewProfileFishs)
			commit('setViewProfileFishs', state.viewProfileFishBottoms)
			commit('setViewProfileFishBottoms', response.data.data)
			commit('setViewTopMeta', state.viewMiddleFishMeta)
			commit('setViewMiddleFishMeta', state.viewBottomMeta)
			commit('setViewBottomMeta', response.data.meta)
		})
	},

	getViewPreviousFish({commit, state, rootState}, {profileDistrict, style, id, page}){
			const nextPage = page-1
			api.getViewFishes(profileDistrict, style, id, nextPage).then((response) => {
			commit('setViewProfileFishBottoms', state.viewProfileFishs)
			commit('setViewProfileFishs', state.viewProfileFishTops)
			commit('setViewProfileFishTops', response.data.data)
			commit('setViewBottomMeta', state.viewMiddleFishMeta)
			commit('setViewMiddleFishMeta', state.viewTopMeta)
			commit('setViewTopMeta', response.data.meta)
		})
	}
}

const mutations = {
	setViewProfileFishs (state, viewProfileFishs) {
		state.viewProfileFishs = viewProfileFishs
	},
	setViewProfileFishTops (state, viewProfileFishTops) {
		state.viewProfileFishTops = viewProfileFishTops
	},
	setViewProfileFishBottoms (state, viewProfileFishBottoms) {
		state.viewProfileFishBottoms = viewProfileFishBottoms
	},
	setViewProfileFishLefts (state, viewProfileFishLefts) {
		state.viewProfileFishLefts = viewProfileFishLefts
	},
	setViewProfileFishRights (state, viewProfileFishRights) {
		state.viewProfileFishRights = viewProfileFishRights
	},
	setViewTopMeta (state, viewTopMeta) {
		state.viewTopMeta = viewTopMeta
	},
	setViewBottomMeta (state, viewBottomMeta) {
		state.viewBottomMeta = viewBottomMeta
	},
	setViewMiddleFishMeta (state, viewMiddleFishMeta) {
		state.viewMiddleFishMeta = viewMiddleFishMeta
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