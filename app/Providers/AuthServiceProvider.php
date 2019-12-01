<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
        'App\Models\Card\Card' => 'App\Policies\CardPolicy',
        'App\Models\Gallery\GalleryHeader' => 'App\Policies\GalleryHeaderPolicy',
        'App\Models\Gallery\GalleryPicture' => 'App\Policies\GalleryPicturePolicy',
        'App\Models\Media\Video' => 'App\Policies\VideoPolicy',
        'App\Models\Media\Blog' => 'App\Policies\BlogPolicy',
        'App\Models\profile\ProfileDistrict' => 'App\Policies\ProfileDistrictPolicy',
        'App\Models\profile\ProfileFish' => 'App\Policies\ProfileFishPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }
}
