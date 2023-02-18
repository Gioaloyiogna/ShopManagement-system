<!DOCTYPE html>
<html lang="en">

<head>
    @include('includes.head')
    @include('includes.styles')
</head>

<body>
    <div class="container">
        @include('includes.sidebar')
        <div class="profile-content">
            @include('includes.navbar')
            @yield('page-content')
            @include('includes.footer')
        </div>
        @include('includes.user_profile')
    </div>

</body>

</html>
