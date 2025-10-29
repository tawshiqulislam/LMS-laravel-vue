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

        #toggleConfirmPassword {
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
                    <div class="col-lg-6">
                        <img src="{{ asset('assets/images/org/register/org-register.jpg') }}" alt="auth-login"
                            class="h-100 w-100 object-fit-cover">
                    </div>
                    <div class="col-lg-6 my-auto ">
                        <div class="card-body">
                            <div class="text-center mb-5 rounded-4" style="background: #F9FBFF ; padding: 10px 0px;">
                                @if ($app_setting['logo'])
                                    <img src="{{ $app_setting['logo'] }}" alt="" width="200">
                                @else
                                    <img src="{{ asset('assets/images/org/register/org-register.jpg') }}"
                                        alt="" width="200">
                                @endif
                            </div>
                            <form action="{{ route('org.authentication') }}" method="POST">
                                @csrf
                                <!-- Name input -->
                                <div class="form-outline mb-2">
                                    <label class="form-label">{{ __('Full Name') }}</label>
                                    <input type="text" id="email" name="name" class="form-control rounded-2"
                                        placeholder="{{ __('Enter your full name') }}" value="{{ old('name') }}">
                                    @error('name')
                                        <p class="text-danger mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Email input -->
                                <div class="form-outline mb-2">
                                    <label class="form-label">{{ __('Email address') }}</label>
                                    <input type="email" id="email" name="email" class="form-control rounded-2"
                                        placeholder="example@domain.com" value="{{ old('email') }}">
                                    @error('email')
                                        <p class="text-danger mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Phone input -->
                                <div class="form-outline mb-2">
                                    <label class="form-label">{{ __('Phone') }}</label>
                                    <input type="tel" id="email" name="phone" class="form-control rounded-2"
                                        placeholder="+100 0000 0000" value="{{ old('phone') }}">
                                    @error('phone')
                                        <p class="text-danger mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Password input -->
                                <div class="form-outline mb-4">
                                    <label class="form-label">{{ __('Password') }}</label>
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

                                <!-- Password input -->
                                <div class="form-outline mb-4">
                                    <label class="form-label">{{ __('Confirm Password') }}</label>
                                    <div class="position-relative">
                                        <input type="password" id="confirmPasswordInput" name="password_confirmation"
                                            class="form-control rounded-2"
                                            placeholder="{{ __('Confirm your password') }}">
                                        <i class="fa-solid fa-eye-slash" id="toggleConfirmPassword"
                                            onclick="myConfirmPasswordView()"></i>
                                    </div>
                                </div>

                                {{-- terms & conditions --}}
                                <div class="form-outline mb-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value=""
                                            id="organization_agreement" onchange="myAgreement(event)">
                                        <label class="form-check-label" for="organization_agreement"
                                            style="cursor: pointer">
                                            {{ __('I accept and agree to the') }}
                                            <a href="/page/terms_and_conditions" target="_blank">
                                                <span class="text-primary fw-bold">
                                                    {{ __('Terms & Condition') }}
                                                </span></a> &
                                            <a href="/page/privacy_policy" target="_blank">
                                                <span class="text-primary fw-bold">
                                                    {{ __('Privacy Policy') }}
                                                </span></a> {{ __('of') }} <a href="/"
                                                target="_blank"><span
                                                    class="text-primary fw-bold">{{ config('app.name') }}</span></a>
                                            </a>
                                        </label>
                                    </div>
                                </div>

                                <!-- Submit button -->
                                <div class="text-end">
                                    <button type="submit" id="orgLoginBtn" disabled onclick="loadder()"
                                        class="btn btn-primary btn-sm rounded-2 fw-bold py-3 px-4">
                                        {{ __('Register As Organization') }}

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
                                </div>
                            </form>
                            <div class="row mt-4">
                                <div class="col-12 text-end">
                                    <p class="m-0 fw-bold text-dark">{{ __('Already have an account') }}? <a
                                            href="{{ route('admin.login') }}" class="text-primary"
                                            style="text-decoration: underline !important">{{ __('Log in') }}</a>
                                    </p>
                                </div>
                            </div>

                        </div>
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

        function myConfirmPasswordView() {
            var icon = document.getElementById("toggleConfirmPassword");
            var x = document.getElementById("confirmPasswordInput");
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

        const myAgreement = (e) => {
            if (e.target.checked) {
                document.getElementById('orgLoginBtn').disabled = false;
            } else {
                document.getElementById('orgLoginBtn').disabled = true;
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
