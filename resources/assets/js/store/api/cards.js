export default {
	getCards (fish,district,style,page) {
    return new Promise((resolve, reject) =>{
      axios.get(`/cards/${fish}/${district}/${style}?page=` + page)
      .then((response) =>{
        resolve(response)
      })
    })
  }
}