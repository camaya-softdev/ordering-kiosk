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
    .dataTables_filter {
    display: none;
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

          @if($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif


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
                                            @include('partials.users')
                                        </div>

                                        <div class="tab-pane fade" id="vert-tabs-restaurant" role="tabpanel" aria-labelledby="vert-tabs-restaurant-tab">
                                            @include('partials.restaurants')
                                        </div>
                                    </div>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>



    @include('partials.modal.createResto')
    @include('partials.modal.createUser')





@endsection
