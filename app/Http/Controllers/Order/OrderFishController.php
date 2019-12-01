<?php

namespace App\Http\Controllers\Order;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Profile\ProfileDistrict;
use App\Models\Profile\ProfileFish;
use Validation;
use Auth;

class OrderFishController extends Controller
{
    public function index()
    {
      return view('order.fish',['user' => Auth::user()]);

    }

    public function update(Request $request, ProfileFish $profileFish)
    {
      $this->authorize('touch', $profileFish);

      $this->validate($request, [
        'sort_order' => 'required'
        ]);

      $fishId = $profileFish->id;

      $profileFish = ProfileFish::findOrFail($fishId);

      $profileFish->sort_order = $request->sort_order;

      $profileFish->save();

      return $profileFish->toJson();

    }

    public function destroy(Request $request, ProfileFish $profileFish)
    {
      $this->authorize('touch', $profileFish);

      $profileFish->delete();

      return $profileFish->toJson();
    }
     
}