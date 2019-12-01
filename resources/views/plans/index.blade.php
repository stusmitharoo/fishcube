@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="box-still">
                    <h4 class="words">Subscriptions</h4>

                    <div class="panel-body">
                        <ul class="list-group">
                            @foreach ($plans as $plan)
                            <li class="box-panel clearfix">
                                <div class="pull-left col-xs-9">
                                    <h4 class="plan-words">{{ $plan->name }}</h4>
                                    <h4 class="plan-words">£{{ number_format($plan->cost, 2) }} Per Month</h4>
                                    <h5 class="plan-words">{{ $plan->description }}</h5>
                                </div>
                                @if(!Auth::user()->subscribedToPlan($plan->braintree_plan, 'main'))
                                    <a href="{{ route('plans.show', $plan->slug) }}" class="btn btn-warning words col-xs-3">Choose</a>
                                @endif
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
