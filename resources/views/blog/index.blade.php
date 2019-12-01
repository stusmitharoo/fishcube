@extends('layouts.app')

@section('title')
	FishCube list blogs 
@endsection

@section('content')
		<listblogs :data="{{ $style->toJson() }}"></listblogs>
@endsection