@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="box-pay">
                <div class="words"><h4>{{ $plan->name }}</h4></div>

                <div class="panel-body">
                    <form action="{{ route('subscription.create') }}" method="post">
                        <div id="dropin-container"></div>
                
                        <button type="submit" class="btn btn-primary pull-right hidden" id="payment-button">Subscribe</button>
                        <input type="hidden" name="plan" value="{{ $plan->id }}">
                        {{csrf_field()}}
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
    <script src="https://js.braintreegateway.com/js/braintree-2.30.0.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script>
        $.ajax({
            url: '{{ route('braintree.token') }}'
        }).done((response) => {
            braintree.setup(response.data.token, 'dropin', {
              container: 'dropin-container',
                onReady: function () {
                    $('#payment-button').removeClass('hidden');
                }
            });
        });
    </script>
@endsection
