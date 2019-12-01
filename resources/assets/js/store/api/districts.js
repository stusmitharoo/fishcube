export default {
	getDistrictStillwaters (page) {
		return new Promise((resolve, reject) =>{
			axios.get('/districtStillwaters?page=' + page).then((response) =>{
				resolve(response)
			})
		})
	},
	getStillwater (districtStillwater) {
		return new Promise((resolve, reject) =>{
			axios.get(`/stillwater/${districtStillwater}`).then((response) =>{
				resolve(response)
			})
		})
	},
	getDistrictStillwaterLures (page) {
		return new Promise((resolve, reject) =>{
			axios.get('/districtStillwaterLures?page=' + page).then((response) =>{
				resolve(response)
			})
		})
	},
	getStillwaterLure (districtStillwaterLure) {
		return new Promise((resolve, reject) =>{
			axios.get(`/stillwaterLure/${districtStillwaterLure}`).then((response) =>{
				resolve(response)
			})
		})
	},
	getDistrictRivers (page) {
		return new Promise((resolve, reject) =>{
			axios.get('/districtRivers?page=' + page).then((response) =>{
				resolve(response)
			})
		})
	},
	getRiver (districtRiver) {
		return new Promise((resolve, reject) =>{
			axios.get(`/river/${districtRiver}`).then((response) =>{
				resolve(response)
			})
		})
	},
	getDistrictRiverLures (page) {
		return new Promise((resolve, reject) =>{
			axios.get('/districtRiverLures?page=' + page).then((response) =>{
				resolve(response)
			})
		})
	},
	getRiverLure (districtRiverLure) {
		return new Promise((resolve, reject) =>{
			axios.get(`/riverLure/${districtRiverLure}`).then((response) =>{
				resolve(response)
			})
		})
	},
	getDistrictCanals (page) {
		return new Promise((resolve, reject) =>{
			axios.get('/districtCanals?page=' + page).then((response) =>{
				resolve(response)
			})
		})
	},
	getCanal (districtCanal) {
		return new Promise((resolve, reject) =>{
			axios.get(`/canal/${districtCanal}`).then((response) =>{
				resolve(response)
			})
		})
	},
	getDistrictCanalLures (page) {
		return new Promise((resolve, reject) =>{
			axios.get('/districtCanalLures?page=' + page).then((response) =>{
				resolve(response)
			})
		})
	},
	getCanalLure (districtCanalLure) {
		return new Promise((resolve, reject) =>{
			axios.get(`/canalLure/${districtCanalLure}`).then((response) =>{
				resolve(response)
			})
		})
	},
	getDistrictSeaShores (page) {
		return new Promise((resolve, reject) =>{
			axios.get('/districtSeaShores?page=' + page).then((response) =>{
				resolve(response)
			})
		})
	},
	getSeaShore (districtSeaShore) {
		return new Promise((resolve, reject) =>{
			axios.get(`/seaShore/${districtSeaShore}`).then((response) =>{
				resolve(response)
			})
		})
	},
	getDistrictSeaBoats (page) {
		return new Promise((resolve, reject) =>{
			axios.get('/districtSeaBoats?page=' + page).then((response) =>{
				resolve(response)
			})
		})
	},
	getSeaBoat (districtSeaBoat) {
		return new Promise((resolve, reject) =>{
			axios.get(`/seaBoat/${districtSeaBoat}`).then((response) =>{
				resolve(response)
			})
		})
	},
		getStillwaterPages (page) {
		return new Promise((resolve, reject) =>{
			axios.get('/stillwaterPages?page=' + page).then((response) =>{
				resolve(response)
			})
		})
	},
	getStillwaterLurePages (page) {
		return new Promise((resolve, reject) =>{
			axios.get('/stillwaterLurePages?page=' + page).then((response) =>{
				resolve(response)
			})
		})
	},
	getRiverPages (page) {
		return new Promise((resolve, reject) =>{
			axios.get('/riverPages?page=' + page).then((response) =>{
				resolve(response)
			})
		})
	},
	getRiverLurePages (page) {
		return new Promise((resolve, reject) =>{
			axios.get('/riverLurePages?page=' + page).then((response) =>{
				resolve(response)
			})
		})
	},
	getCanalPages (page) {
		return new Promise((resolve, reject) =>{
			axios.get('/canalPages?page=' + page).then((response) =>{
				resolve(response)
			})
		})
	},
	getCanalLurePages (page) {
		return new Promise((resolve, reject) =>{
			axios.get('/canalLurePages?page=' + page).then((response) =>{
				resolve(response)
			})
		})
	},
	getSeaShorePages (page) {
		return new Promise((resolve, reject) =>{
			axios.get('/seaShorePages?page=' + page).then((response) =>{
				resolve(response)
			})
		})
	},
	getSeaBoatPages (page) {
		return new Promise((resolve, reject) =>{
			axios.get('/seaBoatPages?page=' + page).then((response) =>{
				resolve(response)
			})
		})
	}
}