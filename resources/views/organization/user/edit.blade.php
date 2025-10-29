@extends($layout_path)

@section('title', $app_setting['name'] . ' | ' . __('User Edit'))

@section('content')
    <!-- ****Body-Section***** -->
    <div class="app-main-outer">
        <div class="app-main-inner">
            <div class="page-title-actions px-3 d-flex">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a
                                href="{{ auth()->user()->is_org ? route('org.dashboard') : route('admin.dashboard') }}">{{ __('Dashboard') }}</a>
                        </li>
                        @if (auth()->user()->hasRole('admin') && auth()->user()->is_admin)
                            <li class="breadcrumb-item">
                                <a href="{{ route('user.index') }}">{{ __('User') }}</a>
                            </li>
                        @elseif(auth()->user()->hasRole('instructor'))
                            <li class="breadcrumb-item">
                                <a href="{{ route('user.index') }}">{{ __('Instructor') }}</a>
                            </li>
                        @else
                            <li class="breadcrumb-item"><a href="javascript:void(0);">
                                    {{ __('Organization') }}</a>
                            </li>
                        @endif
                        <li class="breadcrumb-item active" aria-current="page">{{ __('Edit') }}</li>
                    </ol>
                </nav>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <h3 class="m-0 p-0">
                                {{ __('Edit') }}</h3>
                        </div>
                    </div>
                </div>
            </div>


            <form action="{{ route('user.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                {{-- <div class="row">
                    <div class="col-md-12 my-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-md-12 mb-3">
                                                <label class="form-label">{{ __('Name') }} <span
                                                        class="text-danger">*</span></label>
                                                <input type="text" name="name" class="form-control"
                                                    placeholder="{{ __('Enter user name') }}"
                                                    value="{{ old('name') ?? $user->name }}">
                                                @error('name')
                                                    <p class="text-danger my-2">{{ $message }}</p>
                                                @enderror
                                            </div>
                                            <div class="col-md-12 mb-3">
                                                <label class="form-label">{{ __('Email') }} <span
                                                        class="text-danger">*</span></label>
                                                <input type="email" name="email" class="form-control"
                                                    placeholder="{{ __('Enter user email') }}"
                                                    value="{{ old('email') ?? $user->email }}">
                                                @error('email')
                                                    <p class="text-danger my-2">{{ $message }}</p>
                                                @enderror
                                            </div>
                                            <div class="col-md-12 mb-3">
                                                <label class="form-label">{{ __('Phone') }} <span
                                                        class="text-danger">*</span></label>
                                                <input type="text" name="phone" class="form-control"
                                                    placeholder="{{ __('Enter user phone') }}"
                                                    value="{{ old('phone') ?? $user->phone }}">

                                                @error('phone')
                                                    <p class="text-danger my-2">{{ $message }}</p>
                                                @enderror
                                            </div>
                                            <div class="col-md-12 mb-3">
                                                <label class="form-label">{{ __('Whats App Contact No') }} : <span
                                                        class="text-danger">*</span></label>
                                                <input type="text" name="whatsapp" class="form-control"
                                                    placeholder="{{ __('Enter Whats App Contact') }}"
                                                    value="{{ $user?->whatsapp ?? old('whatsapp') }}">

                                                @error('whatsapp')
                                                    <p class="text-danger my-2">{{ $message }}</p>
                                                @enderror
                                            </div>
                                            <div class="col-md-12 mb-3">
                                                <label class="form-label">{{ __('Gender') }}: </label>
                                                <select class="form-select form-control form-select-lg" name="gender"
                                                    id="whatsapp">
                                                    <option value="">{{ __('Select Gender') }}</option>
                                                    <option {{ $user?->gender == __('Male') ? 'selected' : '' }}
                                                        value="male">
                                                        {{ __('Male') }}
                                                    </option>
                                                    <option {{ $user?->gender == __('Female') ? 'selected' : '' }}
                                                        value="female">{{ __('Female') }}</option>
                                                    <option {{ $user?->gender == __('other') ? 'selected' : '' }}
                                                        value="other">{{ __('Other') }}</option>
                                                </select>
                                                @error('gender')
                                                    <p class="text-danger my-2">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-md-12 mb-3">
                                                <div class="mb-3 d-flex justify-content-center">
                                                    <div style="width: 150px; height:150px; border-radius: 50%;">
                                                        <img id="courseImagePreview" src="{{ $user->profilePicturePath }}"
                                                            class="w-100 h-100"
                                                            style="border-radius:50%; object-fit: cover">
                                                    </div>
                                                </div>
                                                <h4 class="form-label">{{ __('Profile Picture') }} (JPG, JPEG, PNG)*</h4>
                                                <label for="formFileImage" class="w-100 border rounded-3">
                                                    <div class="d-flex justify-content-center align-items-center gap-2 p-3"
                                                        style="width: 160px; background-color: #EDEEF1">
                                                        <span>{{ __('Choose a file') }}</span>
                                                        <img src="/assets/images/media/file-plus.svg">
                                                    </div>
                                                </label>
                                                <input name="profile_picture" class="form-control form-control-lg"
                                                    id="formFileImage" type="file" hidden
                                                    onchange="document.getElementById('courseImagePreview').src = window.URL.createObjectURL(this.files[0])" />
                                                @error('profile_picture')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div class="col-md-12">
                                                <div class="col-md-12">
                                                    <label class="form-label">{{ __('About Me') }}: <span
                                                            class="text-danger">*</span></label>
                                                    <textarea class="form-control" name="about" rows="8" placeholder="{{ __('Enter about text') }}">{{ $user?->about ?? old('about') }}</textarea>

                                                    @error('about')
                                                        <p class="text-danger my-2">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="col-md-12 mt-5">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label class="form-label">{{ __('Password') }} <span
                                                        class="text-danger">*</span></label>
                                                <input type="password" name="password" class="form-control"
                                                    placeholder="{{ __('Enter user password') }}">
                                                @error('password')
                                                    <p class="text-danger my-2">{{ $message }}</p>
                                                @enderror
                                            </div>
                                            <div class="col-md-4">
                                                <label class="form-label">{{ __('Confirm Password') }}</label>
                                                <input type="password" name="password_confirmation"
                                                    class="form-control @if (strpos($errors->first('password'), 'The password field confirmation does not match') !== false) is-invalid @endif"
                                                    placeholder="{{ __('Enter user password again') }}">
                                            </div>
                                            <div class="col-md-4">
                                                <label class="form-label">{{ __('Date of Birth') }}</label>
                                                <input type="date" name="birthday" class="form-control"
                                                    value="{{ $user?->birthday ?? '' }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mt-3">
                                        <label class="form-label">Add Signature</label>
                                        <label for="uploadSignature" class="additionThumbnail"
                                            style="width: 100%; height: 150px; object-fit: fill">
                                            <img src="{{ $user->signaturePath ?? asset('enrollment/upload.png') }}"
                                                id="attribute38preview0" alt="" width="100%" height="100%"
                                                style="object-fit: contain">
                                            <button onclick="" id="removeAttribute38Thumbnail0" type="button"
                                                class="delete btn btn-sm btn-outline-danger circleIcon"
                                                style="display: none">
                                                <img src="http://pcbuilderbd.test/assets/icons-admin/trash.svg"
                                                    loading="lazy" alt="trash">
                                            </button>
                                        </label>
                                        <input id="uploadSignature" accept="image/*" type="file" name="signature"
                                            class="d-none"
                                            onchange="document.getElementById('attribute38preview0').src = window.URL.createObjectURL(this.files[0])">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12 mb-5">
                        <div class="card">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-md-6 d-flex align-items-center gap-3">
                                        <div class="form-check">
                                            <input id="activeInput" @if ($user->is_active || $user->email_verified_at) checked @endif
                                                name="is_active" class="form-check-input" type="checkbox">
                                            <label for="activeInput" class="form-check-label">
                                                {{ __('Verify Account by Default') }}
                                            </label>
                                        </div>
                                        @if (auth()->user()->is_root)
                                            <div class="form-check">
                                                <input id="adminInput" @if ($user->id == auth()->user()->id) disabled @endif
                                                    @if ($user->is_admin) checked @endif name="is_admin"
                                                    class="form-check-input" type="checkbox">
                                                <label for="adminInput" class="form-check-label">
                                                    {{ __('Allow Admin Privileges') }}
                                                </label>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="col-md-6 d-flex justify-content-end">
                                        <button type="submit"
                                            class="btn btn-primary px-5 py-2">{{ __('Update') }}</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> --}}

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
                                                placeholder="{{ __('Enter user name') }}"
                                                value="{{ old('name', $user->name) }}">
                                            @error('name')
                                                <p class="text-danger my-2">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <!-- Email -->
                                        <div class="mb-3">
                                            <label class="form-label">{{ __('Email') }} <span
                                                    class="text-danger">*</span></label>
                                            <input type="email" name="email" class="form-control"
                                                placeholder="{{ __('Enter user email') }}"
                                                value="{{ old('email', $user->email) }}">
                                            @error('email')
                                                <p class="text-danger my-2">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <!-- Phone -->
                                        <div class="mb-3">
                                            <label class="form-label">{{ __('Phone') }} <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" name="phone" class="form-control"
                                                placeholder="{{ __('Enter user phone') }}"
                                                value="{{ old('phone', $user->phone) }}">
                                            @error('phone')
                                                <p class="text-danger my-2">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <!-- WhatsApp -->
                                        <div class="mb-3">
                                            <label class="form-label">{{ __('WhatsApp Contact No') }} <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" name="whatsapp" class="form-control"
                                                placeholder="{{ __('Enter WhatsApp Contact') }}"
                                                value="{{ old('whatsapp', $user?->whatsapp) }}">
                                            @error('whatsapp')
                                                <p class="text-danger my-2">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <!-- Gender -->
                                        <div class="mb-3">
                                            <label class="form-label">{{ __('Gender') }}</label>
                                            <select class="form-select" name="gender">
                                                <option value="">{{ __('Select Gender') }}</option>
                                                <option value="male" {{ $user?->gender == 'male' ? 'selected' : '' }}>
                                                    {{ __('Male') }}</option>
                                                <option value="female" {{ $user?->gender == 'female' ? 'selected' : '' }}>
                                                    {{ __('Female') }}</option>
                                                <option value="other" {{ $user?->gender == 'other' ? 'selected' : '' }}>
                                                    {{ __('Other') }}</option>
                                            </select>
                                            @error('gender')
                                                <p class="text-danger my-2">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Right Side (Profile + About) -->
                                    <div class="col-md-6">
                                        <!-- Profile Picture -->
                                        <div class="text-center mb-3">
                                            <div class="rounded-circle overflow-hidden mx-auto"
                                                style="width: 150px; height: 150px;">
                                                <img id="courseImagePreview" src="{{ $user->profilePicturePath }}"
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
                                            <p class="text-danger my-2">{{ $message }}</p>
                                        @enderror

                                        <!-- About Me -->
                                        <div class="mt-4">
                                            <label class="form-label">{{ __('About Me') }} <span
                                                    class="text-danger">*</span></label>
                                            <textarea class="form-control" name="about" rows="6" placeholder="{{ __('Enter about text') }}">{{ old('about', $user?->about) }}</textarea>
                                            @error('about')
                                                <p class="text-danger my-2">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Password + Birthday -->
                                    <div class="col-12 mt-4">
                                        <div class="row g-3">
                                            <div class="col-md-4">
                                                <label class="form-label">{{ __('Password') }} <span
                                                        class="text-danger">*</span></label>
                                                <input type="password" name="password" class="form-control"
                                                    placeholder="{{ __('Enter user password') }}">
                                                @error('password')
                                                    <p class="text-danger my-2">{{ $message }}</p>
                                                @enderror
                                            </div>
                                            <div class="col-md-4">
                                                <label class="form-label">{{ __('Confirm Password') }}</label>
                                                <input type="password" name="password_confirmation"
                                                    class="form-control
                                    @if (strpos($errors->first('password'), 'confirmation does not match') !== false) is-invalid @endif"
                                                    placeholder="{{ __('Enter user password again') }}">
                                            </div>
                                            <div class="col-md-4">
                                                <label class="form-label">{{ __('Date of Birth') }}</label>
                                                <input type="date" name="birthday" class="form-control"
                                                    value="{{ $user?->birthday ?? '' }}">
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Signature -->
                                    <div class="col-md-6 mt-4">
                                        <label class="form-label">{{ __('Add Signature') }}</label>
                                        <label for="uploadSignature" class="d-block border rounded-3 position-relative"
                                            style="height: 150px; cursor: pointer;">
                                            <img src="{{ $user->signaturePath ?? asset('enrollment/upload.png') }}"
                                                id="attribute38preview0" alt="Signature Preview" class="w-100 h-100"
                                                style="object-fit: contain">
                                            <button id="removeAttribute38Thumbnail0" type="button"
                                                class="btn btn-sm btn-outline-danger position-absolute top-0 end-0 m-2"
                                                style="display: none">
                                                <img src="http://pcbuilderbd.test/assets/icons-admin/trash.svg"
                                                    loading="lazy" alt="trash">
                                            </button>
                                        </label>
                                        <input id="uploadSignature" accept="image/*" type="file" name="signature"
                                            class="d-none"
                                            onchange="document.getElementById('attribute38preview0').src = window.URL.createObjectURL(this.files[0])">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Verify & Admin -->
                <div class="row">
                    <div class="col-12 mb-5">
                        <div class="card">
                            <div class="card-body">
                                <div class="row align-items-center g-3">
                                    <div class="col-md-6 d-flex flex-wrap gap-3">
                                        <div class="form-check">
                                            <input id="activeInput" @if ($user->is_active || $user->email_verified_at) checked @endif
                                                name="is_active" class="form-check-input" type="checkbox">
                                            <label for="activeInput" class="form-check-label">
                                                {{ __('Verify Account by Default') }}
                                            </label>
                                        </div>
                                        @if (auth()->user()->is_root)
                                            <div class="form-check">
                                                <input id="adminInput" @if ($user->id == auth()->user()->id) disabled @endif
                                                    @if ($user->is_admin) checked @endif name="is_admin"
                                                    class="form-check-input" type="checkbox">
                                                <label for="adminInput" class="form-check-label">
                                                    {{ __('Allow Admin Privileges') }}
                                                </label>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="col-md-6 d-flex justify-content-end">
                                        <button type="submit"
                                            class="btn btn-primary px-5 py-2">{{ __('Update') }}</button>
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
