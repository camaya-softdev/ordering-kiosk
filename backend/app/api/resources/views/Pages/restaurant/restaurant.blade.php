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
        // Function to filter table rows based on selected filters
        function filterTable() {
            var cashChecked = document.getElementById('cashFilterToggle').classList.contains('active');
            var gcashChecked = document.getElementById('gcashFilterToggle').classList.contains('active');
            var noShowChecked = document.getElementById('noShowFilterToggle').classList.contains('active');
            var confirmedChecked = document.getElementById('confirmedFilterToggle').classList.contains('active');

            var rows = document.getElementById('orderTable').getElementsByTagName('tr');

            for (var i = 1; i < rows.length; i++) { // Start from index 1 to skip the header row
                var paymentMethod = rows[i].getElementsByTagName('td')[4].innerText.trim();
                var status = rows[i].getElementsByTagName('td')[5].innerText.trim();

                // Hide row by default if it's "Confirmed"
                if (status === 'confirmed') {
                    rows[i].style.display = (confirmedChecked ? '' : 'none');
                } else {
                    // Hide row if it doesn't match the selected filters
                    if ((cashChecked && paymentMethod !== 'Cash') ||
                        (gcashChecked && paymentMethod !== 'GCash') ||
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
