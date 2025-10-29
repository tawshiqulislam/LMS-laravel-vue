@extends($layout_path)

@section('title', $app_setting['name'] . ' | ' . __('User Create'))

@section('content')
    <!-- ****Body-Section***** -->
    <div class="app-main-outer">
        <div class="app-main-inner">
            <div class="page-title-actions px-3 d-flex">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.dashboard') }}">
                                {{ __('Dashboard') }}
                            </a>
                        </li>
                        <li class="breadcrumb-item"><a href="{{ route('user.index') }}">{{ __('User') }}</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{ __('Create') }}</li>
                    </ol>
                </nav>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <h3 class="m-0 p-0">
                                {{ __('Create a New Student / User') }}</h3>
                        </div>
                    </div>
                </div>
            </div>


            <form action="{{ route('user.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="row">
                    <div class="col-12 my-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="row g-4">

                                    <!-- Left Side (User Info) -->
                                    <div class="col-md-6">
                                        <!-- Name -->
                                        <div class="mb-3">
                                            <label class="form-label">{{ __('Name') }} <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" name="name" class="form-control"
                                                placeholder="{{ __('Enter user name') }}" value="{{ old('name') }}">
                                            @error('name')
                                                <p class="text-danger my-2">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <!-- Email -->
                                        <div class="mb-3">
                                            <label class="form-label">{{ __('Email') }} <span
                                                    class="text-danger">*</span></label>
                                            <input type="email" name="email" class="form-control"
                                                placeholder="{{ __('Enter user email') }}" value="{{ old('email') }}">
                                            @error('email')
                                                <p class="text-danger my-2">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <!-- Phone -->
                                        <div class="mb-3">
                                            <label class="form-label">{{ __('Phone') }} <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" name="phone" class="form-control"
                                                placeholder="{{ __('Enter user phone') }}" value="{{ old('phone') }}">
                                            @error('phone')
                                                <p class="text-danger my-2">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Right Side (Profile Picture) -->
                                    <div
                                        class="col-md-6 bg-light-primary-v2 d-flex flex-column align-items-center justify-content-center gap-3 border border-primary rounded-3">
                                        <div class="text-center">
                                            <div class="rounded-circle overflow-hidden mx-auto"
                                                style="width: 150px; height: 150px;">
                                                <img id="courseImagePreview" src="/assets/images/profile/demo-profile.png"
                                                    class="w-100 h-100" style="object-fit: cover">
                                            </div>
                                        </div>
                                        <h6 class="form-label">{{ __('Profile Picture') }} (JPG, JPEG, PNG)*</h6>
                                        <label for="formFileImage" class="d-inline-block">
                                            <div class="border rounded-3 d-flex align-items-center justify-content-center gap-2 p-2"
                                                style="width: 160px; background-color: #EDEEF1; cursor: pointer;">
                                                <span>{{ __('Choose a file') }}</span>
                                                <img src="/assets/images/media/file-plus.svg">
                                            </div>
                                        </label>
                                        <input name="profile_picture" class="d-none" id="formFileImage" type="file"
                                            onchange="document.getElementById('courseImagePreview').src = window.URL.createObjectURL(this.files[0])">
                                        @error('profile_picture')
                                            <p class="text-danger mt-2">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <!-- Passwords -->
                                    <div class="col-12 mt-4">
                                        <div class="row g-3">
                                            <div class="col-md-6">
                                                <label class="form-label">{{ __('Password') }} <span
                                                        class="text-danger">*</span></label>
                                                <input type="password" name="password" class="form-control"
                                                    placeholder="{{ __('Enter user password') }}">
                                                @error('password')
                                                    <p class="text-danger my-2">{{ $message }}</p>
                                                @enderror
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label">{{ __('Confirm Password') }}</label>
                                                <input type="password" name="password_confirmation"
                                                    class="form-control @if (strpos($errors->first('password'), 'confirmation does not match') !== false) is-invalid @endif"
                                                    placeholder="{{ __('Enter user password again') }}">
                                                @error('password_confirmation')
                                                    <p class="text-danger my-2">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                </div> <!-- row g-4 -->
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Permissions & Actions -->
                <div class="row">
                    <div class="col-12 mb-5">
                        <div class="card">
                            <div class="card-body">
                                <div class="row align-items-center g-3">
                                    <div class="col-md-6 d-flex flex-wrap gap-3">
                                        <div class="form-check">
                                            <input id="activeInput" name="is_active" class="form-check-input"
                                                type="checkbox">
                                            <label for="activeInput" class="form-check-label">
                                                {{ __('Verify Account by Default') }}
                                            </label>
                                        </div>
                                        @if (auth()->user()->is_root &&
                                                $user->is_org == false &&
                                                $user->organization == null &&
                                                !$user->hasRole('instructor') &&
                                                !$user->hasRole('organization'))
                                            <div class="form-check">
                                                <input id="adminInput" name="is_admin" class="form-check-input"
                                                    type="checkbox">
                                                <label for="adminInput" class="form-check-label">
                                                    {{ __('Allow Admin Privileges') }}
                                                </label>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="col-md-6 d-flex justify-content-end">
                                        <button type="submit"
                                            class="btn btn-primary px-5 py-2">{{ __('Create') }}</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


            </form>

            <!-- ****End-Body-Section**** -->
        </div>
    </div>
@endsection
