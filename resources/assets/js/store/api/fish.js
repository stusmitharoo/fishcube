export default {
	getCoarseFishs (page) {
		return new Promise((resolve, reject) =>{
			axios.get('/coarseFishs?page=' + page).then((response) =>{
				resolve(response)
			})
		})
	},
	getCoarseFish (coarseFish) {
		return new Promise((resolve, reject) =>{
			axios.get(`/coarseFish/${coarseFish}`).then((response) =>{
				resolve(response)
			})
		})
	},
	getSeaFishs (page) {
		return new Promise((resolve, reject) =>{
			axios.get('/seaFishs?page=' + page).then((response) =>{
				resolve(response)
			})
		})
	},
	getSeaFish (seaFish) {
		return new Promise((resolve, reject) =>{
			axios.get(`/seaFish/${seaFish}`).then((response) =>{
				resolve(response)
			})
		})
	},
	getThreeCoarseFishs (firstFish, secondFish, thirdFish) {
		return new Promise((resolve, reject) =>{
			axios.get( `/threeCoarseFishs/${firstFish}/${secondFish}/${thirdFish}`).then((response) =>{
				resolve(response)
			})
		})
	},
	getThreeSeaFishs (firstFish, secondFish, thirdFish) {
		return new Promise((resolve, reject) =>{
			axios.get( `/threeSeaFishs/${firstFish}/${secondFish}/${thirdFish}`).then((response) =>{
				resolve(response)
			})
		})
	}
}