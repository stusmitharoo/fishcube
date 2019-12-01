import api from '../../api/create'


const state = {
}

const getters = {
}

const actions = {
	editCard({dispatch, commit}, {id,lbs,ozs,dr,capture_date,display_description,profile_description}) {
		 return api.editCard( {
		 	id: id,
			lbs: lbs,
			ozs: ozs,
			dr: dr,
			capture_date: capture_date,
			display_description: display_description,
			profile_description: profile_description,
		}).then((response) => {
			return response
		})
	},

	createCard({dispatch, commit}, {style_id,district_id,fish_id,lbs,ozs,dr,capture_date,display_description,profile_description}) {
		 return api.storeCard( {
			style_id: style_id,
			district_id: district_id,
			fish_id: fish_id,
			lbs: lbs,
			ozs: ozs,
			dr: dr,
			capture_date: capture_date,
			display_description: display_description,
			profile_description: profile_description,
		}).then((response) => {
			return response
		})
	},

	addCardImage({dispatch, commit}, {id, image}) {
		return api.storeCardImage({
			id: id,
			image: image
		})
	},
	
	editCardImage({dispatch, commit}, {id, image}) {
		return api.storeCardImage({
			id: id,
			image: image
		})
	}
}

const mutations = {
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
