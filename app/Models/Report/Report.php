<?php

namespace App\Models\Report;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    protected $fillable = [
    	'style_id',
		'profileDistrict_id',
		'report_date',
		'hours',
		'minutes',
		'fish_id',
		'lbs',
		'ozs',
		'fish_qty',
		'predetor_qty',
		'predetor_id',
    ];
}
