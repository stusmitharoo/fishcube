export default {
	getStyles (page) {
		return new Promise((resolve, reject) =>{
			axios.get(`/styles?page=${page}`)
			.then((response) =>{
				resolve(response)
			})
		})
	},

	getDistricts (page) {
		return new Promise((resolve, reject) =>{
			axios.get(`/profileDistricts?page=${page}`)
			.then((response) =>{
				resolve(response)
			})
		})
	},

	getFishes(profileDistrict,style,page){
  		return new Promise((resolve,reject)=>{
    		axios.get(`/profileFishes/${profileDistrict}/${style}?page=${page}`)
    		.then(response=>{
      			resolve(response)
    		})
  		})
	},

	getProfileCards (profileDistrict,profileFish,style,page) {
		return new Promise((resolve, reject) =>{
			axios.get(`/profileCards/${profileDistrict}/${profileFish}/${style}?page=` + page)
			.then((response) =>{
				resolve(response)
			})
		})
	}
}