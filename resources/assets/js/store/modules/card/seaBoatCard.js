import api from '../../api/cards'
import fishApi from '../../api/fish'
import distApi from '../../api/threedistricts'
import districtSeaBoat from '../district/districtSeaBoat'
import seaFish from '../fish/seaFish'

const state = {
}

const getters = {
}

const actions = {

		getThreeSeaBoats ({dispatch, commit, rootState}, payload){
		distApi.getThreeSeaBoats(payload.firstSeaBoat, payload.secondSeaBoat, payload.thirdSeaBoat).then((response) => {
			commit('setSeaBoatPageLefts', [response.data.data[0]])
			commit('setSeaBoatPages', [response.data.data[1]])
			commit('setSeaBoatPageRights', [response.data.data[2]])
			
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
	districtSeaBoat: districtSeaBoat,
	seaFish: seaFish
}

export default {
	state,
	getters,
	mutations,
	actions,
	modules
}