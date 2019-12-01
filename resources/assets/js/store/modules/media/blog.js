import api from '../../api/blog'


const state = {
	userBlogs: [],
	blogMeta: [],
	blogCardMeta: [],
	blogCards: [],
	blogLists: [],
	blogListMeta: [],
}

const getters = {
	allUserBlogs: state => {
		return state.userBlogs
	},
	allBlogLists: state => {
		return state.blogLists
	},
	allBlogMeta: state => {
		return state.blogMeta
	},
	allBlogCards: state => {
		return state.blogCards
	},
	allBlogCardMeta: state => {
		return state.blogCardMeta
	},
	allBlogListMeta: state => {
		return state.blogListMeta
	}
}

const actions = {
	getUserBlogs ({dispatch, commit}, {district,style, page}) {
		api.getUserBlogs(district,style,page).then((response) => {
			commit('setUserBlogs', response.data.data)
			commit('setBlogMeta', response.data.meta)
		})
	},

	getBlogLists ({dispatch, commit}, {district,style, page}) {
		api.getBlogLists(district,style,page).then((response) => {
			commit('setBlogLists', response.data.data)
			commit('setBlogListMeta', response.data.meta)
		})
	},

	getBlogCards ({dispatch, commit}, {user,blog, page}) {
		api.getBlogCards(user,blog,page).then((response) => {
			commit('setBlogCards', response.data.data)
			commit('setBlogCardMeta', response.data.meta)
		})
	},
	
	createBlog({dispatch, commit}, {style_id,district_id,title,excerpt,content}) {
		 return api.storeBlog( {
			style_id: style_id,
			district_id: district_id,
			title: title,
			excerpt: excerpt,
			content: content,
		}).then((response) => {
			return response
		})
	}
}

const mutations = {
	setUserBlogs (state, userBlogs) {
		state.userBlogs = userBlogs
	},
	setBlogLists (state, blogLists) {
		state.blogLists = blogLists
	},
	setBlogListMeta (state, blogListMeta) {
		state.blogListMeta = blogListMeta
	},
	setBlogCards (state, blogCards) {
		state.blogCards = blogCards
	},
	setBlogCardMeta (state, blogCardMeta) {
		state.blogCardMeta = blogCardMeta
	},
	setBlogMeta (state, blogMeta) {
		state.blogMeta = blogMeta
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