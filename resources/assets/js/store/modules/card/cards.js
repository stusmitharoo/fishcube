import api from '../../api/cards'
import fishApi from '../../api/fish'
import distApi from '../../api/threedistricts'
import districtStillwater from '../district/districtStillwater'
import coarseFish from '../fish/coarseFish'


const state = {
	cards: [],
	waterCardLefts: [],
	waterCardRights: [],
	waterCardTops: [],
	waterCardBottoms: [],
	cardMeta: [],
}

const getters = {
	allCards: state => {
		return state.cards
	},
	allWaterCardLefts: state => {
		return state.waterCardLefts
	},
	allWaterCardRights: state => {
		return state.waterCardRights
	},
	allWaterCardTops: state => {
		return state.waterCardTops
	},
	allWaterCardBottoms: state => {
		return state.waterCardBottoms
	},
	 allCardMeta: state => {
	 	return state.cardMeta
	 }	
}

const actions = {
	
	getCards ({dispatch, commit, rootState},  { payload, page }){
		api.getCards(payload.fish, payload.district, payload.style, page).then((response) => {
			commit('setCards', response.data.data)
			commit('setCardMeta', response.data.meta)
		})
	},
	getWaterCardLefts ({dispatch, commit, rootState},  { payload, page }){
		api.getCards(payload.fish, payload.district, payload.style, page).then((response) => {
			commit('setWaterCardLefts', response.data.data)
		})
	},
	getWaterCardRights ({dispatch, commit, rootState},  { payload, page }){
		api.getCards(payload.fish, payload.district, payload.style, page).then((response) => {
			commit('setWaterCardRights', response.data.data)
		})
	},
	getWaterCardTops ({dispatch, commit, rootState},  { payload, page }){
		api.getCards(payload.fish, payload.district, payload.style, page).then((response) => {
			commit('setWaterCardTops', response.data.data)
		})
	},
	getWaterCardBottoms ({dispatch, commit, rootState},  { payload, page }){
		api.getCards(payload.fish, payload.district, payload.style, page).then((response) => {
			commit('setWaterCardBottoms', response.data.data)
		})
	},

}

const mutations = {
	setCards (state, cards) {
		state.cards = cards
	},
	setWaterCardLefts (state, waterCardLefts) {
		state.waterCardLefts = waterCardLefts
	},
	setWaterCardRights (state, waterCardRights) {
		state.waterCardRights = waterCardRights
	},
	setWaterCardTops (state,waterCardTops) {
		state.waterCardTops = waterCardTops
	},
	setWaterCardBottoms (state, waterCardBottoms) {
		state.waterCardBottoms = waterCardBottoms
	},
	 setCardMeta (state, cardMeta) {
	 	state.cardMeta = cardMeta
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