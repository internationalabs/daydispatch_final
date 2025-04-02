@php
    use Illuminate\Support\Facades\Auth;
    $currentUser = Auth::guard('Authorized')->user();
@endphp
<style>
    .truck-footer {
        position: relative;
        overflow: hidden;
    }

    .truck-container {
        position: absolute;
        bottom: 20px;
        /* Adjust based on your footer height */
        left: -100px;
        animation: moveTruck 10s linear infinite;
    }

    .truck-icon {
        font-size: 48px;
        /* Adjust the size of the truck */
        color: #e02f35;
    }

    @keyframes moveTruck {
        0% {
            left: -100px;
        }

        100% {
            left: 100%;
        }
    }

    #ratings .svg-inline--fa {
        height: auto !important;
    }

    .headercontract div {
        padding: 4px 17px;
        border-radius: 6px;
        font-size: 16px;
        background: #ffffff;
        width: fit-content;
        color: #e02f35;
        font-weight: 700;
        margin: 9px 16px;
    }

    .headercontract {
        background: #1e2e62;
        margin-bottom: 10px;
        border-radius: 4px;
        /*padding: 7px;*/
    }

    .card.showcard {
        box-shadow: 1px 5px 24px 0 rgb(136 135 163 / 35%);
        margin-bottom: 8px;
        min-height: 159px;
        margin-top: 10px;
    }

    .card.showcard p {
        min-height: 38px;
        line-height: 1.1;
        margin-top: 8px;
    }

    .card.showcard i {
        color: red;
        font-size: 26px;
        margin-left: 7px;
    }

    .card.showcard button {
        padding: 6px 18px;
        background: #ffffff;
        color: #001d4d;
        border: 0;
        border-radius: 2px;
        box-shadow: 1px 0px 11px 0 rgb(255 0 0 / 11%);
    }

    .card.showcard .crosss {
        text-align: right;
        font-size: 16px;
        width: 100%;
    }

    .card.showcard .crosss span {
        padding: 4px 9px;
        color: white;
        box-shadow: 1px 5px 24px 0 rgb(136 135 163 / 35%);
        border-radius: 3px;
        background: red;
        cursor: pointer;
    }

    .card.showcard button:nth-child(2) {
        color: red;
    }

    #areYouSureDelete .modal-dialog.modal-xl {
        max-width: 456px;
    }

    #areYouSureDelete .buttons button {
        font-size: 15px;
        font-weight: 700;
        padding-left: 25px;
        padding-right: 25px;
        padding-top: 12px;
        padding-bottom: 12px;
        background: red;
        border: 0;
        border-radius: 4px;
        width: 100%;
        color: white;
    }

    #areYouSureDelete .card svg {
        font-size: 39px;
        margin-top: -16px;
        color: red;
    }

    #areYouSureDelete p {
        text-align: center;
        font-size: 20px;
        font-weight: 700;
    }

    .profile-image {
    position: relative;
    display: inline-block;
}

.upload-profile-photo {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    background: rgba(0, 0, 0, 0.5);
    border-radius: 50%;
    opacity: 0;
    transition: opacity 0.3s;
}

.upload-profile-photo:hover {
    opacity: 1;
}

.profile-full-input {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    opacity: 0;
    cursor: pointer;
}


    @keyframes ripple {
        0% {
            transform: scale(0, 0);
            opacity: 1;
        }

        25% {
            transform: scale(30, 30);
            opacity: 1;
        }

        100% {
            opacity: 0;
            transform: scale(50, 50);
        }
    }
</style>
<div class="breadcrumb-area mb-0">
    <h1>My Profile</h1>
    <ol class="breadcrumb">
        <li class="item"><a href="{{ route('User.Dashboard') }}"><i class='bx bx-home-alt'></i></a></li>
        <li class="item">My Profile</li>
    </ol>
