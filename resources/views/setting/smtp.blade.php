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
                        <li class="breadcrumb-item active" aria-current="page">{{ __('SMTP Settings') }}</li>
                    </ol>
                </nav>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h3 class="m-0 p-0">
                                {{ __('SMTP Settings') }}</h3>
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
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label for="mail_host" class="form-label">SMTP Host</label>
                                            <input type="text" class="form-control" id="mail_host" name="mail_host"
                                                value="{{ config('mail.mailers.smtp.host') ?? '' }}" />
                                            @error('mail_host')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <label for="mail_port" class="form-label">SMTP
                                                {{ __('Email Port No') }}.</label>
                                            <input type="text" class="form-control" id="mail_port" name="mail_port"
                                                value="{{ config('mail.mailers.smtp.port') ?? '' }}" />
                                            @error('mail_port')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col-md-6 mt-3">
                                            <label for="mail_encryption" class="form-label">SMTP Encryption.</label>
                                            <input type="text" class="form-control" id="mail_encryption"
                                                name="mail_encryption"
                                                value="{{ config('mail.mailers.smtp.encryption') ?? '' }}" />
                                            @error('mail_encryption')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col-md-6 mt-3">
                                            <label for="mail_user" class="form-label">SMTP
                                                {{ __('Username') }}</label>
                                            <input type="text" class="form-control" id="mail_user" name="mail_user"
                                                value="{{ config('mail.mailers.smtp.username') ?? '' }}" />
                                            @error('mail_user')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col-md-6 mt-3">
                                            <label for="mail_password" class="form-label">SMTP
                                                {{ __('Password') }}</label>
                                            <input type="text" class="form-control" id="mail_password"
                                                name="mail_password"
                                                value="{{ config('mail.mailers.smtp.password') ?? '' }}" />
                                            @error('mail_password')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col-md-6 mt-3">
                                            <label for="mail_address" class="form-label">SMTP
                                                {{ __('Address') }}</label>
                                            <input type="text" class="form-control" id="mail_address" name="mail_address"
                                                value="{{ config('mail.mailers.smtp.address') }}" />
                                            @error('mail_address')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
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
