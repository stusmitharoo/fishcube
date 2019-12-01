<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

if (env('ENVIRONMENT','production')=='production') {
    URL::forceScheme('https');
}

Route::get('/', function () {
    return view('welcome');
});
Route::get('/worldmap', function () {
    return view('worldmap');
});

Auth::routes();

//catch reports
Route::get('/report', 'Report\ReportController@choice')->name('report.choice');
Route::get('/report/index/{style}', 'Report\ReportController@index')->name('report.index');
Route::post('/report/store', 'Report\ReportController@store')->name('report.store');

//video view
Route::post('/video/views/{video}', 'Video\VideoViewController@create')->name('video.views');
Route::get('/video/views/choice', 'Video\VideoViewController@choice')->name('video.views.choice');
Route::get('/video/views/index/{style}', 'Video\VideoViewController@index')->name('video.views.index');
Route::get('/video/views/show/{video}', 'Video\VideoViewController@show')->name('video.views.show');
Route::get('/video/views/list/{style}/{district}', 'Video\VideoViewController@list')->name('video.views.list');

//blog view
Route::get('/blog/view/choice', 'Blog\BlogViewController@viewChoice')->name('blog.view.choice');
Route::get('/blog/view/index/{style}', 'Blog\BlogViewController@index')->name('blog.view.index');
Route::get('/blog/view/show/{blog}', 'Blog\BlogViewController@show')->name('blog.view.show');
Route::get('/blog/view/list/{style}/{district}', 'Blog\BlogViewController@list')->name('blog.view.list');
Route::get('/blogCards/{user}/{blog}', 'Blog\BlogViewController@cards')->name('blog.view.cards');

//gallery view
Route::get('/gallery/view/choice', 'Gallery\GalleryViewController@choice')->name('gallery.view.choice');
Route::get('/gallery/view/index/{style}', 'Gallery\GalleryViewController@viewIndex')->name('gallery.view.index');
Route::get('/gallery/view/list/{style}/{district}', 'Gallery\GalleryViewController@list')->name('gallery.view.list');
Route::get('/gallery/view/show/{galleryHeader}', 'Gallery\GalleryViewController@show')->name('gallery.view.show');
Route::get('/gallery/collage/show/{galleryHeader}', 'Gallery\GalleryViewController@collageShow')->name('gallery.collage.show');

//facebook share
Route::get('/share/card/{card}', 'Share\ShareController@card')->name('share.card');

//profileview
Route::get('/profileView/{card}', 'Profile\ProfileViewController@index')->name('profileView.index');
Route::get('/profileView/districts/{id}', 'Profile\ProfileViewController@districts')->name('profileView.districts');
Route::get('/profileView/fish/{profileDistrict}/{style}/{id}', 'Profile\ProfileViewController@fish')->name('profileView.fish');
Route::get('/profileView/card/{id}/{profileDistrict}/{profileFish}/{style}', 'Profile\ProfileViewController@card')->name('profileView.card');

Route::get('/styles', 'Profile\ProfileController@style')->name('styles.style');

//terms of use
Route::get('/terms', 'Terms\TermsController@terms')->name('terms.terms');
Route::get('/privacy_policy', 'Terms\TermsController@privacy')->name('terms.privacy');

//contact Us
Route::get('/contactUs', 'Terms\ContactController@index')->name('terms.index');
Route::post('/contactUs', 'Terms\ContactController@store')->name('terms.contactUs');

//species
Route::get('/species/coarsefish', 'Species\SpeciesController@coarse')->name('species.coarsefish');
Route::get('/species/seafish', 'Species\SpeciesController@sea')->name('species.seafish');

//maps
Route::get('/map/district', 'Map\MapController@district')->name('map.district');
Route::get('/map/river', 'Map\MapController@river')->name('map.river');
Route::get('/map/canal', 'Map\MapController@canal')->name('map.canal');
Route::get('/map/sea', 'Map\MapController@sea')->name('map.sea');

//activation
Route::get('/activate/token/{token}', 'Auth\ActivationController@activate')->name('auth.activate');
Route::get('/activate/resend', 'Auth\ActivationController@resend')->name('auth.activate.resend');

