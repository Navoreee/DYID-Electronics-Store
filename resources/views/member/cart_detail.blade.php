@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card p-4">
                <div class="card-body">
                    
                    <div class="row">
                        <div class="col-5">
                            <img src="{{ asset('storage/product/'.$detail->product->image_path)}}" style="width:100%; height:auto; object-fit:contain;">
                        </div>
                        <div class="col-7">
                            <h3><b>{{ $detail->product->name }}</b></h3>
                            <hr>
                            <h6><b>Price:</b></h6>
                            <p>IDR {{ number_format($detail->product->price) }}</p>
                            <hr>
                            <h6><b>Description:</b></h6>
                            <p>{{ $detail->product->description }}</p>
                            <hr>
                            <form method="POST" action="{{ route('update_cart', ['id' => $detail->product->id]) }}" class="form-inline">
                                @csrf
                                <label for="qty">Qty:</label>
                                <input type="text" class="mx-2" id="qty" name="qty" style="width: 50px" placeholder="0" value="{{ old('qty') ?? $detail->quantity }}">
                                <button type="submit" class="btn btn-warning mx-2">
                                    {{ __('Save') }}
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
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

@endsection