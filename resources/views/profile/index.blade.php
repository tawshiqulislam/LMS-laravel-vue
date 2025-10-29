@extends($layout_path)

@section('title', $app_setting['name'] . ' | ' . __('Profile'))

@section('content')

    <div class="app-main-outer">
        <div class="app-main-inner">
            {{-- top --}}
            <div class="row">
                <div class="col-lg-12 border-bottom border-bottom">
                    <h2 class="mb-3 text-uppercase fw-bold fs-4">{{ __('Profile') }}</h2>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12 mt-4">
                    <div class="card border-0 shadow-sm rounded-4">
                        <div class="card-body p-4">
                            <div class="row">
                                <!-- Edit Button -->
                                <div class="col-lg-12 d-flex justify-content-end">
                                    <a href="{{ route('user.edit', auth()->user()->id) }}"
                                        class="btn btn-light btn-sm rounded-3 shadow-sm">
                                        <img src="/assets/images/icon/color-edit.svg" alt="edit" width="20">
                                    </a>
                                </div>

                                <!-- Profile Image -->
                                <div class="col-md-4 col-lg-2 my-auto">
                                    <div class="position-relative mx-auto profile-img" style="width:140px;height:140px;">
                                        <img class="rounded-circle w-100 h-100 object-fit-cover border border-3 border-light shadow-sm"
                                            src="{{ auth()->user()->profilePicturePath }}" alt="profile">
                                        <form action="{{ route('admin.profile.image.update', auth()->user()->id) }}"
                                            method="POST" enctype="multipart/form-data">
                                            @csrf @method('PUT')
                                            <div class="overlay-img">
                                                <label for="profile_picture" class="m-0 cursor-pointer">
                                                    <img src="/assets/images/icon/camera.svg" alt="edit" width="18">
                                                </label>
                                                <input type="file" name="profile_picture" id="profile_picture" hidden
                                                    accept="image/*" onchange="this.form.submit()">
                                            </div>
                                        </form>
                                    </div>
                                </div>

                                <!-- Profile Details -->
                                <div class="col-md-12 col-lg-10 my-auto mt-3 mt-lg-0">
                                    <div class="mb-4">
                                        <h3 class="fw-bold mb-1">{{ auth()->user()->name }}</h3>
                                        <p class="text-muted mb-0">{{ auth()->user()->email }}</p>
                                    </div>
                                    <div class="row bg-light rounded-4 py-3 px-2">
                                        <div class="col-md-6 col-lg-3">
                                            <h6 class="text-secondary mb-1">{{ __('Email') }}</h6>
                                            <p class="fw-medium">{{ auth()->user()->email }}</p>
                                        </div>
                                        <div class="col-md-6 col-lg-3">
                                            <h6 class="text-secondary mb-1">{{ __('Phone Number') }}</h6>
                                            <p class="fw-medium">{{ auth()->user()->phone }}</p>
                                        </div>
                                        <div class="col-md-6 col-lg-3">
                                            <h6 class="text-secondary mb-1">{{ __('Gender') }}</h6>
                                            <p class="fw-medium text-capitalize">{{ auth()->user()->gender ?? 'N/A' }}</p>
                                        </div>
                                        <div class="col-md-6 col-lg-3">
                                            <h6 class="text-secondary mb-1">{{ __('Date of Birth') }}</h6>
                                            <p class="fw-medium">
                                                {{ \Carbon\Carbon::parse(auth()->user()->birthday)->format('d M, Y') }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- About Me & Contact Info -->
                <div class="row my-4">
                    <!-- About Me -->
                    <div class="col-lg-8">
                        <div class="card border-0 shadow-sm rounded-4">
                            <div class="card-body p-4">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <h4 class="fw-bold m-0">{{ __('About Me') }}</h4>
                                    <a href="{{ route('user.edit', auth()->user()->id) }}"
                                        class="btn btn-light btn-sm rounded-3 shadow-sm">
                                        <img src="/assets/images/icon/color-edit.svg" alt="edit" width="18">
                                    </a>
                                </div>
                                <p class="text-muted">
                                    {{ auth()->user()->about ?? __('No information available right now') }}.
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Contact Info -->
                    <div class="col-lg-4 mt-3 mt-lg-0">
                        <div class="card border-0 shadow-sm rounded-4">
                            <div class="card-body p-4">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <h4 class="fw-bold m-0">{{ __('Contact Info') }}</h4>
                                    <a href="{{ route('user.edit', auth()->user()->id) }}"
                                        class="btn btn-light btn-sm rounded-3 shadow-sm">
                                        <img src="/assets/images/icon/color-edit.svg" alt="edit" width="18">
                                    </a>
                                </div>
                                <div class="mb-3 d-flex align-items-center gap-2">
                                    <h6 class="text-secondary m-0">{{ __('Email') }}:</h6>
                                    <p class="fw-medium">{{ auth()->user()->email ?? 'N/A' }}</p>
                                </div>
                                <div class="mb-3 d-flex align-items-center gap-2">
                                    <h6 class="text-secondary m-0">{{ __('Phone Number') }}:</h6>
                                    <p class="fw-medium">{{ auth()->user()->phone ?? 'N/A' }}</p>
                                </div>
                                <div class="d-flex align-items-center gap-2">
                                    <h6 class="text-secondary m-0">{{ __('Whatsapp Number') }}:</h6>
                                    <p class="fw-medium">{{ auth()->user()->whatsapp ?? 'N/A' }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection
