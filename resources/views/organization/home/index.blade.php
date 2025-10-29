@extends($layout_path)

@section('title', $app_setting['name'] . ' | ' . __('Dashboard'))

@section('content')
    <div class="app-main-outer">
        <div class="app-main-inner">

            <div class="row card border-0 shadow-sm rounded-4 p-4 mb-4" style=" color: #000000;">
                <div class="col-12 d-flex justify-content-between align-items-center flex-wrap">

                    <!-- Left: Welcome Text -->
                    <div>
                        <h3 class="fw-bold mb-1">👋 {{ __('Welcome back') }}, {{ auth()->user()->name }}!</h3>
                        <p class="mb-0">{{ __('Here’s a quick overview of your performance this month.') }}</p>
                    </div>
                </div>
            </div>

            <div class="row g-4">
                <div class="col-md-6 col-lg-4 col-xxl-3">
                    <div class="dashboard-card bg-gradient-blue position-relative">
                        <i class="fas fa-user-graduate mb-3 card-icon"></i>
                        <h6>{{ __('Total Students') }}</h6>
                        <h2 class="fw-bold">{{ $total_students }}</h2>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 col-xxl-3">
                    <div class="dashboard-card bg-gradient-green position-relative">
                        <i class="fas fa-book mb-3 card-icon"></i>
                        <h6>{{ __('Total Courses') }}</h6>
                        <h2 class="fw-bold">{{ $total_courses }}</h2>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 col-xxl-3">
                    <div class="dashboard-card bg-gradient-orange position-relative">
                        <i class="fas fa-clipboard-list mb-3 card-icon"></i>
                        <h6>{{ __('Total Enrollments') }}</h6>
                        <h2 class="fw-bold">{{ $total_enrollments }}</h2>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 col-xxl-3">
                    <div class="dashboard-card bg-gradient-red position-relative">
                        <i class="bi bi-credit-card-2-front-fill mb-3 card-icon"></i>
                        <h6>{{ __('Total Transactions') }}</h6>
                        <h2 class="fw-bold">
                            {{ $app_setting['currency_symbol'] }}
                            {{ $total_transactions }}
                        </h2>
                    </div>
                </div>
            </div>

            <!-- Charts + Recent Activity -->
            <div class="row mt-5 g-4">
                <div class="col-md-8">
                    <div class="card shadow-sm border-0 p-3 rounded-4">
                        <h6 class="fw-bold mb-3">{{ __('Revenue Statistics') }}</h6>
                        <canvas id="revenueChart" height="460"></canvas>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card p-3 border-0 shadow-sm rounded-4">
                        <h6 class="fw-bold">{{ __('Community Overview') }}</h6>
                        <canvas id="polarChart"></canvas>
                    </div>
                </div>
            </div>

            <div class="row mt-3 g-4">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="cardTitleBox">
                                <h5 class="card-title chartTitle fw-bold">{{ __('Top') }}
                                    {{ $topStudents?->count() }}
                                    {{ __('Student') }}</h5>
                            </div>
                            @forelse ($topStudents as $student)
                                <div
                                    class="infocard mb-2 d-flex flex-wrap justify-content-between align-items-center gap-2 border rounded p-2">
                                    <div class="d-flex align-items-center gap-2">
                                        <div class="infocard-image">
                                            <img src="{{ $student?->profilePicturePath }}" alt="avatar">
                                        </div>
                                        <div class="infodescription">
                                            <div class="infocard-name">{{ $student?->name }}</div>
                                            <div class="infocard-email">{{ $student?->email }}</div>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="border rounded p-2">
                                            <p class="infocard-count m-0">{{ __('Buy Courses') }} :
                                                {{ $student?->enrollments_count }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div
                                    class="infocard mb-2 d-flex justify-content-between align-items-center gap-2 border rounded p-2">
                                    <div class="d-flex align-items-center gap-2">
                                        <div class="infocard-image">
                                            <img src="https://placehold.co/80x80" alt="avatar">
                                        </div>
                                        <div class="infodescription">
                                            <div class="infocard-name">{{ __('No Students Found') }}!</div>
                                            <div class="infocard-email">5hBzU@example.com</div>
                                        </div>
                                    </div>
                                    <div>
                                        <p class="infocard-count">{{ __('Total Courses') }} : 0</p>
                                        <div class="icons d-flex justify-content-between align-items-center">
                                            <img src="{{ asset('assets/images/icon/eye.svg') }}" alt="icon">
                                            <img src="{{ asset('assets/images/icon/edit.svg') }}" alt="icon">
                                            <img src="{{ asset('assets/images/icon/trash.svg') }}" alt="icon">
                                        </div>
                                    </div>
                                </div>
                            @endforelse
                        </div>

                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="cardTitleBox">
                                <h5 class="card-title chartTitle fw-bold">{{ __('Top') }}
                                    {{ $topInstructors?->count() }}
                                    {{ __('Faculty Member') }}</h5>
                            </div>

                            @forelse ($topInstructors as $instructor)
                                <div
                                    class="infocard mb-2 d-flex flex-wrap justify-content-between align-items-center gap-2 border rounded p-2">
                                    <div class="d-flex align-items-center gap-2">
                                        <div class="infocard-image">
                                            <img src="{{ $instructor?->user?->profilePicturePath }}" alt="avatar">
                                        </div>
                                        <div class="infodescription">
                                            <div class="infocard-name">{{ $instructor?->user?->name }}</div>
                                            <div class="infocard-icon">
                                                @php
                                                    $rating = $instructor?->rating_avg;
                                                    $rating = number_format($rating, 1);

                                                @endphp
                                                @for ($index = 0; $index < 5; $index++)
                                                    @if ($rating > $index)
                                                        <i class="bi bi-star-fill"></i>
                                                    @else
                                                        <i class="bi bi-star"></i>
                                                    @endif
                                                @endfor
                                                <span class="infocard-rating ms-1">
                                                    {{ number_format($instructor?->rating_avg, 1) }}
                                                    <span
                                                        class="infocard-rating-count">({{ $instructor?->reviews_count }})</span>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="border rounded p-2">
                                        <p class="infocard-count m-0">{{ __('Total Courses') }} :
                                            <strong>{{ $instructor?->courses_count }}</strong>
                                        </p>
                                    </div>
                                </div>
                            @empty
                                <div
                                    class="infocard mb-1 d-flex justify-content-between align-items-center border rounded p-2">
                                    <div class="d-flex align-items-center gap-2">
                                        <div class="infocard-image">
                                            <img src="https://placehold.co/80x80" alt="avatar">
                                        </div>
                                        <div class="infodescription">
                                            <div class="infocard-name">{{ __('No Instructor Found') }}!</div>
                                            <div class="infocard-icon">
                                                <i class="bi bi-star"></i>
                                                <i class="bi bi-star"></i>
                                                <i class="bi bi-star"></i>
                                                <i class="bi bi-star"></i>
                                                <i class="bi bi-star"></i>
                                                <span class="infocard-rating ms-1">
                                                    0.0
                                                    <span class="infocard-rating-count">(0)</span>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div>
                                        <p class="infocard-count">{{ __('Buy Courses') }} : 0</p>
                                        <div class="icons d-flex justify-content-between align-items-center">
                                            <img src="{{ asset('assets/images/icon/eye.svg') }}" alt="icon">
                                            <img src="{{ asset('assets/images/icon/edit.svg') }}" alt="icon">
                                            <img src="{{ asset('assets/images/icon/trash.svg') }}" alt="icon">
                                        </div>
                                    </div>
                                </div>
                            @endforelse
                        </div>

                    </div>
                </div>
            </div>

            {{-- /* Top Selling Courses */ --}}
            <div class="row mt-3 g-4">
                <div class="col-md-12">
                    <div class="card mb-3">
                        <div class="card-body">
                            <div class="cardTitleBox">
                                <h5 class="card-title chartTitle fw-bold">{{ __('Top Selling Course') }} <span>(
                                        {{ __('Latest') }}
                                        {{ $topSaleCourses->count() }} )</span></h5>
                                <a href="{{ route('course.index') }}" class="charNavigation">
                                    {{ __('View All Courses') }}
                                </a>
                            </div>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th><strong>{{ __('ID') }}</strong></th>
                                            <th><strong>{{ __('Course') }}</strong></th>
                                            <th><strong>{{ __('Category') }}</strong></th>
                                            <th><strong>{{ __('Views') }}</strong></th>
                                            <th><strong>{{ __('Sale Price') }}</strong></th>
                                            <th><strong>{{ __('Instructor') }}</strong></th>
                                            <th><strong>{{ __('Action') }}</strong></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($topSaleCourses as $course)
                                            <tr>
                                                <td class="tableId">#{{ $course->id }} <i data-feather="eye"></i>
                                                </td>
                                                <td class="tableProduct">
                                                    <div class="listproduct-section">
                                                        <div class="listproducts-image">
                                                            <img src="{{ $course->mediaPath }}">
                                                        </div>
                                                        <div class="product-pera">
                                                            <p class="priceDis">{{ $course->title }}</p>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="tableCustomar">{{ $course->category?->title }}
                                                </td>
                                                <td class="tableId">{{ $course->view_count }}</td>
                                                @php
                                                    $total = 0;
                                                    $transactions = $course->transactions->where('is_paid', 1);
                                                    foreach ($transactions as $transaction) {
                                                        $total += $transaction->payment_amount;
                                                    }
                                                @endphp
                                                <td class="tableId">
                                                    {{ currency($total) }}
                                                </td>
                                                <td class="tableId">{{ $course->instructor->user->name }}</td>
                                                <td class="tableAction">
                                                    <div class="action-icon">
                                                        <a data-bs-toggle="tooltip" data-bs-placement="top"
                                                            data-bs-custom-class="custom-tooltip"
                                                            data-bs-title="{{ __('Edit Course') }}"
                                                            href="{{ route('course.edit', $course->id) }}"
                                                            class="circleIcon">
                                                            <img src="{{ asset('assets/images/icon/edit.svg') }}"
                                                                alt="icon">
                                                        </a>
                                                        <a href="#" data-bs-toggle="tooltip"
                                                            data-bs-placement="top" data-bs-custom-class="custom-tooltip"
                                                            data-bs-title="Delete Course"
                                                            onclick="deleteAction('{{ route('course.destroy', $course->id) }}')"
                                                            class="circleIcon">
                                                            <img src="{{ asset('assets/images/icon/trash.svg') }}"
                                                                alt="icon">
                                                        </a>
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="7">
                                                    <h5 class="text-danger text-center m-0">
                                                        {{ __('No Course Available') }}
                                                    </h5>
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection

@push('styles')
    <style>
        .dashboard-card {
            border: none;
            border-radius: 20px;
            padding: 25px;
            color: #fff;
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.08);
            transition: transform 0.2s ease;
        }

        .dashboard-card:hover {
            transform: translateY(-5px);
        }

        .bg-gradient-blue {
            background: linear-gradient(135deg, #4e73df, #224abe);
        }

        .bg-gradient-green {
            background: linear-gradient(135deg, #1cc88a, #13855c);
        }

        .bg-gradient-orange {
            background: linear-gradient(135deg, #f6c23e, #dda20a);
        }

        .bg-gradient-red {
            background: linear-gradient(135deg, #e74a3b, #be2617);
        }

        .dashboard-footer {
            text-align: center;
            margin-top: 40px;
            font-size: 14px;
            color: #666;
        }

        .dashboard-footer a {
            color: #4e73df;
            text-decoration: none;
            font-weight: 600;
        }

        .card-icon {
            position: absolute;
            top: 25px;
            right: 25px;
            font-size: 40px;
            opacity: 0.4;
        }
    </style>
@endpush


@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            fetch("{{ url('/organizations/chart/revenue-data') }}")
                .then(response => response.json())
                .then(data => {
                    const ctx = document.getElementById('revenueChart');
                    new Chart(ctx, {
                        type: 'line',
                        data: {
                            labels: data.labels,
                            datasets: data.datasets
                        },
                        options: {
                            responsive: true,
                            interaction: {
                                mode: 'index',
                                intersect: false
                            },
                            stacked: true,
                            plugins: {
                                title: {
                                    display: true,
                                    text: 'Monthly Activity (Courses, Enrollments, Reviews)',
                                    font: {
                                        size: 16
                                    }
                                }
                            },
                            scales: {
                                x: {
                                    stacked: true
                                },
                                y: {
                                    stacked: true,
                                    beginAtZero: true
                                }
                            }
                        }
                    });
                });
        });
    </script>

    <script>
        const ctxPolar = document.getElementById('polarChart');
        new Chart(ctxPolar, {
            type: 'polarArea',
            data: {
                labels: ['Instructors', 'Transactions', 'Student Reviews', 'Client Feedback'],
                datasets: [{
                    label: 'User Types',
                    data: [{{ $total_instructors }}, {{ $total_transactions_count }},
                        {{ $total_course_review }}, {{ $total_client_feedback }}
                    ],
                    backgroundColor: [
                        'rgba(78, 115, 223, 0.7)', // Blue
                        'rgba(28, 200, 138, 0.7)', // Green
                        'rgba(246, 194, 62, 0.7)', // Yellow
                        'rgba(231, 74, 59, 0.7)' // Red
                    ],
                    borderColor: '#fff',
                    borderWidth: 3,
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            font: {
                                size: 12
                            },
                        },
                    },
                    title: {
                        display: true,
                    }
                },
                scales: {
                    r: {
                        ticks: {
                            beginAtZero: true
                        }
                    }
                }
            }
        });
    </script>
@endpush
