<?php

namespace App\Http\Controllers\Video;

use App\Models\Media\Video;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Profile\Style;
use Auth;

class VideoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Style $style)
    {
        return view('video.resource.index', compact('style'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Style $style)
    {
        return view('video.resource.create', compact('style'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'style_id' => 'required|integer',
            'district_id' => 'required|integer',
            'title' => 'required|string|max:30',
            'description' => 'string|max:200',
          ]);

        $video = new Video;

        $video->style_id = $request->style_id;
        $video->district_id = $request->district_id;
        $video->title = $request->title;
        $video->description = $request->description;
        $video->user_id = Auth::user()->id;

        $video->video_filename = time() . '.' . $request->extension;

        $current_video_count = Video::getVideosCount(Auth::user()->id);

        if($this->canSave($request->user(), $current_video_count)){
        $card->save();
       
        return $card->toJson();
      }
         return redirect('/plans');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Media\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function show(Video $video)
    {
        return view('video.resource.show', compact('video'));    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Media\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function edit(Video $video)
    {
        $this->authorize('touch', $video);

        return view('video.resource.edit', compact('video'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Media\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Video $video)
    {
        $this->authorize('touch', $video);

        $this->validate($request, [
          'title' => 'required|string|max:30',
          'description' => 'required|string|max:200',
        ]);

      $video->title = $request->title;
      $video->description = $request->description;

      $video->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Media\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function destroy(Video $video)
    {
        $this->authorize('touch', $video);
        
        $video->delete();

      return;
    }

    public function canSave($user, $current_video_count){

      if($current_video_count < 5){
        return true;
      }

      if($user->hasExpertSubscription()){
        return true;
      }

       if($user->subscribed('main') && $current_video_count < 25 ){
        return true;
      }

      return false;
    }
}
