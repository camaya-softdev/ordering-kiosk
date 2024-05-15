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

    .logTable th {
    font-weight:lighter!important
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
    .searchLog {
    padding-left: 30px;
    padding-top: 5px;
    padding-right: 30px;
    padding-bottom: 5px;
    outline: none;
    border: none;
    border-radius: 8px;
    width: 100%;
    }


</style>
    <div class="content-wrapper bg-white cnt-pd">
        <div class="content-header csm-pb">
            <div class="container-fluid">
                <div class="row mb-5">
                    <div class="col-sm-6">
                        <h1 class="m-0">Activity Logs</h1>
                        <span>View and export admin action reports.</span>

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
                <div style="background-color: #F2F4F7; padding: 20px; border-radius: 0px 8px 8px 8px;">

                    <div class="row">
                        <div class="col-6">

                        </div>

                        <div class="col-6">
                            <form id="dateForm" action="{{ route('exportLogs') }}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col">
                                        <div class="search-container">
                                            <input type="date" name="selectedDate" class="searchLog text-secondary" id="selectedDate" placeholder="Select Date">
                                        </div>
                                    </div>
                                    <div class="col">
                                        <button type="submit" class="add-resto btn text-white">
                                            <i class="fas fa-plus plus-icon"></i>
                                            Export
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <table id="reportTable" class="table table-bordered table-hover custom-table reportTable">
                        <thead>
                            <tr>
                                <th>Reference Number</th>
                                <th>Order Number</th>
                                <th>Order</th>
                                <th>Payment Method</th>
                                <th>Total</th>
                                <th>Pending</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($report as $reports)
                                <tr>
                                    <td>
                                        {{ $reports->reference_number }}
                                    </td>
                                    <td>
                                        {{ $reports->id }}
                                    </td>
                                    <td>
                                        @foreach ($reports->orders as $order)
                                         {{ $order->quantity }}x {{ $order->product->name }} <br>
                                        @endforeach
                                    </td>
                                    <td>
                                        {{ $reports->payment_method }}
                                    </td>
                                    <td>
                                        @php
                                            $total = $reports->orders->sum(function ($order) {
                                                return $order->product->price * $order->quantity;
                                            });
                                        @endphp
                                        {{ $total }}
                                    </td>
                                    <td>
                                        {{ $reports->status }}
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





@endsection
