export default {
	getOrderDistricts () {
		return new Promise((resolve, reject) =>{
			axios.get('/profileDistrict/order')
			.then((response) =>{
				resolve(response)
			})
		})
	},
	getOrderFishs(orderDistrict){
  		return new Promise((resolve,reject)=>{
    		axios.get(`/profileFishs/order/${orderDistrict}`)
    		.then(response=>{
      			resolve(response)
    		})
  		})
	}

}