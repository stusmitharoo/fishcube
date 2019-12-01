export default {
	storeSelectDistrict({district_id, name, image, style_id}) {
		return new Promise((resolve, reject) => {
			axios.post('/selectDistricts', {
				style_id: style_id,
		 		district_id: district_id,
		 		name: name,
		 		image: image,
			}).then((response) => {
				resolve(response)
			}).catch(function (error) {
				reject(error);
  			})
		})
	},
	storeSelectFish({district_id, profile_district_id, style_id, fish_id, name, image}) {
		return new Promise((resolve, reject) => {
			axios.post('/selectFishes', {
				district_id: district_id,
				profile_district_id: profile_district_id,
				style_id: style_id,
				fish_id: fish_id,
				name: name,
				image: image,
			}).then((response) => {
				resolve(response)
			})
		})
	},
	getSelectorDistricts(style){
  		return new Promise((resolve,reject)=>{
    		axios.get(`/selectorDistricts/${style}`)
    		.then(response=>{
      			resolve(response)
    		})
  		})
	},
	getSelectorFishs(profileDistrict, style){
  		return new Promise((resolve,reject)=>{
    		axios.get(`/selectCreateFishes/${profileDistrict}/${style}`)
    		.then(response=>{
      			resolve(response)
    		})
  		})
	}
}