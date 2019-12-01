export default {
	getUserVideos (district,style,page) {
	    return new Promise((resolve, reject) =>{
	      axios.get(`/userVideos/${style}/${district}?page=` + page).then((response) =>{
	        resolve(response)
	      })
	    })
	  },

	getVideoList (style,district,page) {
	    return new Promise((resolve, reject) =>{
	      axios.get(`/video/views/list/${style}/${district}?page=` + page).then((response) =>{
	        resolve(response)
	      })
	    })
	  },

	  getVideosCards (user,video,page) {
	    return new Promise((resolve, reject) =>{
	      axios.get(`/videoCards/${user}/${video}?page=` + page).then((response) =>{
	        resolve(response)
	      })
	    })
	  },

	storeVideo({style_id,district_id,title,description,extension}) {
		return new Promise((resolve, reject) => {
			axios.post('/createVideo', {
			style_id: style_id,
			district_id: district_id,
			title: title,
			description: description,
			extension: extension,
			}).then((response) => {
				resolve(response)
			})
		})
	}

}