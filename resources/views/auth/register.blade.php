{{-- <x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Name -->
            <div>
                <x-label for="name" :value="__('Name')" />

                <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />
            </div>

            <!-- Email Address -->
            <div class="mt-4">
                <x-label for="email" :value="__('Email')" />

                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-label for="password" :value="__('Password')" />

                <x-input id="password" class="block mt-1 w-full"
                                type="password"
                                name="password"
                                required autocomplete="new-password" />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-label for="password_confirmation" :value="__('Confirm Password')" />

                <x-input id="password_confirmation" class="block mt-1 w-full"
                                type="password"
                                name="password_confirmation" required />
            </div>

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-button class="ml-4">
                    {{ __('Register') }}
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout> --}}
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="preconnect" href="https://fonts.googleapis.com"><link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100&family=Roboto:wght@100&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="./css/style.css">
    <title>Login page</title>
</head>

<body>
    <div class="container">
        <div class="login-box">
            <h2>Shop Management System</h2>
            <div class="login-content">
                <h4>Register</h4>
                <div class="login-form">
                    <form action="/register" method="post">
                        @csrf
                        <div class="form-group">
                            <span><i class='bx bx-user'></i></span>
                           <span> <input type="text" name="name" id="" placeholder="name"></span>
                        </div>
                        <div class="form-group">
                            <span><i class='bx bx-envelope'></i></span>
                           <span> <input type="text" name="email" id="" placeholder="admin"></span>
                        </div>
                        <div class="form-group">
                            <span><i class='bx bx-lock-alt'></i></span>
                            <span><input type="password" name="password" id="" placeholder="password"></span>
                        </div>
                        <div class="btns-group" >
                            <div> <input type="checkbox" name="" id=""> <span id="remember-me">Remember me</span></div>
                            <div><button type="submit" id="sign-in">Sign-up</button></div>
                        </div>
                    </form>
                </div>
            </div>
            <a href="{{config('app.url')}}/login" id="register-now">Alredy have an account?Login now</a>
        </div>
    </div>
</body>

</html>