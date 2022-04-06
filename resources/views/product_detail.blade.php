@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card p-4">
                <div class="card-body">
                    
                    <div class="row">
                        <div class="col-5">
                            <img src="{{ asset('storage/product/'.$product->image_path)}}" style="width:100%; height:auto; object-fit:contain;">
                        </div>
                        <div class="col-7">
                            <h3><b>{{ $product->name }}</b></h3>
                            <hr>
                            <h6><b>Category:</b></h6>
                            @if ($product->category_id)
                                <p>{{ $product->category->name }}</p>
                            @else
                                <p>None</p>
                            @endif
                            <hr>
                            <h6><b>Price:</b></h6>
                            <p>IDR {{ number_format($product->price) }}</p>
                            <hr>
                            <h6><b>Description:</b></h6>
                            <p>{{ $product->description }}</p>
                            <hr>
                            @guest
                                <a href="{{ route('login') }}" class="btn btn-warning">Login to buy</a>
                            @else
                                @if (Auth::user()->role == 'member')
                                    <form method="POST" action="{{ route('add_cart', ['id' => $product->id]) }}" class="form-inline">
                                        @csrf
                                        <label for="qty">Qty:</label>
                                        <input type="text" class="mx-2" id="qty" name="qty" style="width: 50px" placeholder="0">
                                        <button type="submit" class="btn btn-warning mx-2">
                                            {{ __('Add to cart') }}
                                        </button>
                                        @error('qty')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </form>
                                    <br>
                                    @if(session()->has('message'))
                                        <div class="alert alert-success">
                                            {{ session()->get('message') }}
                                        </div>
                                    @endif
                                @endif
                            @endguest
                            
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

@endsection