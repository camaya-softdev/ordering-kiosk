<style>
.productTable th {
    font-weight:lighter!important
}

.searchProduct {
    padding-left: 30px;
    padding-top: 5px;
    padding-bottom: 5px;
    outline: none;
    border: none;
    border-radius: 8px;
    width: 100%;
}

  .filter-buttons button {
    min-width: 150px;
    border-radius: 6px;
}

  .active-counter-menu, .inactive-counter-menu {
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
</style>
<div class="category-content">
    <span class="text-bold">Products</span>

       <br>  <br>
    <div class="row">
        <div class="col-6">
            <div class="filter-buttons">
                <button id="filterActiveMenu_{{ $category->id }}" class="btn btn-light">Active <span id="active-counter-menu_{{ $category->id }}" class="active-counter-menu">0</span></button>
                <button id="filterInactiveMenu_{{ $category->id }}" class="btn btn-light">Inactive <span id="inactive-counter-menu_{{ $category->id }}" class="active-counter-menu">0</span></button>
            </div>
        </div>

       <div class="col-6">
        <div class="row">
            <div class="col">
                <div class="search-container">
                    <i class="fas fa-search search-icon"></i>
                    <input type="text" class="searchProduct" id="searchProduct_{{ $category->id}}" placeholder="Search Products">
                </div>
            </div>
            <div class="col">
                <button type="button" class="add-resto btn text-white" data-toggle="modal" data-target="#productModal">
                    <i class="fas fa-plus plus-icon"></i>
                    Add Products
                </button>
            </div>
        </div>
       </div>
    </div>


   <table id="productTable_{{ $category->id}}" class="productTable table table-bordered table-hover custom-table">
    <thead>
        <tr>
            <th>Image and name</th>
            <th>Stock</th>
            <th>Price</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($products->where('category_id', $category->id) as $product)
        <tr class="{{ $product->status == 1 ? 'active' : 'inactive' }}">
            <td>
                <img src="{{ asset($product->image) }}" alt="Outlet Image" height="50px"> {{ $product->name }}
            </td>
            <td>
                x{{ $product->stock }}
            </td>
            <td>
                ₱{{ $product->price }}
            </td>
            <td class="{{ $product->status == 1 ? 'text-success' : 'text-danger' }}">
                {{ $product->status == 1 ? 'Active' : 'Inactive' }}
            </td>
            <td>
                <div class="row">
                    <!-- Delete button with modal trigger -->
                        <div class="col-auto">
                            <button type="button" class="btn btn-link p-0 text-danger" data-toggle="modal" data-target="#confirmationModal{{$product->id}}">
                                <i class="fa-regular fa-trash-can"></i>
                            </button>
                            {{-- call delete resto --}}
                            @include('partials.modal.restaurant.deleteProduct')
                        </div>
                        <!-- Update button with modal trigger -->
                        <div class="col-auto">
                            <button type="button" class="btn btn-link p-0" data-toggle="modal" data-target="#updateOutletModal{{$product->id}}">
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
                            {{-- call update resto--}}
                            @include('partials.modal.restaurant.updateProduct')
                        </div>
                </div>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

</div>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    // Wait for the document to be ready
    $(document).ready(function() {
        // Function to update the counts
        function updateCounts() {
            var activeCount = $('#productTable_{{ $category->id }} tbody tr.active').length;
            var inactiveCount = $('#productTable_{{ $category->id }} tbody tr.inactive').length;

            $('#active-counter-menu_{{ $category->id }}').text(activeCount);
            $('#inactive-counter-menu_{{ $category->id }}').text(inactiveCount);
        }

        // Call the updateCounts function initially
        updateCounts();

        // Add an event listener for changes in the table rows
        $('#productTable_{{ $category->id }} tbody tr').on('DOMSubtreeModified', function() {
            // Call the updateCounts function whenever a change in the table occurs
            updateCounts();
        });

        function filterTable(status) {
            $('#productTable_{{ $category->id }} tbody tr').hide(); // Hide all rows initially
            if (status === 'all') {
                $('#productTable_{{ $category->id }} tbody tr').show(); // Show all rows
            } else {
                $('#productTable_{{ $category->id }} tbody tr.' + status).show(); // Show rows with the specified status
            }
        }

        // Add click event listener for the "Active" button
        $('#filterActiveMenu_{{ $category->id }}').on('click', function() {
            if ($(this).hasClass('btn-secondary')) {
                $(this).removeClass('btn-secondary'); // Remove btn-secondary class
                $(this).addClass('btn-light');
                filterTable('all'); // Show all rows
            } else {
                filterTable('active'); // Filter for active products
                $(this).addClass('btn-secondary'); // Add btn-secondary class
                $(this).removeClass('btn-light');
                $('#filterInactiveMenu_{{ $category->id }}').removeClass('btn-secondary'); // Remove btn-secondary class from the other button
            }
        });

        // Add click event listener for the "Inactive" button
        $('#filterInactiveMenu_{{ $category->id }}').on('click', function() {
            if ($(this).hasClass('btn-secondary')) {
                $(this).removeClass('btn-secondary'); // Remove btn-secondary class
                $(this).addClass('btn-light');
                filterTable('all'); // Show all rows
            } else {
                filterTable('inactive'); // Filter for inactive products
                $(this).addClass('btn-secondary'); // Add btn-secondary class
                $(this).removeClass('btn-light');
                $('#filterActiveMenu_{{ $category->id }}').removeClass('btn-secondary'); // Remove btn-secondary class from the other button
            }
        });

        // Add an event listener for changes in the search input
        $('#searchProduct_{{ $category->id }}').on('keyup', function() {
            // Get the search value
            var searchText = $(this).val().toLowerCase();

            // Loop through each table row
            $('#productTable_{{ $category->id }} tbody tr').each(function() {
                // Get the text content of the row
                var rowData = $(this).text().toLowerCase();

                // If the row data contains the search text, show the row, otherwise hide it
                if (rowData.indexOf(searchText) !== -1) {
                    $(this).show();
                } else {
                    $(this).hide();
                }
            });
        });
    });
</script>
