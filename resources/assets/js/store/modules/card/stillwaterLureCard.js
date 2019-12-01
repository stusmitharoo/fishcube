import api from '../../api/cards'
import fishApi from '../../api/fish'
import distApi from '../../api/threedistricts'
import districtStillwaterLure from '../district/districtStillwaterLure'

const state = {
}

const getters = {
}

const actions = {

		getThreeStillwaterLures ({dispatch, commit, rootState}, payload){
		distApi.getThreeStillwaterLures(payload.firstStillwaterLure, payload.secondStillwaterLure, payload.thirdStillwaterLure).then((response) => {
			commit('setStillwaterLurePageLefts', [response.data.data[0]])
			commit('setStillwaterLurePages', [response.data.data[1]])
			commit('setStillwaterLurePageRights', [response.data.data[2]])
			
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
	districtStillwaterLure: districtStillwaterLure,
}

export default {
	state,
	getters,
	mutations,
	actions,
	modules
}