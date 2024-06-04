<style>
    .filter-buttons button {
        min-width: 150px;
        border-radius: 6px;
    }

    .active-counter-resto, .inactive-counter-resto {
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

    .preview-image {
    position: fixed;
    top: 0;
    left: 0;
    width: 300px;
    height: 800px;
    z-index: 999;
    background-color: rgba(0, 0, 0, 0.7);
    border: 5px solid white;
    padding: 10px;
    }
    </style>


    <div class="row">
        <div class="col-6">
            {{-- <div class="filter-buttons">
                <button id="filterActiveResto" class="btn btn-light">Active <span class="active-counter-resto">2</span></button>
                <button id="filterInactiveResto" class="btn btn-light">Inactive <span class="inactive-counter-resto">2</span></button>
            </div> --}}
        </div>

       <div class="col-6">
        <div class="row">
            <div class="col">
                {{-- <div class="search-container">
                    <i class="fas fa-search search-icon"></i>
                    <input type="text" id="searchInput" placeholder="Search Restaurant">
                </div> --}}
            </div>
            <div class="col">
                <button type="button" class="add-resto btn text-white" data-toggle="modal" data-target="#createGcashModal">
                    <i class="fas fa-plus plus-icon"></i>
                    Add Gcash
                </button>
            </div>
        </div>
       </div>
    </div>


<table id="gcash_table" class="table table-bordered table-hover custom-table">
    <thead>
        <tr>
            <th>QR</th>
            <th>Number</th>
            <th>Outlet</th>
            <th>Action</th>
        </tr>
    </thead>

    <tbody>
    @foreach ($gcash as $gcash_details)
    <tr>
        <td class="text-bold">
            @if(isset($gcash_details->image))
                <img src="{{ asset($gcash_details->image) }}" alt="Gcash QR" height="50px">
            @endif

        </td>
        <td>
          {{ $gcash_details->number }}
          {{-- {{ $gcash_details->outlet_id }} --}}

        </td>
        <td>
            {{ $gcash_details->outlet_name != null ?  $gcash_details->outlet_name : 'No Selected Outlet' }}
         </td>
        <td>
        <div class="row">
            <!-- Delete button with modal trigger -->
                <div class="col-auto">
                    <button type="button" class="btn btn-link p-0 text-danger" data-toggle="modal" data-target="#deleteGcash{{$gcash_details->id}}">
                        <i class="fa-regular fa-trash-can"></i>
                    </button>
                    {{-- call delete resto --}}
                    @include('partials.modal.admin.deleteGcash')
                </div>
                <!-- Update button with modal trigger -->
                <div class="col-auto">
                    <button type="button" class="btn btn-link p-0" data-toggle="modal" data-target="#updateGcashModal{{$gcash_details->id}}">
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
                    @include('partials.modal.admin.updateGcash')
                </div>
        </div>
        </td>
    </tr>
    @endforeach
    <tbody>

    </tfoot>
</table>


<script>

document.addEventListener("DOMContentLoaded", function() {
    const gcashImages = document.querySelectorAll("#gcash_table tbody img");
    gcashImages.forEach(image => {
      image.addEventListener("click", function() {
        const previewImage = document.createElement("img");
        previewImage.src = this.src;
        previewImage.style.cssText = "position: fixed; top: 90px; right: 100px; width: 400px; height: 700px; z-index: 999; background-color: rgba(0, 0, 0, 0.7)";
        document.body.appendChild(previewImage);

        // Add click event listener to close the preview
        previewImage.addEventListener("click", function() {
          document.body.removeChild(this);
        });
      });
    });
  });
</script>

    @include('partials.modal.admin.createGcash')
