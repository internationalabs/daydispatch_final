@extends('layouts.authorizedQuote')
@section('content')

<!-- Breadcrumb Area -->
<div class="breadcrumb-area">
    <h1>Dashboard</h1>

    <ol class="breadcrumb">
        <li class="item"><a href="{{ route('User.Dashboard') }}"><i class='bx bx-home-alt'></i></a></li>

        <li class="item">Order Form Setting</li>
    </ol>
</div>
<!-- End Breadcrumb Area -->

<div class="container-flude mb-5">
    {{-- <h1>Order Form Setting</h1> --}}
    <h4 class="text-white py-2 d-flex justify-content-center" 
    style="background: #113771;"><i class="bi bi-hash mr-2"></i> Order Form Setting</h4>

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

    <form action="{{ route('order_form_settings.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row mb-4">
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="company_name">Company Name</label>
                    <input type="text" class="form-control" id="company_name" name="company_name" required>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="logo">Logo</label>
                    <input type="file" class="form-control" id="logo" name="logo" onchange="previewLogo()">
                </div>
                <!-- Preview Image Section -->
                <div class="form-group mt-3">
                    <img id="logo-preview" src="#" alt="Logo Preview" style="display: none; width: 50px; height: 50px;">
                </div>
            </div>
            <div class="col-sm-12">
                <div class="form-group">
                    <label for="terms_condition">Terms & Conditions</label>
                    <textarea class="form-control" id="terms_condition" name="terms_condition" rows="3" required></textarea>
                </div>
            </div>
            <div class="col-sm-12 d-flex justify-content-center">
                <button type="submit" class="btn btn-primary text-center">Submit</button>
            </div>
        </div>
    </form>

    <!-- Table to Display Posted Data -->
    <div class="mt-5">
        {{-- <h2>Submitted Order Form Settings</h2> --}}
        <h4 class="text-white py-2 d-flex justify-content-center" 
        style="background: #113771;">
        <i class="bi bi-hash mr-2"></i> Submitted Order Form Settings</h4>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Company Name</th>
                    <th>Terms & Conditions</th>
                    <th>Logo</th>
                </tr>
            </thead>
            <tbody>
                @foreach($settings as $setting)
                    <tr>
                        <td>{{ $setting->company_name }}</td>
                        <td>{{ $setting->terms_condition }}</td>
                        <td>
                            @if($setting->logo)
                                <img src="{{ asset($setting->logo) }}" alt="Logo" style="width: 50px; height: 50px;">
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var successMessage = document.getElementById('success-message');
        var errorMessage = document.getElementById('error-message');
        if (successMessage || errorMessage) {
            setTimeout(function() {
                if (successMessage) successMessage.classList.remove('show');
                if (errorMessage) errorMessage.classList.remove('show');
                successMessage.classList.add('fade');
                errorMessage.classList.add('fade');
            }, 3000); // 3000 milliseconds = 3 seconds
        }
    });

    function previewLogo() {
        var file = document.getElementById("logo").files[0];
        var reader = new FileReader();

        reader.onload = function (e) {
            var preview = document.getElementById("logo-preview");
            preview.src = e.target.result;
            preview.style.display = 'block';
        };

        if (file) {
            reader.readAsDataURL(file);
        }
    }
</script>

<script>
$(function(){
    $(document).on('click','#delete',function(e){
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
                    window.location.href = link
                    Swal.fire(
                    'Deleted!',
                    'Your file has been deleted.',
                    'success'
                    )
                }
            })
    });

});
</script>

@endsection
