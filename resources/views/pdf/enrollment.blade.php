<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Styled Table</title>
    <style>
        @page {
            body {
                font-family: Arial, sans-serif;
                margin: 0;
                padding: 10px;
            }
        }

        .table-container {
            background: #ffffff;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        thead {
            background-color: #eaf3ff;
        }

        thead th {
            font-weight: bold;
            text-align: left;
            padding: 10px;
        }

        tbody td {
            padding: 10px;
            text-align: left;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tr:hover {
            background-color: #eaf3ff;
        }

        table,
        th,
        td {
            border: 1px solid #e0e0e0;
        }

        th,
        td {
            text-align: left;
            font-size: 14px;
        }
    </style>
</head>

<body>
    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>{{ __('SL') }}</th>
                    <th>{{ __('Enroll ID') }}</th>
                    <th>{{ __('Student') }}</th>
                    <th>{{ __('Course Title') }}</th>
                    <th style="width: 15%"><strong>{{ __('Progress') }}</strong></th>
                </tr>
            </thead>
            <tbody>
                @forelse ($enrollments as $enrollment)
                    <tr>
                        <td class="tableId">{{ $loop->iteration }}</td>
                        <td class="tableId">{{ $enrollment->id }}</td>
                        <td class="tableId">{{ $enrollment->user?->name ?? 'N/A' }}</td>
                        <td class="tableId">
                            @if (strlen($enrollment->course?->title) > 30)
                                {{ substr($enrollment->course?->title, 0, 30) . '...' }}
                            @else
                                {{ $enrollment->course?->title ?? 'N/A' }}
                            @endif
                        </td>
                        <td class="tableId">
                            <div class="mb-3 progress">
                                <div class="progress-bar bg-danger progress-bar-animated progress-bar-striped"
                                    role="progressbar" aria-valuenow="{{ $enrollment->course_progress }}"
                                    aria-valuemin="0" aria-valuemax="100"
                                    style="width: {{ $enrollment->course_progress }}%;">
                                    {{ $enrollment->course_progress }}%
                                </div>
                            </div>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center">{{ __('No data found') }}</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</body>

</html>
