@extends('layouts.app')

@section('title')
	FishCube admin panel 
@endsection

@section('content')


	<div class="container col-xs-12">
		<h3 class="words">contact Form</h3>
		<br>
		<div class="col-xs-12">
			@foreach ($contacts as $contact)
            <li class="box-panel clearfix">
                <div class="pull-left">
                    <h3 class="plan-words">{{ $contact->subject }}</h3>
                    <h4 class="plan-words">{{ $contact->email }}</h4>
                    <p class="plan-words">{{ $contact->content }}</p>
				</div>
                 <a href="#" onclick="event.preventDefault(); document.getElementById('contact-destroy-{{ $contact->id }}').submit();" class="btn btn-primary pull-right">Delete</a>
            </li>
            <br>
			<form action="{{ route('admin.contact.destroy', $contact) }}" method="post" id="contact-destroy-{{ $contact->id }}">
				{{ csrf_field() }}
				{{method_field('DELETE') }}
			</form>
            @endforeach
		</div>
	</div>
@endsection