//waters
Route::get('/water/{style}', 'Card\WaterController@show')->name('water.show');
Route::get('/cards/{fish}/{district}/{style}', 'Card\WaterCardController@index');


//fish
Route::get('/coarseFish/{coarseFish}', 'Fish\CoarseFishController@coarseFish');
Route::get('/coarseFishs', 'Fish\CoarseFishController@index');
Route::get('/threeCoarseFishs/{firstFish}/{secondFish}/{thirdFish}', 'Fish\CoarseFishController@getThreeCoarseFishs');

Route::get('/seaFish/{seaFish}', 'Fish\SeaFishController@seaFish');
Route::get('/seaFishs', 'Fish\SeaFishController@index');
Route::get('/threeSeaFishs/{firstFish}/{secondFish}/{thirdFish}', 'Fish\SeaFishController@getThreeSeaFishs');

//locations
Route::get('/districtStillwaters', 'District\DistrictStillwaterController@index');
Route::get('/threeStillwaters/{firstStillwater}/{secondStillwater}/{thirdStillwater}', 'District\DistrictStillwaterController@getThreeStillwaters');
Route::get('/districtStillwaterLures', 'District\DistrictStillwaterLureController@index');
Route::get('/threeStillwaterLures/{firstStillwaterLure}/{secondStillwaterLure}/{thirdStillwaterLure}', 'District\DistrictStillwaterLureController@getThreeStillwaterLures');
Route::get('/districtCanals', 'District\DistrictCanalController@index');
Route::get('/threeCanals/{firstCanal}/{secondCanal}/{thirdCanal}', 'District\DistrictCanalController@getThreeCanals');
Route::get('/districtCanalLures', 'District\DistrictCanalLureController@index');
Route::get('/threeCanalLures/{firstCanalLure}/{secondCanalLure}/{thirdCanalLure}', 'District\DistrictCanalLureController@getThreeCanalLures');
Route::get('/districtRivers', 'District\DistrictRiverController@index');
Route::get('/threeRivers/{firstRiver}/{secondRiver}/{thirdRiver}', 'District\DistrictRiverController@getThreeRivers');
Route::get('/districtRiverLures', 'District\DistrictRiverLureController@index');
Route::get('/threeRiverLures/{firstRiverLure}/{secondRiverLure}/{thirdRiverLure}', 'District\DistrictRiverLureController@getThreeRiverLures');
Route::get('/districtSeaShores', 'District\DistrictSeaShoreController@index');
Route::get('/threeSeaShores/{firstSeaShore}/{secondSeaShore}/{thirdSeaShore}', 'District\DistrictSeaShoreController@getThreeSeaShores');
Route::get('/districtSeaBoats', 'District\DistrictSeaBoatController@index');
Route::get('/threeSeaBoats/{firstSeaBoat}/{secondSeaBoat}/{thirdSeaBoat}', 'District\DistrictSeaBoatController@getThreeSeaBoats');

//location individual
Route::get('/stillwater/{districtStillwater}', 'District\DistrictStillwaterController@stillwater');
Route::get('/stillwaterLure/{districtStillwaterLure}', 'District\DistrictStillwaterLureController@stillwaterLure');
Route::get('/river/{districtRiver}', 'District\DistrictRiverController@river');
Route::get('/riverLure/{districtRiverLure}', 'District\DistrictRiverLureController@riverLure');
Route::get('/canal/{districtCanal}', 'District\DistrictCanalController@canal');
Route::get('/canalLure/{districtCanalLure}', 'District\DistrictCanalLureController@canalLure');
Route::get('/seaShore/{districtSeaShore}', 'District\DistrictSeaShoreController@seaShore');
Route::get('/seaBoat/{districtSeaBoat}', 'District\DistrictSeaBoatController@seaBoat');


//pages
Route::get('/stillwaterPages', 'District\DistrictStillwaterController@district');
Route::get('/stillwaterLurePages', 'District\DistrictStillwaterLureController@district');
Route::get('/canalPages', 'District\DistrictCanalController@district');
Route::get('/canalLurePages', 'District\DistrictCanalLureController@district');
Route::get('/riverPages', 'District\DistrictRiverController@district');
Route::get('/riverLurePages', 'District\DistrictRiverLureController@district');
Route::get('/seaShorePages', 'District\DistrictSeaShoreController@district');
Route::get('/seaBoatPages', 'District\DistrictSeaBoatController@district');

