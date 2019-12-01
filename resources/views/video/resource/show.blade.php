@extends('layouts.app')

@section('title')
	FishCube video watch
@endsection

@section('content')
	<div class="col-xs-12 col-sm-10 col-sm-offset-1">
		<div>
			@if($video->isProcessed())
				<videoPlayer video-id="{{ $video->id }}" video-url="{{ $video->getStreamUrl() }}" thumbnail-url="{{ $video->getThumbnail() }}"></videoPlayer>
			@endif
			@if(!$video->isProcessed())
				<div class="video-placeholder">
					<div class="video-placeholder__header">
						This video is processing come back later.
					</div>
				</div>
			@endif
		</div>
		<div class="box-still">
			<div class="container">
				<div class="row margin-bs">
				<h5 class="col-xs-6 plan-words">{{ $video->title }}</h5>
				<div class="col-xs-6">
					<div class="pull-right plan-words">
						<h5>{{ $video->viewCount() }} {{ str_plural('view', $video->viewCount()) }}</h5>
					</div>
				</div>
			</div>
			<div class="col-xs-12 box-text-top">
				<h5 class="words">{{ $video->description }}</h5>
			</div>
			</div>
		</div>
	</div>
@endsection