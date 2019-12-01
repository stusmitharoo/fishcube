import api from '../../api/cards'
import fishApi from '../../api/fish'
import distApi from '../../api/threedistricts'
import districtRiverLure from '../district/districtRiverLure'

const state = {
}

const getters = {
}

const actions = {

		getThreeRiverLures ({dispatch, commit, rootState}, payload){
		distApi.getThreeRiverLures(payload.firstRiverLure, payload.secondRiverLure, payload.thirdRiverLure).then((response) => {
			commit('setRiverLurePageLefts', [response.data.data[0]])
			commit('setRiverLurePages', [response.data.data[1]])
			commit('setRiverLurePageRights', [response.data.data[2]])
			
			api.getCards(payload.coarseFish, response.data.data[1].id,payload.style, payload.page=1).then((response) => {
			commit('setCards', response.data.data)
			commit('setCardMeta', response.data.meta)
			})
			})
		}
}

const mutations = {
}

const modules = {
	districtRiverLure: districtRiverLure,
}

export default {
	state,
	getters,
	mutations,
	actions,
	modules
}