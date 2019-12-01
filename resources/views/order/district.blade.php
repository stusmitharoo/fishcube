@extends('layouts.app')

@section('title')
	Order District 
@endsection

@section('content')
	<orderdistrict :data="{{ $user->toJson() }}"></orderdistrict>
@endsection