<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-style-mode" content="1">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{ asset('org_assets') }}/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('org_assets') }}/css/fontawesome-pro.css">
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Lexend:wght@100..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    {{-- select 2 --}}
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <!--Bootstrap-Icon-Css-Link -->
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap-icons.css') }}">
    <!--DataTables--Css-Link -->
    <link rel="stylesheet" href="{{ asset('assets/css/datatables.min.css') }}">
    <!--quill--Css-Link -->
    <link href="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.snow.css" rel="stylesheet" />

    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('org_assets') }}/css/style.css">

    @stack('styles')

    <!-- Place favicon.ico in the root directory -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ $app_setting['favicon'] }}">
</head>

<body class="body-area">

    <!-- loading-start -->
    <div id="loading">
        <div id="loading-center">
            <div id="loading-center-absolute">
                <div class="object" id="object_four"></div>
                <div class="object" id="object_three"></div>
                <div class="object" id="object_two"></div>
                <div class="object" id="object_one"></div>
            </div>
        </div>
    </div>

    <!-- back-to-top-start -->
    <button class="back-to-top" type="button"><i class="far fa-arrow-up"></i></button>

    <!-- dashboard-start -->
    <div class="dashboard-wrapper">

        <!-- sidebar-area-start -->
        @include('organization.layouts.sidebar')
        <!-- sidebar-area-end -->

        <!-- overlay- -->
        <div class="tp-sidebar-overlay d-md-block d-lg-none"></div>

        <!-- page__body-start -->
        <div class="page__body-wrapper">

            <!-- header-start -->
            @include('organization.layouts.header')
            <!-- header-end -->

            <!-- content-start -->
            <div class="demo_main_content_area">
                @yield('content')
            </div>
            <section class="org-footer">
                <h3 class="m-0 p-0">{{ $app_setting['footer_text'] }}</h3>
            </section>
            <!-- content-end -->
        </div>
        <!-- page__body-end -->
    </div>
    <!-- dashboard-end -->

    <script src="{{ asset('org_assets') }}/js/jquery-3.7.1.min.js"></script>
    <script src="{{ asset('org_assets') }}/js/jquery.counterup.min.js"></script>
    <script src="{{ asset('assets/scripts/bootstrap.bundle.min.js') }}"></script>
    {{-- <script src="{{ asset('org_assets') }}/js/bootstrap.min.js"></script> --}}
    <!-- Full-Screen-Js-Link -->
    <script src="{{ asset('assets/scripts/full-screen.js') }}"></script>
    <!-- Sweet-Alert-link -->
    <script src="{{ asset('assets/scripts/sweetalert2.min.js') }}"></script>
    <!-- DataTables-Js-Link -->
    <script src="{{ asset('assets/scripts/datatables.min.js') }}"></script>
    <!-- quill-Js-Link -->
    <script src="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.js"></script>
    {{-- sortable js --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Sortable/1.14.0/Sortable.min.js"></script>
    <script src="{{ asset('org_assets') }}/js/apexcharts.min.js"></script>
    <script src="{{ asset('org_assets') }}/js/main.js"></script>

    {{-- Sweet Alert --}}
    <script>
        function deleteAction(deleteUrl) {
            Swal.fire({
                title: "{{ __('Are you sure?') }}",
                text: "{{ __('The instence and its realted data will be deleted!') }}",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!"
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.replace(deleteUrl);
                }
            });
        }
    </script>

    <script>
        function sureAction(submitUrl) {
            Swal.fire({
                title: "{{ __('Are you sure?') }}",
                text: "{{ __('Please confirm that you understand this course will be offered free of charge') }}",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Confirm!"
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.replace(submitUrl);
                }
            });
        }
    </script>
    @if (session('success'))
        <script>
            const Toast = Swal.mixin({
                toast: true,
                position: "top-end",
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.onmouseenter = Swal.stopTimer;
                    toast.onmouseleave = Swal.resumeTimer;
                }
            });
            Toast.fire({
                icon: "success",
                title: "{{ session('success') }}"
            });
        </script>
    @endif
    @if (session('error'))
        <script>
            const Toast = Swal.mixin({
                toast: true,
                position: "top-end",
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.onmouseenter = Swal.stopTimer;
                    toast.onmouseleave = Swal.resumeTimer;
                },
            });
            Toast.fire({
                icon: "error",
                title: "{{ session('error') }}"
            });
        </script>
    @endif

    <script>
        $('#dataTable').DataTable().destroy();
        $('#dataTable').DataTable({
            language: {
                paginate: {
                    previous: '<i class="bi bi-arrow-left-circle"></i>',
                    next: '<i class="bi bi-arrow-right-circle"></i>', // Custom icon for "Next"
                }
            },
            responsive: true,
        });
    </script>

    @stack('scripts')

</body>

</html>
