@extends('layouts.app')

@section('content')

<div class="container">
    <h2 class="text-center">Manage Product</h2>
    <br>
    <table class="table table-warning table-bordered">
        <thead>
            <tr>
                <th scope="col">No.</th>
                <th scope="col">Image</th>
                <th scope="col">Name</th>
                <th scope="col" style="width:30%">Description</th>
                <th scope="col">Price</th>
                <th scope="col">Category</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($products as $key=>$product)
                <tr>
                    <th scope="row">{{ $key + 1}}</th>
                    <td><img src="{{ asset('storage/product/'.$product->image_path)}}" style="height:auto; width:100px;"></td>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->description }}</td>
                    <td>IDR {{ number_format($product->price) }}</td>
                    <td>
                        @if ($product->category_id)
                            {{ $product->category->name }}
                        @else
                            None
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('edit_product', ['id' => $product->id]) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('delete_product', ['id' => $product->id]) }}" method="POST">
                            @method('DELETE')
                            @csrf
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7">There are no products.</td>
                </tr>
            @endforelse
        </tbody>
        <div class="d-flex justify-content-center">
            {{ $products->links() }}
        </div>
    </table>
</div>

@endsection