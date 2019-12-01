<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
	protected $hidden = [
        'user_id'
    ];
	
    public function roles()
    {
    	return $this->belongsToMany(Role::class, 'roles_permissions');
    }
}
