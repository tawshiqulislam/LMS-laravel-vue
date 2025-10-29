@extends($layout_path)

@section('title', $app_setting['name'] . ' | ' . __('My Current Plan'))

@section('content')
    <div class="app-main-outer">
        <div class="app-main-inner">

            <div class="row">
                <div class="col-12">
                    <div
                        class="page-title-actions px-3 py-3 d-flex justify-content-between align-items-center bg-white rounded mb-3">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb m-0 p-0">
                                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }}</a>
                                </li>
                                <li class="breadcrumb-item" aria-current="page">{{ __('Plans') }}</li>
                                <li class="breadcrumb-item active" aria-current="page">{{ __('Current Plan') }}</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>

            <h2 class="page-title text-warning fs-1 text-center">{{ __('My Current Plan') }}</h2>
            {{-- content start --}}
            <div class="container-fluid">
                <div class="row g-3 g-lg-4 justify-content-center align-items-center my-4">

                    @if ($plan)
                        <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                            <div class="pricing-card">
                                <div class="duration-frame text-center">
                                    <h6 class="m-0 fw-bold">{{ $plan->duration }}</h6>
                                    <span>{{ $plan->plan_type == 'monthly' ? __('Days') : __('Year') }}</span>
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <h5>{{ $plan->title }}</h5>
                                </div>
                                <ul class="text-start">
                                    <li>
                                        <i class="bi bi-card-checklist"></i>
                                        {!! $plan->description !!}
                                    </li>
                                </ul>
                                <div class="mt-auto">
                                    <div class="price">{{ $plan->price }}<span class="fs-6">/
                                            {{ $plan->plan_type }}</span>
                                    </div>
                                    <div class="my-3 card">
                                        <div class="card-body bg-light-primary-v2 rounded d-flex flex-column gap-2">
                                            <p class="m-0 d-flex align-items-center gap-2">
                                                <span class="fw-bold">{{ __('Subscription Date') }}:</span>
                                                <span
                                                    class="badge bg-info">
                                                    {{ \Carbon\Carbon::parse($subscription->subscribed_at)->format('d M, Y h:i A') }}
                                                </span>
                                            </p>
                                            <p class="m-0 d-flex align-items-center gap-2">
                                                <span class="fw-bold">{{ __('Renewal Date') }}:</span>
                                                <span
                                                    class="badge bg-{{ $subscription->expires_at < now() ? 'danger' : 'info' }}">
                                                    {{ \Carbon\Carbon::parse($subscription->expires_at)->format('d M, Y h:i A') }}
                                                </span>
                                            </p>
                                        </div>
                                    </div>
                                    <button type="button" class="btn btn-try mt-3" data-bs-toggle="modal"
                                        data-bs-target="#paymentPlanModal{{ $plan->id }}">{{ __('Renew this plan') }}</button>
                                </div>
                            </div>
                        </div>

                        <!-- Modal -->
                        <div class="modal fade" id="paymentPlanModal{{ $plan->id }}" tabindex="-1"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">
                                            {{ __('Choose Payment Method') }}</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <form action="{{ route('org.pricing.payment.initiate', $plan->id) }}" method="POST">
                                        @csrf
                                        <div class="modal-body">
                                            <div class="list-group payment-options">
                                                @foreach ($paymentGateways as $i => $gateway)
                                                    <label
                                                        class="list-group-item payment-option d-flex align-items-center mb-2">
                                                        <input type="radio" value="{{ $gateway->id }}"
                                                            name="payment_gateway_id">
                                                        <img src="{{ $gateway->imagePath }}" alt="Gateway Logo"
                                                            class="me-3 payment-logo">
                                                        <div class="fw-semibold text-uppercase">{{ $gateway->name }}</div>
                                                    </label>
                                                @endforeach
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit"
                                                class="btn btn-primary">{{ __('Pay Now') . ' ' . $plan->price }}</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @else
                        <h6 class="text-center fw-bold text-danger">
                            <span class="border border-danger px-3 py-1 rounded">
                                {{ __('You are not subscribed to any plan') }}
                            </span>
                        </h6>
                    @endif

                    {{-- payment-modal code start --}}
                </div>
            </div>
            {{-- content end --}}
        </div>
    </div>
