<!doctype html>
<html lang="en">

<meta http-equiv="content-type" content="text/html;charset=UTF-8" />

<head>
    <!-- Meta-Link -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Language" content="en">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" />
    <meta name="description" content="">
    <meta name="mlapplication-tap-highlight" content="no">

    <!-- Title -->
    <title>@yield('title')</title>
    <!-- FaveIcon-Link -->
    <link rel="shortcut icon" href="{{ $app_setting['favicon'] }}" type="image/x-icon">
    <!-- Bootstrap-Min-Css-Link -->
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <!-- Font-Awesome--Min-Css-Link -->
    <link rel="stylesheet" href="{{ asset('assets/css/font-awesome.min.css') }}">
    <!--Bootstrap-Icon-Css-Link -->
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap-icons.css') }}">
    <!--Style--Css-Link -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <!--Responsive--Css-Link -->
    <link rel="stylesheet" href="{{ asset('assets/css/responsive.css') }}">

    <style>
        #togglePassword {
            cursor: pointer;
            position: absolute;
            right: 20px;
            top: 50%;
            transform: translateY(-50%);
        }


        .swal2-html-container {
            font-size: 0.95rem !important;
            line-height: 28px !important;
        }

        .version-badge {
            position: absolute;
            bottom: 10px;
            right: 10px;
            background-color: #5864ff;
            color: #fff;
            font-size: 14px;
            font-weight: bold;
            padding: 5px 20px;
            border-radius: 4px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
        }

        .powerBy {
            position: absolute;
            bottom: 10px;
            left: 10px;
            color: #5864ff;
            font-size: 14px;
            font-weight: bold;
            padding: 5px 20px;
            border-radius: 4px;
        }
    </style>
</head>

