@extends('layouts.app')

@section('title')
	FishCube create blog 
@endsection

@section('content')
	<blogconstructor 
		:card="{{ $card->toJson() }}">
	</blogconstructor>
@endsection