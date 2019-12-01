@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="box-still">
                    <div class="words"><h4>Manage Subscriptions</h4></div>

                    <div class="panel-body">
                        @if (Auth::user()->subscription('main')->cancelled())
                        <p class="words">You have cancelled your subscription. You still have acess until {{ Auth::user()->subscription('main')->ends_at->format('dS M Y') }}</p>
                        <form action="{{ route('subscription.resume') }}" method="post">
                            <button type="submit" class="btn btn-defualt">Resume Subscription</button>
                            {{ csrf_field() }}
                        </form>
                        @else
                            <p class="words">You are currently subscribed!</p>
                            <form action="{{ route('subscription.cancel') }}" method="post">
                                <button type="submit" class="myh4 btn btn-danger words">Cancel Subscription</button>
                                {{ csrf_field() }}
                            </form>
                        @endif
                        <hr>   
                            <div class="row">
                                <div class="col-xs-6">
                                <a class="myh4 btn btn-warning words btn-block" href="{{ route('plans.index') }}">change Subscription</a>
                                </div>
                                <div class="col-xs-6">
                                    <a class="myh4 btn btn-warning words btn-block" href="{{ route('invoices.index') }}">Invoices</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection