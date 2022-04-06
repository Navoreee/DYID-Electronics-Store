@extends('layouts.app')

@section('content')

<div class="container">
    <div class="d-flex justify-content-center">
        <h2>New Products</h2>
    </div>
    <div class="row">
        @forelse ($products as $product)
            <div class="col-sm-4 py-3">
                <div class="card border-warning h-100">
                    <h6 class="card-header">
                        @if ($product->category_id)
                            {{ $product->category->name }}
                        @else
                            No category
                        @endif
                    </h6>
                    <img class="card-img-top" src="{{ asset('storage/product/'.$product->image_path)}}">
                    <div class="card-body">
                        <h5 class="card-title"><b>{{ $product->name }}</b></h5>
                        <p class="card-text">IDR {{ number_format($product->price) }}</p>
                        <a href="{{ route('details', ['id' => $product->id]) }}" class="btn btn-warning">More Details</a>
                    </div>
                </div>
            </div>
        @empty
            <div class="alert alert-danger">
                <h5>There are no products.</h5>
            </div>
        @endforelse
    </div>
    <div class="d-flex justify-content-center">
        {{ $products->links() }}
    </div>
</div>
@endsection