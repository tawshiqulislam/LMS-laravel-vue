@extends($layout_path)

@section('title', $app_setting['name'] . ' | ' . __('Settings'))

@section('content')
    <!-- ****Body-Section***** -->
    <div class="app-main-outer">
        <div class="app-main-inner">
            <div class="page-title-actions px-3 d-flex">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('org.dashboard') }}">{{ __('Dashboard') }}</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{ __('Settings') }}</li>
                    </ol>
                </nav>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h3 class="m-0 p-0">
                                {{ __('Settings') }}</h3>
                        </div>
                    </div>
                </div>
            </div>


            <div class="row">
                <div class="col-12">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="m-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>
            </div>

            <form action="{{ route('org.site.setting.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="row my-3">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-4 border-end mt-auto">
                                        <div class="mb-3">
                                            <img id="logoImagePreview"
                                                src="{{ $setting?->logoPath ?? 'https://placehold.co/550x200' }}"
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
                                    </div>
                                    <div class="col-md-4 border-end mt-auto">
                                        <div class="mb-3">
                                            <img id="footerImagePreview"
                                                src="{{ $setting?->footerPath ?? 'https://placehold.co/550x200' }}"
                                                class="w-100"
                                                style="max-height: 180px; border-radius:1rem; object-fit: contain">
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
                                    </div>
                                    <div class="col-md-4 border-end mt-auto">
                                        <div class="mb-3">
                                            <img id="faviconImagePreview"
                                                src="{{ $setting?->faviconPath ?? 'https://placehold.co/60x60' }}"
                                                class="w-100"
                                                style="max-height: 180px; border-radius:1rem; object-fit: contain">
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
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">

                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-md-12 mb-3">
                                                <p class="fw-bold border-bottom border-2 pb-3 text-primary fs-5">
                                                    {{ __('System Information') }}</p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-4 mb-3">
                                        <label for="courseTitle" class="form-label">{{ __('System Title') }} <span
                                                class="text-danger fw-bold">*</span></label>
                                        <input type="text" class="form-control" id="courseTitle" name="app_name"
                                            value="{{ $setting?->app_name }}" placeholder="Enter System Title" />
                                        @error('app_name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label for="courseTitle" class="form-label">{{ __('Currency') }} <span
                                                class="text-danger fw-bold">*</span></label>
                                        <input type="text" class="form-control" id="courseTitle" name="app_currency"
                                            value="{{ $setting?->app_currency }}" placeholder="Enter App Currency" />
                                        @error('app_currency')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-md-4 mb-3">
                                        <label for="courseTitle" class="form-label">{{ __('Currency Symbol') }}<span
                                                class="text-danger fw-bold">*</span></label>
                                        <input type="text" class="form-control" id="courseTitle"
                                            name="app_currency_symbol" value="{{ $setting?->app_currency_symbol }}" placeholder="Enter App Currency Symbol" />
                                        @error('app_currency_symbol')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>


                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-md-12 my-3">
                                                <p class="fw-bold border-bottom border-2 pb-3 text-primary fs-5">
                                                    {{ __('Footer Information') }}</p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-4 mb-3">
                                        <label for="courseTitle" class="form-label">{{ __('Footer text') }}
                                            <span class="text-danger fw-bold">*</span>
                                        </label>
                                        <input type="text" class="form-control" id="courseTitle" name="footer_text"
                                            value="{{ $setting?->footer_text }}" />
                                        @error('footer_text')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-md-4">
                                        <div class="row">
                                            <div class="col-md-12 mb-3">
                                                <label for="footer_contact_number" class="form-label">
                                                    {{ __('Footer Contact Number') }}(+tel)
                                                    <span class="text-danger fw-bold">*</span>
                                                </label>
                                                <input type="tel" class="form-control" placeholder="+8801XXXXXXXXX"
                                                    id="footer_contact_number" name="{{ __('footer_contact_number') }}"
                                                    value="{{ $setting?->footer_contact_number }}">
                                                @error('footer_contact_number')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="row">
                                            <div class="col-md-12 mb-3">
                                                <label for="footer_support_mail" class="form-label">
                                                    {{ __('Footer Support Mail') }}
                                                    <span class="text-danger fw-bold">*</span>
                                                </label>
                                                <input type="email" class="form-control" id="footer_support_mail"
                                                    placeholder="support@example.com" name="footer_support_mail"
                                                    value="{{ $setting?->footer_support_mail }}">
                                                @error('footer_support_mail')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-md-12 mb-3">
                                                <label for="footer_description"
                                                    class="form-label">{{ __('Footer Description') }}<span
                                                        class="text-danger fw-bold">*</span></label>
                                                <textarea class="form-control" name="footer_description" id="footer_description" rows="3"
                                                    placeholder="{{ __('Footer Description') }}">{{ $setting->footer_description ?? '' }}</textarea>
                                                @error('footer_description')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-md-12 my-3">
                                                <p class="fw-bold border-bottom border-2 pb-3 text-primary fs-5">
                                                    {{ __('Social Media Link') }}</p>
                                            </div>
                                        </div>
                                    </div>

                                    @foreach (json_decode($socialMedias) as $media)
                                        <div class="col-md-4 mb-3">
                                            <label for="facebook_link" class="form-label"> <i
                                                    class="{{ $media->icon }} fs-6"></i>
                                                {{ $media->title }} {{ __('Link') }}</label>
                                            <input type="text" class="form-control" id="facebook_link"
                                                name="social_links[{{ $media->id }}]"
                                                placeholder="{{ $media->url ?? $media->title }} Link"
                                                value="{{ $media->url }}" />
                                        </div>
                                    @endforeach

                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-md-12 my-3">
                                                <p class="fw-bold border-bottom border-2 pb-3 text-primary fs-5">
                                                    {{ __('Downloadable Link') }}</p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="row">

                                            <div class="col-md-4 mt-auto">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <label for="play_store" class="form-label"> <i
                                                                class="bi bi-google-play fs-6"></i>
                                                            {{ __('Play Store') }}<span
                                                                class="text-danger fw-bold">*</span></label>
                                                        <input type="text" class="form-control" id="play_store"
                                                            placeholder="{{ __('Play Store Link') }}"
                                                            name="play_store_url"
                                                            value="{{ $setting?->play_store_url }}">
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
                                                                class="bi bi-apple fs-6"></i> {{ __('App Store') }}<span
                                                                class="text-danger fw-bold">*</span></label>
                                                        <input type="text" class="form-control" id="app_store"
                                                            placeholder="{{ __('App Store Link') }}" name="app_store_url"
                                                            value="{{ $setting?->app_store_url }}">
                                                        @error('app_store_url')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-4 my-auto">
                                                <div class="mb-3 d-flex justify-content-center">
                                                    <img id="scanerImagePreview"
                                                        src="{{ $setting?->scanerPath ?? 'https://placehold.co/100x100' }}"
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

                                            <div class="col-md-12 mt-2">
                                                <div class="row">
                                                    <div class="col-md-12 my-3">
                                                        <p class="fw-bold border-bottom border-2 pb-3 text-primary fs-5">
                                                            {{ __('Google Map Credentials (support only embed code)') }}
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <label for="google_map_embed_code" class="form-label">
                                                            {{ __('Google Map Embed Code') }}</label>
                                                        <input type="text" class="form-control"
                                                            id="google_map_embed_code" name="google_map_embed_code"
                                                            value="{{ $setting->google_map_embed_code ?? '' }}" />
                                                        @error('google_map_embed_code')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <div class="row">
                                                    <div class="col-md-12 my-3">
                                                        <p class="fw-bold border-bottom border-2 pb-3 text-primary fs-5">
                                                            {{ __('Support Whatsapp Credentials') }}
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <label for="SupportTitle" class="form-label">
                                                            {{ __('Whatsapp Support Title') }}</label>
                                                        <input type="text" class="form-control" id="SupportTitle"
                                                            name="whatsapp_support_title"
                                                            value="{{ $setting->whatsapp_support_title ?? 'Chat with us!' }}" />
                                                        @error('whatsapp_support_title')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="WhatsappNumber" class="form-label">
                                                            {{ __('Whatsapp Number') }}</label>
                                                        <input type="text" class="form-control" id="WhatsappNumber"
                                                            name="whatsapp_support_number" placeholder="+** 1234567890"
                                                            value="{{ $setting->whatsapp_support_number ?? '' }}" />
                                                        @error('whatsapp_support_number')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>


                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 mt-2 mb-3">
                        <div class="card">
                            <div class="card-body">
                                <button type="submit" class="btn btn-primary px-5 py-2">{{ __('Update') }}</button>
                            </div>
                        </div>
                    </div>
                </div>

            </form>


        </div>


        <!-- ****End-Body-Section**** -->
    </div>
@endsection
