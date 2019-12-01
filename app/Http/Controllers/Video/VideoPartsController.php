<?php

namespace App\Http\Controllers\Video;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Transformers\Media\VideoTransformer;
use League\Fractal\Pagination\IlluminatePaginatorAdapter;
use App\Models\Media\Video;
use App\Http\Request\VideoUpdateRequest;
use App\Models\Card\Card;
use App\Jobs\UploadVideo;

class VideoPartsController extends Controller
{
    public function choice() 
    {
    	return view('video.resource.choice');
    }

    public function listChoice() 
    {
    	return view('video.parts.listChoice');
    }

    public function card(Request $request,Card $card )
    {
        return view('video.resource.createCard', compact('card'));
    }

    public function userVideo(Request $request,$styleId, $districtId )
    {
        $userId = $request->user()->id;
        $videos = Video::getUserVideos($userId, $styleId, $districtId );
        $videosCollection = $videos->getCollection();

          return fractal()
            ->collection($videosCollection)
            ->transformWith(new VideoTransformer)
            ->paginateWith(new IlluminatePaginatorAdapter($videos))
            ->toArray();
    }

    public function store(Request $request, Video $video) 
    {
        $this->validate($request, [
            file('video') => 'required|file|max:5000',
          ]);

        $request->file('video')->move(storage_path() . '/uploads', $video->video_filename);

        UploadVideo::dispatch($video->video_filename);

        return response()->json(null, 200); 
    }

    public function link(Request $request, $id)
    {
      
        $this->validate($request, [
          'video_id' => 'required|integer',
        ]);

        $videoId = $request->route('id');
        
        $video = Card::findOrFail($videoId);

        $video->video_id = $request->video_id;

        $video->save();

       return $video->toJson();
    }

    public function linkUpdate(Request $request, $videoId)
    {
        Card::where('video_id', '=', $videoId)->update(['video_id' => null]);

        return;
    }
}
