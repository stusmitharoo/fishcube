import api from '../../api/gallery'

const state = {
	headers: [],
	headerTops: [],
	headerBottoms: [],
	userHeaders:[],
	userMeta: [],
	galleryLists: [],
	galleryMeta: [],
}

const getters = {
	allUserHeaders: state => {
		return state.userHeaders
	},
	allGalleryLists: state => {
		return state.galleryLists
	},
	allUserMeta: state => {
		return state.userMeta
	},
	allGalleryMeta: state => {
		return state.galleryMeta
	},
	allHeaders: state => {
		return state.headers
	},
	allHeaderTops: state => {
		return state.headerTops
	},
	allHeaderBottoms: state => {
		return state.headerBottoms
	}
}

const actions = {
	getGalleryLists ({dispatch, commit}, {style,district,page}) {
		api.getGalleryLists(style,district,page).then((response) => {
			commit('setGalleryLists', response.data.data)
			commit('setGalleryMeta', response.data.meta)
		})
	},

	getUserHeaders ({dispatch, commit}, {style,district,page}) {
		api.getUserHeaders(style,district,page).then((response) => {
			commit('setUserHeaders', response.data.data)
			commit('setUserMeta', response.data.meta)
		})
	},

	getHeaders ({dispatch, commit}, page) {
		api.getHeaders(2).then((response) => {
			commit('setHeaders', response.data.data)
		})
	},

	getHeaderTops ({dispatch, commit}, page) {
		api.getHeaders(1).then((response) => {
			commit('setHeaderTops', response.data.data)
		})
	},

	getHeaderBottoms ({dispatch, commit}, page) {
		api.getHeaders(3).then((response) => {
			commit('setHeaderBottoms', response.data.data)
		})
	},

	getNextHeader({commit, state}, page){
			api.getHeaders(page+1).then((response) => {
			commit('setHeaderTops', state.headers)
			commit('setHeaders', state.headerBottoms)
			commit('setHeaderBottoms', response.data.data)
		})
	},
	
	getPreviousHeader({commit, state}, page){
		const nextPage = page-1
			api.getHeaders(nextPage).then((response) => {
			commit('setHeaderBottoms', state.headers)
			commit('setHeaders', state.headerTops)
			commit('setHeaderTops', response.data.data)
		})
	}
}

const mutations = {
	setGalleryLists (state, galleryLists) {
		state.galleryLists = galleryLists
	},
	setUserHeaders (state, userHeaders) {
		state.userHeaders = userHeaders
	},
	setUserMeta (state, userMeta) {
		state.userMeta = userMeta
	},
	setGalleryMeta (state, galleryMeta) {
		state.galleryMeta = galleryMeta
	},
	setHeaders (state, headers) {
		state.headers = headers
	},
	setHeaderTops (state, headerTops) {
		state.headerTops = headerTops
	},
	setHeaderBottoms (state, headerBottoms) {
		state.headerBottoms = headerBottoms
	}
}


export default {
	state,
	getters,
	mutations,
	actions
}