<body>
    <div class="d-flex vh-100">
        @if (config('app.env') == 'local')
            <div class="powerBy">Developed by Md Tawshiqul Islam Rafi ©{{ now()->format('Y') }}</div>
            <div class="version-badge">v{{ config('app.version') }}</div>
        @endif
        <div class="container mx-auto my-auto">
            <div class="main-card card h-100 d-flex flex-column overflow-hidden shadow rounded-4">
                <div class="row">
                    <div class="col-lg-6 my-auto">
                        <div class="card-body">
                            <div class="text-center mb-3 rounded-4" style="background: #F9FBFF ; padding: 10px 0px;">
                                @if ($app_setting['logo'])
                                    <img src="{{ $app_setting['logo'] }}" alt="" width="200">
                                @else
                                    <img src="{{ asset('assets/images/auth/logo.png') }}" alt="" width="200">
                                @endif
                            </div>

                            <div class="row m-0 align-items-center bg-light-primary-v2 rounded-4 p-3">
                                <div class="col-12 mb-4 mx-0">
                                    <p class="m-0 fw-bold text-dark fs-5">{{ __('Choose Your Path to Join Us') }}!</p>
                                    <p class="m-0 fw-medium text-dark fs-6">
                                        {{ __('Are you an Student, Instructor or an Organization') }}?</p>
                                </div>
                                <div class="lms-register-btn-wrap">
                                    <div class="lms-register-btn">
                                        <a href="/register" target="_blank">
                                            {{ __('Student') }}
                                        </a>
                                    </div>
                                    <div class="lms-register-btn">
                                        <a href="{{ route('instructor.register') }}" target="_blank">
                                            {{ __('Instructor') }}
                                        </a>
                                    </div>
                                    <div class="lms-register-btn">
                                        <a href="{{ route('org.register') }}" target="_blank">
                                            {{ __('Organization') }}
                                        </a>
                                    </div>
                                </div>
                            </div>


                            <form action="{{ route('admin.authenticate') }}" method="POST" class="mt-4">
                                @csrf
                                <!-- Email input -->
                                <div class="form-outline mb-2">
                                    <label class="fw-bold mb-2">{{ __('Email address') }}</label>
                                    <input type="email" id="email" name="email" class="form-control rounded-2"
                                        placeholder="example@domain.com" value="{{ old('email') }}">
                                    @error('email')
                                        <p class="text-danger mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Password input -->
                                <div class="form-outline mb-4">
                                    <label class="fw-bold mb-2">{{ __('Password') }}</label>
                                    <div class="position-relative">
                                        <input type="password" id="passwordInput" name="password"
                                            class="form-control rounded-2"
                                            placeholder="{{ __('Enter your password') }}">
                                        <i class="fa-solid fa-eye-slash" id="togglePassword"
                                            onclick="myPasswordView()"></i>
                                    </div>
                                    @error('password')
                                        <p class="text-danger mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Submit button -->
                                <button type="submit" id="loginBtn" onclick="loadder()"
                                    class="btn btn-primary btn-sm rounded-2 fw-bold py-3 px-4 mt-4 w-100">
                                    {{ __('Login') }}

                                    <div id="is-loading" class="d-none d-inline-flex align-items-center gap-1">
                                        <div class="spinner-grow text-white" role="status"
                                            style="width: 5px; height: 5px;">
                                        </div>
                                        <div class="spinner-grow text-white" role="status"
                                            style="width: 5px; height: 5px;">
                                        </div>
                                        <div class="spinner-grow text-white" role="status"
                                            style="width: 5px; height: 5px;">
                                        </div>
                                    </div>
                                </button>
                            </form>

                            @if (config('app.env') == 'local')
                                <div class="row mt-4">
                                    <div class="col-12 col-md-6" style="cursor: pointer">
                                        <div class="border border-2 border-secondary p-2 d-flex align-items-start justify-content-between gap-2 rounded-3 mb-4"
                                            onclick="email.value = 'admin@rightlearning.com'; passwordInput.value = 'secret@123'">
                                            <div>
                                                <strong>{{ __('Email') }}:</strong> admin@rightlearning.com <br>
                                                <strong>{{ __('Password') }}:</strong> secret@123
                                            </div>
                                            <button
                                                onclick="email.value = 'admin@rightlearning.com'; passwordInput.value = 'secret@123'"
                                                class="btn btn-sm btn-outline-secondary small">
                                                <i class="bi bi-clipboard-check-fill"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6" style="cursor: pointer">
                                        <div class="border border-2 border-secondary p-2 d-flex align-items-start justify-content-between gap-2 rounded-3 mb-4"
                                            onclick="email.value = 'instructor@rightlearning.com'; passwordInput.value = 'secret'">
                                            <div>
                                                <strong>Email:</strong> instructor@rightlearning.com <br>
                                                <strong>Password:</strong> secret
                                            </div>
                                            <button
                                                onclick="email.value = 'instructor@rightlearning.com'; passwordInput.value = 'secret'"
                                                class="btn btn-sm btn-outline-secondary small">
                                                <i class="bi bi-clipboard-check-fill"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6" style="cursor: pointer">
                                        <div class="border border-2 border-secondary p-2 d-flex align-items-start justify-content-between gap-2 rounded-3 mb-4"
                                            onclick="email.value = 'org@rightlearning.com'; passwordInput.value = 'secret@org'">
                                            <div>
                                                <strong>Email:</strong> org@rightlearning.com<br>
                                                <strong>Password:</strong> secret@org
                                            </div>
                                            <button
                                                onclick="email.value = 'org@rightlearning.com'; passwordInput.value = 'secret@org'"
                                                class="btn btn-sm btn-outline-secondary small">
                                                <i class="bi bi-clipboard-check-fill"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <img src="{{ asset('assets/images/auth/login.png') }}" alt="auth-login"
                            class="h-100 w-100 object-fit-cover">
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        function myPasswordView() {
            var icon = document.getElementById("togglePassword");
            var x = document.getElementById("passwordInput");
            if (x.type === "password") {
                x.type = "text";
                icon.classList.remove("fa-eye-slash");
                icon.classList.add("fa-eye");
            } else {
                x.type = "password";
                icon.classList.remove("fa-eye");
                icon.classList.add("fa-eye-slash");
            }
        }

        const loadder = () => {
            document.getElementById('is-loading').classList.remove('d-none');
            setTimeout(() => {
                document.getElementById('is-loading').classList.add('d-none');
            }, 5000);
        }
    </script>

    @if (session('verification-error'))
        <script>
            Swal.fire({
                icon: "error",
                title: "{{ session('verification-error') }}",
                showConfirmButton: false,
                timer: 3500
            });
        </script>
    @endif

    @if (session('account-created'))
        <script>
            Swal.fire({
                icon: "success",
                title: "{{ session('account-created') }}",
                showConfirmButton: false,
                timer: 3500,
                customClass: {
                    title: "swal-title",
                },
            });
        </script>
    @endif

    @if (session('account-suspended'))
        <script>
            Swal.fire({
                icon: "error",
                title: "Account Has Been Suspended",
                html: "{!! session('account-suspended') !!} ",
                footer: '<a href="{{ url('/contact-us') }}">contact with support team?</a>',
            });
        </script>
    @endif

</body>

</html>
