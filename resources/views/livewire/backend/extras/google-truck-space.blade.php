<!-- Breadcrumb Area -->
<div class="breadcrumb-area">
    <h1>Truck Space</h1>

    <ol class="breadcrumb">
        <li class="item"><a href="{{ route('User.Dashboard') }}"><i class='bx bx-home-alt'></i></a></li>
        <li class="item">Search Truck Space</li>
    </ol>

</div>
<!-- End Breadcrumb Area -->
<style>
    #map {
        height: 700px;
    }
</style>

<div class="card">
    <div class="card-body">
        <div id="map"></div>

        <div class="row justify-content-center">
            <div class="col-3">
                <a href="{{ route('View.MyTrucks') }}"
                   class="btn btn-danger btn-block my-3">
                    <span>View All Truck's</span>
                </a>
            </div>
            <div class="col-3">
                <a href="{{ route('View.TruckSpace') }}"
                   class="btn btn-danger btn-block my-3">
                    <span>My All Truck's</span>
                </a>
            </div>
            <div class="col-3">
                <a data-toggle="modal"
                   data-target="#AddTruckSpace" href="javascript:void(0);"
                   class="btn btn-danger btn-block my-3">
                    <span>Add New Truck Space</span>
                </a>
            </div>
        </div>
    </div><!-- end card-body -->
</div><!-- end card -->

<script type="text/javascript">
    function initMap() {
        const myLatLng = {lat: 37.0902, lng: -95.7129};
        const map = new google.maps.Map(document.getElementById("map"), {
            zoom: 5,
            center: myLatLng,
        });

        var locations = {{ Js::from($locations) }};

        var infowindow = new google.maps.InfoWindow();
        var marker, i;

        for (i = 0; i < locations.length; i++) {
            marker = new google.maps.Marker({
                position: new google.maps.LatLng(locations[i][1], locations[i][2]),
                map: map
            });

            google.maps.event.addListener(marker, 'click', (function (marker, i) {
                return function () {
                    infowindow.setContent(locations[i][0]);
                    infowindow.open(map, marker);
                }
            })(marker, i));
        }
    }
    window.initMap = initMap;
</script>

<script type="text/javascript"
        src="https://maps.google.com/maps/api/js?key={{ env('GOOGLE_MAP_KEY') }}&callback=initMap"></script>

