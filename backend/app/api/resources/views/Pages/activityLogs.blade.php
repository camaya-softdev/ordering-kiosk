@extends('layout.dashboard.app')
@section('title', 'Dashboard')

@section('content')

<style>
    .my-tabs .nav-link.active {
        background-color: #F2F4F7 !important;
    }
    .custom-table {
        border: none;
    }
    .custom-table th, .custom-table td {
        border: none;
    }
    table tbody {
        background-color: white;
    }
    table tbody td {
        display: table-cell;
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
        font-weight: lighter !important;
    }
    .cnt-pd {
        padding: 2% 2% 0 2%;
    }
    .csm-pb {
        padding-bottom: 0;
    }
    .dataTables_filter {
        display: none;
    }
    .searchLog {
        padding: 5px 30px;
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

    <div class="content">
        <div class="container-fluid">
            <div style="background-color: #F2F4F7; padding: 20px; border-radius: 8px 8px 8px 8px;">
                <div class="row" style="padding: 10px;">
                    <div class="col-6" style="display: flex; gap: 20px;">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="actions[]" value="Create" id="create">
                            <label class="form-check-label" for="create">Create</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="actions[]" value="Update" id="update">
                            <label class="form-check-label" for="update">Update</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="actions[]" value="Delete" id="delete">
                            <label class="form-check-label" for="delete">Delete</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="actions[]" value="Export" id="export">
                            <label class="form-check-label" for="export">Export</label>
                        </div>
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

                <table id="logTable" class="table table-bordered table-hover custom-table logTable">
                    <thead>
                        <tr>
                            <th style="width: 20%">Username</th>
                            <th style="width: 60%">Action</th>
                            <th style="width: 20%">Timestamps</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($activityLog as $logs)
                        <tr>
                            <td>{{ $logs->username }}</td>
                            <td>{{ $logs->action }}</td>
                            <td>{{ $logs->created_at->format('F j, Y, g:i A') }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot></tfoot>
                </table>
            </div>
        </div>
    </div>
</div>

 <!-- jQuery -->
 <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
 <!-- DataTables -->
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
                const action = data[1].toLowerCase(); // Assuming the action is in the second column

                if (selectedActions.length === 0) {
                    return true;
                }

                return selectedActions.some(actionKeyword => action.includes(actionKeyword));
            }
        );

        $('input[name="actions[]"]').on('change', function() {
            table.draw();
        });
    });
</script>

@endsection
