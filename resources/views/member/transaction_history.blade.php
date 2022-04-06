@extends('layouts.app')

@section('content')

<div class="container px-5">
    <h2 class="text-center">Transaction History</h2>
    <br>
    <div class="accordion" id="accordion">
        @forelse ($carts as $key => $cart)
            <div class="accordion-item">
                <h2 class="accordion-header" id="heading-{{$key}}">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-{{$key}}" aria-expanded="false" aria-controls="collapse-{{$key}}">
                        {{ $cart->check_out_datetime }}
                    </button>
                </h2>
                <div id="collapse-{{$key}}" class="accordion-collapse collapse" aria-labelledby="heading-{{$key}}">
                    <div class="accordion-body">
                        @forelse ( $cart->cart_history_detail as $detail )
                            <div class="bg-light border my-3">
                                <div class="row">
                                    <div class="col-lg-2 col-md-3 col-sm-5 col-6">
                                        <img src="{{ asset('storage/product/'.$detail->image_path)}}" style="height:auto; width:100%;">
                                    </div>
                                    <div class="col p-4">
                                        <h5><b>{{ $detail->name }}</b></h5>
                                        <p>IDR {{ number_format($detail->price) }} <b>x{{ $detail->quantity }} pcs</b></p>
                                        <div class="d-flex flex-row justify-content-end">
                                            <p>IDR {{ number_format($detail->subtotal) }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <h4>No transaction details.</h4>
                        @endforelse
                        <div class="d-flex flex-row justify-content-end">
                            <p><b>Total Price: IDR {{ number_format($cart->check_out_price) }}</b></p>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="bg-light rounded p-4 border border-warning">
                <h5>No transactions.</h5>
            </div>
        @endforelse
    </div>
</div>

@endsection