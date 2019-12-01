export default {
	getThreeStillwaters (firstStillwater, secondStillwater,thirdStillwater) {
		return new Promise((resolve, reject) =>{
			axios.get( `/threeStillwaters/${firstStillwater}/${secondStillwater}/${thirdStillwater}`).then((response) =>{
				resolve(response)
			})
		})
	},

	getThreeStillwaterLures (firstStillwaterLure, secondStillwaterLure,thirdStillwaterLure) {
		return new Promise((resolve, reject) =>{
			axios.get( `/threeStillwaterLures/${firstStillwaterLure}/${secondStillwaterLure}/${thirdStillwaterLure}`).then((response) =>{
				resolve(response)
			})
		})
	},

	getThreeRivers (firstRiver, secondRiver,thirdRiver) {
		return new Promise((resolve, reject) =>{
			axios.get( `/threeRivers/${firstRiver}/${secondRiver}/${thirdRiver}`).then((response) =>{
				resolve(response)
			})
		})
	},

	getThreeRiverLures (firstRiverLure, secondRiverLure,thirdRiverLure) {
		return new Promise((resolve, reject) =>{
			axios.get( `/threeRiverLures/${firstRiverLure}/${secondRiverLure}/${thirdRiverLure}`).then((response) =>{
				resolve(response)
			})
		})
	},

	getThreeCanals (firstCanal, secondCanal,thirdCanal) {
		return new Promise((resolve, reject) =>{
			axios.get( `/threeCanals/${firstCanal}/${secondCanal}/${thirdCanal}`).then((response) =>{
				resolve(response)
			})
		})
	},

	getThreeCanalLures (firstCanalLure, secondCanalLure,thirdCanalLure) {
		return new Promise((resolve, reject) =>{
			axios.get( `/threeCanalLures/${firstCanalLure}/${secondCanalLure}/${thirdCanalLure}`).then((response) =>{
				resolve(response)
			})
		})
	},

	getThreeSeaShores (firstSeaShore, secondSeaShore,thirdSeaShore) {
		return new Promise((resolve, reject) =>{
			axios.get( `/threeSeaShores/${firstSeaShore}/${secondSeaShore}/${thirdSeaShore}`).then((response) =>{
				resolve(response)
			})
		})
	},
	
	getThreeSeaBoats (firstSeaBoat, secondSeaBoat,thirdSeaBoat) {
		return new Promise((resolve, reject) =>{
			axios.get( `/threeSeaBoats/${firstSeaBoat}/${secondSeaBoat}/${thirdSeaBoat}`).then((response) =>{
				resolve(response)
			})
		})
	}
}