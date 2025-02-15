@extends('image.layout')

@section('content')
<!-- DataTables CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">

<!-- jQuery (required for DataTables) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- DataTables JavaScript -->
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>

<div class="card mt-5">
    <div class="card-header">
        <h3>List Images</h3>
        @auth
        <form action="{{ route('logout') }}" method="POST" class="text-end">
            @csrf
            <button type="submit" class="btn btn-danger">Logout</button>
        </form>
        @endauth
    </div>
    <div class="card-body">
        @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
        @endif
        <p>
            <a class="btn btn-primary" href="{{ route('image.create') }}">New Images</a>
        </p>
        <table class="table table-striped table-bordered" id="productTable">
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Category</th>
                    <th>Url</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($images as $product)
                <tr>
                    <td><img src="{{ asset($product->image) }}" class="img-thumbnail" style="width:200px" /></td>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->description }}</td>
                    <td>{{ $product->category->category_name }}</td>
                    <td>{{ asset($product->image) }}</td>
                    <td>
                        <button class="btn btn-success btn-sm" onclick="copyToClipboard('{{ asset($product->image) }}')" role="button">Copy URL</button>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6">
                        No record found!
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>

    </div>
</div>
<script>
    $(document).ready(function() {
        // Initialize DataTables
        $('#productTable').DataTable();
    });
</script>
<script>
    function copyToClipboard(url) {
        // Create a temporary input element to hold the URL
        const tempInput = document.createElement('input');
        tempInput.value = url;
        document.body.appendChild(tempInput);

        // Select the text
        tempInput.select();
        tempInput.setSelectionRange(0, 99999); // For mobile devices

        // Copy the selected text to the clipboard
        document.execCommand('copy');

        // Remove the temporary input element from the DOM
        document.body.removeChild(tempInput);

        // Optional: Show an alert or notification
        alert('URL copied to clipboard!');
    }
</script>
@endsection