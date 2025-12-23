<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('../admin/assets/img/apple-icon.png')}}">
    <link rel="icon" type="image/png" href="{{ asset('../admin/assets/img/favicon.png')}}">
    <title>
        Material Dashboard 3 by Creative Tim
    </title>
    <!--     Fonts and icons     -->
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700,900" />
    <!-- Nucleo Icons -->
    <link href="{{ asset('../admin/assets/css/nucleo-icons.css')}}" rel="stylesheet" />
    <link href="{{ asset('../admin/assets/css/nucleo-svg.css')}}" rel="stylesheet" />
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <!-- Material Icons -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@24,400,0,0" />
    <!-- CSS Files -->
    <link id="pagestyle" href="{{ asset('../admin/assets/css/material-dashboard.css?v=3.2.0')}}" rel="stylesheet" />
</head>

<body class="">
    <div class="container position-sticky z-index-sticky top-0">
        <div class="row">
            <div class="col-12">
                <!-- Navbar -->
                <nav class="navbar navbar-expand-lg blur border-radius-lg top-0 z-index-3 shadow position-absolute mt-4 py-2 start-0 end-0 mx-4">
                    <div class="container-fluid ps-2 pe-0">
                        <a class="navbar-brand font-weight-bolder ms-lg-0 ms-3 " href="{{ asset('../admin/pages/dashboard.html')}}">
                            Material Dashboard 3
                        </a>
                        <button class="navbar-toggler shadow-none ms-2" type="button" data-bs-toggle="collapse" data-bs-target="#navigation" aria-controls="navigation" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon mt-2">
                                <span class="navbar-toggler-bar bar1"></span>
                                <span class="navbar-toggler-bar bar2"></span>
                                <span class="navbar-toggler-bar bar3"></span>
                            </span>
                        </button>
                        <div class="collapse navbar-collapse" id="navigation">
                            <ul class="navbar-nav mx-auto">
                                <li class="nav-item">
                                    <a class="nav-link d-flex align-items-center me-2 active" aria-current="page" href="../pages/dashboard.html">
                                        <i class="fa fa-chart-pie opacity-6 text-dark me-1"></i>
                                        Dashboard
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link me-2" href="../pages/profile.html">
                                        <i class="fa fa-user opacity-6 text-dark me-1"></i>
                                        Profile
                                    </a>
                                </li>
                                <!-- <li class="nav-item">
                                    <a class="nav-link me-2" href=" {{ route('admin.register') }}">
                                        <i class="fas fa-user-circle opacity-6 text-dark me-1"></i>
                                        Creer compte
                                    </a>
                                </li> -->
                                <li class="nav-item">
                                    <a class="nav-link me-2" href=" {{ route('admin.login') }}">
                                        <i class="fas fa-key opacity-6 text-dark me-1"></i>
                                        Login
                                    </a>
                                </li>
                            </ul>
                            <ul class="navbar-nav d-lg-flex d-none">
                                <li class="nav-item d-flex align-items-center">
                                    <a class="btn btn-outline-primary btn-sm mb-0 me-2" target="_blank" href="https://www.creative-tim.com/builder?ref=navbar-material-dashboard">Online Builder</a>
                                </li>
                                <li class="nav-item">
                                    <a href="https://www.creative-tim.com/product/material-dashboard" class="btn btn-sm mb-0 me-1 bg-gradient-dark">Free download</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </nav>
                <!-- End Navbar -->
            </div>
        </div>
    </div>
    <main class="main-content  mt-0">
        <section>
            <div class="page-header min-vh-100">
                <div class="container">
                    <div class="row">
                        <div class="col-6 d-lg-flex d-none h-100 my-auto pe-0 position-absolute top-0 start-0 text-center justify-content-center flex-column">
                            <div class="position-relative bg-gradient-primary h-100 m-3 px-7 border-radius-lg d-flex flex-column justify-content-center" style="background-image: url('../assets/img/illustrations/illustration-signup.jpg'); background-size: cover;">
                            </div>
                        </div>
                        <div class="col-xl-4 col-lg-5 col-md-7 d-flex flex-column ms-auto me-auto ms-lg-auto me-lg-5">
                            <div class="card card-plain">
                                <div class="card-header">
                                    <h4 class="font-weight-bolder">Sign Up</h4>
                                    <p class="mb-0">Enter your email and password to register</p>
                                </div>
                                <div class="card-body">
                                    <form role="form" method="POST" action="{{ route('admin.register') }}">
                                        @csrf
                                        <div class="input-group input-group-outline mb-3">
                                            <label class="form-label">Name</label>
                                            <input type="text" class="form-control" name="name"
                                                value="{{ old('name') }}"
                                                required autofocus autocomplete="name" />
                                            @error('name')
                                            <div class="text-sm text-red-500">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="input-group input-group-outline mb-3">
                                            <label class="form-label">Contact</label>
                                            <input type="email" class="form-control" name="phone_number"
                                                value="{{ old('phone_number') }}"
                                                autocomplete="tel" />
                                            @error('phone_number')
                                            <div class="text-sm text-red-500">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="input-group input-group-outline mb-3">
                                            <label class="form-label">Email</label>
                                            <input type="email" class="form-control" name="email"
                                                value="{{ old('email') }}"
                                                required autocomplete="email" />
                                            @error('email')
                                            <div class="text-sm text-red-500">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="input-group input-group-outline mb-3">
                                            <label class="form-label">Password</label>
                                            <input type="password" class="form-control" name="password"
                                                required autocomplete="new-password" />
                                            @error('password')
                                            <div class="text-sm text-red-500">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="input-group input-group-outline mb-3">
                                            <label class="form-label">repeat-Password</label>
                                            <input type="password" class="form-control">
                                        </div>
                                        <div class="form-check form-check-info text-start ps-0">
                                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" checked>
                                            <label class="form-check-label" for="flexCheckDefault">
                                                I agree the <a href="javascript:;" class="text-dark font-weight-bolder">Terms and Conditions</a>
                                            </label>
                                        </div>
                                        <div class="text-center">
                                            <button type="button" class="btn btn-lg bg-gradient-dark btn-lg w-100 mt-4 mb-0">Sign Up</button>
                                        </div>
                                    </form>
                                </div>
                                <div class="card-footer text-center pt-0 px-lg-2 px-1">
                                    <p class="mb-2 text-sm mx-auto">
                                        Already have an account?
                                        <a href="../pages/sign-in.html" class="text-primary text-gradient font-weight-bold">Sign in</a>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <!--   Core JS Files   -->
    <script src="../assets/js/core/popper.min.js"></script>
    <script src="../assets/js/core/bootstrap.min.js"></script>
    <script src="../assets/js/plugins/perfect-scrollbar.min.js"></script>
    <script src="../assets/js/plugins/smooth-scrollbar.min.js"></script>
    <script>
        var win = navigator.platform.indexOf('Win') > -1;
        if (win && document.querySelector('#sidenav-scrollbar')) {
            var options = {
                damping: '0.5'
            }
            Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
        }
    </script>
    <!-- Github buttons -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="../assets/js/material-dashboard.min.js?v=3.2.0"></script>
