<!-- start page title -->

<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0">Dashboard</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="{{ route('Admin.Dashboard') }}" >Dashboard</a></li>
                    <li class="breadcrumb-item">All Companies</li>
                </ol>
            </div>

        </div>
    </div>
</div>

<script>
   
</script>
<!-- end page title -->

<div class="card">
    <div class="card-header">
        <div class="d-flex justify-content-center">
            <h4>All Companies</h4>
        </div>
    </div>
</div>
<div class="card">
    <div class="card-body">
        <div class="d-flex justify-content-center">
            <a class="btn btn-primary" href="{{ route('Admin.Carriers') }}"
                <span class="align-middle" data-key="t-logout">
                    Carriers
                </span>
            </a>
        </div><br>
        <div class="d-flex justify-content-center">
            <a class="btn btn-primary" href="{{ route('Admin.Logistic.Carrier') }}">
                <span class="align-middle" data-key="t-logout">
                    Logistic Carriers
                </span>
            </a>
        </div><br>
        <div class="d-flex justify-content-center">
            <a class="btn btn-primary" href="{{ route('Admin.Logistic.Shippers') }}">
                <span class="align-middle" data-key="t-logout">
                    Logistic Shippers
                </span>
            </a>
        </div><br>
        <div class="d-flex justify-content-center">
            <a class="btn btn-primary" href="{{ route('Admin.Logistic.Broker') }}">
                <span class="align-middle" data-key="t-logout">
                    Logistic Brokers
                </span>
            </a>    
        </div>
    </div>
</div>
