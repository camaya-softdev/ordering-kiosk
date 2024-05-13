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
                        <h1 class="m-0">Menu</h1>
                        <span>Manage the category food availability in the ordering kiosk.</span>

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
                                <div class="row">
                                    <div class="col-12">
                                        <button type="button" class="add-user btn text-white" data-toggle="modal" data-target="#AddCategoryModal">
                                            <i class="fas fa-plus plus-icon"></i>
                                            Add Category
                                        </button>
                                    </div>
                                    <div class="col-12">
                                        <div class="nav-link text-dark text-bold">Categories

                                            <span class="icon-container" style="float:right">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none" class="delete-icon" data-toggle="modal" data-target="#deleteCategoryModal">
                                                    <path d="M2.5 5.00008H4.16667M4.16667 5.00008H17.5M4.16667 5.00008V16.6667C4.16667 17.1088 4.34226 17.5327 4.65482 17.8453C4.96738 18.1578 5.39131 18.3334 5.83333 18.3334H14.1667C14.6087 18.3334 15.0326 18.1578 15.3452 17.8453C15.6577 17.5327 15.8333 17.1088 15.8333 16.6667V5.00008H4.16667ZM6.66667 5.00008V3.33341C6.66667 2.89139 6.84226 2.46746 7.15482 2.1549C7.46738 1.84234 7.89131 1.66675 8.33333 1.66675H11.6667C12.1087 1.66675 12.5326 1.84234 12.8452 2.1549C13.1577 2.46746 13.3333 2.89139 13.3333 3.33341V5.00008M8.33333 9.16675V14.1667M11.6667 9.16675V14.1667" stroke="#D92D20" stroke-width="1.66667" stroke-linecap="round" stroke-linejoin="round"/>
                                                </svg>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none" class="edit-icon" data-toggle="modal" data-target="#editCategoryModal">
                                                    <g clip-path="url(#clip0_1132_12414)">
                                                        <path d="M14.1667 2.49993C14.3856 2.28106 14.6455 2.10744 14.9314 1.98899C15.2174 1.87054 15.5239 1.80957 15.8334 1.80957C16.1429 1.80957 16.4494 1.87054 16.7354 1.98899C17.0214 2.10744 17.2812 2.28106 17.5001 2.49993C17.719 2.7188 17.8926 2.97863 18.011 3.2646C18.1295 3.55057 18.1904 3.85706 18.1904 4.16659C18.1904 4.47612 18.1295 4.78262 18.011 5.06859C17.8926 5.35455 17.719 5.61439 17.5001 5.83326L6.25008 17.0833L1.66675 18.3333L2.91675 13.7499L14.1667 2.49993Z" stroke="#667085" stroke-width="1.66667" stroke-linecap="round" stroke-linejoin="round"/>
                                                        </g>
                                                        <defs>
                                                        <clipPath id="clip0_1132_12414">
                                                        <rect width="20" height="20" fill="white"/>
                                                        </clipPath>
                                                        </defs>
                                                </svg>
                                            </span>
                                        </div>


                                    </div>
                                </div>
                                <a class="nav-link text-dark active" id="vert-tabs-recent-tab" data-toggle="pill" href="#vert-tabs-recent" role="tab" aria-controls="vert-tabs-recent" aria-selected="true">Newly Added</a>

                                @foreach($categories as $category)
                                    <a class="nav-link text-dark loadProductsBtn" id="vert-tabs-{{ $category->id }}-tab" data-toggle="pill" href="#vert-tabs-{{ $category->id }}" role="tab" aria-controls="vert-tabs-{{ $category->id }}" aria-selected="false" data-category-id="{{ $category->id }}">{{ $category->name }}</a>
                                @endforeach

                            </div>
                        </div>

                        <div class="col-10 col-sm-9" style="background-color: #F2F4F7; padding: 20px; border-radius: 0px 8px 8px 8px;">
                            <div class="tab-content" id="vert-tabs-tabContent">
                                <div class="tab-pane text-left fade show active" id="vert-tabs-recent" role="tabpanel" aria-labelledby="vert-tabs-recent-tab">
                                    <span class="text-bold">Products</span>
                                    <h1>Newly Added</h1>
                                </div>

                                @foreach($categories as $category)
                                    <div class="tab-pane fade" id="vert-tabs-{{ $category->id }}" role="tabpanel" aria-labelledby="vert-tabs-{{ $category->id }}-tab">
                                        @include('pages.restaurant.categoryContent')
                                    </div>
                                @endforeach
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Category Modal -->
    @include('partials.modal.restaurant.createCategory')

    <!-- Delete Category Modal -->
    @include('partials.modal.restaurant.updateCategory')


    <!-- Edit Category Modal -->
    @include('partials.modal.restaurant.deleteCategory')



    {{-- @include('partials.modal.createResto') --}}
    @include('partials.modal.restaurant.createProduct')


    <script>
        $(document).ready(function() {
            // Event delegation for dynamically loaded content
            $(document).on('click', '.delete-icon', function() {
                // Trigger the delete category modal
                $('#deleteCategoryModal').modal('show');
            });

            $(document).on('click', '.edit-icon', function() {
                // Trigger the edit category modal
                $('#editCategoryModal').modal('show');
            });

        });
    </script>



@endsection
