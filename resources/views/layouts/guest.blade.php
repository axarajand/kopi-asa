<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-bs-theme="light">
<head>
    <meta charset="utf-8">
    <title>{{ config('app.name', 'KopiAsa') }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="shortcut icon" href="{{ asset('admin-assets/images/favicon.ico') }}">
    <link href="{{ asset('admin-assets/css/app.min.css') }}" rel="stylesheet" type="text/css" id="app-style">
    <link href="{{ asset('admin-assets/css/icons.min.css') }}" rel="stylesheet" type="text/css">
    <script src="{{ asset('admin-assets/js/head.js') }}"></script>
</head>
<body data-sidebar="default">
    <div class="account-page">
        <div class="container-fluid p-0">
            <div class="row align-items-center justify-content-center g-0 px-3 py-3 vh-100">
                <div class="col-xxl-6">
                    <div class="row">
                        <div class="col-xl-6 col-md-6 mx-auto">
                            <div>
                                <div class="mb-3 p-0 text-center">
                                    <div class="auth-brand">
                                        <a href="/" class="logo logo-light">
                                            <span class="logo-lg">
                                                <img src="{{ asset('admin-assets/images/logo-light.png') }}" alt="KopiAsa Logo" height="24">
                                            </span>
                                        </a>
                                        <a href="/" class="logo logo-dark">
                                            <span class="logo-lg">
                                                 <img src="{{ asset('admin-assets/images/logo-dark.png') }}" alt="KopiAsa Logo" height="24">
                                            </span>
                                        </a>
                                    </div>
                                </div>
                                {{ $slot }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('admin-assets/libs/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('admin-assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('admin-assets/libs/iconify-icon/iconify-icon.min.js') }}"></script>
    <script src="{{ asset('admin-assets/js/app.js') }}"></script>
</body>
</html>