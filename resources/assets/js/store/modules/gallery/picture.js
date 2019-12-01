import api from '../../api/gallery'

const state = {
	galleryPictures: [],
	galleryPictureLefts: [],
	galleryPictureRights: [],
	pictureLeftMeta: [],
	pictureMiddleMeta: [],
	pictureRightMeta: [],
}

const getters = {
	allGalleryPictures: state => {
		return state.galleryPictures
	},
	allGalleryPictureLefts: state => {
		return state.galleryPictureLefts
	},
	allGalleryPictureRights: state => {
		return state.galleryPictureRights
	},
	allPictureLeftMeta: state => {
		return state.pictureLeftMeta
	},
	allPictureMiddleMeta: state => {
		return state.pictureMiddleMeta
	},
	allPictureRightMeta: state => {
		return state.pictureRightMeta
	}
}

const actions = {
	getGalleryPictures ({dispatch, commit, rootState}, payload) {
		api.getGalleryPictures(payload.header, payload.page).then((response) => {
			commit('setGalleryPictures', response.data.data)
			commit('setPictureLeftMeta', response.data.meta)
		})
	},

	getGalleryPictureLefts ({dispatch, commit, rootState}, payload) {
		api.getGalleryPictures(payload.header, payload.page).then((response) => {
			commit('setGalleryPictureLefts', response.data.data)
			commit('setPictureMiddleMeta', response.data.meta)
		})
	},

	getGalleryPictureRights ({dispatch, commit, rootState}, payload) {
		api.getGalleryPictures(payload.header, payload.page).then((response) => {
			commit('setGalleryPictureRights', response.data.data)
			commit('setPictureRightMeta', response.data.meta)
		})
	},

	getNextGalleryPicture({commit, state, rootState}, payload){
			api.getGalleryPictures(payload.header, payload.page+1).then((response) => {
			commit('setGalleryPictureLefts', state.galleryPictures)
			commit('setGalleryPictures', state.galleryPictureRights)
			commit('setGalleryPictureRights', response.data.data)
			commit('setPictureLeftMeta', state.pictureMiddleMeta)
			commit('setPictureMiddleMeta', state.pictureRightMeta)
			commit('setPictureRightMeta', response.data.meta)
		})
	},

	getPreviousGalleryPicture({commit, state, rootState}, payload){
			api.getGalleryPictures(payload.header, payload.page-1).then((response) => {
			commit('setGalleryPictureRights', state.galleryPictures)
			commit('setGalleryPictures', state.galleryPictureLefts)
			commit('setGalleryPictureLefts', response.data.data)
			commit('setPictureRightMeta', state.pictureMiddleMeta)
			commit('setPictureMiddleMeta', state.pictureLeftMeta)
			commit('setPictureLeftMeta', response.data.meta)
		})
	}
}

const mutations = {
	setGalleryPictures (state, galleryPictures) {
		state.galleryPictures = galleryPictures
	},
	setGalleryPictureLefts (state, galleryPictureLefts) {
		state.galleryPictureLefts = galleryPictureLefts
	},
	setGalleryPictureRights (state, galleryPictureRights) {
		state.galleryPictureRights = galleryPictureRights
	},
	setPictureLeftMeta (state, pictureLeftMeta) {
		state.pictureLeftMeta = pictureLeftMeta
	},
	setPictureMiddleMeta (state, pictureMiddleMeta) {
		state.pictureMiddleMeta = pictureMiddleMeta
	},
	setPictureRightMeta (state, pictureRightMeta) {
		state.pictureRightMeta = pictureRightMeta
	}
}


export default {
	state,
	getters,
	mutations,
	actions
}