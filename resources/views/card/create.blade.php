@extends('layouts.app')

@section('content')
	<cardcreate :data="{{ $style->toJson() }}"></cardcreate>
   
@endsection