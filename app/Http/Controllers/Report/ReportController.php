<?php

namespace App\Http\Controllers\Report;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Profile\Style;
use App\Models\Report\Report;
use Carbon\Carbon;
use Validator;

class ReportController extends Controller
{
    public function choice()
    {
      return view('report.choice');

    }

    public function index(Style $style)
    {
    	return view('report.index', compact('style'));
    }

    public function store(Request $request)
    {
    	$this->validate($request, [
        'style_id' => 'required|integer',
        'district_id' => 'required|integer',
        'hours' => 'required|integer|max:48',
        'minutes' => 'required|integer',
        'fish_id' => 'string|max:55',
        'lbs' => 'integer',
        'ozs' => 'integer',
        'fish_qty' => 'integer',
        'predetor_qty' => 'integer',
        'predetor_id' => 'string|max:55',
      ]);

      $date = Carbon::parse($request->report_date)->format('Y-m-d');

      $report = new Report;

      $report->style_id = $request->style_id;
      $report->district_id = $request->district_id;
      $report->hours = $request->hours;
      $report->minutes = $request->minutes;
      $report->fish_id = $request->fish_id;
      $report->lbs = $request->lbs;
      $report->ozs = $request->ozs;
      $report->fish_qty = $request->fish_qty;
      $report->predetor_qty = $request->predetor_qty;
      $report->predetor_id = $request->predetor_id;
      $report->report_date = $date;

      $report->save();
       
      return $report->toJson();
    }
     
}