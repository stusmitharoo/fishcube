import api from '../../api/gallery'


const state = {
	galleryCards: [],
	scenaryImages: [],
	locationFishs: [],
	arrayLocationFishs: [],
	arrayCards: [],
}

const getters = {
	allLocationFishs: state => {
		return state.locationFishs
	},
	allArrayLocationFishs: state => {
		return state.arrayLocationFishs
	},
	allGalleryCards: state => {
		return state.galleryCards
	},
	allArrayCards: state => {
		return state.arrayCards
	},
	allScenaryImages: state => {
		return state.scenaryImages
	}
}

const actions = {
	createHeader({dispatch, commit}, {name,style_id,district_id,date,image}) {
		 return api.createHeader( {
			name: name,
			style_id: style_id,
			district_id: district_id,
			date: date,
			image:image,
		})
		 .then((response) => {
			return response
		})
	},

	createAllGallery({dispatch, commit}, {gallery_header_id,order_no,date,name,image}) {
		 return api.createAllGallery( {
			gallery_header_id: gallery_header_id,
			order_no: order_no,
			date: date,
			name: name,
			image: image,
		})
		 .then((response) => {
			return response
		})
	},

	createScenary({dispatch, commit}, {style_id,capture_date,display_description}) {
		 return api.storeScenary( {
			style_id: style_id,
			capture_date: capture_date,
			display_description: display_description,
		})
		 .then((response) => {
			return response
		})
	},

	addScenaryImage({dispatch, commit}, {id, image}) {
		return api.storeScenaryImage({
			id: id,
			image: image
		})
	},

	getLocationFishs ({dispatch, commit, rootState}, payload){
		api.getLocationFishs(payload.district,payload.style).then((response) => {
			commit('setLocationFishs', response.data.data)
		})
	},

	getArrayLocationFishs ({dispatch, commit, rootState}, payload){
	api.getLocationFishs(payload.district,payload.style).then((response) => {
		commit('setArrayLocationFishs', response.data.data)
		})
	},

	getGalleryCards ({dispatch, commit, rootState}, payload){
		api.getGalleryCards(payload.district,payload.style).then((response) => {
			commit('setGalleryCards', response.data.data)
		})
	},

	getArrayCards ({dispatch, commit, rootState}, payload){
		api.getGalleryCards(payload.district,payload.style,payload.fish).then((response) => {
			commit('setArrayCards', response.data.data)
		})
	},
	
	getScenaryImages ({dispatch, commit}, payload){
	api.getScenaryImages(payload.style).then((response) => {
		commit('setScenaryImages', response.data.data)
		})
	}
}

const mutations = {
	setLocationFishs (state, locationFishs) {
		state.locationFishs = locationFishs
	},
	setArrayLocationFishs (state, arrayLocationFishs) {
		state.arrayLocationFishs = arrayLocationFishs
	},
	setGalleryCards (state, galleryCards) {
		state.galleryCards = galleryCards
	},
	setArrayCards (state,arrayCards) {
		state.arrayCards = arrayCards
	},
	setScenaryImages (state, scenaryImages) {
		state.scenaryImages = scenaryImages
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