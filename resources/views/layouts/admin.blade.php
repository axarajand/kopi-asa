<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>@yield('title', 'Admin Panel') | KopiAsa</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc."/>
        <meta name="author" content="Zoyothemes"/>
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />

        <link rel="shortcut icon" href="{{ asset('admin-assets/images/favicon.ico') }}">
        <link href="{{ asset('admin-assets/css/app.min.css') }}" rel="stylesheet" type="text/css" id="app-style" />
        <link href="{{ asset('admin-assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('admin-assets/libs/datatables.net-bs5/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('admin-assets/libs/datatables.net-responsive-bs5/css/responsive.bootstrap5.min.css') }}" rel="stylesheet" type="text/css" />
        <script src="{{ asset('admin-assets/js/head.js') }}"></script>
    </head>

    <body data-menu-color="light" data-sidebar="default">
        <div id="app-layout">
            
            @include('admin.partials.topbar')
            
            @include('admin.partials.sidebar')
            
            <div class="content-page">
                <div class="content">
                    <div class="container-fluid">
                        @yield('content')
                    </div>
                </div>
                
                @include('admin.partials.footer')
                
            </div>
        </div>

        <script src="{{ asset('admin-assets/libs/jquery/jquery.min.js') }}"></script>
        <script src="{{ asset('admin-assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ asset('admin-assets/libs/iconify-icon/iconify-icon.min.js') }}"></script>
        <script src="{{ asset('admin-assets/libs/simplebar/simplebar.min.js') }}"></script>
        <script src="{{ asset('admin-assets/libs/node-waves/waves.min.js') }}"></script>
        <script src="{{ asset('admin-assets/libs/waypoints/lib/jquery.waypoints.min.js') }}"></script>
        <script src="{{ asset('admin-assets/libs/jquery.counterup/jquery.counterup.min.js') }}"></script>
        <script src="{{ asset('admin-assets/libs/feather-icons/feather.min.js') }}"></script>

        @stack('scripts')

        <script src="{{ asset('admin-assets/js/app.js') }}"></script>
    </body>
</html>