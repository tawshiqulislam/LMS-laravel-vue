@extends($layout_path)

@section('title', $app_setting['name'] . ' | ' . __('Subscriber List'))

@section('content')
    <!-- ****Body-Section***** -->
    <div class="app-main-outer">
        <div class="app-main-inner">
            <div class="page-title-actions px-3 d-flex">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }}</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{ __('DNS Subscriber Details') }}</li>
                    </ol>
                </nav>
            </div>
            <div class="row" id="deleteTableItem">
                <div class="col-md-12">
                    <div class="card mb-5">
                        <div class="card-body">
                            <button class="float-start btn btn-outline-primary px-4 py-2 mb-3" type="submit"
                                onclick="printTable()"><i class="bi bi-printer-fill"></i> {{ __('Print') }}</button>
                            <div class=" d-flex justify-content-end mb-3 align-items-center">
                                <form action="{{ route('organizations.subscribers') }}" method="GET" class="w-25 me-2">
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
                                    <a href="{{ route('organizations.subscribers') }}" class="px-3">
                                        <i class="bi bi-arrow-counterclockwise"></i> {{ __('Reset') }}
                                    </a>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th><strong>#</strong></th>
                                            <th><strong>{{ __('Transaction ID') }}</strong></th>
                                            <th><strong>{{ __('Organization Name') }}</strong></th>
                                            <th><strong>{{ __('Plan Name') }}</strong></th>
                                            <th><strong>{{ __('Plan Type') }}</strong></th>
                                            <th><strong>{{ __('Plan Duration') }}</strong></th>
                                            <th><strong>{{ __('Starts At') }}</strong></th>
                                            <th><strong>{{ __('Expires At') }}</strong></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($subscribers as $subscriber)
                                            <tr>
                                                <td>{{ 'ORG-SP-' . str_pad($subscriber->id, 5, '0', STR_PAD_LEFT) }}</td>
                                                <td>{{ $subscriber->transaction_id }}</td>
                                                <td>{{ $subscriber->organization?->name }}</td>
                                                <td>{{ $subscriber->plan->title }}</td>
                                                <td>
                                                    <span class="badge bg-warning">
                                                        {{ $subscriber->plan->plan_type }}
                                                    </span>
                                                </td>
                                                <td>
                                                    {{ $subscriber->plan->plan_type == 'yearly' ? $subscriber->plan->duration . ' ' . 'Yearly' : $subscriber->plan->duration . ' ' . 'Days' }}
                                                </td>
                                                <td>
                                                    <span class="badge bg-info fw-bold fs-6">
                                                        {{ \Carbon\Carbon::parse($subscriber->subscribed_at)->format('d M,Y h:i A') }}
                                                    </span>
                                                </td>
                                                <td>
                                                    <span
                                                        class="badge bg-{{ $subscriber->expires_at < now() ? 'danger' : 'success' }} fw-bold fs-6">
                                                        {{ \Carbon\Carbon::parse($subscriber->expires_at)->format('d M,Y h:i A') }}
                                                    </span>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="9" class="text-center text-danger">
                                                    {{ __('No data found') }}</td>
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

        <!-- ****End-Body-Section**** -->
    </div>
@endsection

@push('styles')
    <style>
        .table-like {
            display: grid;
            grid-template-columns: 1fr 1fr 1fr;
            /* Adjust column widths */
            gap: 0;
            width: 100%;
            border: 1px solid #dee2e6;
            border-radius: 0.25rem;
        }

        .table-like-header,
        .table-like-row {
            display: contents;
            /* Allows child divs to follow grid layout */
        }

        .table-like-header>div {
            background-color: #e9ecef;
            font-weight: bold;
            padding: 0.75rem;
            border-bottom: 1px solid #dee2e6;
            border-right: 1px solid #dee2e6;
        }

        .table-like-row>div {
            padding: 0.75rem;
            border-bottom: 1px solid #dee2e6;
            border-right: 1px solid #dee2e6;
        }

        .table-like-row:nth-child(odd)>div {
            background-color: #f8f9fa;
            /* Mimics table-striped */
        }

        .table-like-row:nth-child(even)>div {
            background-color: #ffffff;
        }

        .table-like-row>div:last-child,
        .table-like-header>div:last-child {
            border-right: none;
            /* Remove right border on last column */
        }

        .table-like-container {
            overflow-x: auto;
            /* Responsive scrolling */
        }
    </style>
@endpush

@push('scripts')
    <script>
        function printTable() {
            const table = document.querySelector('#deleteTableItem .table-responsive');
            const printWindow = window.open('', '', 'width=800,height=600');
            printWindow.document.write(`
        <html>
            <head>
                <title>Print Table</title>
                <style>
                    /* Custom styles for the printed table */
                    body {
                        font-family: Arial, sans-serif;
                        margin: 20px;
                    }
                    table {
                        width: 100%;
                        border-collapse: collapse;
                    }
                    table, th, td {
                        border: 1px solid black;
                    }
                    th, td {
                        padding: 10px;
                        text-align: left;
                    }
                    th {
                        background-color: #f4f4f4;
                    }
                </style>
            </head>
            <body>
                ${table.outerHTML}
            </body>
        </html>
    `);
            printWindow.document.close();
            printWindow.print();
            printWindow.onafterprint = function() {
                printWindow.close();
            };
        }
    </script>
@endpush
