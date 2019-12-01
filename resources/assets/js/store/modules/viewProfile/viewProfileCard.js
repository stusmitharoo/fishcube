import api from '../../api/viewProfile'
import viewProfileDistrict from '../viewProfile/viewProfileDistrict'
import viewProfileFish from '../viewProfile/viewProfileFish'

const state = {
	viewProfileCards: [],
	viewProfileCardLefts: [],
	viewProfileCardRights: [],
	viewProfileCardTops: [],
	viewProfileCardBottoms: [],
	viewProfileCardMeta: []
}

const getters = {
	allViewProfileCards: state => {
		return state.viewProfileCards
	},
	allViewProfileCardLefts: state => {
		return state.viewProfileCardLefts
	},
	allViewProfileCardRights: state => {
		return state.viewProfileCardRights
	},
	allViewProfileCardBottoms: state => {
		return state.viewProfileCardBottoms
	},
	allViewProfileCardTops: state => {
		return state.viewProfileCardTops
	},
	allViewProfileCardMeta: state => {
		return state.viewProfileCardMeta
	}
}

const actions = {
	getViewProfileCards ({dispatch, commit, rootState},  {payload, page }){
		api.getViewProfileCards(payload, page).then((response) => {
			commit('setViewProfileCards', response.data.data)
			commit('setViewProfileCardMeta', response.data.meta)
		})
	},

	getViewProfileCardLefts ({dispatch, commit, rootState},  { payload, page }){
		api.getViewProfileCards(payload, page).then((response) => {
			commit('setViewProfileCardLefts', response.data.data)
		})
	},

	getViewProfileCardRights ({dispatch, commit, rootState},  { payload, page }){
		api.getViewProfileCards(payload, page).then((response) => {
			commit('setViewProfileCardRights', response.data.data)
		})
	},

	getViewProfileCardTops ({dispatch, commit, rootState},  { payload, page }){
		api.getViewProfileCards(payload, page).then((response) => {
			commit('setViewProfileCardTops', response.data.data)
		})
	},

	getViewProfileCardBottoms ({dispatch, commit, rootState},  { payload, page }){
		api.getViewProfileCards(payload, page).then((response) => {
			commit('setViewProfileCardBottoms', response.data.data)
		})
	}
}

const mutations = {
	setViewProfileCards (state, viewProfileCards) {
		state.viewProfileCards = viewProfileCards
	},
	setViewProfileCardTops (state, viewProfileCardTops) {
		state.viewProfileCardTops = viewProfileCardTops
	},
	setViewProfileCardBottoms (state, viewProfileCardBottoms) {
		state.viewProfileCardBottoms = viewProfileCardBottoms
	},
	setViewProfileCardLefts (state, viewProfileCardLefts) {
		state.viewProfileCardLefts = viewProfileCardLefts
	},
	setViewProfileCardRights (state, viewProfileCardRights) {
		state.viewProfileCardRights = viewProfileCardRights
	},
	setViewProfileCardMeta (state, viewProfileCardMeta) {
		state.viewProfileCardMeta = viewProfileCardMeta
	}
}

const modules = {
	viewProfileDistrict: viewProfileDistrict,
	viewProfileFish: viewProfileFish
}

export default {
	state,
	getters,
	mutations,
	actions,
	modules
}
