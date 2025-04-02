<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

@extends('layouts.authorized-admin')

@section('content')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Dashboard</h4>
    
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        {{-- <li class="breadcrumb-item"><a href="{{ route('Admin.Dashboard') }}">Dashboard</a></li> --}}
                        <li class="breadcrumb-item active">Users List</li>
                    </ol>
                </div>
    
            </div>
        </div>
    </div>
    <!-- end page title -->
    
    <div class="card">
        <div class="card-header">
            <h5 class="card-title mb-0">All Registered Users List</h5>
        </div>
        <div class="card-body">
            <div class="d-flex justify-content-between">                        
                <h3>Groups</h3>
                <a class="btn btn-primary" data-bs-toggle="modal" href="#AddNewUser"><i
                                class="fa fa-plus"></i> Add New
                        </a>
            </div>
            <table id="example" class="table table-bordered dt-responsive nowrap table-striped align-middle text-center"
                   style="width:100%">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Group Name</th>
                    <th>Status</th>
                    <th>Created At</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @forelse ($group as $key => $val)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{$val->name}}</td>
                        <td><span class="badge text-white {{ $val->status == 0 ? 'bg-warning' : ($val->status == 1 ? 'bg-success' : 'bg-danger') }}">{{ $val->status == 0 ? 'Not Active' : ($val->status == 1 ? 'Active' : 'Deleted') }}</span></td>
                        <td>{{ \Carbon\Carbon::parse($val->created_at)->format('M,d Y h:i:s A') }}</td>
                        <td>
                            <div class="btn-group">
                                <input type="hidden" class="id" value="{{$val->id}}">
                                    @if($val->status == 0)
                                        <a title="Active" class="btn btn-info" href="{{ route('chat.group.active', $val->id) }}"><i class="fa fa-plus"></i></a>
                                        <a title="Delete" class="btn btn-danger" href="{{ route('chat.group.destroy', $val->id) }}"><i class="fa fa-trash"></i></a>
                                    @elseif($val->status == 1)
                                        <a title="Non active" class="btn btn-warning" href="{{ route('chat.group.notActive', $val->id) }}"><i class="fa fa-minus"></i></a>
                                        <a title="Delete" class="btn btn-danger" href="{{ route('chat.group.destroy', $val->id) }}"><i class="fa fa-trash"></i></a>
                                    @else
                                        <a title="Active" class="btn btn-info" href="{{ route('chat.group.active', $val->id) }}"><i class="fa fa-plus"></i></a>
                                        <a title="Non active" class="btn btn-warning" href="{{ route('chat.group.notActive', $val->id) }}"><i class="fa fa-minus"></i></a>
                                    @endif
                                {{-- <a title="Edit" class="btn btn-success editMile" href="#" data-toggle="modal" data-target="#exampleModalEdit{{$val->id}}"><i class="fa fa-edit"></i></a> --}}
                            </div>
                        </td>
                    </tr>
                @empty
    
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
    
    <div class="modal fade" id="AddNewUser" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content border-0" style="max-width: 100%">
                <div class="modal-header p-3 bg-soft-info">
                    <h5 class="modal-title" id="exampleModalLabel"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                        id="close-modal"></button>
                </div>
                <div class="card mt-4">
                    <div class="card-body p-4">
                        <div class="text-center mt-2">
                            <h5 class="text-primary">Create New User Account</h5>
                            <!--<p class="text-muted">Get your free Day Dispatch account now</p>-->
                        </div>
                        <div class="p-2 mt-4">
                            <form action="{{ route('chat.group.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div style="form-layout margin:20px auto 0;padding: 1rem 0 0;">
                                    <div class="row">
                                        <div class="form-group col-12">
                                            <label class="form-control-label font-weight-bold tx-black"
                                                style="text-align: left !important; display: inherit">Group Name<span
                                                    class="text-danger">*</span></label>
                                            <input class="form-control" name="name" type="text" placeholder="Group Name" />
                                        </div>
                                        <div class="form-group col-12 position-relative">
                                            <label class="form-control-label font-weight-bold tx-black"
                                                style="text-align: left !important; display: inherit">Group description</label>
                                            <textarea class="form-control" name="description" placeholder="Group description"
                                                cols="30" rows="10"></textarea>
                                        </div>
                                        <div class="form-group col-12 position-relative">
                                            <label for="logo" class="form-control-label font-weight-bold tx-black"
                                                style="text-align: left !important; display: inherit">Group Logo</label>
                                            <input class="form-control" style="height: auto" name="logo" type="file" id="logo"
                                                accept="image/*" />
                                        </div>
                                        <div class="text-left col-12 mb-3 position-relative">
                                            <img id="blah" src="#" alt="your image" class="rounded-circle ml-0"
                                                style="width: 20%; display: none" />
                                        </div>
                                        <div class="form-group col-12 position-relative">
                                            <label class="form-control-label font-weight-bold tx-black"
                                                style="text-align: left !important; display: inherit">Status</label>
                                            <select name="status" class="form-control py-0">
                                                <option value="" selected disabled>Select Status</option>
                                                <option value="1">Active</option>
                                                <option value="0">Not active</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-12 position-relative">
                                            <label class="form-control-label font-weight-bold tx-black"
                                                style="text-align: left !important; display: inherit">Users<span
                                                    class="text-danger">*</span></label>
                                            <div class="row form-control" style="height: 150px; overflow: scroll; margin: 0">
                                                @foreach($user as $key => $value)
                                                <div class="col-sm-6 text-left">
                                                    <input type="checkbox" name="user[]" value="{{$value->id}}"
                                                        id="users{{$value->id}}" />
                                                    <label for="users{{$value->id}}">{{($value->name) ? $value->name :
                                                        $value->name}}</label>
                                                </div>
                                                @endforeach
                                            </div>
                                        </div>
                                        <div class="form-group col-12 text-right">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                                Close
                                            </button>
                                            <button type="submit" name="submit" value="submit" class="btn btn-primary">
                                                Save
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- end card body -->
                </div>
                <!-- end card -->
            </div>
        </div>
    </div>
@endsection