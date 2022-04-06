@extends('layouts.app')

@section('content')

<div class="container px-5">
    <h2 class="text-center">My Cart</h2>
    <br>
    @forelse ($cart_details as $detail)
        @php
            $subtotal = $detail->product->price * $detail->quantity;
            $total += $subtotal;
        @endphp
        <div class="bg-light rounded p-2 border border-warning">
            <div class="row">
                <div class="col-lg-2 col-md-3 col-sm-5 col-6">
                    <img src="{{ asset('storage/product/'.$detail->product->image_path)}}" style="height:auto; width:100%;">
                </div>
                <div class="col p-4">
                    <h5><b>{{ $detail->product->name }}</b></h5>
                    <p>IDR {{ number_format($detail->product->price) }} <b>x{{ $detail->quantity }} pcs</b></p>
                    <hr>
                    <h5>IDR {{ number_format($subtotal) }}</h5>
                    <div class="d-flex flex-row justify-content-end">
                        <div class="m-2"><a href="{{ route('edit_cart', ['id' => $detail->id]) }}" class="btn btn-warning">Edit</a></div>
                        <div class="m-2">
                            <form action="{{ route('delete_cart', ['id' => $detail->id]) }}" method="POST">
                                @method('DELETE')
                                @csrf
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <br>
    @empty
        <div class="bg-light rounded p-4 border border-warning">
            <h5>Cart is empty.</h5>
        </div>
        <br>
    @endforelse
    <div class="d-flex flex-row justify-content-between">
        <h3><b>Total:</b> IDR {{ number_format($total) }}</h3>
        <form action="{{ route('check_out') }}" method="POST">
            @method('DELETE')
            @csrf
            <button type="submit" class="btn-lg btn-warning">Checkout</button>
        </form>
    </div>
</div>

@endsection