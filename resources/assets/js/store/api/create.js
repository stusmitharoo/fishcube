export default {
	editCard({id,lbs,ozs,dr,capture_date,display_description,profile_description}) {
		return new Promise((resolve, reject) => {
			axios.patch(`/profileCards/update/${id}`, {
			id: id,	
			lbs: lbs,
			ozs: ozs,
			dr: dr,
			capture_date: capture_date,
			display_description: display_description,
			profile_description: profile_description,
			}).then((response) => {
				resolve(response)
			})
		})
	},
	
	storeCard({style_id,district_id,fish_id,lbs,ozs,dr,capture_date,display_description,profile_description}) {
		return new Promise((resolve, reject) => {
			axios.post('/createCard', {
			style_id: style_id,
			district_id: district_id,
			fish_id: fish_id,
			lbs: lbs,
			ozs: ozs,
			dr: dr,
			capture_date: capture_date,
			display_description: display_description,
			profile_description: profile_description,
			}).then((response) => {
				resolve(response)
			})
		})
	},

	storeCardImage({id, image}) {
		var form = new FormData();
		form.append('image', image);
		form.append('secondField', 'something!');

		return axios({
			url: `/createCardImage/${id}`,
			method: 'post',
			data: form
		})
		.then((response) => {
		})
		.catch((error) => {
		})
	},
	editCardImage({id, image}) {
		var form = new FormData();
		form.append('image', image);
		form.append('secondField', 'something!');

		return axios({
			url: `/profileImage/update/${id}`,
			method: 'patch',
			data: form
		})
		.then((response) => {
		})
		.catch((error) => {
		})
	}
}
