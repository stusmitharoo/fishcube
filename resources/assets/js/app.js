
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');


/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */



//worldmap
Vue.component('worldmap', require('./components/worldmap/Worldmap.vue'));

//reports
Vue.component('report', require('./components/report/Report.vue'));

//friendslist
Vue.component('friendslist', require('./components/friendsList/FriendsList.vue'));

//video
Vue.component('videoconstructor', require('./components/video/VideoConstructor.vue'));
Vue.component('listvideos', require('./components/video/ListVideo.vue'));
Vue.component('videoedit', require('./components/video/VideoEdit.vue'));
Vue.component('videoplayer', require('./components/video/VideoPlayer.vue'));
Vue.component('listviewvideos', require('./components/video/ListViewVideos.vue'));

//blog
Vue.component('blogconstructor', require('./components/blog/BlogConstructor.vue'));
Vue.component('listblogs', require('./components/blog/ListBlogs.vue'));
Vue.component('blogedit', require('./components/blog/BlogEdit.vue'));
Vue.component('list-view-blogs', require('./components/blog/ListViewBlogs.vue'));
Vue.component('tiny-mce', require('./components/blog/TinyMce.vue'));


//viewprofile
Vue.component('viewprofile', require('./components/viewProfile/ViewProfile.vue'));
	//cards
	Vue.component('viewprofilecards', require('./components/viewProfile/cards/ViewProfileCards.vue'));
	Vue.component('viewprofilecardlefts', require('./components/viewProfile/cards/ViewProfileCardLefts.vue'));
	Vue.component('viewprofilecardtops', require('./components/viewProfile/cards/ViewProfileCardTops.vue'));
	Vue.component('viewprofilecardbottoms', require('./components/viewProfile/cards/ViewProfileCardBottoms.vue'));
	Vue.component('viewprofilecardrights', require('./components/viewProfile/cards/ViewProfileCardRights.vue'));
Vue.component('viewprofilecoarsebottom', require('./components/viewProfile/ViewProfileCoarseBottom.vue'));
Vue.component('viewprofilecoarsemiddle', require('./components/viewProfile/ViewProfileCoarseMiddle.vue'));
Vue.component('viewprofilecoarsetop', require('./components/viewProfile/ViewProfileCoarseTop.vue'));
Vue.component('viewprofileleft', require('./components/viewProfile/ViewProfileLeft.vue'));
Vue.component('viewprofilemiddle', require('./components/viewProfile/ViewProfileMiddle.vue'));
Vue.component('viewprofileright', require('./components/viewProfile/ViewProfileRight.vue'));


//order
Vue.component('orderdistrict', require('./components/order/OrderDistrict.vue'));
Vue.component('orderfish', require('./components/order/OrderFish.vue'));
Vue.component('draggablefish', require('./components/order/DraggableFish.vue'));
Vue.component('draggabledistrict', require('./components/order/DraggableDistrict.vue'));

//galleryView
Vue.component('collage', require('./components/gallery/galleryView/Collage.vue'));
Vue.component('flip', require('./components/gallery/galleryView/Flip.vue'));
Vue.component('gallery-list', require('./components/gallery/galleryView/GalleryList.vue'));
Vue.component('gallery-search-list', require('./components/gallery/GallerySearchList.vue'));

//gallery
Vue.component('galleryscenary', require('./components/gallery/GalleryScenary.vue'));
Vue.component('galleryedit', require('./components/gallery/galleryEdit/Edit.vue'));
Vue.component('galleryconstructor', require('./components/gallery/gallerySelector/GalleryConstructor.vue'));

//gallery card
Vue.component('gallerytop', require('./components/gallery/galleryCard/GalleryTop.vue'));
Vue.component('gallerybottom', require('./components/gallery/galleryCard/GalleryBottom.vue'));
Vue.component('galleryright', require('./components/gallery/galleryCard/GalleryRight.vue'));
Vue.component('galleryleft', require('./components/gallery/galleryCard/GalleryLeft.vue'));
Vue.component('gallerycard', require('./components/gallery/galleryCard/GalleryCard.vue'));

//general
Vue.component('modal', require('./components/general/Modal.vue'));
Vue.component('imageupload', require('./components/general/ImageUpload.vue'));
Vue.component('videomodal', require('./components/general/VideoModal.vue'));
Vue.component('mobmenu', require('./components/general/MobMenu.vue'));
Vue.component('pagination', require('./components/general/Pagination.vue'));
Vue.component('gallerymenu', require('./components/general/GalleryMenu.vue'));
Vue.component('videomenu', require('./components/general/VideoMenu.vue'));
Vue.component('blogmenu', require('./components/general/BlogMenu.vue'));
Vue.component('usermenu', require('./components/general/UserMenu.vue'));
Vue.component('profilemenu', require('./components/general/ProfileMenu.vue'));
Vue.component('datepicker', require('vuejs-datepicker'));
Vue.component('helpvideo', require('./components/general/HelpVideo.vue'));


//create
Vue.component('cardcreate', require('./components/create/CardCreate.vue'));


//water card
Vue.component('water', require('./components/waters/Water.vue'));
	//cards
	Vue.component('watercards', require('./components/waters/cards/WaterCards.vue'));
	Vue.component('watercardleft', require('./components/waters/cards/WaterCardLeft.vue'));
	Vue.component('watercardright', require('./components/waters/cards/WaterCardRight.vue'));
	Vue.component('watercardtop', require('./components/waters/cards/WaterCardTop.vue'));
	Vue.component('watercardbottom', require('./components/waters/cards/WaterCardBottom.vue'));
Vue.component('waterdistrictleft', require('./components/waters/WaterDistrictLeft.vue'));
Vue.component('waterdistrictmiddle', require('./components/waters/WaterDistrictMiddle.vue'));
Vue.component('waterdistrictright', require('./components/waters/WaterDistrictRight.vue'));

Vue.component('waterfishbottom', require('./components/waters/WaterFishBottom.vue'));
Vue.component('waterfishmiddle', require('./components/waters/WaterFishMiddle.vue'));
Vue.component('waterfishtop', require('./components/waters/WaterFishTop.vue'));
Vue.component('watermobsearch', require('./components/waters/WaterMobSearch.vue'));

//profile
Vue.component('profile', require('./components/profile/Profile.vue'));
 	//cards
	Vue.component('profilecardleft', require('./components/profile/card/ProfileCardLeft.vue'));
	Vue.component('profilecardright', require('./components/profile/card/ProfileCardRight.vue'));
	Vue.component('profilecardtop', require('./components/profile/card/ProfileCardTop.vue'));
	Vue.component('profilecardbottom', require('./components/profile/card/ProfileCardBottom.vue'));
	Vue.component('profilecards', require('./components/profile/card/ProfileCards.vue'));

Vue.component('profilecoarsetop', require('./components/profile/ProfileCoarseTop.vue'));
Vue.component('profilecoarsemiddle', require('./components/profile/ProfileCoarseMiddle.vue'));
Vue.component('profilecoarsebottom', require('./components/profile/ProfileCoarseBottom.vue'));

Vue.component('profileleft', require('./components/profile/ProfileLeft.vue'));
Vue.component('profilemiddle', require('./components/profile/ProfileMiddle.vue'));
Vue.component('profileright', require('./components/profile/ProfileRight.vue'));
Vue.component('profilecardedit', require('./components/profile/ProfileCardEdit.vue'));

//selector
Vue.component('districtselector', require('./components/selector/DistrictSelector.vue'));
Vue.component('fishselector', require('./components/selector/FishSelector.vue'));

import store from './store/index.js'

const app = new Vue({
    el: '#app',
    store,
},);
