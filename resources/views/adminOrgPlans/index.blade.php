@extends($layout_path)

@section('title', $app_setting['name'] . ' | ' . __('Admin Organization Plan'))

@section('content')
    <!-- ****Body-Section***** -->
    <div class="app-main-outer">
        <div class="app-main-inner">
            <div class="page-title-actions px-3 d-flex align-items-center mb-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }}</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{ __('Organization Plans') }}</li>
                    </ol>
                </nav>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card mb-5">
                        <div class="card-body">
                            <div class="table">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th><strong>#</strong></th>
                                            <th><strong>{{ __('Title') }}</strong></th>
                                            <th><strong>{{ __('Price') }}</strong></th>
                                            <th><strong>{{ __('Type') }}</strong></th>
                                            <th><strong>{{ __('Active Status') }}</strong></th>
                                            <th><strong>{{ __('Action') }}</strong></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($plans as $plan)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td class="tableId fw-bold">{{ $plan->title }}</td>
                                                <td class="tableId fw-bold">{{ currency($plan->price) }}</td>
                                                <td class="tableId">
                                                    <span
                                                        class="badge {{ $plan->plan_type == 'yearly' ? 'bg-warning' : 'bg-success' }}">
                                                        {{ $plan->plan_type }}
                                                    </span>
                                                </td>
                                                <td class="tableId">
                                                    @if (!$plan->is_active)
                                                        <div class="statusItem">
                                                            <div class="circleDot animatedPending"></div>
                                                            <div class="statusText">
                                                                <span class="stutsPanding">{{ __('De-Activated') }}</span>
                                                            </div>
                                                        </div>
                                                    @else
                                                        <div class="statusItem">
                                                            <div class="circleDot animatedCompleted"></div>
                                                            <div class="statusText">
                                                                <span class="stutsCompleted">{{ __('Activated') }}</span>
                                                            </div>
                                                        </div>
                                                    @endif
                                                </td>
                                                <td class="tableAction">
                                                    <div class="action-icon">
                                                        <a class="circleIcon"
                                                            href="{{ route('organizations.plan.edit', $plan->id) }}"
                                                            data-bs-toggle="tooltip" data-bs-placement="top"
                                                            data-bs-custom-class="custom-tooltip"
                                                            data-bs-title="{{ __('Edit Plan') }}">
                                                            <img src="{{ asset('assets/images/icon/edit.svg') }}"
                                                                alt="icon">
                                                        </a>
                                                    </div>
                                                </td>
                                            </tr>

                                        @empty
                                            <tr>
                                                <td colspan="7">
                                                    <h5 class="text-danger text-center m-0">
                                                        {{ __('No Plans Available') }}</h5>
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                            {{-- {{ $requests->links() }} --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- ****End-Body-Section**** -->
    </div>
@endsection
