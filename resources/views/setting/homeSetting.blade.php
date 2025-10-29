@extends('layouts.app')

@section('title', $app_setting['name'] . ' | ' . __('Settings'))

@section('content')
    <!-- ****Body-Section***** -->
    <div class="app-main-outer">
        <div class="app-main-inner">
            <div class="page-title-actions px-3 d-flex">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }}</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{ __('Home Page Settings') }}</li>
                    </ol>
                </nav>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h3 class="m-0 p-0">
                                {{ __('Home Page Settings') }}</h3>
                        </div>
                    </div>
                </div>
            </div>

            {{-- content start here --}}

            <form action="{{ route('setting.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row my-3">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12 mb-3">
                                        <h3 class="m-0 p-0 fw-bold text-primary">{{ __('Site Logo Settings') }}</h3>
                                    </div>
                                    <div class="col-md-4 border-end mt-auto">
                                        <div class="mb-3">
                                            <img id="logoImagePreview"
                                                src="{{ $setting?->logoPath ?? 'https://placehold.jp/675x154.png' }}"
                                                class="w-100"
                                                style="max-height: 180px; border-radius:1rem; object-fit: contain">
                                        </div>
                                        <div>
                                            <h4 class="form-label">{{ __('System Logo') }} (JPG, JPEG, PNG)*</h4>
                                            <label for="formLogoImage" class="w-100 border rounded-3">
                                                <div class="d-flex justify-content-center align-items-center gap-2 p-3"
                                                    style="width: 160px; background-color: #EDEEF1">
                                                    <span>{{ __('Choose a file') }}</span>
                                                    <img src="/assets/images/media/file-plus.svg">
                                                </div>
                                            </label>
                                            <input name="logo" class="form-control form-control-lg" id="formLogoImage"
                                                type="file" hidden
                                                onchange="document.getElementById('logoImagePreview').src = window.URL.createObjectURL(this.files[0])" />
                                        </div>

                                        @error('logo')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-4 border-end mt-auto">
                                        <div class="mb-3">
                                            <img id="footerImagePreview"
                                                src="{{ $setting?->footerPath ?? 'https://placehold.jp/675x154.png' }}"
                                                class="w-100"
                                                style="max-height: 160px; border-radius:1rem; object-fit: contain">
                                        </div>
                                        <div>
                                            <h4 class="form-label">{{ __('System Footer Logo') }} (JPG, JPEG, PNG)*</h4>
                                            <label for="formFooterImage" class="w-100 border rounded-3">
                                                <div class="d-flex justify-content-center align-items-center gap-2 p-3"
                                                    style="width: 160px; background-color: #EDEEF1">
                                                    <span>{{ __('Choose a file') }}</span>
                                                    <img src="/assets/images/media/file-plus.svg">
                                                </div>
                                            </label>
                                            <input name="footerlogo" class="form-control form-control-lg"
                                                id="formFooterImage" type="file" hidden
                                                onchange="document.getElementById('footerImagePreview').src = window.URL.createObjectURL(this.files[0])" />
                                        </div>
                                        @error('footerlogo')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-4 border-end mt-auto">
                                        <div class="mb-3">
                                            <img id="faviconImagePreview"
                                                src="{{ $setting?->faviconPath ?? 'https://placehold.jp/60x60.png' }}"
                                                class="w-100"
                                                style="max-height: 110px; border-radius:1rem; object-fit: contain">
                                        </div>
                                        <div>
                                            <h4 class="form-label">{{ __('Website Favicon') }} (JPG, JPEG, PNG)*</h4>
                                            <label for="formFaviconImage" class="w-100 border rounded-3">
                                                <div class="d-flex justify-content-center align-items-center gap-2 p-3"
                                                    style="width: 160px; background-color: #EDEEF1">
                                                    <span>{{ __('Choose a file') }}</span>
                                                    <img src="/assets/images/media/file-plus.svg">
                                                </div>
                                            </label>
                                            <input name="favicon" class="form-control form-control-lg" id="formFaviconImage"
                                                type="file" hidden
                                                onchange="document.getElementById('faviconImagePreview').src = window.URL.createObjectURL(this.files[0])" />
                                        </div>
                                        @error('favicon')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row my-3">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12 mb-3">
                                        <h3 class="m-0 p-0 fw-bold text-primary">{{ __('Images Settings') }}</h3>
                                    </div>
                                    <div class="col-md-4 border-end mt-auto">
                                        <div class="mb-3">
                                            <img id="heroImagePreview"
                                                src="{{ $setting?->heroPath ?? 'https://placehold.jp/1480x2052.png' }}"
                                                class="w-100"
                                                style="max-height: 145px; border-radius:1rem; object-fit: cover">
                                        </div>
                                        <div>
                                            <h4 class="form-label">{{ __('Hero Image') }} (JPG, JPEG, PNG)*</h4>
                                            <label for="formHeroImage" class="w-100 border rounded-3">
                                                <div class="d-flex justify-content-center align-items-center gap-2 p-3"
                                                    style="width: 160px; background-color: #EDEEF1">
                                                    <span>{{ __('Choose a file') }}</span>
                                                    <img src="/assets/images/media/file-plus.svg">
                                                </div>
                                            </label>
                                            <input name="hero_thumbnail" class="form-control form-control-lg"
                                                id="formHeroImage" type="file" hidden
                                                onchange="document.getElementById('heroImagePreview').src = window.URL.createObjectURL(this.files[0])" />
                                        </div>
                                        @error('hero_thumbnail')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-4 border-end mt-auto">
                                        <div class="mb-3">
                                            <img id="aboutImagePreview"
                                                src="{{ $setting?->aboutPath ?? 'https://placehold.jp/1008x1116.png' }}"
                                                class="w-100"
                                                style="max-height: 145px; border-radius:1rem; object-fit: cover">
                                        </div>
                                        <div>
                                            <h4 class="form-label">{{ __('About Us Image') }} (JPG, JPEG, PNG)*</h4>
                                            <label for="footerImage" class="w-100 border rounded-3">
                                                <div class="d-flex justify-content-center align-items-center gap-2 p-3"
                                                    style="width: 160px; background-color: #EDEEF1">
                                                    <span>{{ __('Choose a file') }}</span>
                                                    <img src="/assets/images/media/file-plus.svg">
                                                </div>
                                            </label>
                                            <input name="about_thumbnail" class="form-control form-control-lg"
                                                id="footerImage" type="file" hidden
                                                onchange="document.getElementById('aboutImagePreview').src = window.URL.createObjectURL(this.files[0])" />
                                        </div>
                                        @error('about_thumbnail')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-md-4 border-end mt-auto">
                                        <div class="mb-3">
                                            <img id="footerbgImagePreview"
                                                src="{{ $setting?->footerBGPath ?? 'https://placehold.jp/1440x420.png' }}"
                                                class="w-100"
                                                style="max-height: 145px; border-radius:1rem; object-fit: cover">
                                        </div>
                                        <div>
                                            <h4 class="form-label">{{ __('Footer Background Image') }} (JPG, JPEG, PNG)*
                                            </h4>
                                            <label for="formFooterBgImage" class="w-100 border rounded-3">
                                                <div class="d-flex justify-content-center align-items-center gap-2 p-3"
                                                    style="width: 160px; background-color: #EDEEF1">
                                                    <span>{{ __('Choose a file') }}</span>
                                                    <img src="/assets/images/media/file-plus.svg">
                                                </div>
                                            </label>
                                            <input name="footer_bg_thumbnail" class="form-control form-control-lg"
                                                id="formFooterBgImage" type="file" hidden
                                                onchange="document.getElementById('footerbgImagePreview').src = window.URL.createObjectURL(this.files[0])" />
                                        </div>
                                        @error('footer_bg_thumbnail')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12 mb-3">
                                        <h3 class="fw-bold text-primary border-bottom border-2 pb-3 ">
                                            {{ __('Hero Information') }}</h3>
                                    </div>

                                    <div class="col-md-4 mb-3">
                                        <label for="courseTitle" class="form-label">{{ __('Hero Title') }} <span
                                                class="text-danger fw-bold">*</span></label>
                                        <input type="text" class="form-control" id="courseTitle" name="hero_title"
                                            value="{{ $setting?->hero_title }}" placeholder="Enter Hero Title" />
                                        @error('hero_title')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label for="courseTitle" class="form-label">{{ __('Hero Subtitle') }} <span
                                                class="text-danger fw-bold">*</span></label>
                                        <input type="text" class="form-control" id="courseTitle" name="hero_subtitle"
                                            value="{{ $setting?->hero_subtitle }}" placeholder="Enter Hero Subtitle" />
                                        @error('hero_subtitle')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label for="courseTitle" class="form-label">{{ __('Hero Description') }} <span
                                                class="text-danger fw-bold">*</span></label>
                                        <input type="text" class="form-control" id="courseTitle"
                                            name="hero_description" value="{{ $setting?->hero_description }}"
                                            placeholder="Enter Hero Description" />
                                        @error('hero_description')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">

                                    <div class="col-md-12 my-3">
                                        <h3 class="fw-bold text-primary border-bottom border-2 pb-3 ">
                                            {{ __('Downloadable Link') }}</h3>
                                    </div>

                                    <div class="col-md-4 mt-auto">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <label for="play_store" class="form-label"> <i
                                                        class="bi bi-google-play fs-6"></i>
                                                    {{ __('Play Store') }}<span
                                                        class="text-danger fw-bold">*</span></label>
                                                <input type="text" class="form-control" id="play_store"
                                                    placeholder="{{ __('Play Store Link') }}" name="play_store_url"
                                                    value="{{ $setting->play_store_url }}">
                                                @error('play_store_url')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-4 mt-auto">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <label for="app_store" class="form-label"><i
                                                        class="bi bi-apple fs-6"></i>
                                                    {{ __('App Store') }}<span
                                                        class="text-danger fw-bold">*</span></label>
                                                <input type="text" class="form-control" id="app_store"
                                                    placeholder="{{ __('App Store Link') }}" name="app_store_url"
                                                    value="{{ $setting->app_store_url }}">
                                                @error('app_store_url')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-4 my-auto">
                                        <div class="mb-3 d-flex justify-content-center">
                                            <img id="scanerImagePreview" src="{{ $setting->scanerPath }}"
                                                style="width:100px; height:100px; border-radius:1rem; object-fit: contain">
                                        </div>
                                        <div>
                                            <h4 class="form-label">{{ __('Website QR Scaner') }}(JPG, JPEG, PNG)*
                                            </h4>
                                            <label for="formScanerImage" class="w-100 border rounded-3">
                                                <div class="d-flex justify-content-center align-items-center gap-2 p-3"
                                                    style="width: 160px; background-color: #EDEEF1">
                                                    <span>{{ __('Choose a file') }}</span>
                                                    <img src="/assets/images/media/file-plus.svg">
                                                </div>
                                            </label>
                                            <input name="scaner" class="form-control form-control-lg"
                                                id="formScanerImage" type="file" hidden
                                                onchange="document.getElementById('scanerImagePreview').src = window.URL.createObjectURL(this.files[0])" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body d-flex justify-content-end">
                                <button type="submit" class="btn btn-lg btn-primary py-2 px-5">
                                    {{ __('Update') }}
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

            </form>

            {{-- content end here --}}

        </div>
    </div>
    <!-- ****Body-Section***** -->
@endsection