@endsection

@push('styles')
    <style>
        .pricing-card {
            position: relative;
            background-color: #ffffff;
            color: #181059;
            border-radius: 20px;
            padding: 30px 25px;
            margin: 20px auto;
            box-shadow: 0 6px 18px rgba(0, 0, 0, 0.1);
            transition: all 0.5s ease-in-out;
            cursor: pointer;
            display: flex;
            flex-direction: column;
            height: 100%;
        }

        .duration-frame {
            position: absolute;
            top: 20px;
            right: 20px;
            background-color: #6d4aff;
            color: #fff;
            padding: 5px 10px;
            border-radius: 4px;
            font-size: 0.8rem;
            animation: pulse 2s infinite;
        }

        .duration-frame h6 {
            margin: 0;
            font-size: 1.5rem;
        }

        .duration-frame span {
            font-size: 0.8rem;
        }

        @keyframes pulse {
            0% {
                transform: scale(1);
                box-shadow: 0 0 0 0 rgba(109, 76, 255, 0.7);
            }

            50% {
                transform: scale(1.1);
                box-shadow: 0 0 0 10px rgba(109, 76, 255, 0);
            }

            100% {
                transform: scale(1);
                box-shadow: 0 0 0 0 rgba(109, 76, 255, 0);
            }
        }


        .pricing-card:hover {
            color: #ffffff;
            background-color: #181059;
            transform: translateY(-10px);
        }

        .pricing-card:hover .price {
            color: #ffffff !important;
        }

        .pricing-card:hover h5 {
            color: #ffffff !important;
        }

        .pricing-card h5 {
            font-size: 2rem !important;
            font-weight: 600 !important;
            color: #181059 !important;
            transition: all 0.5s ease-in-out;
        }

        .save-badge {
            background-color: #6d4aff;
            color: #fff;
            font-size: 0.8rem;
            padding: 4px 10px;
            border-radius: 12px;
            margin-left: 10px;
        }

        .pricing-card ul {
            list-style: none;
            padding: 0;
            margin-top: 20px;
        }

        .pricing-card ul li {
            width: 100%;
            margin-bottom: 12px;
            font-size: 0.95rem;
            display: flex;
            align-items: start;
            text-align: wrap;
        }

        .pricing-card ul li i {
            margin-right: 10px;
            color: #181059;
            font-size: 1.2rem;
        }

        .pricing-card:hover ul li i {
            color: #fff;
        }

        .pricing-card ul li.disabled {
            color: rgba(255, 255, 255, 0.4);
            text-decoration: line-through;
        }

        .price {
            text-align: start;
            font-size: 2.5rem;
            font-weight: 700;
            transition: all 0.5s ease-in-out;
        }

        .btn-try {
            background-color: #F8F4FF;
            border: none;
            color: #8b54e8;
            padding: 10px 20px;
            border-radius: 10px;
            font-weight: 600;
            transition: 0.3s;
            width: 100%;
        }

        .btn-try:hover {
            background-color: #8b54e8;
            color: #ffffff;
        }

        .pricing-card:hover .btn-try {
            background-color: #8b54e8;
            color: #ffffff;
        }

        @media (max-width: 768px) {
            .pricing-card h5 {
                font-size: 1.5rem;
            }

            .pricing-card ul li {
                font-size: 0.75rem;
            }

            .price {
                font-size: 1.25rem;
            }
        }

        .payment-option {
            border: 2px solid #e5e7eb;
            border-radius: 12px;
            padding: 12px 16px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .payment-option .payment-logo {
            width: 50px;
            height: 50px;
            object-fit: contain;
        }

        .payment-option input[type="radio"] {
            display: none;
        }

        .payment-option:hover {
            border-color: #0d6efd;
            background: #f8f9fa;
        }

        .payment-option input[type="radio"]:checked+.payment-logo,
        .payment-option input[type="radio"]:checked~div {
            color: #0d6efd;
            font-weight: 600;
        }

        .payment-option input[type="radio"]:checked~.payment-logo {
            filter: drop-shadow(0 0 5px #0d6efd);
        }

        .payment-option input[type="radio"]:checked~div {
            color: #0d6efd;
        }
    </style>
@endpush
