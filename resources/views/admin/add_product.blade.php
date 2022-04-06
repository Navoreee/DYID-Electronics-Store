@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card p-4">
                @if(session()->has('message'))
                    <div class="alert alert-success">
                        {{ session()->get('message') }}
                    </div>
                @endif
                <div class="card-body">
                    <h2 class="card-title text-info">Add New Product</h2>
                    <br>
                    <form method="POST" action="{{ route('store_product') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group">
                            <div>
                                <input id="name" type="text" placeholder="Product Name" class="form-control" name="name" value="{{ old('name') }}">
                                @error('name')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <br>
                        <div class="form-group">
                            <textarea class="form-control" name="description" id="description" placeholder="Product Description" rows="3">{{ old('description') }}</textarea>
                            @error('description')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <br>
                        <div class="input-group">
                            <div class="input-group-prepend">
                              <div class="input-group-text">IDR</div>
                            </div>
                            <input type="text" class="form-control" id="price" name="price" placeholder="Product Price" value="{{ old('price') }}">
                        </div>
                        @error('price')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                        <br>
                        <div class="form-group">
                            <label for="category">Product Category</label>
                            <select class="form-select" name="category" id="category">
                                @forelse ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @empty
                                    <option value=null>No category</option>
                                @endforelse
                            </select>
                            @error('category')
                                    <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <br>
                        <div class="form-group">
                            <label for="image" class="form-label">Product Image</label>
                            <input type="file" class="form-control" id="image" name="image">
                            @error('image')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <br>
                        <div class="form-group row">
                            <div class="col">
                                <button type="submit" class="btn btn-warning">
                                    {{ __('Add Product') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection