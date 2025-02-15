@extends('category.layout')

@section('content')

<div class="card mt-5">
    <h2 class="card-header">Add New Image</h2>
    <div class="card-body">

        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
            <a class="btn btn-primary btn-sm" href="{{ route('image.index') }}"><i class="fa fa-arrow-left"></i> Back</a>
        </div>
        <form method="post" action="{{ route('image.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="card mt-5">
                <div class="card-header">
                    <h3>New Image</h3>
                </div>
                <div class="card-body">
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <div class="alert-title">
                            <h4>Whoops!</h4>
                        </div>
                        There are some problems with your input.
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    @if (session('error'))
                    <div class="alert alert-danger">{{ session('error') }}</div>
                    @endif

                    <div class="mb-3">
                        <label class="form-label">Name</label>
                        <input type="text" class="form-control" name="name" value="{{ old('name') }}" placeholder="Name">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">description</label>
                        <input type="text" class="form-control" name="description" value="{{ old('description') }}" placeholder="description">
                    </div>
                    <div class="mb-3">
                        <label for="formFile" class="form-label">Image</label>
                        <input class="form-control" type="file" name="image" id="formFile">
                    </div>
                    <div class="form-group">
                        <label for="category">Category</label>
                        <select name="category_id" id="category" class="form-control">
                            <option value="">Select a Category</option>
                            @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="card-footer">
                    <button class="btn btn-primary" type="submit">Create</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection