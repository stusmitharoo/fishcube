export default {
	getViewDistricts (id, page) {
		return new Promise((resolve, reject) =>{
			axios.get(`/profileView/districts/${id}?page=` + page)
			.then((response) =>{
				resolve(response)
			})
		})
	},

	getViewFishes(profileDistrict, style,id, page){
  		return new Promise((resolve,reject)=>{
    		axios.get(`/profileView/fish/${profileDistrict}/${style}/${id}?page=${page}`)
    		.then(response=>{
      			resolve(response)
    		})
  		})
	},

	getViewProfileCards (payload, page) {
		return new Promise((resolve, reject) =>{
			axios.get(`/profileView/card/${payload.id}/${payload.profileDistrict}/${payload.profileFish}/${payload.style}?page=` + page)
			.then((response) =>{
				resolve(response)
			})
		})
	}
}