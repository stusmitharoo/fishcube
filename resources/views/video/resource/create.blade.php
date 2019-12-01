@extends('layouts.app')

@section('title')
	FishCube create video 
@endsection

@section('content')
	<videoconstructor 
		:data="{{ $style->toJson() }}">
	</videoconstructor>
@endsection