@extends('layouts.authorizedQuote')
@section('content')


<!-- Breadcrumb Area -->
<div class="breadcrumb-area">
    <h1>Dashboard</h1>

    <ol class="breadcrumb">
        <li class="item"><a href="{{ route('User.Dashboard') }}"><i class='bx bx-home-alt'></i></a></li>

        <li class="item">Edit Sidebar Option</li>
    </ol>
</div>
<!-- End Breadcrumb Area -->

<div class="container mb-5">
    <h1>Edit Sidebar</h1>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert" id="success-message">
            {{ session('success') }}
            <span type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></span>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert" id="error-message">
            {{ session('error') }}
            <span type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></span>
        </div>
    @endif
    

    <!-- Form to Add New Sidebar Option -->
    <form action="{{ route('sidebar-options.update', $sidebarOptions->id) }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">Option Name</label>
            <input type="text" name="name" id="name" class="form-control" value="{{$sidebarOptions->name}}">
        </div>
        <button type="submit" class="btn btn-primary">Update Option</button>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var successMessage = document.getElementById('success-message');
        var successMessage = document.getElementById('error-message');
        if (successMessage) {
            setTimeout(function() {
                successMessage.classList.remove('show');
                successMessage.classList.add('fade');
            }, 9000); // 3000 milliseconds = 3 seconds
        }
    });
</script>

@endsection
