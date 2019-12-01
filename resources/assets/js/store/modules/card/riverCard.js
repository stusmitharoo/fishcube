import api from '../../api/cards'
import fishApi from '../../api/fish'
import distApi from '../../api/threedistricts'
import districtRiver from '../district/districtRiver'

const state = {
}

const getters = {
}

const actions = {

		getThreeRivers ({dispatch, commit, rootState}, payload){
		distApi.getThreeRivers(payload.firstRiver, payload.secondRiver, payload.thirdRiver).then((response) => {
			commit('setRiverPageLefts', [response.data.data[0]])
			commit('setRiverPages', [response.data.data[1]])
			commit('setRiverPageRights', [response.data.data[2]])
			
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
	districtRiver: districtRiver,
}

export default {
	state,
	getters,
	mutations,
	actions,
	modules
}