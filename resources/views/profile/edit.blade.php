@extends('layouts.app')

@section('title')
	Edit Card 
@endsection

@section('content')
	<profilecardedit :data="{{ $card->toJson() }}"></profilecardedit>
@endsection