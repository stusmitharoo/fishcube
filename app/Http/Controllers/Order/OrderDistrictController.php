<?php

namespace App\Http\Controllers\Order;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Validation;
use App\Models\Profile\ProfileDistrict;
use Auth;

class OrderDistrictController extends Controller
{
    public function index()
    {
      return view('order.district', ['user' => Auth::user()]);

    }

    public function update(Request $request, ProfileDistrict $profileDistrict)
    {
      $this->authorize('touch', $profileDistrict);

      $this->validate($request, [
        'order_no' => 'required'
        ]);

      $districtId = $profileDistrict->id; 

      $profileDistrict = ProfileDistrict::findOrFail($districtId);

      $profileDistrict->order_no = $request->order_no;

      $profileDistrict->save();

      return $profileDistrict->toJson();

    }

    public function destroy(Request $request, ProfileDistrict $profileDistrict)
    {
      $this->authorize('touch', $profileDistrict);

      $profileDistrict->delete();

      return $profileDistrict->toJson();
    }
     
}