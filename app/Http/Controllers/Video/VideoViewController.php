<?php

namespace App\Http\Controllers\Video;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Transformers\Media\VideoTransformer;
use League\Fractal\Pagination\IlluminatePaginatorAdapter;
use App\Models\Media\VideoView;
use App\Models\Media\Video;
use App\Models\Profile\Style;
use Carbon\Carbon;
use App\User;

class VideoViewController extends Controller
{

	const BUFFER = 10;

    public function choice() 
    {
    	return view('video.view.viewChoice');
    }

    public function index(Style $style)
    {
        return view('video.view.index', compact('style'));
    }

    public function list(Request $request, $styleId, $districtId )
    {
        $videos = Video::getVideos($styleId, $districtId);
      
        $videosCollection = $videos->getCollection();

        return fractal()
           ->collection($videosCollection)
           ->parseIncludes(['user'])
           ->transformWith(new VideoTransformer)
           ->paginateWith(new IlluminatePaginatorAdapter($videos))
           ->toArray();
    }

    public function show(Request $request, Video $video)
    {
        $userId = $video->user_id;
        $view = User::viewable($userId)->get();

        if(!$view->isEmpty()){
            return view('video.resource.show', compact('video'));
        }

        return back()->withInfo('This video is private try searching for another.');
        
    }

    public function create(Request $request, Video $video)
    {

    	if($request->user()) {
    		$lastUserView = $video->views()->latestByUser($request->user())->first();

    		if($this->withinBuffer($lastUserView)) {
    			return;
    		}
    	}

    	$lastIpView = $video->views()->latestByIp($request->ip())->first();

    	if($this->withinBuffer($lastIpView)) {
    			return;
    		}

    	$videoViews = new VideoView;

        $videoViews->user_id = $request->user() ? $request->user()->id : null;
        $videoViews->video_id = $video->id;
        $videoViews->ip = $request->ip();

        $videoViews->save();

        return response()->json(null, 200);
    }

    protected function withinBuffer($view)
    {
    	return $view && $view->created_at->diffInMinutes(Carbon::now()) < self::BUFFER;
    }
}
