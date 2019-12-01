import api from '../../api/profile'
import profileDistrict from '../profile/profileDistrict'
import profileFish from '../profile/profileFish'

const state = {
	profileCards: [],
	profileCardLefts: [],
	profileCardRights: [],
	profileCardTops: [],
	profileCardBottoms: [],
	profileCardMeta: [],
	styles: [],
}

const getters = {
	allStyles: state => {
		return state.styles
	},
	allProfileCards: state => {
		return state.profileCards
	},
	allProfileCardLefts: state => {
		return state.profileCardLefts
	},
	allProfileCardRights: state => {
		return state.profileCardRights
	},
	allProfileCardBottoms: state => {
		return state.profileCardBottoms
	},
	allProfileCardTops: state => {
		return state.profileCardTops
	},
	allProfileCardMeta: state => {
		return state.profileCardMeta
	}
}

const actions = {
	getStyles ({dispatch, commit, rootState}, page ){
		api.getStyles().then((response) => {
			commit('setStyles', response.data.data)
		})
	},

	getProfileCards ({dispatch, commit, rootState},  { payload, page }){
		api.getProfileCards(payload.profileDistrict, payload.profileFish, payload.style, page).then((response) => {
			commit('setProfileCards', response.data.data)
			commit('setProfileCardMeta', response.data.meta)
		})
	},

	getProfileCardLefts ({dispatch, commit, rootState},  { payload, page }){
		api.getProfileCards(payload.profileDistrict, payload.profileFish, payload.style, page).then((response) => {
			commit('setProfileCardLefts', response.data.data)
		})
	},

	getProfileCardRights ({dispatch, commit, rootState},  { payload, page }){
		api.getProfileCards(payload.profileDistrict, payload.profileFish, payload.style, page).then((response) => {
			commit('setProfileCardRights', response.data.data)
		})
	},

	getProfileCardTops ({dispatch, commit, rootState},  { payload, page }){
		api.getProfileCards(payload.profileDistrict, payload.profileFish, payload.style, page).then((response) => {
			commit('setProfileCardTops', response.data.data)
		})
	},

	getProfileCardBottoms ({dispatch, commit, rootState},  { payload, page }){
		api.getProfileCards(payload.profileDistrict, payload.profileFish, payload.style, page).then((response) => {
			commit('setProfileCardBottoms', response.data.data)
		})
	}
}

const mutations = {
	setStyles (state, styles) {
		state.styles = styles
	},
	setProfileCards (state, profileCards) {
		state.profileCards = profileCards
	},
	setProfileCardTops (state, profileCardTops) {
		state.profileCardTops = profileCardTops
	},
	setProfileCardBottoms (state, profileCardBottoms) {
		state.profileCardBottoms = profileCardBottoms
	},
	setProfileCardLefts (state, profileCardLefts) {
		state.profileCardLefts = profileCardLefts
	},
	setProfileCardRights (state, profileCardRights) {
		state.profileCardRights = profileCardRights
	},
	setProfileCardMeta (state, profileCardMeta) {
		state.profileCardMeta = profileCardMeta
	}
}

const modules = {
	profileDistrict: profileDistrict,
	profileFish: profileFish
}

export default {
	state,
	getters,
	mutations,
	actions,
	modules
}
