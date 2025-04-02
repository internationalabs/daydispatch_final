{{-- <style>
    .search-button {
        height: 32px;
        border: 1px solid #80808057;
        background: #1f2e63;
        color: white;
        font-weight: 700;
        padding: 0px 13px;
        border-radius: 5px;
        transition: 0.3s ease-in-out;
    }

    .search-button:hover {

        background: white;
        color: #1f2e63;

    }
    .input-style {
        /*background-color: #74a3d5;*/
        background-color: grey;
        border-radius: 9px;
        padding: 20px 25px;
        margin-top: 20px;
        margin-bottom: 30px;
    }
    .input-style.container form div label {
    font-size: 17px;
    font-weight: 700;
    color: white; 
}
</style> --}}
<style>
    .global-search-area {
    position: relative;
    z-index: 1;
    background: #f6f7fb;
    }
    /* .global-search-area.bg-image {
        background-image: url(../../frontend/img/slider-3.webp);
        background-position: center center;
        background-size: cover;
        background-repeat: no-repeat;
        border-radius: 50px;
        overflow: hidden;
    } */
    .global-search-area .d-table {
        width: 100%;
        height: 100%;
    }
    .global-search-area .d-table-cell {
        vertical-align: middle;
    }
    .global-search-area .search-form {
        max-width: 1300px;
        background: #ffffff;
        border-radius: 30px;
        overflow: hidden;
        text-align: center;
        padding: 20px 20px;
        box-shadow: 1px 5px 24px 0 rgba(68, 102, 242, 0.05);
        margin: 20px auto;
    }
    .global-search-area .search-form h2 {
        font-size: 30px;
        font-weight: 700;
        margin-top: 30px;
        margin-bottom: 0;
    }
    .global-search-area .search-form form {
        margin-top: 25px;
        display: flex;
        flex-wrap: wrap;
        gap: 20px;
        justify-content: center;
    }
    .global-search-area .search-form form .form-group {
        flex: 1;
        min-width: 200px;
        margin-bottom: 20px;
        position: relative;
    }
    .global-search-area .search-form form .form-group .label-title {
        margin-bottom: 0;
        position: absolute;
        display: block;
        left: 0;
        top: 0;
        pointer-events: none;
        width: 100%;
        height: 100%;
        color: #2a2a2a;
    }
    .global-search-area .search-form form .form-group .label-title i {
        position: absolute;
        left: 0;
        transition: 0.5s;
        top: 9px;
        font-size: 22px;
    }
    .global-search-area .search-form form .form-group .label-title::before {
        content: "";
        display: block;
        position: absolute;
        bottom: 0;
        left: 0;
        width: 0;
        height: 2px;
        transition: 0.5s;
        background: #e1000a;
    }
    .global-search-area .search-form form .form-group .form-control {
        border-radius: 0;
        border: none;
        border-bottom: 2px solid #adadad;
        padding: 0 0 0 32px;
        color: #2a2a2a;
        height: 45px;
        transition: 0.5s;
        font-family: "Nunito", sans-serif;
        font-size: 17px;
        font-weight: 500;
    }
    .global-search-area .search-form form .form-group .form-control::placeholder {
        color: #A1A1A1;
        transition: 0.5s;
    }
    .global-search-area .search-form form .form-group .form-control:focus {
        padding-left: 5px;
    }

    .global-search-area .search-form form .form-group .form-control:focus::placeholder {
        color: transparent;
    }
    .global-search-area .search-form form .form-group .form-control:focus + .label-title::before {
        width: 100%;
    }
    .global-search-area .search-form form .form-group .form-control:focus + .label-title {
        color: #A1A1A1;
    }
    .global-search-area .search-form form .form-group .form-control:focus + .label-title i {
        top: -22px;
    }
    .global-search-area .search-form form .search-btn {
        height: 45px;
        padding: 0px 30px;
        border-radius: 30px;
        border: none;
        text-transform: uppercase;
        transition: 0.5s;
        background-color: #012862;
        color: #ffffff;
        font-size: 15px;
        font-weight: 700;
        flex: 0 0 auto;
    }
    .global-search-area .search-form form .search-btn:hover,
    .global-search-area .search-form form .search-btn:focus {
        background-color: #000b33;
        color: #ffffff;
    }
