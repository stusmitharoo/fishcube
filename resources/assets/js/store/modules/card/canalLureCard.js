import api from '../../api/cards'
import fishApi from '../../api/fish'
import distApi from '../../api/threedistricts'
import districtCanalLure from '../district/districtCanalLure'

const state = {
}

const getters = {
}

const actions = {

		getThreeCanalLures ({dispatch, commit, rootState}, payload){
		distApi.getThreeCanalLures(payload.firstCanalLure, payload.secondCanalLure, payload.thirdCanalLure).then((response) => {
			commit('setCanalLurePageLefts', [response.data.data[0]])
			commit('setCanalLurePages', [response.data.data[1]])
			commit('setCanalLurePageRights', [response.data.data[2]])
			
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
	districtCanalLure: districtCanalLure,
}

export default {
	state,
	getters,
	mutations,
	actions,
	modules
}