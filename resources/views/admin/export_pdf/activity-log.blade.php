<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>{{ env('APP_NAME') }} &copy; {{ date('Y') }} - Activity Logs</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>

    <h3 class="text-center mt-5 mb-5">{{ env('APP_NAME') }} &copy; {{ date('Y') }} - Activity Logs</h3>
    <table class="table table-bordered table-sm">
        <thead>
            <tr>
                <th>ID</th>
                <th>Module</th>
                <th>Log Type</th>
                <th>IP Address</th>
                <th>Logged By</th>
                <th>Date Created</th>
            </tr>
        </thead>
        <tbody>
            @if (count($activity_logs) > 0)
                    @foreach ($activity_logs as $key => $logs)
                    <tr>
                        <td>{{++$key}}</td>
                        <td>{{ $logs->module }}</td>
                        <td>{{ $logs->log_type }}</td>
                        <td>{{ $logs->ip_address }}</td>
                        <td>{{ $logs->first_name }} {{ $logs->middle_name }} {{ $logs->last_name }}</td>
                        <td>{{ date("M d, Y h:i A", strtotime($logs->created_at)) }}</td>
                    </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="7" class="text-center">No records found.</td>
                    </tr>
                @endif
        </tbody>
    </table>
    
</body>
</html>