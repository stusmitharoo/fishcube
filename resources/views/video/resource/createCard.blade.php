@extends('layouts.app')

@section('title')
	FishCube create video 
@endsection

@section('content')
	<videoconstructor 
		:card="{{ $card->toJson() }}">
	</videoconstructor>
@endsection