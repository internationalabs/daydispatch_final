@extends('layouts.authorizedQuote')
@section('content')

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- Breadcrumb Area -->
<div class="breadcrumb-area">
    <h1>Dashboard</h1>

    <ol class="breadcrumb">
        <li class="item"><a href="{{ route('User.Dashboard') }}"><i class='bx bx-home-alt'></i></a></li>
        <li class="item">Add New Sidebar Option</li>
    </ol>
</div>

<div class="container mb-5">
    <h1>Add New Sidebar Option</h1>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert" id="success-message">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert" id="error-message">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <form action="{{ route('sidebar-options.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">Option Name</label>
            <input type="text" name="name" id="name" class="form-control" placeholder="Option Name" required>
        </div>
        <button type="submit" class="btn btn-primary">Add Option</button>
    </form>

    <h2 class="mt-4">Sidebar Options List</h2>
    <table class="table table-striped mt-3">
        <thead>
            <tr>
                <th>Name</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($sidebarOptions as $option)
                <tr>
                    <td>{{ $option->name }}</td>
                    <td>
                        <a href="{{ route('sidebar-options.edit', $option->id) }}" class="btn btn-primary btn-sm">Edit</a>
                        <a href="{{ route('sidebar-options.delete', $option->id) }}" id="delete" class="btn btn-danger btn-sm">Delete</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var successMessage = document.getElementById('success-message');
        var errorMessage = document.getElementById('error-message');
        
        if (successMessage) {
            successMessage.classList.add('show');
        }
        if (errorMessage) {
            errorMessage.classList.add('show');
        }
    });
</script>

<script>
    $(function(){
        $(document).on('click', '#delete', function(e){
            e.preventDefault();
            var link = $(this).attr("href");

            Swal.fire({
                title: 'Are you sure?',
                text: "Delete This Data?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = link;
                    Swal.fire(
                        'Deleted!',
                        'Your file has been deleted.',
                        'success'
                    )
                }
            });
        });
    });
</script>

@endsection
