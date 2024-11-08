<style>
.filter-buttons button {
    min-width: 150px;
    border-radius: 6px;
}

.active-counter-user, .inactive-counter-user {
    margin-left: 10px;
    background: #F2F4F7;
    border-radius: 50%; /* Set border-radius to 50% to make it a circle */
    color: #344054;
    width: 20px; /* Adjust width and height as needed */
    height: 20px;
    text-align: center; /* Center the number */
    line-height: 20px; /* Ensure the number is vertically centered */
    display: inline-block; /* Make it inline to have the circle only around the number */
}

th {
   font-weight: lighter;
}

</style>


<div class="row">
    <div class="col-6">
        <div class="filter-buttons">
            <button id="filterActiveUser" class="btn btn-light">Active <span class="active-counter-user">2</span></button>
            <button id="filterInactiveUser" class="btn btn-light">Inactive <span class="inactive-counter-user">2</span></button>
        </div>
    </div>

   <div class="col-6">
    <div class="row">
        <div class="col">
            <div class="search-container">
                <i class="fas fa-search search-icon"></i>
                <input type="text" id="searchUser" placeholder="Search Restaurant">
            </div>
        </div>
        <div class="col">
            <button type="button" class="add-user btn text-white" data-toggle="modal" data-target="#userModal">
                <i class="fas fa-plus plus-icon"></i>
                Add Users
            </button>
        </div>
    </div>
   </div>
</div>

<table id="userTable" class="table table-bordered table-hover custom-table">
<thead>
    <tr>
        <th>Name & Username</th>
        <th>Restaurant</th>
        <th>Status</th>
        <th>Date Created</th>
        <th>Action</th>
    </tr>
</thead>

<tbody>
    @foreach ($users as $user)
        @if ($user->username != 'it_department')
        <tr>
            <td>
                <div class="row">
                    <div>
                        <img src="../../dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle" style="height:40px">
                    </div>
                    <div>
                        {{ $user->first_name }} {{ $user->last_name }} <br> {{ $user->username }}
                    </div>
                </div>
            </td>
            <td>
                @if ($user->outlet)
                    <img src="{{ asset($user->outlet->image ) }}" alt="Outlet Image" height="50px">
                @else
                    No Outlet Assigned
                @endif
            </td>
            <td class="{{ $user->status == 1 ? 'text-success' : 'text-danger' }}">
                {{ $user->status == 1 ? 'Active' : 'Inactive' }}
            </td>
            <td>{{ $user->created_at->format('F j, Y, g:i A') }}</td>
            <td>
                <div class="row">
                    <!-- Delete button with modal trigger -->
                    <div class="col-auto">
                        <button type="button" class="btn btn-link p-0 text-danger" data-toggle="modal" data-target="#confirmationModal{{$user->id}}">
                            <i class="fa-regular fa-trash-can"></i>
                        </button>
                        {{-- call delete resto --}}
                        @include('partials.modal.deleteUser')
                    </div>
                    <!-- Update button with modal trigger -->
                    <div class="col-auto">
                        <button type="button" class="btn btn-link p-0" data-toggle="modal" data-target="#updateUserModal{{$user->id}}">
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
                        @include('partials.modal.updateUser')
                    </div>
                </div>
            </td>
        </tr>
        @endif
    @endforeach
    </tbody>


</tfoot>
</table>

<script>
    var activeCount = 0;
    var inactiveCount = 0;

    // Function to count "Active" and "Inactive" entries
    function countStatusUser() {
        var tableRows = document.getElementById('userTable').getElementsByTagName('tr');

        for (var i = 1; i < tableRows.length; i++) {
            var statusCell = tableRows[i].getElementsByTagName('td')[2]; // Assuming status is in the third column
            var status = statusCell.textContent.trim();

            if (status === 'Active') {
                activeCount++;
            } else if (status === 'Inactive') {
                inactiveCount++;
            }
        }

        // Update counters
        updateCounters();
    }

// Call countStatusUser function to initialize counters
    countStatusUser();

    function updateCounters() {
        document.querySelector('.active-counter-user').textContent = activeCount;
        document.querySelector('.inactive-counter-user').textContent = inactiveCount;
    }


  // Filter by status
    function filterTableUser(status)
    {
        var tableRows = document.getElementById('userTable').getElementsByTagName('tr');

        for (var i = 1; i < tableRows.length; i++) {
            var rowData = tableRows[i].getElementsByTagName('td')[2].innerText;

            if ((status === 'Active' && rowData === 'Active') ||
                (status === 'Inactive' && rowData === 'Inactive')) {
                tableRows[i].style.display = '';
            } else {
                tableRows[i].style.display = 'none';
            }
        }
    }

    // Event listeners for filter buttons
    document.getElementById('filterActiveUser').addEventListener('click', function() {
        clearFilterUser();
        var isActiveFilter = this.classList.contains('active-filter-user');

        if (isActiveFilter) {
            // Clear filter
            clearFilterUser();
        } else {
            filterTableUser('Active');
            // Add active class to indicate filter is applied
            this.classList.add('active-filter-user');
            // Remove active class from the other button
            document.getElementById('filterInactiveUser').classList.remove('active-filter-user');
        }
        // Toggle button classes
        toggleButtonUserClasses();
    });

    document.getElementById('filterInactiveUser').addEventListener('click', function() {
        clearFilterUser();
        var isInactiveFilter = this.classList.contains('active-filter-user');
        if (isInactiveFilter) {
            // Clear filter
            clearFilterUser();
        } else {
            filterTableUser('Inactive');
            // Add active class to indicate filter is applied
            this.classList.add('active-filter-user');
            // Remove active class from the other button
            document.getElementById('filterActiveUser').classList.remove('active-filter-user');
        }
        // Toggle button classes
        toggleButtonUserClasses();
    });

    // Function to clear filter
    function clearFilterUser() {
        var tableRows = document.getElementById('userTable').getElementsByTagName('tr');
        for (var i = 1; i < tableRows.length; i++) {
            tableRows[i].style.display = '';
        }
        // Remove active class from both filter buttons
        document.getElementById('filterActiveUser').classList.remove('active-filter-user');
        document.getElementById('filterInactiveUser').classList.remove('active-filter-user');
        // Toggle button classes
        toggleButtonUserClasses();
    }

    // // Function to toggle button classes
    function toggleButtonUserClasses() {
        var filterActiveButton = document.getElementById('filterActiveUser');
        var filterInactiveButton = document.getElementById('filterInactiveUser');

        if (filterActiveButton.classList.contains('active-filter-user')) {
            filterActiveButton.classList.remove('btn-light');
            filterActiveButton.classList.add('btn-secondary');
        } else {
            filterActiveButton.classList.remove('btn-secondary');
            filterActiveButton.classList.add('btn-light');
        }

        if (filterInactiveButton.classList.contains('active-filter-user')) {
            filterInactiveButton.classList.remove('btn-light');
            filterInactiveButton.classList.add('btn-secondary');
        } else {
            filterInactiveButton.classList.remove('btn-secondary');
            filterInactiveButton.classList.add('btn-light');
        }
    }

    // Search functionality
    document.getElementById('searchUser').addEventListener('input', function() {
        var searchQuery = this.value.toLowerCase();
        var tableRows = document.getElementById('userTable').getElementsByTagName('tr');

        for (var i = 1; i < tableRows.length; i++) {
            var rowData = tableRows[i].innerText.toLowerCase();
            if (rowData.includes(searchQuery)) {
                tableRows[i].style.display = '';
            } else {
                tableRows[i].style.display = 'none';
            }
        }
    });

</script>

