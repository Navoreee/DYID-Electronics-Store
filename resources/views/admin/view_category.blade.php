@extends('layouts.app')

@section('content')

<div class="container">
    <h2 class="text-center">Manage Category</h2>
    <br>
    <table class="table table-warning table-bordered">
        <thead>
            <tr>
                <th scope="col">No.</th>
                <th scope="col">Category Name</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($categories as $key=>$category)
                <tr>
                    <th scope="row">{{ $key + 1}}</th>
                    <td>{{ $category->name }}</td>
                    <td>
                        <a href="{{ route('edit_category', ['id' => $category->id]) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('delete_category', ['id' => $category->id]) }}" method="POST">
                            @method('DELETE')
                            @csrf
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7">There are no categories.</td>
                </tr>
            @endforelse
        </tbody>
        <div class="d-flex justify-content-center">
            {{ $categories->links() }}
        </div>
    </table>
</div>

@endsection