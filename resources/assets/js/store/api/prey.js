export default {

  createAllPrey({style_id,district_id,report_date,
		hours,minutes,fish_id,lbs,ozs,fish_qty,predetor_qty,predetor_id}) {
    return new Promise((resolve, reject) => {
      axios.post('/report/store', {
			style_id: style_id,
			district_id: district_id,
			report_date: report_date,
			hours: hours,
			minutes: minutes,
			fish_id: fish_id,
			lbs: lbs,
			ozs: lbs,
			fish_qty: fish_qty,
			predetor_qty: predetor_qty,
			predetor_id: predetor_id,
      }).then((response) => {
      		return response
        resolve(response)
      })
    })
  },

}