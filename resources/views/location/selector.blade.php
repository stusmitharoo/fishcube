@extends('layouts.app')

@section('title')
	FishCube Canal 
@endsection

@section('content')
	<districtselector :data="{{ $style->toJson() }}"></districtselector>
@endsection