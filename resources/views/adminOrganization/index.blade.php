@extends($layout_path)

@section('title', $app_setting['name'] . ' | ' . __('Authorized Organization'))

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
                        <li class="breadcrumb-item active" aria-current="page">{{ __('Authorized Organization') }}</li>
                    </ol>
                </nav>
            </div>

            <div class="row" id="deleteTableItem">
                <div class="col-md-12">
                    <div class="card mb-5">
                        <div class="card-body">
                            <div class=" d-flex justify-content-end mb-3 align-items-center">
                                <form action="{{ route('organizations.index') }}" method="GET" class="search-width me-2">
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="inputGroupFile04"
                                            aria-describedby="inputGroupFileAddon04" aria-label="Upload"
                                            placeholder="{{ __('Search') }}" name="search"
                                            value="{{ request('search') }}">
                                        <button class="btn btn-outline-primary px-3" type="submit"
                                            id="inputGroupFileAddon04"><i class="bi bi-search"></i></button>
                                    </div>
                                </form>
                                <div class="d-flex justify-content-end">
                                    <a href="{{ route('organizations.index') }}" class="px-3">
                                        <i class="bi bi-arrow-counterclockwise"></i> {{ __('Reset') }}
                                    </a>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th><strong>#</strong></th>
                                            <th><strong>{{ __('ID') }}</strong></th>
                                            <th><strong>{{ __('Image') }}</strong></th>
                                            <th><strong>{{ __('Author Name') }}</strong></th>
                                            <th><strong>{{ __('Company Name') }}</strong></th>
                                            <th><strong>{{ __('Email') }}</strong></th>
                                            <th><strong>{{ __('Domain Address') }}</strong></th>
                                            <th><strong>{{ __('Account Verified') }}</strong></th>
                                            @if (Auth::user()->hasRole('admin') || Auth::user()->is_admin)
                                                <th><strong>{{ __('Action') }}</strong></th>
                                            @endif
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($users ?? [] as $user)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>#{{ $user->id }}</td>
                                                <td class="tableId">
                                                    <div class="d-flex justify-content-start align-items-center"
                                                        style="width: 80px; height: 80px">
                                                        <img src="{{ $user->user->profilePicturePath }}"
                                                            class="w-100 h-100 object-fit-cover rounded-circle">
                                                    </div>
                                                </td>
                                                <td class="tableProduct">
                                                    <div class="product-pera">
                                                        <p class="priceDis">{{ $user->user->name }}</p>
                                                    </div>
                                                </td>
                                                <td class="tableProduct">
                                                    <div class="product-pera">
                                                        <p class="priceDis">{{ $user->name }}</p>
                                                    </div>
                                                </td>
                                                <td class="tableId">{{ $user->user->email }}</td>
                                                <td class="tableId">
                                                    <span class="badge bg-primary">{{ $user->domain ?? 'N/A' }}</span>
                                                </td>
                                                <td class="tableStatus">
                                                    @if ($user->user->email_verified_at == null)
                                                        <div class="statusItem">
                                                            <div class="circleDot animatedPending"></div>
                                                            <div class="statusText">
                                                                <span class="stutsPanding">{{ __('Pending') }}</span>
                                                            </div>
                                                        </div>
                                                    @else
                                                        <div class="statusItem">
                                                            <div class="circleDot animatedCompleted"></div>
                                                            <div class="statusText">
                                                                <span class="stutsCompleted">{{ __('Verified') }}</span>
                                                            </div>
                                                        </div>
                                                    @endif
                                                </td>
                                                @if (Auth::user()->hasRole('admin') ||
                                                        Auth::user()->hasRole('organization') ||
                                                        Auth::user()->is_admin ||
                                                        Auth::user()->is_org)
                                                    <td class="tableAction">
                                                        <div class="action-icon">
                                                            @if ($user->trashed())
                                                                <a class="circleIcon" data-bs-toggle="tooltip"
                                                                    data-bs-placement="top"
                                                                    data-bs-custom-class="custom-tooltip"
                                                                    data-bs-title="{{ __('Restore User') }}"
                                                                    href="{{ route('user.restore', $user->id) }}">
                                                                    <img src="{{ asset('assets/images/icon/rotate-left.svg') }}"
                                                                        alt="icon">
                                                                </a>
                                                            @else
                                                                <a class="circleIcon" data-bs-toggle="tooltip"
                                                                    data-bs-placement="top"
                                                                    data-bs-custom-class="custom-tooltip"
                                                                    data-bs-title="{{ __('Edit User') }}"
                                                                    href="{{ route('organizations.edit', $user->user->id) }}">
                                                                    <img src="{{ asset('assets/images/icon/edit.svg') }}"
                                                                        alt="icon">
                                                                </a>
                                                            @endif
                                                        </div>
                                                    </td>
                                                @endif
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="9">
                                                    <h5 class="text-danger text-center m-0">{{ __('No User Available') }}
                                                    </h5>
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                            {{-- {{ $users->links() }} --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- ****End-Body-Section**** -->
    </div>
@endsection
