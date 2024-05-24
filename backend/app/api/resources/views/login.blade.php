<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>

<style>
.login-img-head {
    padding-bottom: 100px !important;
}

</style>
<body>


    <div class="row">
        {{-- col 1 --}}
        <div class="col-lg-6 d-flex flex-column justify-content-center align-items-center">


           <div class="login-img-head">
                <img src="{{ asset('images/camaya-logo.png') }}" alt="camaya_logo" class="img-fluid" style="width: 156px; height: 90px;">
           </div>

            <div class="card-body form_layout">
                @if (session('error'))
                    <div class="alert alert-danger" role="alert">
                        {{ session('error') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <h1 class="login_header">Admin Login</h1>
                    <p class="login_subheader">Welcome back! Please enter your details.</p>

                    <div class="form-group">
                        <label for="username">Username:</label>
                        <input
                            type="text"
                            id="username"
                            name="username"
                            placeholder="makkunii"
                            value="{{ old('username') }}"
                            class="form-control" required autofocus aria-label="Username">
                    </div>

                    <div class="form-group">
                        <label for="password">Password:</label>
                        <input
                            type="password"
                            id="password"
                            name="password"
                            placeholder="Enter Password"
                            class="form-control" required aria-label="Password">
                    </div>

                    <div class="form-group pt-2">
                        <button type="submit" class="btn makkunii_btn_warning">Sign In</button>
                    </div>
                </form>
            </div>
        </div>

        {{-- /col 2 --}}
        <div class="col-lg-6 d-none d-md-block" style="padding:0">
            <img  style="float:right; width: 800px; height: 100vh" src="{{ asset('/images/Section.png') }}" alt="" class="img-fluid">
        </div>
    </div>



    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
