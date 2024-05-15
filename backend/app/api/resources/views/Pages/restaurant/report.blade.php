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
                        <h1 class="m-0">Reports</h1>
                        <span>View and generate order reports.</span>

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

                    <div class="row" style="padding: 10px;">
                        <div class="col-7">
                            <div class="col-6" style="display: flex; gap: 20px;">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="actions[]" value="Gcash" id="gcash">
                                    <label class="form-check-label" for="gcash">Gcash</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="actions[]" value="Cash" id="cash">
                                    <label class="form-check-label" for="update">Cash</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="actions[]" value="Confirmed" id="confirmed">
                                    <label class="form-check-label" for="confirmed">Confirmed</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="actions[]" value="No Show" id="no_show">
                                    <label class="form-check-label" for="export">No Show</label>
                                </div>
                            </div>
                        </div>

                        <div class="col-5">
                            <form id="dateForm" action="{{ route('export-report') }}" method="POST">
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

                    <table id="logTable" class="table table-bordered table-hover custom-table logTable">
                        <thead>
                            <tr>
                                <th>Reference Number</th>
                                <th>Order Number</th>
                                <th>Order</th>
                                <th>Payment Method</th>
                                <th>Total</th>
                                <th>Status</th>
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
                                        ₱{{ $total }}
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




    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>


   <script>
       $(document).ready(function() {
           var table = $('#logTable').DataTable({
               paging: true,
               searching: true,
               info: true,
               lengthChange: true,
           });

           $.fn.dataTable.ext.search.push(
               function(settings, data, dataIndex) {
                   const checkboxes = document.querySelectorAll('input[name="actions[]"]:checked');
                   const selectedActions = Array.from(checkboxes).map(checkbox => checkbox.value.toLowerCase());

                   const column4 = data[3].toLowerCase(); // Assuming the 4th column (index 3) is one of the filter criteria
                   const column6 = data[5].toLowerCase(); // Assuming the 6th column (index 5) is the other filter criteria

                   if (selectedActions.length === 0) {
                       return true;
                   }

                const matchesColumn4 = selectedActions.some(actionKeyword => column4.includes(actionKeyword));
                const matchesColumn6 = selectedActions.some(actionKeyword => column6.includes(actionKeyword));

                return matchesColumn4 || matchesColumn6;
               }
           );

           $('input[name="actions[]"]').on('change', function() {
               table.draw();
           });
       });
   </script>

   @endsection
