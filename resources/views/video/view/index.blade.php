@extends('layouts.app')

@section('title')
	FishCube video listings
@endsection

@section('content')
		<listviewvideos :water="{{ $style->toJson() }}"></listviewvideos>
@endsection