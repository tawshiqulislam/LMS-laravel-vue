@extends($layout_path)

@section('title', $app_setting['name'] . ' | ' . __('Server DNS Record'))

@section('content')
    <!-- ****Body-Section***** -->
    <div class="app-main-outer">
        <div class="app-main-inner">
            <div
                class="page-title-actions px-3 py-3 d-flex justify-content-between align-items-center bg-white rounded mb-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb m-0 p-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }}</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{ __('Server DNS Record') }}</li>
                    </ol>
                </nav>
            </div>

            <div class="container">
                <form action="{{ route('server.store') }}" method="POST">
                    @csrf
                    <div class="row g-4">
                        <div class="col-12">
                            <h3 class="fw-bold mb-1">
                                <i class="bi bi-hdd-network text-primary"></i>
                                {{ __('Server DNS Record') }}
                            </h3>
                            <p class="text-muted mb-4">
                                {{ __('Configure your server DNS records below. Ensure all fields are filled out correctly.') }}
                            </p>
                        </div>

                        <!-- Server Name -->
                        <div class="col-md-6 col-lg-4">
                            <div class="card border-0 shadow-sm rounded-4 h-100">
                                <div class="card-header text-white rounded-top-4"
                                    style="background: linear-gradient(90deg,#4e73df,#1cc88a);">
                                    <h6 class="mb-0"><i class="bi bi-server me-2"></i>{{ __('Server Name') }}</h6>
                                </div>
                                <div class="card-body">
                                    <input type="text" class="form-control rounded-pill" name="server_name"
                                        placeholder="e.g. Main Hosting, DigitalOcean-1"
                                        value="{{ $server->server_name ?? '' }}">
                                    @error('server_name')
                                        <span class="text-danger small">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Domain -->
                        <div class="col-md-6 col-lg-4">
                            <div class="card border-0 shadow-sm rounded-4 h-100">
                                <div class="card-header text-white rounded-top-4"
                                    style="background: linear-gradient(90deg,#36b9cc,#4e73df);">
                                    <h6 class="mb-0"><i class="bi bi-globe2 me-2"></i>{{ __('Domain') }}</h6>
                                </div>
                                <div class="card-body">
                                    <input type="text" class="form-control rounded-pill" name="domain"
                                        placeholder="e.g. example.com" value="{{ $server->domain ?? '' }}">
                                    @error('domain')
                                        <span class="text-danger small">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Name Server 1 -->
                        <div class="col-md-6 col-lg-4">
                            <div class="card border-0 shadow-sm rounded-4 h-100">
                                <div class="card-header  text-white rounded-top-4"
                                    style="background: linear-gradient(90deg,#f6c23e,#e74a3b);">
                                    <h6 class="mb-0"><i class="bi bi-diagram-3 me-2"></i>{{ __('Name Server 1') }}</h6>
                                </div>
                                <div class="card-body">
                                    <input type="text" class="form-control rounded-pill" name="ns1"
                                        placeholder="ns1.example.com" value="{{ $server->ns1 ?? '' }}">
                                    @error('ns1')
                                        <span class="text-danger small">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Name Server 2 -->
                        <div class="col-md-6 col-lg-4">
                            <div class="card border-0 shadow-sm rounded-4 h-100">
                                <div class="card-header text-white rounded-top-4"
                                    style="background: linear-gradient(90deg,#1cc88a,#20c997);">
                                    <h6 class="mb-0"><i class="bi bi-diagram-3-fill me-2"></i>{{ __('Name Server 2') }}
                                    </h6>
                                </div>
                                <div class="card-body">
                                    <input type="text" class="form-control rounded-pill" name="ns2"
                                        placeholder="ns2.example.com" value="{{ $server->ns2 ?? '' }}">
                                    @error('ns2')
                                        <span class="text-danger small">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Root Path -->
                        <div class="col-md-6 col-lg-4">
                            <div class="card border-0 shadow-sm rounded-4 h-100">
                                <div class="card-header text-white rounded-top-4"
                                    style="background: linear-gradient(90deg,#858796,#4e73df);">
                                    <h6 class="mb-0"><i class="bi bi-folder2-open me-2"></i>{{ __('Root Path') }}
                                    </h6>
                                </div>
                                <div class="card-body">
                                    <input type="text" class="form-control rounded-pill" name="root_path"
                                        placeholder="/home/username/public_html" value="{{ $server->root_path ?? '' }}">
                                    @error('root_path')
                                        <span class="text-danger small">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- SSL Certified -->
                        <div class="col-md-6 col-lg-4">
                            <div class="card border-0 shadow-sm rounded-4 h-100">
                                <div class="card-header text-white rounded-top-4"
                                    style="background: linear-gradient(90deg,#4e73df,#36b9cc);">
                                    <h6 class="mb-0"><i class="bi bi-lock-fill me-2"></i>{{ __('SSL Certified') }}</h6>
                                </div>
                                <div class="card-body">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="ssl_enabled"
                                            id="ssl_enabled_true" value="true"
                                            {{ $server?->ssl_enabled == true ? 'checked' : '' }}>
                                        <label class="form-check-label" for="ssl_enabled_true">{{ __('True') }}</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="ssl_enabled"
                                            id="ssl_enabled_false" value="false"
                                            {{ $server?->ssl_enabled == false ? 'checked' : '' }}>
                                        <label class="form-check-label"
                                            for="ssl_enabled_false">{{ __('False') }}</label>
                                    </div>
                                    @error('ssl_enabled')
                                        <span class="text-danger small">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Save Button -->
                        <div class="col-12 text-end mt-4">
                            <button type="submit" class="btn btn-lg btn-primary rounded-pill shadow px-5">
                                <i class="bi bi-check-circle me-2"></i>{{ __('Save') }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>

        </div>

        <!-- ****End-Body-Section**** -->
    </div>
@endsection