</body>

</html>
<form role="form text-left" method="POST" action="{{ route('admin.register') }}">
    @csrf

    <div class="mb-4">
        <input
            type="text"
            class="text-sm focus:shadow-soft-primary-outline leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding py-2 px-3 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:bg-white focus:text-gray-700 focus:outline-none focus:transition-shadow"
            placeholder="Nom"
            aria-label="Name"
            aria-describedby="email-addon"
            name="name"
            value="{{ old('name') }}"
            required autofocus autocomplete="name" />
        @error('name')
        <div class="text-sm text-red-500">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-4">
        <input
            type="text"
            class="text-sm focus:shadow-soft-primary-outline leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding py-2 px-3 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:bg-white focus:text-gray-700 focus:outline-none focus:transition-shadow"
            placeholder="N° Telephone"
            aria-label="Phone"
            name="phone_number"
            value="{{ old('phone_number') }}"
            autocomplete="tel" />
        @error('phone_number')
        <div class="text-sm text-red-500">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-4">
        <input
            type="email"
            class="text-sm focus:shadow-soft-primary-outline leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding py-2 px-3 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:bg-white focus:text-gray-700 focus:outline-none focus:transition-shadow"
            placeholder="Email"
            aria-label="Email"
            aria-describedby="email-addon"
            name="email"
            value="{{ old('email') }}"
            required autocomplete="email" />
        @error('email')
        <div class="text-sm text-red-500">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-4">
        <input
            type="password"
            class="text-sm focus:shadow-soft-primary-outline leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding py-2 px-3 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:bg-white focus:text-gray-700 focus:outline-none focus:transition-shadow"
            placeholder="Mot de passe"
            aria-label="Password"
            aria-describedby="password-addon"
            name="password"
            required autocomplete="new-password" />
        @error('password')
        <div class="text-sm text-red-500">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-4">
        <input
            type="password"
            class="text-sm focus:shadow-soft-primary-outline leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding py-2 px-3 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:bg-white focus:text-gray-700 focus:outline-none focus:transition-shadow"
            placeholder="Confirmer le mot de passe"
            aria-label="Confirm Password"
            name="password_confirmation"
            required autocomplete="new-password" />
    </div>

    <div class="min-h-6 pl-6.92 mb-0.5 block">
        <input
            id="terms"
            class="w-4.92 h-4.92 ease-soft -ml-6.92 rounded-1.4 checked:bg-gradient-to-tl checked:from-gray-900 checked:to-slate-800 after:text-xxs after:font-awesome after:duration-250 after:ease-soft-in-out duration-250 relative float-left mt-1 cursor-pointer appearance-none border border-solid border-slate-200 bg-white bg-contain bg-center bg-no-repeat align-top transition-all after:absolute after:flex after:h-full after:w-full after:items-center after:justify-center after:text-white after:opacity-0 after:transition-all after:content-['\f00c'] checked:border-0 checked:border-transparent checked:bg-transparent checked:after:opacity-100"
            type="checkbox"
            name="terms"
            value="1" />
        <label
            class="mb-2 ml-1 font-normal cursor-pointer select-none text-sm text-slate-700"
            for="terms">
            I agree the
            <a href="javascript:;" class="font-bold text-slate-700">Terms and Conditions</a>
        </label>
        @error('terms')
        <div class="text-sm text-red-500">{{ $message }}</div>
        @enderror
    </div>

    <div class="text-center">
        <button
            type="submit"
            class="inline-block w-full px-6 py-3 mt-6 mb-2 font-bold text-center text-white uppercase align-middle transition-all bg-transparent border-0 rounded-lg cursor-pointer active:opacity-85 hover:scale-102 hover:shadow-soft-xs leading-pro text-xs ease-soft-in tracking-tight-soft shadow-soft-md bg-150 bg-x-25 bg-gradient-to-tl from-gray-900 to-slate-800 hover:border-slate-700 hover:bg-slate-700 hover:text-white">
            Sign up
        </button>
    </div>
    <p class="mt-4 mb-0 leading-normal text-sm">
        Already have an account?
        <a href="{{ route('admin.login') }}" class="font-bold text-slate-700">Sign in</a>
    </p>
</form>