Route::group(['middleware' => 'auth'], function () {
	//tacklebox
		Route::get('/tacklebox', 'Tacklebox\TackleboxController@index')->name('tacklebox.index');
	//gallery create
		Route::get('/galleryChoice', 'Gallery\GalleryController@choice')->name('gallery.choice');
		Route::get('/gallery/list/choice', 'Gallery\GalleryController@listChoice')->name('gallery.list.choice');
		Route::get('/galleryFishs/{district}/{style}', 'Gallery\ImageGalleryController@locationFish')->name('location.fish');
		Route::get('/galleryScenary', 'Gallery\GalleryScenaryController@index')->name('gallery.scenary');
		Route::get('/galleryScenaryImage/{style}', 'Gallery\GalleryScenaryController@scenary')->name('gallery.scenaryImage');
		Route::get('/galleryHeader', 'Gallery\ImageGalleryController@header')->name('gallery.header');
    	Route::post('/createHeader', 'Gallery\GallerySelectorController@header')->name('createHeader.header');
    	Route::post('/createGallery', 'Gallery\GallerySelectorController@gallery')->name('createGallery.gallery');
    	Route::get('/galleryConstructor/{card}', 'Gallery\GalleryController@constructor')->name('gallery.constructor');
    	Route::get('/galleryStyle/{style}', 'Gallery\GalleryController@style')->name('gallery.style');
    	Route::patch('/galleryConstructor/update/{id}', 'Gallery\GallerySelectorController@update')->name('editGallery.update');

		//gallery list
			Route::get('/gallery/list/choice', 'Gallery\GalleryController@listChoice')->name('gallery.list.choice');
			Route::get('/gallery/{galleryHeader}', 'Gallery\GalleryController@index')->name('gallery.index');
			Route::get('/gallery', 'Gallery\GalleryController@view')->name('gallery.view');
    		Route::get('/gallery/list/index/{style}', 'Gallery\GalleryViewController@index')->name('gallery.list.index');

		//gallery parts
			Route::post('/createScenary', 'Gallery\GalleryScenaryController@store')->name('createScenary.store');
    		Route::post('/createScenaryImage/{id}', 'Gallery\GalleryScenaryController@storeImage')->name('createScenary.storeImage');
    		Route::patch('/editGallery/update/{galleryHeader}', 'Gallery\EditGalleryController@update')->name('editGallery.update');
    		Route::delete('/editGallery/destroy/{galleryPicture}', 'Gallery\EditGalleryController@destroy')->name('editGallery.destroy');
    		Route::delete('/editGallery/destroyHeader/{galleryHeader}', 'Gallery\EditGalleryController@destroyHeader')->name('editGallery.destroyHeader');
    		Route::get('/editGallery/{galleryHeader}', 'Gallery\EditGalleryController@index')->name('editGallery.index');
    		Route::patch('/gallery/link/update/{galleryId}', 'Video\GalleryController@linkUpdate')->name('gallery.link.update');

		//gallery view
		Route::get('/galleryCards/{district}/{style}', 'Gallery\ImageGalleryController@galleryCard')->name('gallery.card');
		Route::get('/galleryPicture/{headerId}', 'Gallery\ImageGalleryController@galleryPicture')->name('gallery.picture');
    	Route::get('/userHeaders/{style}/{district}', 'Gallery\GalleryLinkController@headers')->name('userHeaders.headers');

    //blog
    	Route::get('/blog/choice', 'Blog\BlogViewController@choice')->name('blog.choice');
    	Route::get('/blog/index/{style}', 'Blog\BlogController@index')->name('blog.index');
    	Route::get('/blog/create/{style}', 'Blog\BlogController@create')->name('blog.blog.create');
    	Route::get('/blog/show/{blog}', 'Blog\BlogController@show')->name('blog.show');
    	Route::get('/blog/unique', 'Blog\BlogController@unique')->name('blog.unique');
    	Route::get('/blog/edit/{blog}', 'Blog\BlogController@edit')->name('blog.edit');
    	Route::patch('/blog/edit/update/{blog}', 'Blog\BlogController@update')->name('blog.edit.update');
    	Route::post('/createBlog', 'Blog\BlogController@store')->name('blog.store');
    	Route::delete('/blog/destroy/{blog}', 'Blog\BlogController@destroy')->name('blog.destroy');
    	Route::patch('/blog/link/update/{blogId}', 'Blog\BlogPartsController@linkUpdate')->name('blog.link.update');

    	//parts
    		Route::get('/blog/create/card/{card}', 'Blog\BlogPartsController@card')->name('blog.view.card');
    		Route::get('/userBlogs/{style}/{district}', 'Blog\BlogPartsController@userBlog')->name('blog.userBlog');
    		Route::patch('/blog/create/update/{id}', 'Blog\BlogPartsController@update')->name('blog.create.update');
    		Route::patch('/blog/create/card/update/{id}', 'Blog\BlogPartsController@update')->name('blog.create.card.update');
    		Route::get('/blog/list/choice', 'Blog\BlogPartsController@listChoice')->name('blog.list.choice');
    	

    //gallery views
    	Route::get('/gallery/collage/{galleryHeader}', 'Gallery\GalleryViewController@collage')->name('gallery.collage');
    	Route::get('/gallery/flip/{galleryHeader}', 'Gallery\GalleryViewController@flip')->name('gallery.flip');

	//profile
		Route::get('/profileDistricts', 'Profile\ProfileController@show')->name('profile.show');
		Route::get('/profile', 'Profile\ProfileController@index')->name('profile.index');
		Route::get('/profileFishes/{profileDistrict}/{style}', 'Profile\ProfileController@fish')->name('profile.fish');
		Route::get('/profileCards/{profileDistrict}/{profileFish}/{style}', 'Profile\ProfileCardController@profileCard')->name('profile.card');
		Route::get('/profileCards/edit/{card}', 'Profile\ProfileCardController@edit')->name('profile.edit');
		Route::patch('/profileCards/update/{card}', 'Profile\ProfileCardController@update')->name('profile.update');
		Route::patch('/profileImage/update/{card}', 'Profile\ProfileCardController@updateImage')->name('profile.updateImage');
		Route::get('/profileCards/delete/{card}', 'Profile\ProfileCardController@delete')->name('profile.delete');

	//selector
		Route::get('/selectorDistricts/{style}', 'Profile\ProfileSelectorController@districts')->name('profile.districts');
		Route::get('/selectCreateFishes/{profileDistrict}/{style}', 'Profile\SelectorFishesController@fishes')->name('profile.fishes');
		Route::post('/selectDistricts', 'Profile\ProfileSelectorController@store')->name('profile.selector');
		Route::post('/selectFishes', 'Profile\SelectorFishesController@store')->name('profile.selector');

	//profile settings
		Route::get('/auth/profileSettings', 'Auth\ProfileSettingsController@index')->name('profileSettings.index');
		Route::post('/auth/profileSettings', 'Auth\ProfileSettingsController@update')->name('profileSettings.update');

	//profile order
		Route::get('/orderFish', 'Order\OrderFishController@index')->name('orderFish.index');
		Route::get('/orderDistrict', 'Order\OrderDistrictController@index')->name('orderDistricts.index');
		Route::post('/orderDistrict/update', 'Order\OrderDistrictController@update')->name('orderDistricts.index');
		Route::get('/profileDistrict/order', 'Order\OrderProfileController@districts')->name('profileDistricts.order.index');
		Route::get('/profileFishs/order/{profileDistrict}', 'Order\OrderProfileController@fishs')->name('profileFishs.order.index');
		Route::patch('/orderFish/update/{profileFish}', 'Order\OrderFishController@update')->name('orderFish.update');
		Route::patch('/orderDistrict/update/{profileDistrict}', 'Order\OrderDistrictController@update')->name('orderDistrict.update');
		Route::delete('/orderDistrict/destroy/{profileDistrict}', 'Order\OrderDistrictController@destroy')->name('orderDistrict.destroy');
		Route::delete('/orderFish/destroy/{profileFish}', 'Order\OrderFishController@destroy')->name('orderFish.destroy');


	//accont items
		Route::get('/plans', 'Auth\PlanController@index')->name('plans.index');
		Route::get('/plan/{plan}', 'Auth\PlanController@show')->name('plans.show');

		Route::get('/braintree/token', 'Auth\BraintreeTokenController@token')->name('braintree.token');

		Route::post('/subscription', 'Auth\SubscriptionController@create')->name('subscription.create');


		//create
		Route::post('/createCard', 'Create\CreateCardController@store')->name('createCard.store');
    	Route::post('/createCardImage/{id}', 'Create\CreateCardController@storeImage')->name('createCard.storeImage');

		Route::get('/createChoice', 'Create\ChoiceController@show')->name('createChoice.show');
		Route::get('/create/card/{style}', 'Create\ChoiceController@index')->name('create.card.index');

		//locationlocation
		Route::get('/locationChoice', 'Location\LocationChoiceController@show')->name('locationChoice.show');
		Route::get('/selector/{style}', 'Location\LocationChoiceController@index')->name('selector.index');
		

		//subscribed
		Route::group(['middleware' => 'subscribed'], function () {

			Route::get('/subscription', 'Auth\SubscriptionController@index')->name('subscription.index');
			Route::post('/subscription/cancel', 'Auth\SubscriptionController@cancel')->name('subscription.cancel');
			Route::post('/subscription/resume', 'Auth\SubscriptionController@resume')->name('subscription.resume');
	    //video
			//resource
	    		Route::get('/video/choice', 'Video\VideoPartsController@choice')->name('video.choice');
		    	Route::get('/video/index/{style}', 'Video\VideoController@index')->name('video.index');
		    	Route::get('/video/create/{style}', 'Video\VideoController@create')->name('video.video.create');
		    	Route::get('/video/show/{video}', 'Video\VideoController@show')->name('video.show');
		    	Route::get('/video/edit/{video}', 'Video\VideoController@edit')->name('video.edit');
		    	Route::patch('/video/edit/update/{video}', 'Video\VideoController@update')->name('video.edit.update');
		    	Route::post('/createVideo', 'Video\VideoController@store')->name('video.store');
		    	Route::delete('/video/destroy/{video}', 'Video\VideoController@destroy')->name('video.destroy');
		    	Route::patch('/video/link/update/{video}', 'Video\VideoPartsController@linkUpdate')->name('video.link.update');
	    	//view
	    	
	    	//parts
	    		Route::get('/video/listChoice', 'Video\VideoPartsController@listChoice')->name('video.listChoice');
	    		Route::post('/video/upload/{video}', 'Video\VideoPartsController@store')->name('upload.video.store');
	    		Route::patch('/video/link/{videoId}', 'Video\VideoPartsController@updatelink')->name('upload.video.link');
	    		Route::get('/video/create/card/{card}', 'Video\VideoPartsController@card')->name('video.view.card');
	    		Route::get('/userVideos/{style}/{district}', 'Video\VideoPartsController@userVideo')->name('video.userVideo');
		});

		//subscribed expert
		Route::group(['middleware' => 'subscribed.expert'], function () {
			Route::get('/friends', 'Gallery\FriendsController@index')->name('friends.index');

		});

		Route::group(['middleware' => 'customer'], function () {
			Route::get('/invoices', 'Auth\InvoiceController@index')->name('invoices.index');
			Route::get('/invoices/{invoice}', 'Auth\InvoiceController@show')->name('invoices.show');
		});

		//admin panel
		Route::group(['middleware' => 'role:admin'], function () {
			Route::get('/admin', 'Admin\AdminController@index')->name('admin.index');
			Route::get('/admin/contactForm', 'Admin\AdminController@contact')->name('admin.contact');
			Route::delete('/admin/destroy/{contact}', 'Admin\AdminController@destroy')->name('admin.contact.destroy');
		});

});
//webhooks
Route::post('/webhook/Braintree', 'Auth\BraintreeWebhookController@handle');
Route::post('/webhook/cocunut', 'Webhook\CocunutWebhookController@handle');
