import api from '../../api/cards'
import fishApi from '../../api/fish'
import distApi from '../../api/threedistricts'
import districtStillwater from '../district/districtStillwater'
import coarseFish from '../fish/coarseFish'


const state = {
}

const getters = {
}

const actions = {

	getThreeCoarseFishs ({dispatch, commit, rootState}, payload){
		fishApi.getThreeCoarseFishs(payload.firstFish, payload.secondFish, payload.thirdFish).then((response) => {
			commit('setCoarseFishTops', [response.data.data[0]])
			commit('setCoarseFishs', [response.data.data[1]])
			commit('setCoarseFishBottoms', [response.data.data[2]])
			
			api.getCards(response.data.data[1].id, payload.district,payload.style, payload.page=1).then((response) => {
			commit('setCards', response.data.data)
			commit('setCardMeta', response.data.meta)
			})
			})
		},

		getThreeStillwaters ({dispatch, commit, rootState}, payload){
		distApi.getThreeStillwaters(payload.firstStillwater, payload.secondStillwater, payload.thirdStillwater).then((response) => {
			commit('setStillwaterPageLefts', [response.data.data[0]])
			commit('setStillwaterPages', [response.data.data[1]])
			commit('setStillwaterPageRights', [response.data.data[2]])
			
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
	districtStillwater: districtStillwater,
	coarseFish: coarseFish
}

export default {
	state,
	getters,
	mutations,
	actions,
	modules
}