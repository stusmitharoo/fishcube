export default {
	getGalleryCards(District,style,page){
  		return new Promise((resolve,reject)=>{
    		axios.get(`/galleryCards/${District}/${style}?page=${page}`)
    		.then(response=>{
      			resolve(response)
    		})
  		})
	},
  getLocationFishs(District,style,page){
      return new Promise((resolve,reject)=>{
        axios.get(`/galleryFishs/${District}/${style}?page=${page}`)
        .then(response=>{
            resolve(response)
        })
      })
  },
  getScenaryImages(style){
      return new Promise((resolve,reject)=>{
        axios.get(`/galleryScenaryImage/${style}`)
        .then(response=>{
            resolve(response)
        })
      })
  },
  getGalleryLists(style,district,page){ 
      return new Promise((resolve,reject)=>{
        axios.get(`/gallery/view/list/${style}/${district}?page=` + page)
        .then(response=>{
            resolve(response)
        })
      })
  },
    getHeaders (page) {
    return new Promise((resolve, reject) =>{
      axios.get('/galleryHeader?page=' + page)
      .then((response) =>{
        resolve(response)
      })
    })
  },
  getUserHeaders (style,district,page) {
    return new Promise((resolve, reject) =>{
      axios.get(`/userHeaders/${style}/${district}?page=` + page)
      .then((response) =>{
        resolve(response)
      })
    })
  },
  getGalleryPictures(header,page){
      return new Promise((resolve,reject)=>{
        axios.get(`/galleryPicture/${header}?page=${page}`)
        .then(response=>{
            resolve(response)
        })
      })
  },
  storeScenary({style_id,capture_date,display_description}) {
    return new Promise((resolve, reject) => {
      axios.post('/createScenary', {
      style_id: style_id,
      capture_date: capture_date,
      display_description: display_description,
      }).then((response) => {
        resolve(response)
      })
    })
  },
  storeScenaryImage({id, image}) {
    var form = new FormData();
    form.append('image', image);

    return axios({
      url: `/createScenaryImage/${id}`,
      method: 'post',
      data: form
    })
    .then((response) => {
    })
    .catch((error) => {
    })
  },

  createAllGallery({gallery_header_id,order_no,date,name,image}) {
    return new Promise((resolve, reject) => {
      axios.post('/createGallery', {
      gallery_header_id: gallery_header_id,
      sort_order: order_no,
      date: date,
      name: name,
      image: image,
      }).then((response) => {
        resolve(response)
      })
    })
  },

  createHeader({name,style_id,district_id,date,image}) {
    return new Promise((resolve, reject) => {
      axios.post('/createHeader', {
      name: name,
      style_id: style_id,
      district_id: district_id,
      date: date,
      image: image,
      }).then((response) => {
        resolve(response)
      })
    })
  }
}