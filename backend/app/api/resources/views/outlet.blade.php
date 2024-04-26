@extends('layout.dashboard.app')
@section('title', 'Dashboard')


@section('content')

<style>
    .my-tabs  .nav-link.active {
        background-color: #F2F4F7 !important;
    }
    .custom-table {
    border: none;
    }

    .custom-table th,
    .custom-table td {
        border: none;
    }

    table tbody {
    background-color: white;
    }

    table tbody td {
    display: table-cell
    }

    table tbody tr:first-child td:first-child {
    border-top-left-radius: 16px;
    }

    table tbody tr:first-child td:last-child {
    border-top-right-radius: 16px;
    }

    table tbody tr:last-child td:first-child {
    border-bottom-left-radius: 16px;
    }

    table tbody tr:last-child td:last-child {
    border-bottom-right-radius: 16px;
    }

    .cnt-pd {
        padding: 2% 2% 0 2%;
    }
    .csm-pb {
        padding-bottom: 0
    }


</style>

    <div class="content-wrapper bg-white cnt-pd">
        <div class="content-header csm-pb">
            <div class="container-fluid">
                <div class="row mb-5">
                    <div class="col-sm-6">
                        <h1 class="m-0">Accounts</h1>
                        <span>Manage all restaurant accounts that manages the food ordering kiosk products.</span>
                    </div>
                </div>
            </div>
        </div>


        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="my-tabs">
                    <div class="row">
                        <div class="col-2 col-sm-2" style="padding-right:0">
                            <div class="nav flex-column nav-tabs h-100" id="vert-tabs-tab" role="tablist" aria-orientation="vertical">
                                <a class="nav-link text-dark active" id="vert-tabs-account-tab" data-toggle="pill" href="#vert-tabs-account" role="tab" aria-controls="vert-tabs-account" aria-selected="true">Users</a>
                                <a class="nav-link text-dark" id="vert-tabs-restaurant-tab" data-toggle="pill" href="#vert-tabs-restaurant" role="tab" aria-controls="vert-tabs-restaurant" aria-selected="false">Restaurant</a>
                            </div>
                        </div>

                        <div class="col-10 col-sm-9" style="background-color: #F2F4F7; padding: 20px; border-radius: 0px 8px 8px 8px;">

                                    <div class="tab-content" id="vert-tabs-tabContent">
                                        <div class="tab-pane text-left fade show active" id="vert-tabs-account" role="tabpanel" aria-labelledby="vert-tabs-account-tab">
                                            <h1>Users</h1>
                                        </div>

                                        <div class="tab-pane fade" id="vert-tabs-restaurant" role="tabpanel" aria-labelledby="vert-tabs-restaurant-tab">

                                            <button type="button" class="add-resto btn text-white" data-toggle="modal" data-target="#exampleModal">
                                                Add Restaurant
                                            </button>

                                        <table id="example2" class="table table-bordered table-hover custom-table">
                                            <thead>
                                                <tr>
                                                    <th>Image</th>
                                                    <th>Name</th>
                                                    <th>Status</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                            @foreach ($outlets as $outlet)
                                            <tr>
                                                <td><img src="{{ asset($outlet->image) }}" alt="Outlet Image" height="50px"></td>
                                                <td>{{ $outlet->name }}</td>
                                                <td class="{{ $outlet->status == 1 ? 'text-success' : 'text-danger' }}">
                                                    {{ $outlet->status == 1 ? 'Active' : 'Inactive' }}
                                                </td>
                                                <td>
                                                <div class="row">
                                                    <!-- Delete button with modal trigger -->
                                                        <div class="col-auto">
                                                            <button type="button" class="btn btn-link p-0 text-danger" data-toggle="modal" data-target="#confirmationModal{{$outlet->id}}">
                                                                <i class="fa-regular fa-trash-can"></i>
                                                            </button>

                                                            <div class="modal fade" id="confirmationModal{{$outlet->id}}" tabindex="-1" role="dialog" aria-labelledby="confirmationModalLabel{{$outlet->id}}" aria-hidden="true">
                                                                <div class="modal-dialog" role="document">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title" id="confirmationModalLabel{{$outlet->id}}">Confirm Deletion</h5>
                                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                <span aria-hidden="true">&times;</span>
                                                                            </button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            Are you sure you want to delete this outlet?
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                                                            <!-- Actual delete form -->
                                                                            <form method="POST" action="{{ route('outlet.destroy', $outlet->id) }}">
                                                                                @csrf
                                                                                @method('DELETE')
                                                                                <button type="submit" class="btn btn-danger">Delete</button>
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <!-- Update button with modal trigger -->
                                                        <div class="col-auto">
                                                            <button type="button" class="btn btn-link p-0" data-toggle="modal" data-target="#updateOutletModal{{$outlet->id}}">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                                                                    <g clip-path="url(#clip0_451_6816)">
                                                                        <path d="M14.1667 2.49993C14.3856 2.28106 14.6454 2.10744 14.9314 1.98899C15.2173 1.87054 15.5238 1.80957 15.8334 1.80957C16.1429 1.80957 16.4494 1.87054 16.7353 1.98899C17.0213 2.10744 17.2812 2.28106 17.5 2.49993C17.7189 2.7188 17.8925 2.97863 18.011 3.2646C18.1294 3.55057 18.1904 3.85706 18.1904 4.16659C18.1904 4.47612 18.1294 4.78262 18.011 5.06859C17.8925 5.35455 17.7189 5.61439 17.5 5.83326L6.25002 17.0833L1.66669 18.3333L2.91669 13.7499L14.1667 2.49993Z" stroke="#667085" stroke-width="1.66667" stroke-linecap="round" stroke-linejoin="round"/>
                                                                    </g>
                                                                    <defs>
                                                                        <clipPath id="clip0_451_6816">
                                                                            <rect width="20" height="20" fill="white"/>
                                                                        </clipPath>
                                                                    </defs>
                                                                </svg>
                                                            </button>

                                                            <div class="modal fade" id="updateOutletModal{{$outlet->id}}" tabindex="-1" role="dialog" aria-labelledby="updateOutletModalLabel{{$outlet->id}}" aria-hidden="true">
                                                                <div class="modal-dialog" role="document">
                                                                    <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="updateOutletModalLabel{{$outlet->id}}">Update Outlet</h5>
                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <form method="POST" action="{{ route('outlet.update', $outlet->id) }}" enctype="multipart/form-data">
                                                                        @csrf
                                                                        @method('PUT')
                                                                        <div class="modal-body">
                                                                        <div class="form-group">
                                                                            <label for="name">Name:</label>
                                                                            <input type="text" class="form-control" id="name" name="name" value="{{ $outlet->name }}" required>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="status">Status:</label>
                                                                            <select class="form-control" id="status" name="status">
                                                                            <option value="1" {{ $outlet->status == 1 ? 'selected' : '' }}>Active</option>
                                                                            <option value="0" {{ $outlet->status == 0 ? 'selected' : '' }}>Inactive</option>
                                                                            </select>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="image">Image:</label>
                                                                            <input type="file" class="form-control-file" id="image" name="image">
                                                                        </div>
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                        <button type="submit" class="btn btn-primary">Update</button>
                                                                        </div>
                                                                    </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                </div>
                                                </td>
                                            </tr>
                                            @endforeach
                                            <tbody>

                                            </tfoot>
                                        </table>

                                        </div>
                                    </div>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>



    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Create Outlet</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <!-- Form inside the modal -->
              <form method="POST" action="{{ route('outlet.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                  <label for="name">Outlet Name:</label>
                  <input type="text" class="form-control" id="name" name="name" required>
                </div>
                <div class="form-group">
                  <label for="status">Status:</label>
                  <select class="form-control" id="status" name="status">
                    <option value="1">Active</option>
                    <option value="0">Inactive</option>
                  </select>
                </div>
                <div class="form-group">
                  <label for="image">Upload Image:</label>
                  <input type="file" class="form-control-file" id="image" name="image">
                </div>
                <button type="submit" class="btn btn-primary">Create Outlet</button>
              </form>
            </div>
          </div>
        </div>
    </div>




@endsection
