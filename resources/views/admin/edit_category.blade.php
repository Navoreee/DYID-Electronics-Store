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
                    <h2 class="card-title text-info">Edit Category</h2>
                    <br>
                    <form method="POST" action="{{ route('update_category', ['id' => $category->id]) }}">
                        @csrf

                        <div class="form-group">
                            <div>
                                <input id="name" type="text" placeholder="Category Name" class="form-control" name="name" value="{{ old('name') ?? $category->name }}">
                                @error('name')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
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