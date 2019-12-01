@extends('layouts.app')

@section('title')
	FishCube view blog 
@endsection

@section('content')
	<div class="col-xs-12 col-sm-8 col-sm-offset-2">
		<div class="box-still margin-s">
			<div class="panel panel-default">
				<div class="panel-heading">
					<div class="row">
						<h3 class="words col-xs-12">{{ $blog->title }}</h3>
	                </div>
				</div>
				<div class="panel-body">
					<h5 class="plan-words">{!! $blog->content !!}</h5>
				</div>
			</div>
		</div>
	</div>
@endsection