</div>
<form class="was-validated" method="POST"
    action="{{ route('User.Profile.Update') }}" enctype="multipart/form-data">
    @csrf
    <section class="profile-area">
        <div class="profile-header mb-30">
            <div class="user-profile-images">
                
                {{-- Cover Photo --}}
                <img id="cover-image-preview" src="{{ $currentUser->cover_photo ? url($currentUser->cover_photo) : asset('frontend/img/cover_banner.jpg') }}" alt="image" class="cover-image">
                <div class="upload-cover-photo text-white ">
                    <i class="bx bx-camera"></i> <span>Update</span>
                    <input type="file" class="custom-file-input" id="cover-image-input" name="Cover_Image" accept="image/*">
                </div>

                {{-- Profile Photo --}}
                <div class="profile-image">
                    <img id="profile-image-preview" src="{{ $currentUser->profile_photo_path ? url($currentUser->profile_photo_path) : asset('backend/img/avatar.webp') }}" alt="image">
                
                    <div class="upload-profile-photo text-white">
                        <input type="file" class="custom-file-input profile-full-input" id="profile-image-input" name="Profile_Image" accept="image/*">
                        <i class="bx bx-camera"></i> <span>&nbsp Update</span>
                    </div>
                </div>

                <div class="user-profile-text">
                    <h3>{{ \Illuminate\Support\Str::limit($currentUser->Company_Name, $limit = 21, '...') }}</h3>
                    <span class="d-block">Developer</span>
                </div>
            </div>
            {{-- <div class="profile-header"> --}}
                <div class="user-profile-nav">
                    <ul class="nav nav-tabs" role="tablist">

                        <li class="nav-item">
                            <a class="nav-link active" id="settings-tab" data-toggle="tab" href="#settings" role="tab"
                                aria-controls="settings" aria-selected="false">Edit Profile</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" id="about-tab" data-toggle="tab" href="#about" role="tab"
                                aria-controls="about" aria-selected="false">My Profile</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" id="documents-tab" data-toggle="tab" href="#documents" role="tab"
                                aria-controls="documents" aria-selected="false">My Documents</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" id="contract-tab" data-toggle="tab" href="#contract" role="tab"
                                aria-controls="contract" aria-selected="false">My Contracts</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" id="address-tab" data-toggle="tab" href="#address" role="tab"
                                aria-controls="address" aria-selected="false">My Address Book</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" id="network-tab" data-toggle="tab" href="#network" role="tab"
                                aria-controls="network" aria-selected="false">My Network</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" id="notification-tab" data-toggle="tab" href="#notification" role="tab"
                                aria-controls="notification" aria-selected="false">Notifications</a>
                        </li>
                    </ul>
                </div>
            {{-- </div> --}}
        </div>
        <div class="container-flude">
            <div class="row">
                <div class="col-lg-12">
                    <div class="tab-content">

                        <div class="tab-pane fade p-3 show active" id="settings" role="tabpanel"
                            aria-labelledby="settings-tab">
                            <div class="container-flude">
                                <div class="card user-settings-box mb-30">
                                    <div class="card-body">
                                        

                                            {{-- <h4 class="text-white py-2 d-flex justify-content-center"
                                                style="background: #113771;border-radius: 25px 25px 0px 0px;">
                                                Account Information
                                            </h4>
                                            <div class="row">
                                                <div class="col-lg-3">
                                                    <div class="form-group">
                                                        <label>User Name*</label>
                                                        <input type="text" class="form-control" name="User_Name"
                                                            placeholder="Enter User Name"
                                                            value="{{ $User_Info->name ? $User_Info->name : '' }}" required>
                                                        <div class="invalid-feedback">
                                                            Entered UserName.
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-lg-3">
                                                    <div class="form-group">
                                                        <label>Email Address*</label>
                                                        <input readonly type="email" class="form-control"
                                                            value="{{ $User_Info->email }}" name="User_Email" required>
                                                    </div>
                                                </div>

                                                <div class="col-lg-3">
                                                    <div class="form-group">
                                                        <label>Local Phone</label>
                                                        <input type="text" class="form-control phone-number"
                                                            placeholder="Local Phone Number" name="Local_Phone"
                                                            value="{{ $User_Info->Local_Phone ? $User_Info->Local_Phone : '' }}"
                                                            required>
                                                        <div class="invalid-feedback">
                                                            Entered Local Phone.
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-lg-3">
                                                    <div class="form-group">
                                                        <label>Toll Free</label>
                                                        <input type="text" class="form-control phone-number"
                                                            placeholder="Toll Free Number" name="Toll_Free"
                                                            value="{{ $User_Info->Toll_Free ?: '' }}">
                                                        <div class="invalid-feedback">
                                                            Entered Toll Free.
                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="col-lg-3">
                                                    <div class="form-group">
                                                        <label>Fax Phone</label>
                                                        <input type="text" class="form-control phone-number"
                                                            placeholder="Fax Phone Number" name="Fax_Phone"
                                                            value="{{ $User_Info->Fax_Phone ?: '' }}">
                                                        <div class="invalid-feedback">
                                                            Entered Fax Phone.
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-lg-3">
                                                    <div class="form-group">
                                                        <label>Dispatch Phone*</label>
                                                        <input type="text" class="form-control phone-number"
                                                            placeholder="Dispatch Phone Number"
                                                            value="{{ $User_Info->Dispatch_Phone ?: '' }}"
                                                            name="Dispatch_Phone" required>
                                                        <div class="invalid-feedback">
                                                            Entered Dispatch Phone.
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-lg-3">
                                                    <div class="form-group">
                                                        <label>Contact Preferred Method*</label>
                                                        <select class="custom-select" name="Contact_Method" required>
                                                            <option value="">Select AnyOne</option>
                                                            <option @if ($User_Info->Contact_Method == 'Any') selected @endif
                                                                value="Any">Any</option>
                                                            <option @if ($User_Info->Contact_Method == 'Phone') selected @endif
                                                                value="Phone">Phone</option>
                                                            <option @if ($User_Info->Contact_Method == 'Fax') selected @endif
                                                                value="Fax">Fax</option>
                                                            <option @if ($User_Info->Contact_Method == 'Email') selected @endif
                                                                value="Email">Email</option>
                                                        </select>
                                                        <div class="invalid-feedback">Select Contact Method</div>
                                                    </div>
                                                </div>

                                                <div class="col-lg-3">
                                                    <div class="form-group">
                                                        <label>Website URL</label>
                                                        <input type="url" class="form-control"
                                                            placeholder="Website Url" name="Website_URL"
                                                            value="{{ $User_Info->Website_Url ?: '' }}">
                                                        <div class="invalid-feedback">
                                                            Entered Website URL.
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-lg-3">
                                                    <div class="form-group">
                                                        <label>Time Zone*</label>
                                                        <select class="custom-select" name="Time_Zone" required>
                                                            <option value="">Select AnyOne</option>
                                                            <option value="OTH" @if ($User_Info->Time_Zone == 'OTH') selected @endif>OTH</option>
                                                            <option value="Pacific Standard Time (PST)" @if ($User_Info->Time_Zone == 'Pacific Standard Time (PST)') selected @endif>Pacific Standard Time (PST)</option>
                                                            <option value="Mountain Standard Time (MST)" @if ($User_Info->Time_Zone == 'Mountain Standard Time (MST)') selected @endif>Mountain Standard Time (MST)</option>
                                                            <option value="Central Standard Time (CST" @if ($User_Info->Time_Zone == 'Central Standard Time (CST') selected @endif>Central Standard Time (CST)</option>
                                                            <option value="Eastern Standard Time (EST)" @if ($User_Info->Time_Zone == 'Eastern Standard Time (EST)') selected @endif>Eastern Standard Time (EST)</option>
                                                            <option value="Alaska Standard Time (AKST)" @if ($User_Info->Time_Zone == 'Alaska Standard Time (AKST)') selected @endif>Alaska Standard Time (AKST)</option>
                                                            <option value="Hawaii-Aleutian Standard Time (HAST)" @if ($User_Info->Time_Zone == 'Hawaii-Aleutian Standard Time (HAST)') selected @endif>Hawaii-Aleutian Standard Time (HAST)</option>
                                                            <option value="Newfoundland Standard Time (NST)" @if ($User_Info->Time_Zone == 'Newfoundland Standard Time (NST)') selected @endif>Newfoundland Standard Time (NST)</option>
                                                            <option value="Other" @if ($User_Info->Time_Zone == 'Other') selected @endif>Other</option>
                                                        </select>
                                                        <div class="invalid-feedback">
                                                            Select Any Time Zone.
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-lg-3">
                                                    <div class="form-group">
                                                        <label>Hours Of Operation*</label>
                                                        <input type="text" class="form-control"
                                                            placeholder="Hours Of Operation" name="Hours_Operations"
                                                            value="{{ $User_Info->Hours_Operations ?: '' }}" required>
                                                        <div class="invalid-feedback">
                                                            Entered Hours Of Operation.
                                                        </div>
                                                    </div>
                                                </div>

                                            </div> --}}

                                            <h4 class="text-white py-2 d-flex justify-content-center"
                                            style="background: #113771;border-radius: 25px 25px 0px 0px;">
                                            Company Information
                                        </h4>
                                        <div class="row">
                                            <div class="col-lg-3">
                                                <div class="form-group">
                                                    <label>User Name *</label>
                                                    <input type="text" class="form-control" name="User_Name"
                                                        placeholder="User Name"
                                                        value="{{ $User_Info->name ? $User_Info->name : '' }}" required>
                                                    <div class="invalid-feedback">
                                                        Entered UserName.
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-lg-3">
                                                <div class="form-group">
                                                    <label>Marketplaces</label>
                                                    <input readonly type="email" class="form-control"
                                                        value="Day Disptach">
                                                </div>
                                            </div>

                                            <div class="col-lg-3">
                                                <div class="form-group">
                                                    <label>Business Type</label>
                                                    <input type="text" class="form-control phone-number"
                                                        placeholder="Business Type" name="User_Type"
                                                        value="{{ $User_Info->usr_type ? $User_Info->usr_type : '' }}"
                                                        readonly>
                                                    <div class="invalid-feedback">
                                                        Entered Business Type.
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-lg-3">
                                                <div class="form-group">
                                                    <label>Company Name</label>
                                                    <input type="text" class="form-control phone-number"
                                                        placeholder="Company Name" name="Company_Name"
                                                        value="{{ $User_Info->Company_Name ?: '' }}">
                                                    <div class="invalid-feedback">
                                                        Entered Company Name.
                                                    </div>
                                                </div>
                                            </div>


                                            {{-- <div class="col-lg-3">
                                                <div class="form-group">
                                                    <label>Owner</label>
                                                    <input type="text" class="form-control phone-number"
                                                        placeholder="Fax Phone Number" name="Fax_Phone"
                                                        value="{{ $User_Info->name ?: '' }}">
                                                    <div class="invalid-feedback">
                                                        Entered Owner.
                                                    </div>
                                                </div>
                                            </div> --}}

                                            <div class="col-lg-3">
                                                <div class="form-group">
                                                    <label>Address</label>
                                                    <input type="text" class="form-control phone-number"
                                                        placeholder="Address"
                                                        value="{{ $User_Info->Address ?: '' }}"
                                                        name="Address" required>
                                                    <div class="invalid-feedback">
                                                        Entered Address.
                                                    </div>
                                                </div>
                                            </div>

                                            {{-- <div class="col-lg-3">
                                                <div class="form-group">
                                                    <label>Contact Preferred Method*</label>
                                                    <select class="custom-select" name="Contact_Method" required>
                                                        <option value="">Select AnyOne</option>
                                                        <option @if ($User_Info->Contact_Method == 'Any') selected @endif
                                                            value="Any">Any</option>
                                                        <option @if ($User_Info->Contact_Method == 'Phone') selected @endif
                                                            value="Phone">Phone</option>
                                                        <option @if ($User_Info->Contact_Method == 'Fax') selected @endif
                                                            value="Fax">Fax</option>
                                                        <option @if ($User_Info->Contact_Method == 'Email') selected @endif
                                                            value="Email">Email</option>
                                                    </select>
                                                    <div class="invalid-feedback">Select Contact Method</div>
                                                </div>
                                            </div> --}}

                                            <div class="col-lg-3">
                                                <div class="form-group">
                                                    <label>Website URL</label>
                                                    <input type="url" class="form-control"
                                                        placeholder="Website Url" name="Website_URL"
                                                        value="{{ $User_Info->Website_Url ?: '' }}">
                                                    <div class="invalid-feedback">
                                                        Entered Website URL.
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-lg-3">
                                                <div class="form-group">
                                                    <label>Time Zone*</label>
                                                    <select class="custom-select" name="Time_Zone" required>
                                                        <option value="">Select AnyOne</option>
                                                        <option value="OTH" @if ($User_Info->Time_Zone == 'OTH') selected @endif>OTH</option>
                                                        <option value="Pacific Standard Time (PST)" @if ($User_Info->Time_Zone == 'Pacific Standard Time (PST)') selected @endif>Pacific Standard Time (PST)</option>
                                                        <option value="Mountain Standard Time (MST)" @if ($User_Info->Time_Zone == 'Mountain Standard Time (MST)') selected @endif>Mountain Standard Time (MST)</option>
                                                        <option value="Central Standard Time (CST" @if ($User_Info->Time_Zone == 'Central Standard Time (CST') selected @endif>Central Standard Time (CST)</option>
                                                        <option value="Eastern Standard Time (EST)" @if ($User_Info->Time_Zone == 'Eastern Standard Time (EST)') selected @endif>Eastern Standard Time (EST)</option>
                                                        <option value="Alaska Standard Time (AKST)" @if ($User_Info->Time_Zone == 'Alaska Standard Time (AKST)') selected @endif>Alaska Standard Time (AKST)</option>
                                                        <option value="Hawaii-Aleutian Standard Time (HAST)" @if ($User_Info->Time_Zone == 'Hawaii-Aleutian Standard Time (HAST)') selected @endif>Hawaii-Aleutian Standard Time (HAST)</option>
                                                        <option value="Newfoundland Standard Time (NST)" @if ($User_Info->Time_Zone == 'Newfoundland Standard Time (NST)') selected @endif>Newfoundland Standard Time (NST)</option>
                                                        <option value="Other" @if ($User_Info->Time_Zone == 'Other') selected @endif>Other</option>
                                                    </select>
                                                    <div class="invalid-feedback">
                                                        Select Any Time Zone.
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-lg-3">
                                                <div class="form-group">
                                                    <label>Hours Of Operation*</label>
                                                    <input type="text" class="form-control"
                                                        placeholder="Hours Of Operation" name="Hours_Operations"
                                                        value="{{ $User_Info->Hours_Operations ?: '' }}" required>
                                                    <div class="invalid-feedback">
                                                        Entered Hours Of Operation.
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-lg-3">
                                                <div class="form-group">
                                                    <label>Year Established*</label>
                                                    <input type="text" class="form-control"
                                                        placeholder="Year Established" name="Year_Established"
                                                        value="{{ $User_Info->created_at ?: '' }}" readonly>
                                                    <div class="invalid-feedback">
                                                        Entered Year Established.
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-3">
                                                <div class="form-group">
                                                    <label>Allow Carriers to Search My Vehicles by Company Name*</label>
                                                    <input type="checkbox" class=""
                                                        name="Allow_Carrier"
                                                        value="Yes">
                                                </div>
                                            </div>

                                            {{-- <div class="col-lg-3">
                                                <label>Upload/Change Profile Picture</label>
                                                <div class="input-group mb-3">
                                                    <div class="custom-file">
                                                        <input type="file" class="custom-file-input"
                                                            name="Profile_Image" accept="image/*">
                                                        <div class="invalid-feedback">
                                                            Upload Profile Picture.
                                                        </div>
                                                        <label class="custom-file-label">Choose file</label>
                                                    </div>
                                                </div>
                                            </div> --}}
                                        </div>

                                        <h4 class="text-white py-2 d-flex justify-content-center"
                                        style="background: #113771;border-radius: 25px 25px 0px 0px;">
                                        Contact Information
                                    </h4>
                                    <div class="row">
                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <label>Dispatch Contact Person *</label>
                                                <input type="text" class="form-control" name="Dispatch_Person"
                                                    placeholder="Dispatch Contact Person"
                                                    value="{{ $User_Info->Dispatch_Contact ? $User_Info->Dispatch_Contact : 'null' }}" required>
                                                <div class="invalid-feedback">
                                                    Entered Dispatch Contact Person *
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-3">
                                                <div class="form-group">
                                                    <label>Preferred Contact Method*</label>
                                                    <select class="custom-select" name="Contact_Method" required>
                                                        <option value="">Select AnyOne</option>
                                                        <option @if ($User_Info->Contact_Method == 'Any') selected @endif
                                                            value="Any">Any</option>
                                                        <option @if ($User_Info->Contact_Method == 'Phone') selected @endif
                                                            value="Phone">Phone</option>
                                                        <option @if ($User_Info->Contact_Method == 'Fax') selected @endif
                                                            value="Fax">Fax</option>
                                                        <option @if ($User_Info->Contact_Method == 'Email') selected @endif
                                                            value="Email">Email</option>
                                                    </select>
                                                    <div class="invalid-feedback">Select Contact Method</div>
                                                </div>
                                            </div>

                                        {{-- <div class="col-lg-3">
                                            <div class="form-group">
                                                <label>Preferred Contact Method</label>
                                                <input type="text" class="form-control phone-number"
                                                    placeholder="Local Phone Number" name="Local_Phone"
                                                    value="{{ $User_Info->Contact_Method ? $User_Info->Contact_Method : '' }}"
                                                    required>
                                                <div class="invalid-feedback">
                                                    Entered Preferred Contact Method
                                                </div>
                                            </div>
                                        </div> --}}

                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <label>Listing Phone Number *</label>
                                                <input type="text" class="form-control phone-number"
                                                    placeholder="Listing Phone Number" name="Listing_Phone"
                                                    value="{{ $User_Info->Contact_Phone ? $User_Info->Contact_Phone : '' }}"
                                                    required>
                                                <div class="invalid-feedback">
                                                    Entered Listing Phone Number *
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <label>Toll-free Phone Number *</label>
                                                <input type="text" class="form-control phone-number"
                                                    placeholder="Toll Free Number" name="Toll_Free"
                                                    value="{{ $User_Info->Toll_Free ?: '' }}">
                                                <div class="invalid-feedback">
                                                    Entered Toll-free Phone Number *.
                                                </div>
                                            </div>
                                        </div>


                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <label>Local Phone Number *</label>
                                                <input type="text" class="form-control phone-number"
                                                    placeholder="Local Phone Number" name="Local_Phone"
                                                    value="{{ $User_Info->Local_Phone ?: '' }}">
                                                <div class="invalid-feedback">
                                                    Entered Local Phone Number *.
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <label>Local Phone Notes *</label>
                                                <input type="text" class="form-control phone-number"
                                                    placeholder="Local Phone Notes"
                                                    value="{{ $User_Info->Local_Phone ?: '' }}"
                                                    name="Local_Phone2" required>
                                                <div class="invalid-feedback">
                                                    Entered Local Phone Notes *.
                                                </div>
                                            </div>
                                        </div>

                                        {{-- <div class="col-lg-3">
                                            <div class="form-group">
                                                <label>Contact Preferred Method*</label>
                                                <select class="custom-select" name="Contact_Method" required>
                                                    <option value="">Select AnyOne</option>
                                                    <option @if ($User_Info->Contact_Method == 'Any') selected @endif
                                                        value="Any">Any</option>
                                                    <option @if ($User_Info->Contact_Method == 'Phone') selected @endif
                                                        value="Phone">Phone</option>
                                                    <option @if ($User_Info->Contact_Method == 'Fax') selected @endif
                                                        value="Fax">Fax</option>
                                                    <option @if ($User_Info->Contact_Method == 'Email') selected @endif
                                                        value="Email">Email</option>
                                                </select>
                                                <div class="invalid-feedback">Select Contact Method</div>
                                            </div>
                                        </div> --}}

                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <label>Fax Number</label>
                                                <input type="text" class="form-control"
                                                    placeholder="Fax Number" name="Fax_Phone"
                                                    value="{{ $User_Info->Fax_Phone ?: '' }}" required>
                                                <div class="invalid-feedback">
                                                    Entered Fax Number.
                                                </div>
                                            </div>
                                        </div>

                                        {{-- <div class="col-lg-3">
                                            <div class="form-group">
                                                <label>Time Zone*</label>
                                                <select class="custom-select" name="Time_Zone" required>
                                                    <option value="">Select AnyOne</option>
                                                    <option value="OTH" @if ($User_Info->Time_Zone == 'OTH') selected @endif>OTH</option>
                                                    <option value="Pacific Standard Time (PST)" @if ($User_Info->Time_Zone == 'Pacific Standard Time (PST)') selected @endif>Pacific Standard Time (PST)</option>
                                                    <option value="Mountain Standard Time (MST)" @if ($User_Info->Time_Zone == 'Mountain Standard Time (MST)') selected @endif>Mountain Standard Time (MST)</option>
                                                    <option value="Central Standard Time (CST" @if ($User_Info->Time_Zone == 'Central Standard Time (CST') selected @endif>Central Standard Time (CST)</option>
                                                    <option value="Eastern Standard Time (EST)" @if ($User_Info->Time_Zone == 'Eastern Standard Time (EST)') selected @endif>Eastern Standard Time (EST)</option>
                                                    <option value="Alaska Standard Time (AKST)" @if ($User_Info->Time_Zone == 'Alaska Standard Time (AKST)') selected @endif>Alaska Standard Time (AKST)</option>
                                                    <option value="Hawaii-Aleutian Standard Time (HAST)" @if ($User_Info->Time_Zone == 'Hawaii-Aleutian Standard Time (HAST)') selected @endif>Hawaii-Aleutian Standard Time (HAST)</option>
                                                    <option value="Newfoundland Standard Time (NST)" @if ($User_Info->Time_Zone == 'Newfoundland Standard Time (NST)') selected @endif>Newfoundland Standard Time (NST)</option>
                                                    <option value="Other" @if ($User_Info->Time_Zone == 'Other') selected @endif>Other</option>
                                                </select>
                                                <div class="invalid-feedback">
                                                    Select Any Time Zone.
                                                </div>
                                            </div>
                                        </div> --}}

                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <label>Email</label>
                                                <input readonly type="email" class="form-control"
                                                    value="{{ $User_Info->email }}" name="User_Email">
                                            </div>
                                        </div>

                                        {{-- <div class="col-lg-3">
                                            <div class="form-group">
                                                <label>Email</label>
                                                <input type="text" class="form-control"
                                                    placeholder="Hours Of Operation" name="Hours_Operations"
                                                    value="{{ $User_Info->Hours_Operations ?: '' }}" required>
                                                <div class="invalid-feedback">
                                                    Entered Email.
                                                </div>
                                            </div>
                                        </div> --}}

                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <label>Receive Dispatch Email at</label>
                                                <input type="text" class="form-control"
                                                    placeholder="Notification Email" name="Notification_Email"
                                                    value="{{ $User_Info->notification_email ?: 'N/A' }}">
                                                {{-- <div class="invalid-feedback">
                                                    Entered Receive Dispatch Emails at.
                                                </div> --}}
                                            </div>
                                        </div>
                                        {{-- <div class="col-lg-3">
                                            <div class="form-group">
                                                <label>Allow Carriers to Search My Vehicles by Company Name*</label>
                                                <input type="text" class="form-control"
                                                    placeholder="Hours Of Operation" name="Hours_Operations"
                                                    value="{{ $User_Info->Hours_Operations ?: '' }}" required>
                                                <div class="invalid-feedback">
                                                    Entered Allow Carriers to Search My Vehicles by Company Name.
                                                </div>
                                            </div>
                                        </div> --}}

                                          {{-- <div class="col-lg-3">
                                            <label>Upload/Change Profile Picture</label>
                                            <div class="input-group mb-3">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input"
                                                        name="Profile_Image" accept="image/*">
                                                    <div class="invalid-feedback">
                                                        Upload Profile Picture.
                                                    </div>
                                                    <label class="custom-file-label">Choose file</label>
                                                </div>
                                            </div>
                                        </div> --}}
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-6">
                                            {{-- <h3><i class='bx bx-file'></i> W9 & USDOT Information:</h3> --}}
                                            <h4 class="text-white py-2 d-flex justify-content-center"
                                                style="background: #113771;border-radius: 25px 25px 0px 0px;">
                                                Reference Information
                                            </h4>
                                            <div class="row">

                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label>MC Number</label>
                                                        <input type="text" class="form-control"
                                                            placeholder="Hours Of Operation" name="MC_Number"
                                                            value="{{ $User_Info->Mc_Number ?: '' }}" required>
                                                        <div class="invalid-feedback">
                                                            Entered MC Number.
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label>USDOT Number</label>
                                                        <input type="text" class="form-control"
                                                            placeholder="Hours Of Operation" name="Dot_Number"
                                                            value="{{ $User_Info->Company_USDot ?: '' }}" required>
                                                        <div class="invalid-feedback">
                                                            Entered USDOT Number.
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            {{-- <h3><i class='bx bx-file'></i> Equiment and Route Information</h3> --}}
                                            <h4 class="text-white py-2 d-flex justify-content-center"
                                                style="background: #113771;border-radius: 25px 25px 0px 0px;">
                                                Broker Bond Information
                                            </h4>
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label>Surety Bonding Agent</label>
                                                        <input type="text" class="form-control"
                                                            placeholder="Number of Trucks" value="{{ isset($User_Info->insurance->Agent_Name) ? $User_Info->insurance->Agent_Name : '' }}" name="Number_of_Trucks"
                                                            @if ($currentUser->usr_type == 'Carrier' && $User_Info->insurance->Agent_Name == null) required @endif>
                                                        <div class="invalid-feedback">
                                                            Entered Surety Bonding Agent.
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label>Bonding Company Phone
                                                        </label>
                                                        <input type="text" class="form-control"
                                                            placeholder="Number of Trucks" value="{{ $User_Info->insurance->Agent_Phone ?? 'N/A' }}" name="Number_of_Trucks"
                                                            @if ($currentUser->usr_type == 'Carrier' && $User_Info->insurance->Agent_Phone == null) required @endif>
                                                        <div class="invalid-feedback">
                                                            Entered Bonding Company Phone.                                                            .
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                
                                            </div>
                                        </div>
                                        
                                    </div>


                                            {{-- <h3><i class='bx bx-file'></i> Insurance Information:</h3> --}}
                                            <h4 class="text-white py-2 d-flex justify-content-center"
                                                style="background: #113771;border-radius: 25px 25px 0px 0px;">
                                                Insurance Information:
                                            </h4>
                                            <div class="row">
                                                <div class="col-lg-3">
                                                    <label>Insurance Certificate <i class='fa fa-eye'></i></label>
                                                    <div class="input-group mb-3">
                                                        <div class="custom-file">
                                                            <input type="file" class="custom-file-input"
                                                                name="Insurance_Certificate" accept="application/pdf"
                                                                @if(!isset($User_Info->certificates?->Insurance_Certificate) || $User_Info->certificates?->Insurance_Certificate === null) required @endif>
                                                            <div class="invalid-feedback">
                                                                Upload insurance Certificate.
                                                            </div>
                                                            <label class="custom-file-label">Choose file</label>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-lg-3">
                                                    <div class="form-group">
                                                        <label>Expiration Date</label>
                                                        <input type="date" class="form-control"
                                                            placeholder="Expiration Date" name="Expiration_Date"
                                                            value="{{ $User_Info->insurance?->Expiration_Date ? \Carbon\Carbon::parse($User_Info->insurance?->Expiration_Date)->format('Y-m-d') : '' }}"
                                                            @if(!$User_Info->insurance?->Expiration_Date) required @endif>
                                                        <div class="invalid-feedback">
                                                            Entered Expiration Date.
                                                        </div>
                                                    </div>
                                                </div>
                                                {{-- <div class="col-lg-3">
                                                    <div class="form-group">
                                                        <label>Expiration Date</label>
                                                        <input type="date" class="form-control"
                                                            placeholder="Expiration Date" name="Expiration_Date"
                                                            value="{{ isset($User_Info->insurance->Expiration_Date) ?? '' }}"
                                                            @if($User_Info->insurance->Expiration_Date == null) required @endif>
                                                        <div class="invalid-feedback">
                                                            Entered Expiration Date.
                                                        </div>
                                                    </div>
                                                </div> --}}

                                                <div class="col-lg-3">
                                                    <div class="form-group">
                                                        <label>Cargo Limit: *</label>
                                                        <input type="number" class="form-control"
                                                            placeholder="Cargo Limit" name="Carg_Limit"
                                                            value="{{ $User_Info->insurance?->Cargo_Limit ? (int) $User_Info->insurance?->Cargo_Limit : '' }}"
                                                            required>
                                                        <div class="invalid-feedback">
                                                            Entered Cargo Limit.
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-lg-3">
                                                    <div class="form-group">
                                                        <label>Deductible</label>
                                                        <input type="number" class="form-control"
                                                            placeholder="Deductible" name="Deductible"
                                                            value="{{ $User_Info->insurance?->Deductable ? (int) $User_Info->insurance?->Deductable : '' }}"
                                                            required>
                                                        <div class="invalid-feedback">
                                                            Entered Deductible.
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-lg-3">
                                                    <div class="form-group">
                                                        <label>Auto Policy Number: *</label>
                                                        <input type="text" class="form-control"
                                                            placeholder="Auto Policy Number" name="Policy_Number"
                                                            value="{{ $User_Info->insurance?->Auto_Policy_Number ?: '' }}"
                                                            required>
                                                        <div class="invalid-feedback">
                                                            Entered Policy Number.
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-lg-3">
                                                    <div class="form-group">
                                                        <label>Cargo Policy Number: *</label>
                                                        <input type="number" class="form-control"
                                                            placeholder="Cargo Policy Number" name="Cargo_Number"
                                                            value="{{ $User_Info->insurance?->Cargo_Policy_Number ? (int) $User_Info->insurance?->Cargo_Policy_Number : '' }}"
                                                            required>
                                                        <div class="invalid-feedback">
                                                            Entered Cargo Number.
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-lg-3">
                                                    <div class="form-group">
                                                        <label>Agent Name</label>
                                                        <input type="text" class="form-control"
                                                            placeholder="Bonding Agent" name="Agent_Name"
                                                            value="{{ isset($User_Info->insurance->Agent_Name) ? $User_Info->insurance->Agent_Name : '' }}"
                                                            required>
                                                        <div class="invalid-feedback">
                                                            Entered Bonding Agent.
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-lg-3">
                                                    <div class="form-group">
                                                        <label>Agent Phone</label>
                                                        <input type="text" class="form-control phone-number"
                                                            placeholder="Agent Phone" name="Agent_Phone"
                                                            value="{{ $User_Info->insurance?->Agent_Phone ? (int) $User_Info->insurance?->Agent_Phone : '' }}"
                                                            required>
                                                        <div class="invalid-feedback">
                                                            Entered Agent Phone.
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>




                                            <div class="row">
                                                <div class="col-sm-4">
                                                    {{-- <h3><i class='bx bx-file'></i> W9 & USDOT Information:</h3> --}}
                                                    <h4 class="text-white py-2 d-flex justify-content-center"
                                                        style="background: #113771;border-radius: 25px 25px 0px 0px;">
                                                        W9 & USDOT Information:
                                                    </h4>
                                                    <div class="row">

                                                        <div class="col-sm-6">
                                                            <label>W9 Certificate <i class='fa fa-eye'></i></label>
                                                            <div class="input-group mb-3">
                                                                <div class="custom-file">
                                                                    <input type="file" class="custom-file-input"
                                                                        name="WNine_Certificate" accept="application/pdf"
                                                                        @if ($User_Info->certificates?->W_Nine == null) required @endif>
                                                                    <div class="invalid-feedback">
                                                                        Upload W9 Certificate.
                                                                    </div>
                                                                    <label class="custom-file-label">Choose file</label>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-sm-6">
                                                            <label>USDOT Certificate <i class='fa fa-eye'></i></label>
                                                            <div class="input-group mb-3">
                                                                <div class="custom-file">
                                                                    <input type="file" class="custom-file-input"
                                                                        name="USDOT_Certificate" accept="application/pdf"
                                                                        @if ($User_Info->certificates?->USDOT_Certificate == null) required @endif>
                                                                    <div class="invalid-feedback">
                                                                        Upload USDOT Certificate.
                                                                    </div>
                                                                    <label class="custom-file-label">Choose file</label>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                               @if (Auth::guard('Authorized')->user()->usr_type == 'Carrier')
                                                <div class="col-sm-4">
                                                    {{-- <h3><i class='bx bx-file'></i> Equiment and Route Information</h3> --}}
                                                    <h4 class="text-white py-2 d-flex justify-content-center"
                                                        style="background: #113771;border-radius: 25px 25px 0px 0px;">
                                                        Equiment and Route Information
                                                    </h4>
                                                    <div class="row">
                                                        <div class="col-sm-6">
                                                            <div class="form-group">
                                                                <label>Number of Trucks</label>
                                                                <input type="text" class="form-control"
                                                                    placeholder="Number of Trucks" value="{{ $User_Info->Number_of_Trucks }}" name="Number_of_Trucks"
                                                                    @if ($currentUser->usr_type == 'Carrier' && $User_Info->Number_of_Trucks == null) required @endif>
                                                                <div class="invalid-feedback">
                                                                    Entered Number of Trucks.
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <div class="form-group">
                                                                <label>Equipment Type</label>
                                                                {{-- {{ dd($User_Info->myEquipments->toArray()) }} --}}
                                                                <select data-placeholder="Select Equipment Type" class="custom-select custom-multi-select" name="Equipment_Type[]" multiple>
                                                                    {{-- <option value="">Select Equipment Type</option> --}}
                                                                    <option @if(in_array('VAN (V)', $User_Info->myEquipments->pluck('equipment')->toArray())) selected @endif>VAN (V)</option>
                                                                    <option @if(in_array('REEFER (RE)', $User_Info->myEquipments->pluck('equipment')->toArray())) selected @endif>REEFER (RE)</option>
                                                                    <option @if(in_array('FLATBED (F)', $User_Info->myEquipments->pluck('equipment')->toArray())) selected @endif>FLATBED (F)</option>
                                                                    <option @if(in_array('Step Deck Trailer', $User_Info->myEquipments->pluck('equipment')->toArray())) selected @endif>Step Deck Trailer</option>
                                                                    <option @if(in_array('REMOVABLE GOOSENECK (RGN)', $User_Info->myEquipments->pluck('equipment')->toArray())) selected @endif>REMOVABLE GOOSENECK (RGN)</option>
                                                                    <option @if(in_array('CONESTOGA (CS)', $User_Info->myEquipments->pluck('equipment')->toArray())) selected @endif>CONESTOGA (CS)</option>
                                                                    <option @if(in_array('TRUCK (T)', $User_Info->myEquipments->pluck('equipment')->toArray())) selected @endif>TRUCK (T)</option>
                                                                    <option @if(in_array('HAZMAT (hazardous materials)', $User_Info->myEquipments->pluck('equipment')->toArray())) selected @endif>HAZMAT (hazardous materials)</option>
                                                                    <option @if(in_array('POWER ONLY (PO)', $User_Info->myEquipments->pluck('equipment')->toArray())) selected @endif>POWER ONLY (PO)</option>
                                                                    <option @if(in_array('HOT SHOT (HS)', $User_Info->myEquipments->pluck('equipment')->toArray())) selected @endif>HOT SHOT (HS)</option>
                                                                    <option @if(in_array('LOWBOY (LB)', $User_Info->myEquipments->pluck('equipment')->toArray())) selected @endif>LOWBOY (LB)</option>
                                                                    <option @if(in_array('ENDUMP (ED)', $User_Info->myEquipments->pluck('equipment')->toArray())) selected @endif>ENDUMP (ED)</option>
                                                                    <option @if(in_array('LANDOLL (LD)', $User_Info->myEquipments->pluck('equipment')->toArray())) selected @endif>LANDOLL (LD)</option>
                                                                    <option @if(in_array('PARTIAL (PT)', $User_Info->myEquipments->pluck('equipment')->toArray())) selected @endif>PARTIAL (PT)</option>
                                                                    <option @if(in_array('20ft container', $User_Info->myEquipments->pluck('equipment')->toArray())) selected @endif>20ft container</option>
                                                                    <option @if(in_array('40ft container', $User_Info->myEquipments->pluck('equipment')->toArray())) selected @endif>40ft container</option>
                                                                    <option @if(in_array('48ft container', $User_Info->myEquipments->pluck('equipment')->toArray())) selected @endif>48ft container</option>
                                                                    <option @if(in_array('53ft container', $User_Info->myEquipments->pluck('equipment')->toArray())) selected @endif>53ft container</option>
                                                                </select>

                                                                <!-- dribbble -->
                                                                {{-- <a class="dribbble"
                                                                    href="https://dribbble.com/shots/5112850-Multiple-select-animation-field"
                                                                    target="_blank"><img
                                                                        src="https://cdn.dribbble.com/assets/dribbble-ball-1col-dnld-e29e0436f93d2f9c430fde5f3da66f94493fdca66351408ab0f96e2ec518ab17.png"
                                                                        alt=""></a> --}}
                                                                <!--<select class="custom-select" name="Trailer_Type[]" required="" autocomplete="off">-->
                                                                <!--    <option selected="" value="">Select Equipment Type</option>-->
                                                                <!--    <option>VAN (V)</option>-->
                                                                <!--    <option>REEFER (RE) </option>-->
                                                                <!--    <option>FLATBED (F)</option>-->
                                                                <!--    <option>Step Deck Trailer</option>-->
                                                                <!--    <option>REMOVABLE GOOSENECK (RGN) </option>-->
                                                                <!--    <option>CONESTOGA (CS)</option>-->
                                                                <!--    <option>TRUCK (T)</option>-->
                                                                <!--    <option>HAZMAT (hazardous materials)</option>-->
                                                                <!--    <option>POWER ONLY (PO)</option>-->
                                                                <!--    <option>HOT SHOT (HS)</option>-->
                                                                <!--    <option>LOWBOY (LB)</option>-->
                                                                <!--    <option>ENDUMP (ED)</option>-->
                                                                <!--    <option>LANDOLL (LD)</option>-->
                                                                <!--    <option>PARTIAL (PT)</option>-->
                                                                <!--    <option>20ft container</option>-->
                                                                <!--    <option>40ft container</option>-->
                                                                <!--    <option>48ft container</option>-->
                                                                <!--    <option>53ft container</option>-->
                                                                <!--</select>-->
                                                                <div class="invalid-feedback">Select Any Equipment Type
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <div class="form-group">
                                                                <label>Equipment Description</label>
                                                                <input type="text" class="form-control"
                                                                    placeholder="Equipment Description"
                                                                    value="{{ $User_Info->Equipment_Description }}"
                                                                    name="Equipment_Description"
                                                                    @if ($currentUser->usr_type == 'Carrier' && $User_Info->Equipment_Description == null) required @endif>
                                                                <div class="invalid-feedback">
                                                                    Entered Equipment Description.
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <div class="form-group">
                                                                <label>Route Description</label>
                                                                <input type="text" class="form-control"
                                                                    placeholder="Route Description"
                                                                    value="{{ $User_Info->Route_Description }}"
                                                                    name="Route_Description"
                                                                    @if ($currentUser->usr_type == 'Carrier' && $User_Info->Route_Description == null) required @endif>
                                                                <div class="invalid-feedback">
                                                                    Entered Route Description.
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                               @endif
                                                <div class="col-sm-4">
                                                    {{-- <h3><i class='bx bx-file'></i> Business Information:</h3> --}}
                                                    <h4 class="text-white py-2 d-flex justify-content-center"
                                                        style="background: #113771;border-radius: 25px 25px 0px 0px;">
                                                        Business Information:
                                                    </h4>
                                                    <div class="row">

                                                        <div class="col-sm-6">
                                                            <label>Business License <i class='fa fa-eye'></i></label>
                                                            <div class="input-group mb-3">
                                                                <div class="custom-file">
                                                                    <input type="file" class="custom-file-input"
                                                                        name="Business_License" accept="application/pdf"
                                                                        @if ($currentUser->usr_type != 'Broker' && $currentUser->usr_type != 'Carrier') required @endif>
                                                                    <div class="invalid-feedback">
                                                                        Upload Business License.
                                                                    </div>
                                                                    <label class="custom-file-label">Choose file</label>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="btn-box text-right">
                                                <button type="submit" class="submit-btn"><i class='bx bx-save'></i>
                                                    Save
                                                </button>
                                            </div>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade p-3" id="about" role="tabpanel" aria-labelledby="about-tab">
                            <div class="container-flude">
                                <div class="row">

                                    <div class="col-sm-6">
                                        <div class="card user-info-box mb-30">
                                            <div class="card-header ">
                                                <h4 class="text-white py-2 d-flex justify-content-center"
                                                    style="background: #113771;border-radius: 25px 25px 0px 0px;">
                                                    Account Information
                                                </h4>
                                            </div>

                                            <div class="card-body">
                                                <ul class="list-unstyled mb-0">

                                                    <li class="d-flex">
                                                        <i class="bx bx-user mr-2"></i>
                                                        <h6 class="d-inline-block"><b>Username:</b> <span
                                                                class="d-inline-block">{{ $User_Info->name }}</span>
                                                        </h6>
                                                    </li>

                                                    <li class="d-flex">
                                                        <i class="bx bx-lock mr-2"></i>
                                                        <h6 class="d-inline-block"><b>Password:</b> <span
                                                                class="d-inline-block">
                                                                ********* <a href="javascript:void(0);" onclick="changePassModal()">Change Password</a></span>
                                                        </h6>
                                                    </li>

                                                    <li class="d-flex">
                                                        <i class="bx bx-user-circle mr-2"></i>
                                                        <h6 class="d-inline-block"><b>User Type:</b> <span
                                                                class="d-inline-block">{{ $User_Info->usr_type }}</span>
                                                        </h6>
                                                    </li>

                                                </ul>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="card user-info-box mb-30">
                                            <div class="card-header ">
                                                <h4 class="text-white py-2 d-flex justify-content-center"
                                                    style="background: #113771;border-radius: 25px 25px 0px 0px;">
                                                    Carrier Bond Information
                                                </h4>
                                            </div>

                                            <div class="card-body">
                                                <ul class="list-unstyled mb-0">

                                                    <li class="d-flex">
                                                        <i class="bx bx-file mr-2"></i>
                                                        <h6 class="d-inline-block"><b>Surety Bonding Agent:</b> <span
                                                                class="d-inline-block">{{ $User_Info->insurance?->Agent_Name ? $User_Info->insurance?->Agent_Name : 'N/A' }}</span>
                                                        </h6>
                                                    </li>

                                                    <li class="d-flex">
                                                        <i class="bx bx-phone mr-2"></i>
                                                        <h6 class="d-inline-block"><b>Bonding Company Phone:</b> <span
                                                                class="d-inline-block">
                                                                {{ $User_Info->insurance?->Agent_Phone ? $User_Info->insurance?->Agent_Phone : 'N/A' }}</span>
                                                        </h6>
                                                    </li>

                                                </ul>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                                <div class="row">

                                    <div class="col-sm-6">
                                        <div class="card user-info-box mb-30">
                                            <div class="card-header ">
                                                <h4 class="text-white py-2 d-flex justify-content-center"
                                                    style="background: #113771;border-radius: 25px 25px 0px 0px;">
                                                    Company Information
                                                </h4>
                                            </div>

                                            <div class="card-body">
                                                <ul class="list-unstyled mb-0">

                                                    <li class="d-flex">
                                                        <i class="bx bx-building mr-2"></i>
                                                        <h6 class="d-inline-block"><b>Company Name:</b> <span
                                                                class="d-inline-block">{{ $User_Info->Company_Name }}</span>
                                                        </h6>
                                                    </li>

                                                    <li class="d-flex">
                                                        <i class="bx bx-map mr-2"></i>
                                                        <h6 class="d-inline-block"><b>Address:</b> <span
                                                                class="d-inline-block">
                                                                {{ $User_Info->Address }}</span>
                                                        </h6>
                                                    </li>

                                                    <li class="d-flex">
                                                        <i class="bx bx-home mr-2"></i>
                                                        <h6 class="d-inline-block"><b>City:</b> <span
                                                                class="d-inline-block">
                                                                {{ $User_Info->Company_City }}</span>
                                                        </h6>
                                                    </li>

                                                    <li class="d-flex">
                                                        <i class="bx bx-phone mr-2"></i>
                                                        <h6 class="d-inline-block"><b>Preferred Contact Method:</b> <span
                                                                class="d-inline-block">
                                                                {{ $User_Info->Contact_Method ? $User_Info->Contact_Method : 'N/A' }}</span>
                                                        </h6>
                                                    </li>

                                                    <li class="d-flex">
                                                        <i class="bx bx-globe mr-2"></i>
                                                        <h6 class="d-inline-block"><b>Website:</b> <span
                                                                class="d-inline-block">
                                                                {{ $User_Info->Website_Url ? $User_Info->Website_Url : 'N/A' }}</span>
                                                        </h6>
                                                    </li>

                                                    <li class="d-flex">
                                                        <i class="bx bx-time mr-2"></i>
                                                        <h6 class="d-inline-block"><b>Hours:</b> <span
                                                                class="d-inline-block">
                                                                {{ $User_Info->Hours_Operations ? $User_Info->Hours_Operations : 'N/A' }}</span>
                                                        </h6>
                                                    </li>

                                                    <li class="d-flex">
                                                        <i class="bx bx-time-time mr-2"></i>
                                                        <h6 class="d-inline-block"><b>Timezone:</b> <span
                                                                class="d-inline-block">
                                                                {{ $User_Info->Time_Zone ? $User_Info->Time_Zone : 'N/A' }}</span>
                                                        </h6>
                                                    </li>

                                                    <li class="d-flex">
                                                        <i class="bx bx-location mr-2"></i>
                                                        <h6 class="d-inline-block"><b>Established:</b> <span
                                                                class="d-inline-block">
                                                                {{ $User_Info->created_at ? date('Y', strtotime($User_Info->created_at)) : 'N/A' }}</span>
                                                        </h6>
                                                    </li>

                                                    <li class="d-flex">
                                                        <i class="bx bx-location mr-2"></i>
                                                        <h6 class="d-inline-block"><b>Company Description:</b> <span
                                                                class="d-inline-block">
                                                                {{ $User_Info->Company_Desc ?: 'N/A' }}</span>
                                                        </h6>
                                                    </li>

                                                </ul>
                                            </div>
                                            {{-- <div class="card-footer truck-footer">
                                        <h6 class="text-white py-2 d-flex justify-content-center" 
                                            style="background: #113771; border-radius: 0 0 25px 25px;">
                                            "Excellence in Every Shipment" <br>
                                            <a href="mailto:info@company.com" class="text-white mx-2">info@company.com</a> |
                                            <a href="/privacy-policy" class="text-white mx-2">Privacy Policy</a>
                                        </h6>
                                    
                                        <div class="truck-container">
                                            <i class="fas fa-truck-moving truck-icon"></i>
                                        </div>
                                    </div> --}}
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="card user-info-box mb-30">
                                            <div class="card-header ">
                                                <h4 class="text-white py-2 d-flex justify-content-center"
                                                    style="background: #113771;border-radius: 25px 25px 0px 0px;">
                                                    Contact Information
                                                </h4>
                                            </div>

                                            <div class="card-body">
                                                <ul class="list-unstyled mb-0">

                                                    <li class="d-flex">
                                                        <i class="bx bx-file mr-2"></i>
                                                        <h6 class="d-inline-block"><b>Dispatch Contact:</b> <span
                                                                class="d-inline-block">{{ $User_Info->Dispatch_Contact ? $User_Info->Dispatch_Contact : 'N/A' }}</span>
                                                        </h6>
                                                    </li>

                                                    <li class="d-flex">
                                                        <i class="bx bx-phone mr-2"></i>
                                                        <h6 class="d-inline-block"><b>Preferred Contact Method:</b> <span
                                                                class="d-inline-block">
                                                                {{ $User_Info->Contact_Method ? $User_Info->Contact_Method : 'N/A' }}</span>
                                                        </h6>
                                                    </li>

                                                    <li class="d-flex">
                                                        <i class="bx bx-phone mr-2"></i>
                                                        <h6 class="d-inline-block"><b>Toll-Free:</b> <span
                                                                class="d-inline-block">
                                                                {{ $User_Info->Toll_Free ? $User_Info->Toll_Free : 'N/A' }}</span>
                                                        </h6>
                                                    </li>

                                                    <li class="d-flex">
                                                        <i class="bx bx-phone mr-2"></i>
                                                        <h6 class="d-inline-block"><b>Local Phone:</b> <span
                                                                class="d-inline-block">
                                                                {{ $User_Info->Local_Phone ? $User_Info->Local_Phone : 'N/A' }}</span>
                                                        </h6>
                                                    </li>

                                                    <li class="d-flex">
                                                        <i class="bx bx-phone mr-2"></i>
                                                        <h6 class="d-inline-block"><b>Fax:</b> <span
                                                                class="d-inline-block">
                                                                {{ $User_Info->Fax_Phone ? $User_Info->Fax_Phone : 'N/A' }}</span>
                                                        </h6>
                                                    </li>

                                                    <li class="d-flex">
                                                        <i class="bx bx-envelope mr-2"></i>
                                                        <h6 class="d-inline-block"><b>Email Address:</b> <span
                                                                class="d-inline-block">
                                                                {{ $User_Info->email ? $User_Info->email : 'N/A' }}</span>
                                                        </h6>
                                                    </li>

                                                </ul>
                                            </div>
                                        </div>
                                        <div class="card user-info-box mb-30">
                                            {{-- <div class="card-header d-flex justify-content-between align-items-center">
                                        <h3>Equipment & Route Information</h3>
                                    </div> --}}
                                            <div class="card-header ">
                                                <h4 class="text-white py-2 d-flex justify-content-center"
                                                    style="background: #113771;border-radius: 25px 25px 0px 0px;">
                                                    Equipment & Route Information
                                                </h4>
                                            </div>

                                            <div class="card-body">
                                                <ul class="list-unstyled mb-0">

                                                    <li class="d-flex">
                                                        <i class="bx bx-file mr-2"></i>
                                                        <h6 class="d-inline-block"><b>Number of Trucks:</b> <span
                                                                class="d-inline-block">{{ $User_Info->Number_of_Trucks ? $User_Info->Number_of_Trucks : 'N/A' }}</span>
                                                        </h6>
                                                    </li>

                                                    <li class="d-flex">
                                                        <i class="bx bx-phone mr-2"></i>
                                                        <h6 class="d-inline-block"><b>Equipment Type:</b> <span
                                                                class="d-inline-block">
                                                                {{ $User_Info->Equipment_Type ? $User_Info->Equipment_Type : 'N/A' }}</span>
                                                        </h6>
                                                    </li>

                                                    <li class="d-flex">
                                                        <i class="bx bx-phone mr-2"></i>
                                                        <h6 class="d-inline-block"><b>Equipment Description:</b> <span
                                                                class="d-inline-block">
                                                                {{ $User_Info->Equipment_Description ? $User_Info->Equipment_Description : 'N/A' }}</span>
                                                        </h6>
                                                    </li>

                                                    <li class="d-flex">
                                                        <i class="bx bx-phone mr-2"></i>
                                                        <h6 class="d-inline-block"><b>Route Description:</b> <span
                                                                class="d-inline-block">
                                                                {{ $User_Info->Route_Description ? $User_Info->Route_Description : 'N/A' }}</span>
                                                        </h6>
                                                    </li>

                                                </ul>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                            </div>
                        </div>
                        <div class="tab-pane fade p-3" id="documents" role="tabpanel" aria-labelledby="documents-tab">
                            <div class="card">
                                <div class="card-body card-header">
                                    <h3>My Documents</h3>
                                    <p class="font-weight-normal">A Document Packet ("Docpack") is a compilation of your
                                        U.S.
                                        DOT Certification, Insurance and/or Bond Certificate, A Completed W-9 Form, and
                                        Other
                                        Licenses <strong>(if any)</strong>.
                                        <strong>Once you FAX us your documents, We securely store them and allow
                                            you to
                                            give either temporary or
                                            permanent viewing access at your discretion.
                                        </strong>
                                    </p>
                                    <!-- Start -->
                                    <div class="todo-content-area mt-20 text-center">
                                        <div style="float: none;">
                                            <div class="todo-area">
                                                <div class="todo-list-wrapper">
                                                    <div class="todo-list">

                                                        <div class="card mb-4">
                                                            <div class="card-header text-white">
                                                                <h4 class="text-white py-2 d-flex justify-content-center"
                                                                    style="background: #113771;border-radius: 25px 25px 0px 0px;">
                                                                    Manage User Certificates
                                                                </h4>
                                                            </div>
                                                            <div class="card-body">
                                                                @if (is_null($User_Info->certificates))
                                                                    <div class="alert alert-warning" role="alert">
                                                                        Verified Documents are <strong>Not Attached.</strong>
                                                                    </div>
                                                                @endif
                                                                <form action="{{ route('User.Certificate.Assign') }}" method="POST">
                                                                    @csrf
                                                                    <input type="hidden" name="certificate_id"
                                                                        value="{{ $User_Info->certificates?->id }}">
                                                                        <div class="row">
                                                                            <div class="col-4">
                                                                                <div class="mb-4">
                                                                                    <h5 class="text-white py-2 d-flex justify-content-center"
                                                                                    style="background: #113771;border-radius: 25px 25px 0px 0px;">DOT Certificate or License
                                                                                        <strong>({{ $User_Info->certificates?->USDOT_Privacy === 0 ? 'Public' : 'Private' }})</strong>
                                                                                    </h5>
                                                                                    <p>
                                                                                        <a target="_blank" href="{{ $User_Info->certificates?->USDOT_Certificate ? url($User_Info->certificates?->USDOT_Certificate) : '' }}">
                                                                                            View Certificate
                                                                                        </a>
                                                                                        {{-- @if ($User_Info->certificates->USDOT_Privacy === 0)
                                                                                        <div class="todo-item-action">
                                                                                            <a style="width: 100%; text-decoration: none;"
                                                                                                href="{{ route('User.Update.Documents', ['user_id' => $User_Info->id, 'doc_id' => $User_Info->certificates->id, 'doc_type' => 'USDOT']) }}"
                                                                                                class="edit px-2"><i
                                                                                                    class='bx bx-low-vision mr-2'></i><strong>{{ !$User_Info->certificates->USDOT_Privacy === 0 ? 'Public' : 'Private' }}</strong></a>
                                                                                        </div>
                                                                                        @endif
                                                                                        @if ($User_Info->certificates->USDOT_Privacy === 1)
                                                                                        <div class="todo-item-action">
                                                                                            <a style="width: 100%; text-decoration: none;"
                                                                                                href="{{ route('User.Update.Documents', ['user_id' => $User_Info->id, 'doc_id' => $User_Info->certificates->id, 'doc_type' => 'USDOT']) }}"
                                                                                                class="edit px-2"><i
                                                                                                    class='fa fa-eye mr-2'></i><strong>{{ !$User_Info->certificates->USDOT_Privacy === 0 ? 'Public' : 'Private' }}</strong></a>
                                                                                        </div>
                                                                                        @endif --}}
                                                                                        {{-- @if ($User_Info->certificates->USDOT_Privacy === 0) --}}
                                                                                            <div class="todo-item-action">
                                                                                                <a style="width: 100%; text-decoration: none;"
                                                                                                href="{{ route('User.Update.Documents', ['user_id' => $User_Info->id, 'doc_id' => $User_Info->certificates?->id ?? 0, 'doc_type' => 'USDOT']) }}"
                                                                                                class="edit px-2">
                                                                                                <i @if($User_Info->certificates?->USDOT_Privacy === 0) class='bx bx-low-vision mr-2' @else class='fa fa-eye mr-2' @endif></i>
                                                                                                <strong>Public</strong>
                                                                                                </a>
                                                                                            </div>
                                                                                        {{-- @elseif ($User_Info->certificates->USDOT_Privacy === 1)
                                                                                            <div class="todo-item-action">
                                                                                                <a style="width: 100%; text-decoration: none;"
                                                                                                href="{{ route('User.Update.Documents', ['user_id' => $User_Info->id, 'doc_id' => $User_Info->certificates->id, 'doc_type' => 'USDOT']) }}"
                                                                                                class="edit px-2">
                                                                                                <i class='fa fa-eye mr-2'></i>
                                                                                                <strong>Private</strong>
                                                                                                </a>
                                                                                            </div>
                                                                                        @endif --}}
                                                                                    </p>
                                                                                    <label for="users_usdot">Select Companies:</label>
                                                                                    <select id="users_usdot" name="usdot_companies[]" class="custom-select custom-multi-select" multiple>
                                                                                        @foreach ($all_user as $user)
                                                                                            <option value="{{ $user->id }}" 
                                                                                                {{ in_array($user->id, $Selected_Certificates_assigns->pluck('user_id')->toArray()) && $Selected_Certificates_assigns->where('user_id', $user->id)->where('certificate_name', 'USDOT_Certificate')->isNotEmpty() ? 'selected' : '' }}>
                                                                                                {{ $user->Company_Name }} ({{ $user->usr_type }})
                                                                                            </option>
                                                                                        @endforeach
                                                                                    </select>
                                                                                    <input type="text" hidden value="Dot Certificate" name="Certificate_Name_01"/>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-4">
                                                                                <div class="mb-4">
                                                                                    <h5 class="text-white py-2 d-flex justify-content-center"
                                                                                    style="background: #113771;border-radius: 25px 25px 0px 0px;">Insurance or Bond Certificate
                                                                                        <strong>({{ $User_Info->certificates?->Insurance_Privacy === 0 ? 'Public' : 'Private' }})</strong>
                                                                                    </h5>
                                                                                    <p>
                                                                                        <a target="_blank" href="{{ $User_Info->certificates?->Insurance_Certificate ? url($User_Info->certificates?->Insurance_Certificate) : '' }}">
                                                                                            View Certificate
                                                                                        </a>
                                                                                        {{-- @if ($User_Info->certificates->Insurance_Privacy === 0) --}}
                                                                                            <div class="todo-item-action">
                                                                                                <a style="width: 100%; text-decoration: none;"
                                                                                                    href="{{ route('User.Update.Documents', ['user_id' => $User_Info->id, 'doc_id' => $User_Info->certificates?->id ?? 0, 'doc_type' => 'IP']) }}"
                                                                                                    class="edit px-2"><i
                                                                                                        @if($User_Info->certificates?->Insurance_Privacy === 0) class='bx bx-low-vision mr-2' @else class='fa fa-eye mr-2' @endif></i><strong>{{ !$User_Info->certificates?->Insurance_Privacy == 0 ? 'Public' : 'Private' }}</strong></a>
                                                                                            </div>
                                                                                        {{-- @endif
                                                                                        @if ($User_Info->certificates->Insurance_Privacy === 1)
                                                                                            <div class="todo-item-action">
                                                                                                <a style="width: 100%; text-decoration: none;"
                                                                                                    href="{{ route('User.Update.Documents', ['user_id' => $User_Info->id, 'doc_id' => $User_Info->certificates->id, 'doc_type' => 'IP']) }}"
                                                                                                    class="edit px-2"><i
                                                                                                        class='fa fa-eye mr-2'></i><strong>{{ !$User_Info->certificates->Insurance_Privacy == 0 ? 'Public' : 'Private' }}</strong></a>
                                                                                            </div>
                                                                                        @endif --}}
                                                                                    </p>
                                                                                    <div class="form-group">
                                                                                    <label for="users_insurance">Select Companies:</label>
                                                                                    <select id="users_insurance" name="insurance_companies[]" class="custom-select custom-multi-select" multiple>
                                                                                        @foreach ($all_user as $user)
                                                                                            <option value="{{ $user->id }}" 
                                                                                                {{ in_array($user->id, $Selected_Certificates_assigns->pluck('user_id')->toArray()) && $Selected_Certificates_assigns->where('user_id', $user->id)->where('certificate_name', 'Insurance_Certificate')->isNotEmpty() ? 'selected' : '' }}>
                                                                                                {{ $user->Company_Name }} ({{ $user->usr_type }})
                                                                                            </option>
                                                                                        @endforeach
                                                                                    </select>
                                                                                    <input type="text" hidden value="Insurance Certificate" name="Certificate_Name_02"/>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-4">
                                                                                <div class="mb-4">
                                                                                    <h5 class="text-white py-2 d-flex justify-content-center"
                                                                                    style="background: #113771;border-radius: 25px 25px 0px 0px;">Completed W-9 [W/O Instructions]
                                                                                        <strong>({{ $User_Info->certificates?->W_Nine_Privacy === 0 ? 'Public' : 'Private' }})</strong>
                                                                                    </h5>
                                                                                    <p>
                                                                                        <a target="_blank" href="{{ $User_Info->certificates?->W_Nine ? url($User_Info->certificates?->W_Nine) : '' }}">
                                                                                            View Certificate
                                                                                        </a>
                                                                                        {{-- @if ($User_Info->certificates->W_Nine_Privacy == 0) --}}
                                                                                            <div class="todo-item-action">
                                                                                                <a style="width: 100%; text-decoration: none;"
                                                                                                    href="{{ route('User.Update.Documents', ['user_id' => $User_Info->id, 'doc_id' => $User_Info->certificates?->id ?? 0, 'doc_type' => 'W9']) }}"
                                                                                                    class="edit px-2"><i @if($User_Info->certificates?->W_Nine_Privacy === 0) class='bx bx-low-vision mr-2' @else class='fa fa-eye mr-2' @endif></i><strong>{{ !$User_Info->certificates?->W_Nine_Privacy == 0 ? 'Public' : 'Private' }}</strong></a>
                                                                                            </div>
                                                                                        {{-- @endif
                                                                                        @if ($User_Info->certificates->W_Nine_Privacy == 1)
                                                                                            <div class="todo-item-action">
                                                                                                <a style="width: 100%; text-decoration: none;"
                                                                                                    href="{{ route('User.Update.Documents', ['user_id' => $User_Info->id, 'doc_id' => $User_Info->certificates->id, 'doc_type' => 'W9']) }}"
                                                                                                    class="edit px-2"><i
                                                                                                        class='fa fa-eye mr-2'></i><strong>{{ !$User_Info->certificates->W_Nine_Privacy == 0 ? 'Public' : 'Private' }}</strong></a>
                                                                                            </div>
                                                                                        @endif --}}
                                                                                    </p>
                                                                                    <div class="form-group">
                                                                                    <label for="users_w9">Select Companies:</label>
                                                                                    <select id="users_w9" name="w9_companies[]" class="custom-select custom-multi-select" multiple>
                                                                                        @foreach ($all_user as $user)
                                                                                            <option value="{{ $user->id }}" 
                                                                                                {{ in_array($user->id, $Selected_Certificates_assigns->pluck('user_id')->toArray()) && $Selected_Certificates_assigns->where('user_id', $user->id)->where('certificate_name', 'W_Nine')->isNotEmpty() ? 'selected' : '' }}>
                                                                                                {{ $user->Company_Name }} ({{ $user->usr_type }})
                                                                                            </option>
                                                                                        @endforeach
                                                                                    </select>
                                                                                    <input type="text" hidden value="W-9 Certificate" name="Certificate_Name_03"/>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="text-end">
                                                                            <button type="submit" class="btn btn-success">Submit All Changes</button>
                                                                        </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                        {{-- <ul class="list-wrapper w-100" data-simplebar
                                                            style="height: auto;">
                                                            @if (is_null($User_Info->certificates))
                                                                <li class="todo-list-item">
                                                                    <div class="todo-item-title">
                                                                        <h3>Verified Documents are <strong>Not
                                                                                Attached.</strong>

                                                                        </h3>
                                                                    </div>
                                                                </li>
                                                            @endif
                                                            <li class="todo-list-item">

                                                                <div class="todo-item-title">
                                                                    <img src="{{ asset('backend/img/pdf.PNG') }}"
                                                                        alt="icon">
                                                                    <h3>DOT Certificate or License
                                                                        <strong>({{ $User_Info->certificates->USDOT_Privacy === 0 ? 'Public' : 'Private' }}
                                                                            )</strong>
                                                                    </h3>
                                                                    <p>
                                                                        <a target="_blank"
                                                                            href="{{ $User_Info->certificates->USDOT_Certificate ? url($User_Info->certificates->USDOT_Certificate) : '' }}">View
                                                                            Certificate</a>
                                                                    </p>

                                                                    <form action="{{ route('User.Certificate.Assign') }}"
                                                                        method="POST">
                                                                        @csrf
                                                                        <input type="hidden" name="certificate_name"
                                                                            value="USDOT_Certificate" />
                                                                        <input type="hidden" name="certificate_id"
                                                                            value="{{ $User_Info->certificates->id }}">

                                                                        <label for="users">Select Companies:</label>
                                                                        <select id="users" name="companies[]"
                                                                            class="form-control custom-multi-select" multiple="multiple"
                                                                            style="width: 100%;">
                                                                            @foreach ($all_user as $user)
                                                                                <option value="{{ $user->id }}"
                                                                                    {{ in_array($user->id, $Selected_Certificates_assigns->pluck('user_id')->toArray()) && $Selected_Certificates_assigns->where('user_id', $user->id)->where('certificate_name', 'USDOT_Certificate')->isNotEmpty()? 'selected': '' }}>
                                                                                    {{ $user->Company_Name }} <br>
                                                                                    ({{ $user->usr_type }})
                                                                                </option>
                                                                            @endforeach
                                                                        </select>

                                                                        <button type="submit"
                                                                            class="btn btn-primary mt-2">Submit</button>
                                                                    </form>

                                                                </div>


                                                                @if ($User_Info->certificates->USDOT_Privacy === 0)
                                                                    <div class="todo-item-action">
                                                                        <a style="width: 100%; text-decoration: none;"
                                                                            href="{{ route('User.Update.Documents', ['user_id' => $User_Info->id, 'doc_id' => $User_Info->certificates->id, 'doc_type' => 'USDOT']) }}"
                                                                            class="edit px-2"><i
                                                                                class='bx bx-low-vision mr-2'></i><strong>{{ !$User_Info->certificates->USDOT_Privacy === 0 ? 'Public' : 'Private' }}</strong></a>
                                                                    </div>
                                                                @endif

                                                                @if ($User_Info->certificates->USDOT_Privacy === 1)
                                                                    <div class="todo-item-action">
                                                                        <a style="width: 100%; text-decoration: none;"
                                                                            href="{{ route('User.Update.Documents', ['user_id' => $User_Info->id, 'doc_id' => $User_Info->certificates->id, 'doc_type' => 'USDOT']) }}"
                                                                            class="edit px-2"><i
                                                                                class='fa fa-eye mr-2'></i><strong>{{ !$User_Info->certificates->USDOT_Privacy === 0 ? 'Public' : 'Private' }}</strong></a>
                                                                    </div>
                                                                @endif

                                                            </li>

                                                            <li class="todo-list-item">
                                                                <div class="todo-item-title">
                                                                    <img src="{{ asset('backend/img/pdf.PNG') }}"
                                                                        alt="image">

                                                                    <h3>Insurance or Bond Certificate
                                                                        <strong>({{ $User_Info->certificates->Insurance_Privacy === 0 ? 'Public' : 'Private' }}
                                                                            )</strong>
                                                                    </h3>
                                                                    <p><a target="_blank"
                                                                            href="{{ $User_Info->certificates->Insurance_Certificate ? url($User_Info->certificates->Insurance_Certificate) : '' }}">View
                                                                            Certificate</a></p>

                                                                    <form action="{{ route('User.Certificate.Assign') }}"
                                                                        method="POST">
                                                                        @csrf
                                                                        <input type="hidden" name="certificate_name"
                                                                            value="Insurance_Certificate" />
                                                                        <input type="hidden" name="certificate_id"
                                                                            value="{{ $User_Info->certificates->id }}">
                                                                        <label for="users1">Select Companies:</label>
                                                                        <select id="users1" name="companies[]"
                                                                            class="form-control" multiple="multiple"
                                                                            style="width: 100%;">
                                                                            @foreach ($all_user as $user)
                                                                                <option value="{{ $user->id }}"
                                                                                    {{ in_array($user->id, $Selected_Certificates_assigns->pluck('user_id')->toArray()) && $Selected_Certificates_assigns->where('user_id', $user->id)->where('certificate_name', 'Insurance_Certificate')->isNotEmpty()? 'selected': '' }}>
                                                                                    {{ $user->Company_Name }} <br>
                                                                                    ({{ $user->usr_type }})
                                                                                </option>
                                                                            @endforeach
                                                                        </select>
                                                                        <button type="submit"
                                                                            class="btn btn-primary mt-2">Submit</button>
                                                                    </form>

                                                                </div>

                                                                @if ($User_Info->certificates->Insurance_Privacy === 0)
                                                                    <div class="todo-item-action">
                                                                        <a style="width: 100%; text-decoration: none;"
                                                                            href="{{ route('User.Update.Documents', ['user_id' => $User_Info->id, 'doc_id' => $User_Info->certificates->id, 'doc_type' => 'IP']) }}"
                                                                            class="edit px-2"><i
                                                                                class='bx bx-low-vision mr-2'></i><strong>{{ !$User_Info->certificates->Insurance_Privacy == 0 ? 'Public' : 'Private' }}</strong></a>
                                                                    </div>
                                                                @endif

                                                                @if ($User_Info->certificates->Insurance_Privacy === 1)
                                                                    <div class="todo-item-action">
                                                                        <a style="width: 100%; text-decoration: none;"
                                                                            href="{{ route('User.Update.Documents', ['user_id' => $User_Info->id, 'doc_id' => $User_Info->certificates->id, 'doc_type' => 'IP']) }}"
                                                                            class="edit px-2"><i
                                                                                class='fa fa-eye mr-2'></i><strong>{{ !$User_Info->certificates->Insurance_Privacy == 0 ? 'Public' : 'Private' }}</strong></a>
                                                                    </div>
                                                                @endif

                                                            </li>

                                                            <li class="todo-list-item">
                                                                <div class="todo-item-title">
                                                                    <img src="{{ asset('backend/img/pdf.PNG') }}"
                                                                        alt="image">

                                                                    <h3>Completed W-9 [W/O Instructions]
                                                                        <strong>({{ $User_Info->certificates->W_Nine_Privacy === 0 ? 'Public' : 'Private' }}
                                                                            )</strong>
                                                                    </h3>
                                                                    <p><a target="_blank"
                                                                            href="{{ $User_Info->certificates->W_Nine ? url($User_Info->certificates->W_Nine) : '' }}">View
                                                                            Certificate</a></p>

                                                                    <form action="{{ route('User.Certificate.Assign') }}"
                                                                        method="POST">
                                                                        @csrf
                                                                        <input type="hidden" name="certificate_name"
                                                                            value="W_Nine" />
                                                                        <input type="hidden" name="certificate_id"
                                                                            value="{{ $User_Info->certificates->id }}">
                                                                        <label for="users2">Select Companies:</label>
                                                                        <select id="users2" name="companies[]"
                                                                            class="form-control" multiple="multiple"
                                                                            style="width: 100%;">
                                                                            @foreach ($all_user as $user)
                                                                                <option value="{{ $user->id }}"
                                                                                    {{ in_array($user->id, $Selected_Certificates_assigns->pluck('user_id')->toArray()) && $Selected_Certificates_assigns->where('user_id', $user->id)->where('certificate_name', 'W_Nine')->isNotEmpty()? 'selected': '' }}>
                                                                                    {{ $user->Company_Name }} <br>
                                                                                    ({{ $user->usr_type }})
                                                                                </option>
                                                                            @endforeach
                                                                        </select>
                                                                        <button type="submit"
                                                                            class="btn btn-primary mt-2">Submit</button>
                                                                    </form>
                                                                </div>

                                                                @if ($User_Info->certificates->W_Nine_Privacy == 0)
                                                                    <div class="todo-item-action">
                                                                        <a style="width: 100%; text-decoration: none;"
                                                                            href="{{ route('User.Update.Documents', ['user_id' => $User_Info->id, 'doc_id' => $User_Info->certificates->id, 'doc_type' => 'W9']) }}"
                                                                            class="edit px-2"><i
                                                                                class='bx bx-low-vision mr-2'></i><strong>{{ !$User_Info->certificates->W_Nine_Privacy == 0 ? 'Public' : 'Private' }}</strong></a>
                                                                    </div>
                                                                @endif

                                                                @if ($User_Info->certificates->W_Nine_Privacy == 1)
                                                                    <div class="todo-item-action">
                                                                        <a style="width: 100%; text-decoration: none;"
                                                                            href="{{ route('User.Update.Documents', ['user_id' => $User_Info->id, 'doc_id' => $User_Info->certificates->id, 'doc_type' => 'W9']) }}"
                                                                            class="edit px-2"><i
                                                                                class='fa fa-eye mr-2'></i><strong>{{ !$User_Info->certificates->W_Nine_Privacy == 0 ? 'Public' : 'Private' }}</strong></a>
                                                                    </div>
                                                                @endif

                                                            </li>

                                                        </ul> --}}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End -->
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane fade p-3" id="contract" role="tabpanel" aria-labelledby="contract-tab">
                            <div class="card">
                                <div class="card-body card-header">
                                    <h3>My Contracts</h3>
                                    <div class="row">
                                        @foreach ($User_Info->myContracts as $row)
                                            <div class="col-md-2" id="showmycard{{ $row->id }}">
                                                <div class="card showcard">
                                                    <div class="row">
                                                        <div class="col-md-6">

                                                            <i class="bx bx-file icon"></i>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="crosss">
                                                                <span aria-hidden="true" class="crossicon"
                                                                    data-toggle="modal" data-target="#areYouSureDelete">
                                                                    × <input type="hidden" class="id"
                                                                        value="{{ $row->id }}" />
                                                                    <input type="hidden" class="contract_Name"
                                                                        value="{{ $row->contractName }}"
                                                                        name="contract_Name" />
                                                                </span>

                                                            </div>

                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <p>{{ $row->contractName }}</p>

                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <button class="showmycontract">
                                                                <!--Edit-->
                                                                <i class="far fa-edit"></i>
                                                                <input type="hidden" class="getcontent"
                                                                    value="{{ $row->My_Contract }}" />
                                                                <input type="hidden" class="getid"
                                                                    value="{{ $row->id }}" name="contract_id" />
                                                                <input type="hidden" class="contract_Name"
                                                                    value="{{ $row->contractName }}"
                                                                    name="contract_Name" />
                                                            </button>
                                                            <button class="showmycontractonpopup" type="button"
                                                                data-toggle="modal" data-target="#showmycontractonpopup">
                                                                <!--Show-->
                                                                <i class="far fa-eye"></i>
                                                                <input type="hidden" class="getcontent"
                                                                    value="{{ $row->My_Contract }}" />
                                                                <input type="hidden" class="getid"
                                                                    value="{{ $row->id }}" name="contract_id" />
                                                                <input type="hidden" class="contract_Name"
                                                                    value="{{ $row->contractName }}"
                                                                    name="contract_Name" />
                                                            </button>

                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        @endforeach

                                        <div class="col-md-2">
                                            <div class="card showcard">
                                                <button class="addnewcontract">
                                                    <p>Add New Contract</p>
                                                </button>
                                            </div>
                                        </div>

                                    </div>
                                    <p class="font-weight-normal">If you post vehicles for shipment and have a pre-existing
                                        dispatch contract that you
                                        would like to use with your Day Dispatch sheets, you may copy and paste it below.
                                        Once
                                        you have added your contract, each carrier will be required to sign your contract at
                                        the
                                        same time they sign the dispatch sheet.</p>
                                    <strong>Please Note: Modifying your contract will NOT modify it for any dispatches that
                                        have
                                        been previously signed by the carrier.</strong>
                                    <div class="user-settings-box">
                                        <form class="was-validated " action="{{ route('User.Contract') }}"
                                            method="POST">
                                            @csrf
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="form-group">
                                                        <label>Contract</label>
                                                        <div class="headercontract">

                                                        </div>
                                                        <div class="addid">

                                                        </div>
                                                        <textarea rows="20" name="My_Contract" id="show_contract" placeholder="Contract Regarding To Shipment"
                                                            class="form-control" required>
                                                        </textarea>
                                                        <div class="invalid-feedback">
                                                            Contract Regarding To Shipment is Required.
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="btn-box text-center">
                                                    <button id="buttonsave" class="submit-btn w-100" type="button"
                                                        data-toggle="modal" data-target="#CarrierRequests"><i
                                                            class='bx bx-save'></i>
                                                        Save Contract
                                                    </button>
                                                </div>
                                            </div>

                                            <div class="modal fade" id="CarrierRequests" data-backdrop="true"
                                                role="dialog" aria-hidden="true">
                                                <div class="modal-dialog modal-xl" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Save By the Name <span
                                                                    class="get_Order_ID"></span></h5>
                                                            <button type="button" class="close" data-dismiss="modal">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body user-settings-box"
                                                            style="min-height: 100px; display: flex; flex-direction: column; justify-content: center;">
                                                            <div class="row" style="justify-content: center;">
                                                                <div class="col-md-5">
                                                                    <input type="text" name="contractName"
                                                                        class="form-control" value="" required>
                                                                </div>
                                                                <div class="col-md-2">
                                                                    <button type="submit"
                                                                        class="btn btn-success btn-block">Submit</button>
                                                                </div>
                                                            </div>
                                                            <div class="table-responsive" id="all-fetch-requests">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!--Show contract data on Popup-->
                        <div class="modal fade" id="showmycontractonpopup" data-backdrop="true" role="dialog"
                            aria-hidden="true">
                            <div class="modal-dialog modal-xl" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Name : <span class="NameOfContract"></span></h5>
                                        <button type="button" class="close" data-dismiss="modal">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body user-settings-box"
                                        style="min-height: 100px; display: flex; flex-direction: column; justify-content: center;">
                                        <div class="row" style="justify-content: center;">
                                            <div class="col-md-12">
                                                <div id="showDateOnPopup"></div>
                                            </div>
                                        </div>
                                        <div class="table-responsive" id="all-fetch-requests">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--Show contract data on Popup-->

                        <!--are you sure to delete content popup-->
                        <div class="modal fade" id="areYouSureDelete" data-backdrop="true" role="dialog"
                            aria-hidden="true">
                            <div class="modal-dialog modal-xl" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Name : <span class="NameOfContract"></span></h5>
                                        <button type="button" class="close" data-dismiss="modal">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body user-settings-box"
                                        style="min-height: 100px; display: flex; flex-direction: column; justify-content: center;">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="card">
                                                    <i class="fas fa-exclamation-triangle"></i>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <p>
                                                    Are You Sure You Want To Delete
                                                </p>
                                            </div>
                                        </div>
                                        <div class="row buttons" style="justify-content: center;">
                                            <div class="col-md-6">
                                                <div>
                                                    <button data-dismiss="modal">
                                                        <input type="hidden" id="idnumber" />
                                                        No
                                                    </button>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div>
                                                    <button id="showbutton" data-dismiss="modal">
                                                        <input type="hidden" id="idnumber" />
                                                        Yes
                                                    </button>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--are you sure to delete content popup-->

                        <div class="tab-pane fade p-3" id="address" role="tabpanel" aria-labelledby="address-tab">
                            <div class="card">
                                <div class="d-flex justify-content-end my-3">
                                    <button type="button" data-toggle="modal" data-target=".basicModalXL"
                                        class="btn btn-success">Add Contact
                                    </button>
                                </div>
                                <div class="card-body card-header">
                                    <h3>My Address Book</h3>
                                    <p class="font-weight-normal">Your List Of Address Book Contacts Are Here. Click On A
                                        Edit
                                        Action Button To Edit It.</p>
                                    <div class="table-responsive">
                                        <table class="display" id="address-book">
                                            <thead>
                                                <tr>
                                                    <th>First Name</th>
                                                    <th>Last Name</th>
                                                    <th>Company Name</th>
                                                    <th>Email Address</th>
                                                    <th>Phone Number</th>
                                                    <th>Tittle</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($User_Info->address_Book as $contact)
                                                    <tr>
                                                        <td><strong>{{ $contact->First_Name }}</strong></td>
                                                        <td>{{ $contact->Last_Name }} </td>
                                                        <td>{{ $contact->CMP_Name }}</td>
                                                        <td>{{ $contact->CMP_Address }}</td>
                                                        <td>{{ $contact->CMP_Phone_Number }}</td>
                                                        <td>{{ $contact->Title }}</td>
                                                        <td>
                                                            <div class="todo-item-action">
                                                                <a href="{{ route('User.Delete.Contact', ['contact_id' => $contact->id]) }}"
                                                                    class="btn btn-danger"><i class="bx bx-trash"></i>
                                                                    Delete</a>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane fade p-3" id="network" role="tabpanel" aria-labelledby="network-tab">
                            <div class="card user-friends-box">

                                <div class="card-body card-header">
                                    <h3>My Network</h3>
                                    <p class="font-weight-normal">Manage Your Preferred Network Or Block Companies You Do
                                        Not
                                        Wish To Do Business With. Day Dispatch Streamlines Your Ability To Work With Your
                                        Professional Business Relationships.</p>
                                    <div class="profile-header">

                                        <div class="user-profile-nav" style="padding: 25px 25px 25px 25px !important;">
                                            <ul class="nav nav-tabs" role="tablist" style="justify-content: center; ">

                                                <li class="nav-item">
                                                    <a class="nav-link active" id="prefered-tab" data-toggle="tab"
                                                        href="#prefered" role="tab" aria-controls="prefered"
                                                        aria-selected="false">Prefered Networks</a>
                                                </li>

                                                <li class="nav-item">
                                                    <a class="nav-link" id="block-tab" data-toggle="tab" href="#block"
                                                        role="tab" aria-controls="block" aria-selected="false">
                                                        Blocked Networks</a>
                                                </li>

                                            </ul>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="tab-content">
                                                <div class="tab-pane fade show active" id="prefered" role="tabpanel"
                                                    aria-labelledby="prefered-tab">
                                                    <div class="d-flex justify-content-end my-3">
                                                        <button type="button" data-toggle="modal"
                                                            data-target="#basicStaticBackdrop" class="btn btn-success">Add
                                                            Company
                                                        </button>
                                                    </div>

                                                    <div class="row">
                                                        @foreach ($My_Networks as $CMP)
                                                            @if ($CMP->status == 1)
                                                                @continue
                                                            @endif
                                                            <div class="col-lg-3 col-sm-4 col-md-3">
                                                                <div class="single-friends-box d-flex align-items-center">
                                                                    {{-- asset('backend/img/user1.jpg') --}}
                                                                    <img src="{{ $CMP->profile_photo_path ? url($CMP->profile_photo_path) : '' }}"
                                                                        alt="image">

                                                                    <div class="info ml-3">
                                                                        <h5><a target="_blank"
                                                                                href="{{ route('View.Profile', $CMP->CMP_ID) }}"
                                                                                class="d-inline-block">{{ $CMP->My_Network }}</a>
                                                                        </h5>
                                                                        <span
                                                                            class="d-inline-block">{{ $CMP->usr_type }}</span><br>
                                                                        <h6>
                                                                            <a href="{{ route('User.Update.Network', $CMP->id) }}"
                                                                                class="badge badge-danger">Blocked</a>
                                                                        </h6>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    </div>

                                                </div>

                                                <div class="tab-pane fade" id="block" role="tabpanel"
                                                    aria-labelledby="block-tab">
                                                    <div class="d-flex justify-content-end my-3">
                                                        <button type="button" data-toggle="modal"
                                                            data-target="#basicStaticBackdropI"
                                                            class="btn btn-warning">Add
                                                            Company
                                                        </button>
                                                    </div>

                                                    <div class="row">
                                                        @foreach ($My_Networks as $CMP)
                                                            @if ($CMP->status == 0)
                                                                @continue
                                                            @endif
                                                            <div class="col-lg-3 col-sm-4 col-md-3">
                                                                <div class="single-friends-box d-flex align-items-center">
                                                                    {{-- asset('backend/img/user1.jpg') --}}
                                                                    <img src="{{ $CMP->profile_photo_path ? url($CMP->profile_photo_path) : '' }}"
                                                                        alt="image">

                                                                    <div class="info ml-3">
                                                                        <h5><a target="_blank"
                                                                                href="{{ route('View.Profile', $CMP->CMP_ID) }}"
                                                                                class="d-inline-block">{{ $CMP->My_Network }}</a>
                                                                        </h5>
                                                                        <span
                                                                            class="d-inline-block">{{ $CMP->usr_type }}</span><br>
                                                                        <h6>
                                                                            <a href="{{ route('User.Update.Network', $CMP->id) }}"
                                                                                class="badge badge-success">Un-Blocked</a>
                                                                        </h6>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane fade p-3" id="notification" role="tabpanel" aria-labelledby="notification-tab">
                            <div class="card-header">
                                <h3>Notification Settings</h3>
                            </div>
                                <div class="container-flude">
                                    <div class="card user-settings-box mb-30">
                                        <div class="card-body">
                                            <form class="was-validated" method="POST"
                                                action="{{ route('User.Notification.Update') }}">
                                                @csrf
        
                                                <div class="row">
                                                    {{-- <div class="col-6">
                                                    <h4 class="text-white py-2 d-flex justify-content-center"
                                                        style="background: #113771;border-radius: 25px 25px 0px 0px;">
                                                        Notification Channels
                                                    </h4>
                                                    <div class="card-body m-5">
                                                        <div class="form-group">
                                                            <div class="custom-control custom-switch">
                                                                <input type="checkbox" class="custom-control-input" name="email_notification" id="customSwitch1" value="1" @if($User_Info->setting && $User_Info->setting->email_notification ?? 1) checked @endif>
                                                                <label class="custom-control-label" for="customSwitch1">Enable Email Notification</label>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <div class="custom-control custom-switch">
                                                                <input type="checkbox" class="custom-control-input" name="custom_notification" id="customSwitch2" value="1" @if($User_Info->setting && $User_Info->setting->custom_notification ?? 1) checked @endif>
                                                                <label class="custom-control-label" for="customSwitch2">Enable Custom Notification</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    </div> --}}
                                                    
                                                    {{-- <div class="col-6">
                                                        <h4 class="text-white py-2 d-flex justify-content-center"
                                                            style="background: #113771;border-radius: 25px 25px 0px 0px;">
                                                            Notification Channels
                                                        </h4>
                                                        <div class="card-body m-5">
                                                            <!-- Email Notification Toggle -->
                                                            <div class="form-group">
                                                                <div class="custom-control custom-switch">
                                                                    <input type="checkbox" class="custom-control-input" name="email_notification" id="customSwitch1" value="1" 
                                                                        @if($User_Info->setting && $User_Info->setting->email_notification ?? 1) checked @endif>
                                                                    <label class="custom-control-label" for="customSwitch1">Enable Email Notification</label>
                                                                </div>
                                                            </div>
                                                    
                                                            <!-- Hidden Subtoggles -->
                                                            <div id="hiddenSubToggles" style="display: none; margin-left: 20px;">
                                                                <!-- Allow All -->
                                                                <div class="form-group">
                                                                    <div class="custom-control custom-switch">
                                                                        <input type="checkbox" class="custom-control-input" name="sub_toggle_1" id="subToggle1" value="1" checked>
                                                                        <label class="custom-control-label" for="subToggle1">Allow All</label>
                                                                    </div>
                                                                </div>
                                                                <!-- Saved Filters Only -->
                                                                <div class="form-group">
                                                                    <div class="custom-control custom-switch">
                                                                        <input type="checkbox" class="custom-control-input" name="sub_toggle_2" id="subToggle2" value="1">
                                                                        <label class="custom-control-label" for="subToggle2">Saved Filters Only</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                    
                                                            <!-- Custom Notification Toggle -->
                                                            <div class="form-group">
                                                                <div class="custom-control custom-switch">
                                                                    <input type="checkbox" class="custom-control-input" name="custom_notification" id="customSwitch2" value="1" 
                                                                        @if($User_Info->setting && $User_Info->setting->custom_notification ?? 1) checked @endif>
                                                                    <label class="custom-control-label" for="customSwitch2">Enable Custom Notification</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div> --}}
                                                    <div class="col-6">
                                                        <h4 class="text-white py-2 d-flex justify-content-center"
                                                            style="background: #113771;border-radius: 25px 25px 0px 0px;">
                                                            Notification Channels
                                                        </h4>
                                                        <div class="card-body m-5">
                                                            <!-- Email Notification Toggle -->
                                                            <div class="form-group">
                                                                <div class="custom-control custom-switch">
                                                                    <input type="checkbox" class="custom-control-input" name="email_notification" id="customSwitch1" value="1" 
                                                                        @if(isset($User_Info->setting->email_notification) ? $User_Info->setting->email_notification : 1) checked @endif>
                                                                    <label class="custom-control-label" for="customSwitch1">Enable Email Notification</label>
                                                                </div>
                                                            </div>
                                                    
                                                            <!-- Hidden Radio Buttons for Notification Type -->
                                                            <div id="hiddenSubToggles" style="display: none; margin-left: 20px;">
                                                                <div class="form-group">
                                                                    <div class="custom-control custom-radio">
                                                                        <input type="radio" class="custom-control-input" name="notification_type" id="radioAllowAll" value="allow_all" checked>
                                                                        <label class="custom-control-label" for="radioAllowAll">Allow All</label>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <div class="custom-control custom-radio">
                                                                        <input type="radio" class="custom-control-input" name="notification_type" id="radioSavedFilters" value="saved_filters">
                                                                        <label class="custom-control-label" for="radioSavedFilters">Saved Filters Only</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                    
                                                            <!-- Custom Notification Toggle -->
                                                            <div class="form-group">
                                                                <div class="custom-control custom-switch">
                                                                    <input type="checkbox" class="custom-control-input" name="custom_notification" id="customSwitch2" value="1" 
                                                                        @if(isset($User_Info->setting->custom_notification) ? $User_Info->setting->custom_notification : 1) checked @endif>
                                                                    <label class="custom-control-label" for="customSwitch2">Enable Custom Notification</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
            
                                                    <div class="col-6">
                                                        <h4 class="text-white py-2 d-flex justify-content-center"
                                                            style="background: #113771;border-radius: 25px 25px 0px 0px;">
                                                            Preferences
                                                        </h4>
                                                        <div class="card-body m-5">
                                                            <div class="form-group">
                                                                <div class="custom-control custom-switch">
                                                                    <input type="checkbox" class="custom-control-input" name="prefer_vehicle" id="vehicle" value="1" @if($User_Info->setting && $User_Info->setting->prefer_vehicle ?? 1) checked @endif>
                                                                    <label class="custom-control-label" for="vehicle">Vehicle</label>
                                                                </div>
                                                                <div class="custom-control custom-switch">
                                                                    <input type="checkbox" class="custom-control-input" name="prefer_heavy" id="heavy" value="1" @if($User_Info->setting && $User_Info->setting->prefer_heavy ?? 1) checked @endif>
                                                                    <label class="custom-control-label" for="heavy">Heavy</label>
                                                                </div>
                                                                <div class="custom-control custom-switch">
                                                                    <input type="checkbox" class="custom-control-input" name="prefer_dryvan" id="dryvan" value="1" @if($User_Info->setting && $User_Info->setting->prefer_dryvan ?? 1) checked @endif>
                                                                    <label class="custom-control-label" for="dryvan">Dry Van / Freight</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="btn-box text-right">
                                                    <button type="submit" class="submit-btn"><i class='bx bx-save'></i>
                                                        Save
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            {{-- </div> --}}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
</form>
<div class="modal fade basicModalXL" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title text-center">Add New Contact Information to Your Address Book.</h4>
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body user-settings-box">
                <form action="{{ route('User.New.Contact') }}" method="POST" class="was-validated">
                    @csrf
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>First Name</label>
                                <input type="text" class="form-control" name="CMP_First_Name"
                                    placeholder="Enter First Name" required>
                                <div class="invalid-feedback">
                                    Entered First Name.
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Last Name</label>
                                <input type="text" class="form-control" name="CMP_Last_Name"
                                    placeholder="Enter First Name" >
                                <div class="invalid-feedback">
                                    Entered Last Name.
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Company Name</label>
                                <input type="text" class="form-control" name="CMP_Name"
                                    placeholder="Enter Company Name" required>
                                <div class="invalid-feedback">
                                    Entered Company Name.
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Email Address</label>
                                <input type="text" class="form-control" name="CMP_Email"
                                    placeholder="Enter Your Email" required>
                                <div class="invalid-feedback">
                                    Entered Email Address.
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Phone Number</label>
                                <input type="text" class="form-control" placeholder="Phone Number"
                                    name="Phone_Number" maxlength="14" autocomplete="off"
                                    onkeypress="return onlyNumberKey(evnt)" required>
                                <div class="invalid-feedback">
                                    Entered Phone Number.
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Title</label>
                                <input type="text" class="form-control" name="CMP_Title"
                                    placeholder="Enter Title" required>
                                <div class="invalid-feedback">
                                    Entered Title.
                                </div>
                            </div>
                        </div>
                        {{-- <div class="col-lg-6">
                            <div class="form-group">
                                <label>Company Address</label>
                                <input type="text" class="form-control" name="CMP_Address"
                                    placeholder="Enter Company Address" required>
                                <div class="invalid-feedback">
                                    Entered Company Address.
                                </div>
                            </div>
                        </div> --}}

                        {{-- <div class="col-lg-6">
                            <div class="form-group">
                                <label>Buyer Number</label>
                                <input type="text" class="form-control" placeholder="Buyer Number"
                                    name="Buyer_Number" required>
                                <div class="invalid-feedback">
                                    Entered Buyer Number.
                                </div>
                            </div>
                        </div> --}}

                        {{-- <div class="col-lg-4">
                            <div class="form-group">
                                <label>City</label>
                                <input type="text" class="form-control" name="CMP_City" placeholder="Enter City"
                                    required autocomplete="off" onkeypress="return /^[a-zA-Z\s]*$/g.test(event.key)">
                                <div class="invalid-feedback">
                                    Entered City.
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4">
                            <div class="form-group">
                                <label>State</label>
                                <select class="custom-select" name="CMP_State" required>
                                    <option value="">Select AnyOne</option>
                                    <option value="AK">Alaska</option>
                                    <option value="AZ">Arizona</option>
                                    <option value="AR">Arkansas</option>
                                    <option value="CA">California</option>
                                    <option value="CO">Colorado</option>
                                    <option value="CT">Connecticut</option>
                                    <option value="DE">Delaware</option>
                                    <option value="FL">Florida</option>
                                    <option value="GA">Georgia</option>
                                    <option value="HI">Hawaii</option>
                                    <option value="ID">Idaho</option>
                                    <option value="IL">Illinois</option>
                                    <option value="IN">Indiana</option>
                                    <option value="IA">Iowa</option>
                                    <option value="KS">Kansas</option>
                                    <option value="KY">Kentucky</option>
                                    <option value="LA">Louisiana</option>
                                    <option value="ME">Maine</option>
                                    <option value="MD">Maryland</option>
                                    <option value="MA">Massachusetts</option>
                                    <option value="MI">Michigan</option>
                                    <option value="MN">Minnesota</option>
                                    <option value="MS">Mississippi</option>
                                    <option value="MO">Missouri</option>
                                    <option value="MT">Montana</option>
                                    <option value="NE">Nebraska</option>
                                    <option value="NV">Nevada</option>
                                    <option value="NH">New Hampshire</option>
                                    <option value="NJ">New Jersey</option>
                                    <option value="NM">New Mexico</option>
                                    <option value="NY">New York</option>
                                    <option value="NC">North Carolina</option>
                                    <option value="ND">North Dakota</option>
                                    <option value="OH">Ohio</option>
                                    <option value="OK">Oklahoma</option>
                                    <option value="OR">Oregon</option>
                                    <option value="PA">Pennsylvania</option>
                                    <option value="RI">Rhode Island</option>
                                    <option value="SC">South Carolina</option>
                                    <option value="SD">South Dakota</option>
                                    <option value="TN">Tennessee</option>
                                    <option value="TX">Texas</option>
                                    <option value="UT">Utah</option>
                                    <option value="VT">Vermont</option>
                                    <option value="VA">Virginia</option>
                                    <option value="WA">Washington</option>
                                    <option value="DC">Washington DC</option>
                                    <option value="WV">West Virginia</option>
                                    <option value="WI">Wisconsin</option>
                                    <option value="WY">Wyoming</option>
                                    <option value="AB">Alberta</option>
                                    <option value="BC">British Columbia</option>
                                    <option value="MB">Manitoba</option>
                                    <option value="NB">New Brunswick</option>
                                    <option value="NL">Newfoundland</option>
                                    <option value="NT">Northwest Territories</option>
                                    <option value="NS">Nova Scotia</option>
                                    <option value="NU">Nunavut</option>
                                    <option value="ON">Ontario</option>
                                    <option value="PE">Prince Edward Island</option>
                                    <option value="QC">Quebec</option>
                                    <option value="SK">Saskatchewan</option>
                                    <option value="YT">Yukon</option>
                                </select>
                                <div class="invalid-feedback">Select Any State</div>
                            </div>
                        </div>

                        <div class="col-lg-4">
                            <div class="form-group">
                                <label>Postal Code</label>
                                <input type="number" class="form-control" placeholder="Postal Code"
                                    name="Postal_Code" required>
                                <div class="invalid-feedback">
                                    Entered Postal Code.
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4">
                            <div class="form-group">
                                <label>Phone Number</label>
                                <input type="text" class="form-control phone-number" name="CMP_Phone"
                                    placeholder="Enter Phone Number" maxlength="14" autocomplete="off"
                                    onkeypress="return onlyNumberKey(evnt)" required>
                                <div class="invalid-feedback">
                                    Entered Phone Number.
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4">
                            <div class="form-group">
                                <label>Phone Number (Optional)</label>
                                <input type="text" class="form-control phone-number" name="CMP_Phone_I"
                                    placeholder="Enter Phone Number" maxlength="14" autocomplete="off"
                                    onkeypress="return onlyNumberKey(evnt)">
                            </div>
                        </div>

                        <div class="col-lg-4">
                            <div class="form-group">
                                <label>Phone Number (Optional)</label>
                                <input type="text" class="form-control phone-number" name="CMP_Phone_II"
                                    placeholder="Enter Phone Number" maxlength="14" autocomplete="off"
                                    onkeypress="return onlyNumberKey(evnt)">
                            </div>
                        </div> --}}
                        <div class="col-lg-12">
                            <div class="btn-box text-center">
                                <button type="submit" class="submit-btn w-100"><i class='bx bx-save'></i>
                                    Save Contract
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="basicStaticBackdrop" data-backdrop="true" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add New Company Information</h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body user-settings-box">
                <form action="{{ route('User.Add.Network') }}" method="POST" class="was-validated">
                    @csrf
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group network">
                                <label>Find/Select Company</label>
                                <input type="text" class="form-control CMP_Find" name="CMP_Find"
                                    placeholder="Enter Company Name" required>
                                <div class="invalid-feedback">
                                    Entered Company Name.
                                </div>
                                <input hidden type="text" class="CMP_ID" name="CMP_ID" value="">
                                <div class="CMP_list"></div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="btn-box text-center">
                                <button type="submit" class="submit-btn w-100"><i class='bx bx-save'></i>
                                    Add to List
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="basicStaticBackdropI" data-backdrop="true" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Blocked Company Information</h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body user-settings-box">
                <form action="{{ route('User.Blocked.Network') }}" method="POST" class="was-validated">
                    @csrf
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group network">
                                <label>Find/Select Company</label>
                                <input type="text" class="form-control CMP_Find" name="CMP_Find"
                                    placeholder="Enter Company Name" required>
                                <div class="invalid-feedback">
                                    Entered Company Name.
                                </div>
                                <input hidden type="text" class="CMP_ID" name="CMP_ID" value="">
                                <div class="CMP_list"></div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="btn-box text-center">
                                <button type="submit" class="submit-btn w-100"><i class='bx bx-save'></i>
                                    Add to Blocked List
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="addDisputeModal" data-backdrop="true" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Dispute Ratings From <span id="get_Profile_Name"></span></h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body user-settings-box">
                <p>Add Dispute with your explanation of what happend & how would you like to resolve the
                    Rating Cover
                    Sheet</p>
                <form action="{{ route('User.Add.Disputes') }}" method="POST" class="was-validated"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>Reply with your explanation of what happend & how would you like to resolve the
                                    Rating</label>
                                <input type="text" class="form-control" name="Dispute_Comments"
                                    placeholder="Enter Explanation" required>
                                <div class="invalid-feedback">
                                    Explanation Required.
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <label>Upload Documents</label>
                            <div class="input-group mb-3">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" name="Dispute_Documents[]"
                                        multiple>
                                    <label class="custom-file-label">Upload File(s)</label>
                                </div>
                            </div>
                        </div>
                        <input hidden type="text" id="get_Profile_ID" name="Profile_ID" value="">
                        <input hidden type="text" id="get_Rate_ID" name="Rate_ID" value="">
                        <div class="col-lg-12">
                            <div class="btn-box text-center">
                                <button type="submit" class="submit-btn w-100"><i class='bx bx-save'></i>
                                    Submit Dispute
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="viewDisputeModal" data-backdrop="true" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">View Dispute Ratings From <span id="get_Profile_Name_view"></span></h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body user-settings-box">
                <p>Add Dispute with your explanation of what happend & how would you like to resolve the
                    Rating Cover
                    Sheet</p>
                <div id="fetch-disputes-records"></div>
                <form action="{{ route('User.Add.Disputes') }}" method="POST" class="was-validated"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>Reply with your explanation of what happend & how would you like to resolve the
                                    Rating</label>
                                <input type="text" class="form-control" name="Dispute_Comments"
                                    placeholder="Enter Explanation" required>
                                <div class="invalid-feedback">
                                    Explanation Required.
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <label>Upload Documents</label>
                            <div class="input-group mb-3">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" name="Dispute_Documents[]"
                                        multiple>
                                    <label class="custom-file-label">Upload File(s)</label>
                                </div>
                            </div>
                        </div>
                        <input hidden type="text" id="get_Profile_ID_view" name="Profile_ID" value="">
                        <input hidden type="text" id="get_Rate_ID_view" name="Rate_ID" value="">
                        <div class="col-lg-12">
                            <div class="btn-box text-center">
                                <button type="submit" class="submit-btn w-100"><i class='bx bx-save'></i>
                                    Submit Dispute
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script>
    $('#rating-recieved').DataTable();
    $('#rating-send').DataTable();
    $('#address-book').DataTable();
    $('#network-list').DataTable();

    $(document).ready(function() {

    $(document).on('keyup', '.CMP_Find', function() {
        var query = $(this).val();
        $.ajax({
            url: '{{ route('Find.Network') }}',
            type: 'GET',
            data: {
                'name': query
            },
            success: function(data) {
                // console.log(data);
                $('.CMP_list').html(data);
            }
        });
    });
    // $(document).on('keyup', '.CMP_Find', function() {
    //     console.log('okaaaa');
    //     // $('.CMP_Find').on('keyup', function() {
    //         var query = $(this).val();
    //         $.ajax({
    //             url: '{{ route('Find.Network') }}',
    //             type: 'GET',
    //             data: {
    //                 'name': query
    //             },
    //             success: function(data) {
    //                 $('.CMP_list').html(data);
    //             }
    //         })
    //     });
        // });
        $(document).on('click', '.network li', function() {
            var value = $(this).text();
            $('.CMP_Find').val(value);
            var cMP_ID = $('.network li input').val();
            $(".CMP_ID").val(cMP_ID);
            $('.CMP_list').html("");
        });

        // Add Dispute Functionality
        $("td.action-column").click(function() {
            var getProfileID = $(this).find('.Profile_ID').val();
            var getProfileName = $(this).find('.Profile_Name').val();
            var getRateID = $(this).find('.Rate_ID').val();
            $("#get_Profile_Name").html(getProfileName);
            $("#get_Profile_ID").val(getProfileID);
            $("#get_Rate_ID").val(getRateID);
        });

        // View Dispute Functionality
        $("td.view-action-column").click(function() {
            var getProfileID = $(this).find('.Profile_ID').val();
            var getProfileName = $(this).find('.Profile_Name').val();
            var getRateID = $(this).find('.Rate_ID').val();
            $("#get_Profile_Name_view").html(getProfileName);
            $("#get_Profile_ID_view").val(getProfileID);
            $("#get_Rate_ID_view").val(getRateID);

            $.ajax({
                url: '{{ route('User.View.Disputes') }}',
                type: 'GET',
                data: {
                    'Profile_ID': getProfileID,
                    'Rate_ID': getRateID
                },
                success: function(data) {
                    $('#fetch-disputes-records').html(data);
                }
            })

        });

    });



    $('.showmycontract').click(function() {
        // console.log('showcontract')
        let x = $(this).children('.getid').val();
        let y = $(this).children('.getcontent').val();
        let show_contract = document.getElementById('show_contract');
        let contract_Name = $(this).children('.contract_Name').val();

        show_contract.value = y;
        $('.addid').html(
            `<input type="hidden" value="${x}"  name="contract_id" /><input type="hidden" value="${contract_Name}"  name="contractName" /> `
        );
        $('#buttonsave').attr('type', 'submit');
        $('#buttonsave').text('Update Contract');
        $('#CarrierRequests').html('');
        $('.headercontract').html(`
            <div class="contract">
            <span class="addnewcontract">×</span>
                ${contract_Name}
            </div>
        `);
    });



    $('.addnewcontract').click(function() {
        document.getElementById('show_contract').value = '';
        $('#CarrierRequests').html(` <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Save By the Name <span class="get_Order_ID"></span></h5>
                        <button type="button" class="close" data-dismiss="modal">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body user-settings-box" style="min-height: 100px; display: flex; flex-direction: column; justify-content: center;">
                        <div class="row" style="justify-content: center;">
                            <div class="col-md-5">
                                <input type="text" name="contractName" class="form-control" value="" required>
                            </div>
                            <div class="col-md-2">
                                <button type="submit" class="btn btn-success btn-block">Submit</button>
                            </div>
                        </div>
                        <div class="table-responsive" id="all-fetch-requests">
                        </div>
                    </div>
                </div>
            </div>
        `);
        $('.addid').html(``);
        $('#buttonsave').attr('type', 'button');
        $('#buttonsave').html(`<i class='bx bx-save'></i> Save Contract`);
        $('.headercontract').html(``);
    })

    $('.showmycontractonpopup').click(function() {
        let getcontent = $(this).children('.getcontent').val();
        let name = $(this).children('.contract_Name').val();

        // console.log(getcontent)
        $('#showDateOnPopup').text(getcontent);
        $('.NameOfContract').text(name)

    })

    var getinputfirst;
    var getcontractnamefirst;
    $('.crossicon').click(function() {
        getinputfirst = $(this).children('.id').val();
        getcontractnamefirst = $(this).children('.contract_Name').val();
        // console.log(getcontractnamefirst)
        $('#areYouSureDelete .NameOfContract').text(getcontractnamefirst);

    })

    $('#showbutton').click(function() {

        $('#idnumber').text(getinputfirst);

        var id = getinputfirst;
        var url = "{{ route('User.Delete.Contract', ':id') }}";
        url = url.replace(':id', id);

        $.ajax({
            type: "GET",
            url: url,
        }).done(function(data) {
            // alert(data);
            $(`#showmycard${getinputfirst}`).remove();
        });

    })

    $(document).ready(function() {
        // Show/Hide Radio Buttons based on email notification toggle
        if ($('#customSwitch1').is(':checked')) {
            $('#hiddenSubToggles').show();
        }

        $('#customSwitch1').on('change', function() {
            if ($(this).is(':checked')) {
                $('#hiddenSubToggles').fadeIn();
            } else {
                $('#hiddenSubToggles').fadeOut();
                $('#radioAllowAll').prop('checked', true); // Default to "Allow All" when hidden
            }
        });

        // Prevent no selection for radio buttons (handled inherently by radio input type)
        $('input[name="notification_type"]').on('change', function() {
            if (!$('#radioAllowAll').is(':checked') && !$('#radioSavedFilters').is(':checked')) {
                $('#radioAllowAll').prop('checked', true); // Fallback to default
                alert("At least one notification type must be selected!");
            }
        });
    });

    // $(document).ready(function() {

    //     var select = $('select[multiple]');
    //     var options = select.find('option');

    //     var div = $('<div />').addClass('selectMultiple');
    //     var active = $('<div />');
    //     var list = $('<ul />');
    //     var placeholder = select.data('placeholder');

    //     var span = $('<span />').text(placeholder).appendTo(active);

    //     options.each(function() {
    //         var text = $(this).text();
    //         if ($(this).is(':selected')) {
    //             active.append($('<a />').html('<em>' + text + '</em><i></i>'));
    //             span.addClass('hide');
    //         } else {
    //             list.append($('<li />').html(text));
    //         }
    //     });

    //     active.append($('<div />').addClass('arrow'));
    //     div.append(active).append(list);

    //     select.wrap(div);

    //     $(document).on('click', '.selectMultiple ul li', function(e) {
    //         var select = $(this).parent().parent();
    //         var li = $(this);
    //         if (!select.hasClass('clicked')) {
    //             select.addClass('clicked');
    //             li.prev().addClass('beforeRemove');
    //             li.next().addClass('afterRemove');
    //             li.addClass('remove');
    //             var a = $('<a />').addClass('notShown').html('<em>' + li.text() + '</em><i></i>').hide()
    //                 .appendTo(select.children('div'));
    //             a.slideDown(400, function() {
    //                 setTimeout(function() {
    //                     a.addClass('shown');
    //                     select.children('div').children('span').addClass('hide');
    //                     select.find('option:contains(' + li.text() + ')').prop(
    //                         'selected', true);
    //                 }, 500);
    //             });
    //             setTimeout(function() {
    //                 if (li.prev().is(':last-child')) {
    //                     li.prev().removeClass('beforeRemove');
    //                 }
    //                 if (li.next().is(':first-child')) {
    //                     li.next().removeClass('afterRemove');
    //                 }
    //                 setTimeout(function() {
    //                     li.prev().removeClass('beforeRemove');
    //                     li.next().removeClass('afterRemove');
    //                 }, 200);

    //                 li.slideUp(400, function() {
    //                     li.remove();
    //                     select.removeClass('clicked');
    //                 });
    //             }, 600);
    //         }
    //     });

    //     $(document).on('click', '.selectMultiple > div a', function(e) {
    //         var select = $(this).parent().parent();
    //         var self = $(this);
    //         self.removeClass().addClass('remove');
    //         select.addClass('open');
    //         setTimeout(function() {
    //             self.addClass('disappear');
    //             setTimeout(function() {
    //                 self.animate({
    //                     width: 0,
    //                     height: 0,
    //                     padding: 0,
    //                     margin: 0
    //                 }, 300, function() {
    //                     var li = $('<li />').text(self.children('em').text())
    //                         .addClass('notShown').appendTo(select.find('ul'));
    //                     li.slideDown(400, function() {
    //                         li.addClass('show');
    //                         setTimeout(function() {
    //                             select.find('option:contains(' +
    //                                 self.children('em')
    //                                 .text() + ')').prop(
    //                                 'selected', false);
    //                             if (!select.find(
    //                                     'option:selected')
    //                                 .length) {
    //                                 select.children('div')
    //                                     .children('span')
    //                                     .removeClass('hide');
    //                             }
    //                             li.removeClass();
    //                         }, 400);
    //                     });
    //                     self.remove();
    //                 })
    //             }, 300);
    //         }, 400);
    //     });

    //     $(document).on('click', '.selectMultiple > div .arrow, .selectMultiple > div span', function(e) {
    //         $(this).parent().parent().toggleClass('open');
    //     });

    // });

</script>

<script>
    document.getElementById('profile-image-input').addEventListener('change', function(event) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('profile-image-preview').src = e.target.result;
            };
            reader.readAsDataURL(file);
        }
    });

    document.getElementById('cover-image-input').addEventListener('change', function(event) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('cover-image-preview').src = e.target.result;
            };
            reader.readAsDataURL(file);
        }
    });
</script>