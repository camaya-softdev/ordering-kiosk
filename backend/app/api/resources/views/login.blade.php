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
<body>

    <div>
        <div class="row">
          <div class="col-md-6">

            <div class="row justify-content-center">
                <div class="col-md-10">

                    <div class="header-navigation">
                        <div class="header-nav-img">
                            <img src="{{ asset('images/camaya-logo.png') }}" alt="camaya_logo" style="width: 156px;
                            height: 90px;
                            flex-shrink: 0;">
                        </div>
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
                                    class="form-control" required autofocus>
                            </div>

                            <div class="form-group">
                                <label for="password">Password:</label>
                                <input
                                type="password"
                                id="password"
                                name="password"
                                placeholder="Enter Password"
                                class="form-control" required>
                            </div>

                            <div class="form-group" style="padding-top:10px">
                                <button type="submit" class="btn makkunii_btn_warning">Sign In</button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>

          </div>

          <div class="col-md-6 d-none d-md-block">
            <div class="side-panel" style="height: 100vh;"></div>
        </div>
      </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
