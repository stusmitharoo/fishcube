import api from '../../api/prey'


const state = {
}

const getters = {
}

const actions = {

	createAllPrey({dispatch, commit}, {style_id,district_id,report_date,
		hours,minutes,fish_id,lbs,ozs,fish_qty,predetor_qty,predetor_id}) {
		 return api.createAllPrey( {
			style_id: style_id,
			district_id: district_id,
			report_date: report_date,
			hours: hours,
			minutes: minutes,
			fish_id: fish_id,
			lbs: lbs,
			ozs: lbs,
			fish_qty: fish_qty,
			predetor_qty: predetor_qty,
			predetor_id: predetor_id,
		})
		 .then((response) => {
			return response
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