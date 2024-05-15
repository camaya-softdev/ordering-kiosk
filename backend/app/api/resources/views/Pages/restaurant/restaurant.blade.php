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
        display: inline-block;
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

    <div class="content-wrapper bg-white cnt-pd">
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
                <div class="my-tabs">
                    <div class="row">
                        <div class="col-2 col-sm-2" style="padding-right:0">
                            <a class="nav-link text-dark active text-bold" id="vert-tabs-orders-tab" data-toggle="pill" href="#vert-tabs-orders" role="tab" aria-controls="vert-tabs-orders" aria-selected="true">Orders</a>
                            <div class="toggle-btn-wrapper">
                                <div class="toggle-btn" id="cashFilterToggle" data-filter="cash"></div>
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


                        <div class="col-10 col-sm-9" style="background-color: #F2F4F7; padding: 20px; border-radius: 0px 8px 8px 8px;">

                                    <div class="tab-content" id="vert-tabs-tabContent">
                                        <div class="tab-pane text-left fade show active" id="vert-tabs-orders" role="tabpanel" aria-labelledby="vert-tabs-orders-tab">
                                            @include('Pages.restaurant.orders')
                                        </div>

                                    </div>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        // Function to filter table rows based on selected filters
        function filterTable() {
            var cashChecked = document.getElementById('cashFilterToggle').classList.contains('active');
            var gcashChecked = document.getElementById('gcashFilterToggle').classList.contains('active');
            var noShowChecked = document.getElementById('noShowFilterToggle').classList.contains('active');
            var confirmedChecked = document.getElementById('confirmedFilterToggle').classList.contains('active');

            var rows = document.getElementById('orderTable').getElementsByTagName('tr');

            for (var i = 1; i < rows.length; i++) { // Start from index 1 to skip the header row
                var paymentMethod = rows[i].getElementsByTagName('td')[1].innerText.trim();
                var status = rows[i].getElementsByTagName('td')[2].innerText.trim();

                // Hide row by default if it's "Confirmed"
                if (status === 'confirmed') {
                    rows[i].style.display = (confirmedChecked ? '' : 'none');
                } else {
                    // Hide row if it doesn't match the selected filters
                    if ((cashChecked && paymentMethod !== 'cash') ||
                        (gcashChecked && paymentMethod !== 'gcash') ||
                        (noShowChecked && status !== 'No Show')) {
                        rows[i].style.display = 'none';
                    } else {
                        rows[i].style.display = ''; // Show the row
                    }
                }
            }
        }

        // Attach event listeners to the toggle buttons to trigger the filtering
        document.querySelectorAll('.toggle-btn').forEach(function(btn) {
            btn.addEventListener('click', function() {
                this.classList.toggle('active');
                filterTable();
            });
        });

        // Initially hide rows with status "Confirmed"
        filterTable();
    </script>

@endsection