</style>

<div class="global-search-area  mx-5 mb-3 z-0">
  <div class="d-table">
    <div class="d-table-cell">
      <div class="search-form">
        <h2>Global Search</h2>
        <form action="{{ route('quote.global.search') }}" method="GET">
          <div class="form-group">
            <select name="search_criteria" id="search_criteria" class="form-control">
                <option value="1" {{ request()->input('search_criteria') == 1 ? 'selected' : '' }}>Order ID</option>
                <option value="2" {{ request()->input('search_criteria') == 2 ? 'selected' : '' }}>Pickup City</option>
                <option value="3" {{ request()->input('search_criteria') == 3 ? 'selected' : '' }}>Pickup State</option>
                <option value="10" {{ request()->input('search_criteria') == 10 ? 'selected' : '' }}>Pickup Zipcode</option>
                <option value="4" {{ request()->input('search_criteria') == 4 ? 'selected' : '' }}>Delivery City</option>
                <option value="5" {{ request()->input('search_criteria') == 5 ? 'selected' : '' }}>Delivery State</option>
                <option value="11" {{ request()->input('search_criteria') == 11 ? 'selected' : '' }}>Delivery Zipcode</option>
                <option value="6" {{ request()->input('search_criteria') == 6 ? 'selected' : '' }}>Vin Number</option>
                <option value="7" {{ request()->input('search_criteria') == 7 ? 'selected' : '' }}>Vehicle</option>
                <option value="8" {{ request()->input('search_criteria') == 8 ? 'selected' : '' }}>Customer Name</option>
                <option value="9" {{ request()->input('search_criteria') == 9 ? 'selected' : '' }}>Customer Email</option>
                <option value="12" {{ request()->input('search_criteria') == 12 ? 'selected' : '' }}>Customer Phone</option>
            </select>
            <span class="label-title"><i class='bx bx-user'></i></span>
          </div>
          <div class="form-group">
            {{-- <input type="text" class="form-control" placeholder="Input Field 1" /> --}}
            <input type="text" name="search_query" placeholder="Search" id="search_query" class="form-control"
                    value="{{ old('search_query', request()->input('search_query')) }}" style="">
            <span class="label-title"><i class='bx bx-user'></i></span>
          </div>
          <div class="form-group">
            <select class="form-control ml-1" id="Search_vehicleType" name="Search_vehicleType">
                <option value="">Select Vehicle Type</option>
                <option value="heavy_equipments"
                    {{ request()->input('Search_vehicleType') == 'heavy_equipments' ? 'selected' : '' }}>Heavy
                    Equipments
                </option>
                <option value="vehicles"
                    {{ request()->input('Search_vehicleType') == 'vehicles' ? 'selected' : '' }}>
                    Vehicles(Autos)</option>
                <option value="dry_vans"
                    {{ request()->input('Search_vehicleType') == 'dry_vans' ? 'selected' : '' }}>
                    Freight Shipping</option>
            </select>
            <span class="label-title"><i class='bx bx-user'></i></span>
          </div>
          <div class="form-group">
            <select class="form-control ml-1" id="Time_Frame" name="Time_Frame">
                <option value="" selected>EveryThing</option>
                <option value="2" {{ request()->input('Time_Frame') == '2' ? 'selected' : '' }}>03 Months
                </option>
                <option value="3" {{ request()->input('Time_Frame') == '3' ? 'selected' : '' }}>06 Months
                </option>
                <option value="4" {{ request()->input('Time_Frame') == '4' ? 'selected' : '' }}>01 Year
                </option>
                <option value="5" {{ request()->input('Time_Frame') == '5' ? 'selected' : '' }}>03 Years
                </option>
            </select>
            <span class="label-title"><i class='bx bx-user'></i></span>
          </div>
          <button type="submit" class="search-btn">Search</button>
        </form>
      </div>
    </div>
  </div>
