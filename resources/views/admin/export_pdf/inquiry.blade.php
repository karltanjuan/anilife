<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Anilife &copy; {{ date('Y') }} - Feedback</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>

    <h3 class="text-center mt-5 mb-5">Barangay 899, Zone 100 &copy; {{ date('Y') }} - Feedback</h3>
    <table class="table table-bordered table-sm">
        <thead>
            <tr>
                <th>ID</th>
                <th>Full Name</th>
                <th>Email Address</th>
                <th>Contact No.</th>
                <th>Feedback Details</th>
                <th>Date Created</th>
            </tr>
        </thead>
        <tbody>
            @if (count($inquiries) > 0)
                    @foreach ($inquiries as $key => $inquiry)
                    <tr>
                        <td>{{++$key}}</td>
                        <td>{{ $inquiry->full_name }}</td>
                        <td>{{ $inquiry->email_address }}</td>
                        <td>{{ $inquiry->contact_no }}</td>
                        <td>{{ $inquiry->message }}</td>
                        <td>{{ date("M d, Y h:i A", strtotime($inquiry->created_at)) }}</td>
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