import api from '../../api/video'


const state = {
	userVideos: [],
	videoMeta: [],
	videoCardMeta: [],
	videoCards: [],
	videoLists: [],
	videoListMeta: [],
}

const getters = {
	allUserVideos: state => {
		return state.userVideos
	},
	allVideoLists: state => {
		return state.videoLists
	},
	allVideoMeta: state => {
		return state.videoMeta
	},
	allVideoListMeta: state => {
		return state.videoListMeta
	},
	allVideoCards: state => {
		return state.videoCards
	},
	allVideoCardMeta: state => {
		return state.videoCardMeta
	}
}

const actions = {
	getUserVideos ({dispatch, commit}, {district,style, page}) {
		api.getUserVideos(district,style,page).then((response) => {
			commit('setUserVideos', response.data.data)
			commit('setVideoMeta', response.data.meta)
		})
	},
	getVideoList ({dispatch, commit}, {style,district, page}) {
		api.getVideoList(style,district,page).then((response) => {
			commit('setVideoLists', response.data.data)
			commit('setVideoListMeta', response.data.meta)
		})
	},

	getVideoCards ({dispatch, commit}, {user,video, page}) {
		api.getVideoCards(user,video,page).then((response) => {
			commit('setVideoCards', response.data.data)
			commit('setVideoCardMeta', response.data.meta)
		})
	},
	
	createVideo({dispatch, commit}, {style_id,district_id,title,description,extension}) {
		 return api.storeVideo( {
			style_id: style_id,
			district_id: district_id,
			title: title,
			description: description,
			extension: extension,
		}).then((response) => {
			return response
		})
	}
}

const mutations = {
	setUserVideos (state, userVideos) {
		state.userVideos = userVideos
	},
	setVideoLists (state, videoLists) {
		state.videoLists = videoLists
	},
	setVideoListMeta (state, videoListMeta) {
		state.videoListMeta = videoListMeta
	},
	setVideoMeta (state, videoMeta) {
		state.videoMeta = videoMeta
	},
	setVideoCards (state, videoCards) {
		state.videoCards = videoCards
	},
	setVideoCardMeta (state, videoCardMeta) {
		state.videoCardMeta = videoCardMeta
	}
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