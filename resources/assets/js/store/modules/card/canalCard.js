import api from '../../api/cards'
import fishApi from '../../api/fish'
import distApi from '../../api/threedistricts'
import districtCanal from '../district/districtCanal'

const state = {
}

const getters = {
}

const actions = {

		getThreeCanals ({dispatch, commit, rootState}, payload){
		distApi.getThreeCanals(payload.firstCanal, payload.secondCanal, payload.thirdCanal).then((response) => {
			commit('setCanalPageLefts', [response.data.data[0]])
			commit('setCanalPages', [response.data.data[1]])
			commit('setCanalPageRights', [response.data.data[2]])
			
			api.getCards(payload.coarseFish, response.data.data[1].id, payload.style, payload.page=1).then((response) => {
			commit('setCards', response.data.data)
			commit('setCardMeta', response.data.meta)
			})
			})
		}
}

const mutations = {
}

const modules = {
	districtCanal: districtCanal,
}

export default {
	state,
	getters,
	mutations,
	actions,
	modules
}