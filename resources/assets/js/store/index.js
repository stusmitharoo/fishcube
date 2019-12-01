import Vue from 'vue'
import Vuex from 'vuex'
import stillwaterCard from './modules/card/stillwaterCard'
import stillwaterLureCard from './modules/card/stillwaterLureCard'
import riverCard from './modules/card/riverCard'
import riverLureCard from './modules/card/riverLureCard'
import canalCard from './modules/card/canalCard'
import canalLureCard from './modules/card/canalLureCard'
import seaShoreCard from './modules/card/seaShoreCard'
import seaBoatCard from './modules/card/seaBoatCard'
import create from './modules/forms/create'
import profileCard from './modules/profile/profileCard'
import selector from './modules/forms/selector'
import form from './modules/gallery/form'
import header from './modules/gallery/header'
import picture from './modules/gallery/picture'
import order from './modules/order/order'
import viewProfileCard from './modules/viewProfile/viewProfileCard'
import fish from './modules/fish/fish'
import blog from './modules/media/blog'
import cards from './modules/card/cards'
import video from './modules/media/video'
import prey from './modules/prey/prey'


Vue.use(Vuex)

export default new Vuex.Store({
	modules: {
		stillwaterCard,
		stillwaterLureCard,
		riverCard,
		riverLureCard,
		canalCard,
		canalLureCard,
		seaBoatCard,
		seaShoreCard,
		create,
		profileCard,
		selector,
		form,
		header,
		picture,
		order,
		viewProfileCard,
		fish,
		blog,
		cards,
		video,
		prey,
	}

})