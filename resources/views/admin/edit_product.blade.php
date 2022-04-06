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
                    <h2 class="card-title text-info">Edit Product</h2>
                    <br>
                    <form method="POST" action="{{ route('update_product', ['id' => $product->id]) }}" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group">
                            <div>
                                <input id="name" type="text" placeholder="Product Name" class="form-control" name="name" value="{{ old('name') ?? $product->name }}">
                                @error('name')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <br>
                        <div class="form-group">
                            <textarea class="form-control" name="description" id="description" placeholder="Product Description" rows="3">{{ old('description') ?? $product->description }}</textarea>
                            @error('description')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <br>
                        <div class="input-group">
                            <div class="input-group-prepend">
                              <div class="input-group-text">IDR</div>
                            </div>
                            <input type="text" class="form-control" id="price" name="price" placeholder="Product Price" value="{{ old('price') ?? $product->price }}">
                        </div>
                        @error('price')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                        <br>
                        <div class="form-group">
                            <label for="category">Product Category</label>
                            <select class="form-select" name="category" id="category">
                                @forelse ($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category', $product->category_id) == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
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
                            <p>Image saved: {{ $product->image_path }}</p>
                            @error('image')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <br>
                        <div class="form-group row">
                            <div class="col">
                                <button type="submit" class="btn btn-warning">
                                    {{ __('Save') }}
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