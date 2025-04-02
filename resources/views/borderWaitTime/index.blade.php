@extends('layouts.authorized')

@section('content')

<style>
    .title-h2 {
    font-family: oswald, sans-serif;
    color: #233366;
    margin-top: 0;
    font-weight: bold;
    line-height: 1.2;
    letter-spacing: -.3px;
    text-transform: uppercase;
    }
</style>
<div class="container mt-5">
  <div class="row">
    <!-- First Box -->
    <div class="col-md-6">
      <div class="card">
        <div class="card-body">
          <h2 class="title-h2 text-center">Canada border wait time</h2>
          <!-- Your content goes here -->
          <!--<img src="your_image_url.jpg" class="img-fluid mx-auto d-block" alt="Image">-->
          <img class="img-fluid mx-auto d-block" src="{{ asset('frontend/img/flag/flag-canada.webp') }}"  width="70%" alt="canada-flag">
          <a href="https://www.cbsa-asfc.gc.ca/bwt-taf/menu-eng.html" target="_blank"> <button  class="btn btn-primary mt-3 bg-danger border-danger w-100 ">View Canada</button> </a>
        </div>
      </div>
    </div> 

    <!-- Second Box -->
    <div class="col-md-6">
      <div class="card">
        <div class="card-body">
          <h2 class="title-h2 text-center">USA border wait time</h2>
          <!-- Your content goes here -->
          <img src="{{ asset('frontend/img/flag/american-flag-background.webp') }}" class="img-fluid mx-auto d-block "  width="70%" alt="american-img">
          <a href="https://bwt.cbp.gov/" target="_blank"> <button class="btn btn-primary mt-3 bg-danger border-danger w-100 ">View American</button> </a> 
        </div>
      </div>
    </div>
  </div>
</div>












@endsection