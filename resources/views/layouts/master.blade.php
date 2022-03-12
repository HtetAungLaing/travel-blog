<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title','IPSUM Travel')</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light shadow bg-white">
        <div class="container">
            <a class="navbar-brand p-0" href="{{ route('index') }}">
                <img src="{{ asset('storage/misc/logo.jpg') }}" height="75" class="" alt="">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    @auth
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }}
                                <img src="{{ asset('storage/misc/' . auth()->user()->profile_photo) }}" alt="" height="20"
                                    class="nav-profile-photo rounded-circle border-2 border-white border">
                            </a>
                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('edit-profile') }}">
                                    Edit Profile
                                </a>
                                <a class="dropdown-item" href="{{ route('password.edit') }}">
                                    Change Password
                                </a>
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                    class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @endauth
                    @guest
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="{{ route('login') }}">Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="{{ route('register') }}">Register</a>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>
    <div class="my-4">

    </div>
    @yield('content')
    <div class="my-5"></div>
    <footer class="mt-3" id="footer">
        <div class="bg-primary p-5">
            <div class="fw-bolder text-center">&copy; Kimmich . All rights reserve</div>
        </div>
    </footer>
</body>
<script src="{{ asset('js/app.js') }}"></script>
@stack('script')

</html>
