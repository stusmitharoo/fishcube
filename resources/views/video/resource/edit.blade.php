@extends('layouts.app')

@section('title')
	FishCube edit video 
@endsection

@section('content')
		<videoedit :video="{{ $video->toJson() }}"></videoedit>
@endsection