export default {
	getUserBlogs (district,style,page) {
	    return new Promise((resolve, reject) =>{
	      axios.get(`/userBlogs/${style}/${district}?page=` + page).then((response) =>{
	        resolve(response)
	      })
	    })
	  },

	getBlogLists (district,style,page) {
	    return new Promise((resolve, reject) =>{
	      axios.get(`/blog/view/list/${style}/${district}?page=` + page).then((response) =>{
	        resolve(response)
	      })
	    })
	  },

	  getBlogCards (user,blog,page) {
	    return new Promise((resolve, reject) =>{
	      axios.get(`/blogCards/${user}/${blog}?page=` + page).then((response) =>{
	        resolve(response)
	      })
	    })
	  },

	storeBlog({style_id,district_id,title,excerpt,content}) {
		return new Promise((resolve, reject) => {
			axios.post('/createBlog', {
			style_id: style_id,
			district_id: district_id,
			title: title,
			excerpt: excerpt,
			content: content,
			}).then((response) => {
				resolve(response)
			})
		})
	}
}