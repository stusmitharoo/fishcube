import api from '../../api/cards'
import fishApi from '../../api/fish'
import distApi from '../../api/threedistricts'
import districtSeaShore from '../district/districtSeaShore'

const state = {
}

const getters = {
	
}

const actions = {

	getThreeSeaFishs ({dispatch, commit, rootState}, payload){
		fishApi.getThreeSeaFishs(payload.firstFish, payload.secondFish, payload.thirdFish).then((response) => {
			commit('setSeaFishTops', [response.data.data[0]])
			commit('setSeaFishs', [response.data.data[1]])
			commit('setSeaFishBottoms', [response.data.data[2]])
			
			api.getCards(response.data.data[1].id, payload.district,payload.style, payload.page=1).then((response) => {
			commit('setCards', response.data.data)
			commit('setCardMeta', response.data.meta)
			})
			})
		},

		getThreeSeaShores ({dispatch, commit, rootState}, payload){
		distApi.getThreeSeaShores(payload.firstSeaShore, payload.secondSeaShore, payload.thirdSeaShore).then((response) => {
			commit('setSeaShorePageLefts', [response.data.data[0]])
			commit('setSeaShorePages', [response.data.data[1]])
			commit('setSeaShorePageRights', [response.data.data[2]])
			
			api.getCards(payload.seaFish, response.data.data[1].id,payload.style, payload.page=1).then((response) => {
			commit('setCards', response.data.data)
			commit('setCardMeta', response.data.meta)
			})
			})
		}
}

const mutations = {
}

const modules = {
	districtSeaShore: districtSeaShore,
}

export default {
	state,
	getters,
	mutations,
	actions,
	modules
}