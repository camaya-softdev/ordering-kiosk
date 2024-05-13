@extends('layout.dashboard.app')
@section('title', 'Dashboard')


@section('content')

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-5">
                    <div class="col-sm-6">
                        <h1 class="m-0">Welcome <span class="text-danger">{{ $info['username'] }}</span></h1>
                    </div><!-- /.col -->
                    {{-- <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Starter Page</li>
                        </ol>
                    </div><!-- /.col --> --}}
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">

                <h1>Welcome to the Admin Page</h1>
                <p>Welcome, {{ $loginData['user']['username'] }}!</p>

                <!-- Outlet creation form -->
                <form method="POST" action="{{ secure_url('outlet.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="name">Outlet Name:</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="form-group">
                        <label for="status">Status:</label>
                        <select class="form-control" id="status" name="status">
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="image">Upload Image:</label>
                        <input type="file" class="form-control-file" id="image" name="image">
                    </div>
                    <button type="submit" class="btn btn-primary">Create Outlet</button>
                </form>

                <hr>

                <h2>Existing Outlets</h2>

                <table class="table">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Image</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($outlets as $outlet)
                        <tr>
                            <td>{{ $outlet->name }}</td>
                            <td><img src="{{ asset($outlet->image) }}" alt="Outlet Image" style="max-width: 100px;"></td>
                            <td>{{ $outlet->status }}</td>
                            <td>
                                <!-- Update Outlet form -->
                                <form method="POST" action="{{ route('outlet.update', $outlet->id) }}" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="name" value="{{ $outlet->name }}" required>
                                    </div>
                                    <div class="form-group">
                                        <select class="form-control" name="status">
                                            <option value="1" {{ $outlet->status == 1 ? 'selected' : '' }}>Active</option>
                                            <option value="0" {{ $outlet->status == 0 ? 'selected' : '' }}>Inactive</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <input type="file" class="form-control-file" name="image">
                                    </div>
                                    <button type="submit" class="btn btn-primary">Update</button>
                                </form>

                                <!-- Delete Outlet form -->
                                <form method="POST" action="{{ route('outlet.destroy', $outlet->id) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn btn-danger">Logout</button>
                </form>
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content -->
    </div>

@endsection
