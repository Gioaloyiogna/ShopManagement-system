<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100&family=Roboto:wght@100&display=swap"
        rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <title>Login page</title>
</head>

<body>
    <div class="container">
        <div class="login-box">
            <h2>Shop Management System</h2>
            <div class="login-content">
                <h4>Login <i class='bx bx-book-reader' style="font-size: 2rem;position:relative; top:3px"></i></h4>
                <div class="login-form">
                    <form action="{{ route('login') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <span><i class='bx bx-envelope'></i></span>
                            <span> <input type="text" name="email" id="" placeholder="admin"
                                    class="@error('email') is-invalid @enderror"></span>
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <span><i class='bx bx-lock-alt'></i></span>
                            <span><input type="password" name="password" id="" placeholder="password"
                                    class="@error('password') is-invalid @enderror""></span>
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="btns-group">
                            <div> <input type="checkbox" name="" id=""> <span id="remember-me">Remember
                                    me</span></div>
                            <div><button type="submit" id="sign-in">Sign-in</button></div>
                        </div>
                    </form>
                </div>
            </div>
            <a href="{{ config('app.url') }}/register" id="register-now">Don't have an account?Register now</a>
        </div>
    </div>
</body>

</html>
