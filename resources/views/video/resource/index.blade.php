@extends('layouts.app')

@section('title')
	FishCube video listings
@endsection

@section('content')
		<listvideos :data="{{ $style->toJson() }}"></listvideos>
@endsection