</div>  
{{-- <div class="input-style container">
    <form action="{{ route('quote.global.search') }}" method="GET">
        <div class="row align-items-end">
            <div class="col-3">
                <label for="search_criteria">Search Criteria:</label>
                <select name="search_criteria" id="search_criteria" class="form-control">
                    <option value="1" {{ request()->input('search_criteria') == 1 ? 'selected' : '' }}>Order ID</option>
                    <option value="2" {{ request()->input('search_criteria') == 2 ? 'selected' : '' }}>Pickup City</option>
                    <option value="3" {{ request()->input('search_criteria') == 3 ? 'selected' : '' }}>Pickup State</option>
                    <option value="10" {{ request()->input('search_criteria') == 10 ? 'selected' : '' }}>Pickup ZipCode</option>
                    <option value="4" {{ request()->input('search_criteria') == 4 ? 'selected' : '' }}>Delivery City</option>
                    <option value="5" {{ request()->input('search_criteria') == 5 ? 'selected' : '' }}>Delivery State</option>
                    <option value="11" {{ request()->input('search_criteria') == 11 ? 'selected' : '' }}>Delivery ZipCode</option>
                    <option value="6" {{ request()->input('search_criteria') == 6 ? 'selected' : '' }}>vin number</option>
                    <option value="7" {{ request()->input('search_criteria') == 7 ? 'selected' : '' }}>Vehicle</option>
                    <option value="8" {{ request()->input('search_criteria') == 8 ? 'selected' : '' }}>Customer Name</option>
                    <option value="9" {{ request()->input('search_criteria') == 9 ? 'selected' : '' }}>Customer Email</option>
                    <option value="12" {{ request()->input('search_criteria') == 12 ? 'selected' : '' }}>Customer Phone</option>
                </select>
            </div>
            <div class="col-3">
                <label for="search_query">Search:</label>
                <input type="text" name="search_query" id="search_query" class="form-control"
                    value="{{ old('search_query', request()->input('search_query')) }}" style="">
            </div>
            <div class="col-2">
                <label for="Search Vehicle" class="text-left">Search Vehicle Type:</label>
                <select class="form-control ml-1" id="Search_vehicleType" name="Search_vehicleType">
                    <option value="">Select Vehicle Type</option>
                    <option value="heavy_equipments"
                        {{ request()->input('Search_vehicleType') == 'heavy_equipments' ? 'selected' : '' }}>Heavy
                        Equipments
                    </option>
                    <option value="vehicles"
                        {{ request()->input('Search_vehicleType') == 'vehicles' ? 'selected' : '' }}>
                        Vehicles(Autos)</option>
                    <option value="dry_vans"
                        {{ request()->input('Search_vehicleType') == 'dry_vans' ? 'selected' : '' }}>
                        Freight Shipping</option>
                </select>
            </div>
            <div class="col-2">
                <label for="Time Frame" class="text-left">Time Frame:</label>
                <select class="form-control ml-1" id="Time_Frame" name="Time_Frame">
                    <option value="" selected>EveryThing</option>
                    <option value="2" {{ request()->input('Time_Frame') == '2' ? 'selected' : '' }}>03 Months
                    </option>
                    <option value="3" {{ request()->input('Time_Frame') == '3' ? 'selected' : '' }}>06 Months
                    </option>
                    <option value="4" {{ request()->input('Time_Frame') == '4' ? 'selected' : '' }}>01 Year
                    </option>
                    <option value="5" {{ request()->input('Time_Frame') == '5' ? 'selected' : '' }}>03 Years
                    </option>
                </select>
            </div>
            <div class="col-2 align-items-center">
                <button type="submit" class="search-button w-100" style="height: 40px;">Search</button>
            </div>
        </div>
    </form>
</div> --}}