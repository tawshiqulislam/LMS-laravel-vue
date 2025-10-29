@extends($layout_path)

@section('title', $app_setting['name'] . ' | ' . __('My Profile'))

@section('content')

    <div class="app-main-outer">
        <div class="app-main-inner">
            <div
                class="page-title-actions px-3 py-3 d-flex justify-content-between align-items-center bg-white rounded mb-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb m-0 p-0">
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.dashboard') }}">
                                {{ __('Dashboard') }}
                            </a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">{{ __('My Profile') }}</li>
                    </ol>
                </nav>
            </div>

            {{-- section start --}}

            <section class="my-2">
                <form action="{{ route('user.update', $user->id) }}" method="POST" class="row"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="bg-white rounded-3 p-4 theme-shadow col-10 mx-auto">
                        <!-- Profile Picture & Verified -->
                        <div class="text-center mb-4 rounded-2 p-4 position-relative" style="background: #F1F5F9;">
                            {{-- verified --}}
                            <div class="virified-badge">
                                @if ($user->email_verified_at != null)
                                    <span class="badge bg-success px-3 py-2">✔
                                        {{ __('Verified') }}</span>
                                @else
                                    <span v-else class="badge bg-danger px-3 py-2">✘ {{ __('Not Verified') }}</span>
                                @endif
                            </div>
                            {{-- verified --}}
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <div class="mb-3">
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
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <div class="rounded-circle overflow-hidden mx-auto"
                                            style="width: 150px; height: 150px;">
                                            <img id="attribute38preview0"
                                                src="{{ $user->signaturePath ?? asset('enrollment/upload.png') }}"
                                                class="w-100 h-100" style="object-fit: cover">
                                        </div>
                                    </div>
                                    <h6 class="form-label">{{ __('Signature') }} (JPG, JPEG, PNG)*</h6>
                                    <label for="uploadSignature" class="d-inline-block">
                                        <div class="border rounded-3 d-flex align-items-center justify-content-center gap-2 p-2"
                                            style="width: 160px; background-color: #EDEEF1; cursor: pointer;">
                                            <span>{{ __('Choose a file') }}</span>
                                            <img src="/assets/images/media/file-plus.svg">
                                        </div>
                                    </label>
                                    <input name="signature" class="d-none" id="uploadSignature" type="file"
                                        onchange="document.getElementById('attribute38preview0').src = window.URL.createObjectURL(this.files[0])">
                                    @error('signature')
                                        <p class="text-danger my-2">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Profile Form -->
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">{{ __('Author Name') }} <span
                                        class="text-danger">*</span></label>
                                <input type="text" name="name" class="form-control"
                                    placeholder="{{ __('Enter user name') }}" value="{{ old('name', $user->name) }}">
                                @error('name')
                                    <p class="text-danger my-2">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">{{ __('Author Designation') }} <span
                                        class="text-danger">*</span></label>
                                <input type="text" name="designation" class="form-control"
                                    placeholder="{{ __('Enter Designation') }}"
                                    value="{{ $user->organization->designation }}">
                                @error('designation')
                                    <p class="text-danger my-2">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">{{ __('Company/Organization Name') }} <span
                                        class="text-danger">*</span></label>
                                <input type="text" name="company_name" class="form-control"
                                    placeholder="{{ __('Enter company name') }}" value="{{ $user->organization->name }}">
                                @error('company_name')
                                    <p class="text-danger my-2">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">{{ __('Gender') }}</label>
                                <select class="form-select form-control" name="gender">
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

                            <!-- About Me -->
                            <div class="col-md-12">
                                <label class="form-label">{{ __('About Me') }} <span class="text-danger">*</span></label>
                                <textarea class="form-control" name="about" rows="6" placeholder="{{ __('Enter about text') }}">{{ old('about', $user?->about) }}</textarea>
                                @error('about')
                                    <p class="text-danger my-2">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Email -->
                            <div class="col-md-6">
                                <label class="form-label">{{ __('Email') }} <span class="text-danger">*</span></label>
                                <input type="email" name="email" class="form-control"
                                    placeholder="{{ __('Enter user email') }}" value="{{ old('email', $user->email) }}">
                                @error('email')
                                    <p class="text-danger my-2">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Phone -->
                            <div class="col-md-6">
                                <label class="form-label">{{ __('Phone') }} <span class="text-danger">*</span></label>
                                <input type="text" name="phone" class="form-control"
                                    placeholder="{{ __('Enter user phone') }}" value="{{ old('phone', $user->phone) }}">
                                @error('phone')
                                    <p class="text-danger my-2">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- WhatsApp -->
                            <div class="col-md-6">
                                <label class="form-label">{{ __('WhatsApp Contact No') }} <span
                                        class="text-danger">*</span></label>
                                <input type="text" name="whatsapp" class="form-control"
                                    placeholder="{{ __('Enter WhatsApp Contact') }}"
                                    value="{{ old('whatsapp', $user?->whatsapp) }}">
                                @error('whatsapp')
                                    <p class="text-danger my-2">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="col-md-6"></div>

                            <div class="col-md-6">
                                <label class="form-label">{{ __('Password') }} <span class="text-danger">*</span></label>
                                <input type="password" name="password" class="form-control"
                                    placeholder="{{ __('Enter user password') }}">
                                @error('password')
                                    <p class="text-danger my-2">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">{{ __('Confirm Password') }}</label>
                                <input type="password" name="password_confirmation"
                                    class="form-control
                                    @if (strpos($errors->first('password'), 'confirmation does not match') !== false) is-invalid @endif"
                                    placeholder="{{ __('Enter user password again') }}">
                            </div>

                            {{-- <div class="col-md-6 d-flex flex-wrap gap-3 my-3">
                                <div class="form-check">
                                    <input id="activeInput" @if ($user->email_verified_at != null) checked @endif
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
                            </div> --}}
                        </div>

                        <!-- Submit -->
                        <div class="mt-4">
                            <button type="submit" class="btn btn-primary w-100 py-2 fs-5">
                                {{ __('Update Profile') }}
                            </button>
                        </div>
                    </div>
                </form>

            </section>

            {{-- section end --}}

        </div>
    </div>

@endsection


@push('styles')
    <style>
        .virified-badge {
            position: absolute;
            top: 10px;
            right: 10px;
        }
    </style>
@endpush
