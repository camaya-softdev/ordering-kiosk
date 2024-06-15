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

.toggle-btn-wrapper {
    padding-top: 10px;
    display:flex;
    gap: 5px;
}

.toggle-btn {
        /* display: -; */
        width: 40px;
        height: 20px;
        position: relative;
        border-radius: 10px;
        background-color: #ccc;
        cursor: pointer;
    }

    .toggle-btn::after {
        content: "";
        position: absolute;
        width: 16px;
        height: 16px;
        border-radius: 50%;
        background-color: white;
        top: 2px;
        left: 2px;
        transition: 0.3s;
    }

    .toggle-btn.active::after {
        left: 22px;
    }

</style>

    <div class="{{ $loginData['user']['username'] === 'it_department' ? '' : 'content-wrapper' }} bg-white cnt-pd">
        <div class="content-header csm-pb">
            <div class="container-fluid">
                <div class="row mb-5">
                    <div class="col-sm-6">
                        <h1 class="m-0">Orders</h1>
                        <span>Monitor all paid and pay-at-the-counter orders from the ordering kiosk</span>

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

               <div style="display: flex; gap: 20px; padding:5px">
                <div class="toggle-btn-wrapper">
                    <div class="toggle-btn" id="cashFilterToggle" data-filter="Pay at the counter"></div>
                    <label class="text-dark" for="cashFilterToggle">For Cash Payment</label>
                </div>
                <div class="toggle-btn-wrapper">
                    <div class="toggle-btn" id="gcashFilterToggle" data-filter="gcash"></div>
                    <label class="text-dark" for="gcashFilterToggle">Paid Through Gcash</label>
                </div>
                <div class="toggle-btn-wrapper">
                    <div class="toggle-btn" id="noShowFilterToggle" data-filter="no_show"></div>
                    <label class="text-dark" for="noShowFilterToggle">No Show</label>
                </div>
                <div class="toggle-btn-wrapper">
                    <div class="toggle-btn" id="confirmedFilterToggle" data-filter="confirmed"></div>
                    <label class="text-dark" for="confirmedFilterToggle">Confirmed Order</label>
                </div>
               </div>



                        <div style="background-color: #F2F4F7; padding: 20px; border-radius: 0px 8px 8px 8px;">

                                    <div class="tab-content" id="vert-tabs-tabContent">
                                        <div class="tab-pane text-left fade show active" id="vert-tabs-orders" role="tabpanel" aria-labelledby="vert-tabs-orders-tab">
                                            @include('Pages.restaurant.orders')
                                        </div>
                                       @if($loginData['user']['username'] === "it_department")
                                       <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="btn active logout-btn" style="width: 100%">Logout</button>
                                        </form>

                                        @endif


                                    </div>

                        </div>



            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        var dataTable;

        // Initialize DataTable
        $(document).ready(function() {
            dataTable = $('#orderTable').DataTable();
        });

        // Function to filter table rows based on selected filters
        function filterTable() {
            var cashChecked = $('#cashFilterToggle').hasClass('active');
            var gcashChecked = $('#gcashFilterToggle').hasClass('active');
            var noShowChecked = $('#noShowFilterToggle').hasClass('active');
            var confirmedChecked = $('#confirmedFilterToggle').hasClass('active');

            $.fn.dataTable.ext.search.push(function(settings, data, dataIndex) {
                var paymentMethod = data[4].trim(); // Use index based on your table structure
                var status = data[5].trim(); // Use index based on your table structure

                if (confirmedChecked && status === 'confirmed') {
                    return true;
                }

                if ((cashChecked && paymentMethod === 'Pay at the counter') ||
                    (gcashChecked && paymentMethod === 'GCash') ||
                    (noShowChecked && status === 'No Show')) {
                    return true;
                }

                return !cashChecked && !gcashChecked && !noShowChecked && !confirmedChecked;
            });

            dataTable.draw();
        }

        // Attach event listeners to the toggle buttons to trigger the filtering
        $('.toggle-btn').on('click', function() {
            $(this).toggleClass('active');
            $.fn.dataTable.ext.search.length = 0; // Clear previous filters
            filterTable();
        });
    </script>



@endsection
