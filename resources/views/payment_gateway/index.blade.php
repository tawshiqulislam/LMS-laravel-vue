@extends($layout_path)
@section('title', $app_setting['name'] . ' | ' . __('Payment Gateways'))

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
                        <li class="breadcrumb-item active" aria-current="page">{{ __('Payment Gateways') }}</li>
                    </ol>
                </nav>
            </div>
            <div class="row" id="deleteTableItem">
                <div class="col-md-12">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="m-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="row">
                        {{-- PayPal --}}
                        <div class="col-md-4 mb-4">
                            <div class="card h-100">
                                <div class="card-body">
                                    <form action="{{ route('payment_gateway.update', $paypal->id) }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf @method('PUT')

                                        <div class="d-flex justify-content-between align-items-center mb-3">
                                            <h5 class="h4">PayPal</h5>
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox" name="is_active"
                                                    @if ($paypal->is_active) checked @endif>
                                            </div>
                                        </div>

                                        <div class="text-center mb-4">
                                            <img src="{{ $paypal->imagePath }}" alt="Paypal" class="img-fluid"
                                                width="120">
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">{{ __('Mode') }}</label>
                                            <select name="mode" class="form-select">
                                                <option value="sandbox"
                                                    {{ $paypalConfig->mode === 'sandbox' ? 'selected' : '' }}>
                                                    {{ __('Sandbox') }}</option>
                                                <option value="live"
                                                    {{ $paypalConfig->mode === 'live' ? 'selected' : '' }}>
                                                    {{ __('Live') }}</option>
                                            </select>
                                            @error('mode')
                                                <p class="text-danger mt-1">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">App ID</label>
                                            <input type="text" name="app_id" value="{{ $paypalConfig->app_id }}"
                                                class="form-control" required>
                                            @error('app_id')
                                                <p class="text-danger mt-1">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">Client ID</label>
                                            <input type="text" name="client_id" value="{{ $paypalConfig->client_id }}"
                                                class="form-control" required>
                                            @error('client_id')
                                                <p class="text-danger mt-1">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">Client Secret</label>
                                            <input type="text" name="client_secret"
                                                value="{{ $paypalConfig->client_secret }}" class="form-control" required>
                                            @error('client_secret')
                                                <p class="text-danger mt-1">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <div class="text-end">
                                            <button type="submit"
                                                class="btn btn-primary px-4">{{ __('Update PayPal') }}</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        {{-- Stripe --}}
                        <div class="col-md-4 mb-4">
                            <div class="card h-100">
                                <div class="card-body">
                                    <form action="{{ route('payment_gateway.update', $stripe->id) }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf @method('PUT')

                                        <div class="d-flex justify-content-between align-items-center mb-3">
                                            <h5 class="h4">Stripe</h5>
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox" name="is_active"
                                                    @if ($stripe->is_active) checked @endif>
                                            </div>
                                        </div>

                                        <div class="text-center mb-4">
                                            <img src="{{ $stripe->imagePath }}" alt="Stripe" class="img-fluid"
                                                width="120">
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">Publishable Key</label>
                                            <input type="text" name="publishable_key"
                                                value="{{ $stripeConfig->publishable_key }}" class="form-control" required>
                                            @error('publishable_key')
                                                <p class="text-danger mt-1">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">Secret Key</label>
                                            <input type="text" name="secret_key" value="{{ $stripeConfig->secret_key }}"
                                                class="form-control" required>
                                            @error('secret_key')
                                                <p class="text-danger mt-1">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <div class="text-end">
                                            <button type="submit"
                                                class="btn btn-primary px-4">{{ __('Update Stripe') }}</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        {{-- Aamarpay --}}
                        <div class="col-md-4 mb-4">
                            <div class="card h-100">
                                <div class="card-body">
                                    <form action="{{ route('payment_gateway.update', $aamarpay->id) }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf @method('PUT')

                                        <div class="d-flex justify-content-between align-items-center mb-3">
                                            <h5 class="h4">Aamarpay</h5>
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox" name="is_active"
                                                    @if ($aamarpay->is_active) checked @endif>
                                            </div>
                                        </div>

                                        <div class="text-center mb-4">
                                            <img src="{{ $aamarpay->imagePath }}" alt="Aamarpay" class="img-fluid"
                                                width="120">
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">Store ID</label>
                                            <input type="text" name="store_id"
                                                value="{{ $aamarpayConfig->store_id }}" class="form-control" required>
                                            @error('store_id')
                                                <p class="text-danger mt-1">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">Signature Key</label>
                                            <input type="text" name="signature_key"
                                                value="{{ $aamarpayConfig->signature_key }}" class="form-control"
                                                required>
                                            @error('signature_key')
                                                <p class="text-danger mt-1">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <div class="text-end">
                                            <button type="submit"
                                                class="btn btn-primary px-4">{{ __('Update Aamarpay') }}</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        {{-- Razorpay --}}
                        <div class="col-md-4 mb-4">
                            <div class="card h-100">
                                <div class="card-body">
                                    <form action="{{ route('payment_gateway.update', $razorpay->id) }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf @method('PUT')

                                        <div class="d-flex justify-content-between align-items-center mb-3">
                                            <h5 class="h4">Razorpay</h5>
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox" name="is_active"
                                                    @if ($razorpay->is_active) checked @endif>
                                            </div>
                                        </div>

                                        <div class="text-center mb-4">
                                            <img src="{{ $razorpay->imagePath }}" alt="Razorpay" class="img-fluid"
                                                width="120">
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">Key</label>
                                            <input type="text" name="key" value="{{ $razorpayConfig->key }}"
                                                class="form-control" required>
                                            @error('key')
                                                <p class="text-danger mt-1">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">Secret Key</label>
                                            <input type="text" name="secret" value="{{ $razorpayConfig->secret }}"
                                                class="form-control" required>
                                            @error('secret')
                                                <p class="text-danger mt-1">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <div class="text-end">
                                            <button type="submit"
                                                class="btn btn-primary px-4">{{ __('Update Razorpay') }}</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        {{-- 2Checkout --}}
                        <div class="col-md-4 mb-4">
                            <div class="card h-100">
                                <div class="card-body">
                                    <form action="{{ route('payment_gateway.update', $twoCheckout->id) }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf @method('PUT')

                                        <div class="d-flex justify-content-between align-items-center mb-3">
                                            <h5 class="h4">2Checkout</h5>
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox" name="is_active"
                                                    @if ($twoCheckout->is_active) checked @endif>
                                            </div>
                                        </div>

                                        <div class="text-center mb-4">
                                            <img src="{{ $twoCheckout->imagePath }}" alt="2Checkout" class="img-fluid"
                                                width="120">
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">Merchant</label>
                                            <input type="text" name="merchant"
                                                value="{{ $twoCheckoutConfig->merchant }}" class="form-control" required>
                                            @error('merchant')
                                                <p class="text-danger mt-1">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <div class="text-end">
                                            <button type="submit"
                                                class="btn btn-primary px-4">{{ __('Update 2Checkout') }}</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>

        <!-- ****End-Body-Section**** -->
    </div>
@endsection
