<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Builder;
use Laravel\Cashier\Billable;
use App\Models\ActivationToken;
use App\Models\Profile\ProfileDistrict;
use App\Models\Profile\ProfileFish;
use App\Models\Gallery\GalleryHeader;
use App\Models\Media\Video;
use App\Models\Media\Blog;
use Laravel\Scout\Searchable;
use App\Permissions\HasPermissionsTrait;

class User extends Authenticatable
{
    use Notifiable;
    use Billable;
    use HasPermissionsTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'active', 'view'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token','email', 'braintree_id','paypal_email','card_brand','card_last_four'
    ];

    public function activationToken()
    {
        return $this->hasOne(ActivationToken::class);
    }

    public function ProfileDistricts()
    {
        return $this->hasMany(ProfileDistrict::class);
    }

    public function ProfileFishs()
    {
        return $this->hasMany(ProfileFish::class);
    }

    public function galleryHeader()
    {
        return $this->hasMany(GalleryHeader::class);
    }

    public function video()
    {
        return $this->hasMany(Video::class);
    }

    public function blog()
    {
        return $this->hasMany(Blog::class);
    }

    public function hasExpertSubscription()
    {
        return $this->subscribedToPlan('expert', 'main');
    }

    public function hasBeenCustomer()
    {
        return $this->braintree_id !== null;
    }

    public static function byEmail($email)
    {
        return Static::where('email', $email);
    }

    public function scopeViewable(Builder $builder, $profile_id)
    {

        return $builder->where([
            'view' => true,
            'id' =>  $profile_id
            ]);
    }
}