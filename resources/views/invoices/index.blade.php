@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="box-still">
                <div class="words"><h4>Invoices</h4></div>

                <div class="panel-body">
                   @if ($invoices->count())
                        <table class="table">
                            <thead>
                                <tr>
                                    <th><h5 class="words">Date</h5></th>
                                    <th><h5 class="words">Amount</h5></th>
                                    <th><h5 class="words pull-right">Download</h5></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($invoices as $invoice)
                                <tr>
                                    <td class="words">{{ $invoice->date()->toDateTimeString() }}</td>
                                    <td class="words">{{ $invoice->total() }}</td>
                                    <td>
                                        <a class="words pull-right" href="{{ route('invoices.show', '$invoice->id')}}">Download</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection