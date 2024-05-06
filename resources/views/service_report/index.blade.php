<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Service Report</title>
    @vite('resources/css/app.css')
</head>
<body>
    <table>
        <thead>
            <tr>
                <th>SR Number</th>
                <th>Customer Name</th>
                <th>Address</th>
                <th>Contact Person</th>
                <th>Technical Engineer Assigned</th>
                <th>SR File</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($service_report as $report)
                <tr>
                    <td>{{ $report->sr_number }}</td>
                    <td>{{ $report->customer_name }}</td>
                    <td>{{ $report->address }}</td>
                    <td>{{ $report->contact_person }}</td>
                    <td>{{ $report->engineer_assigned }}</td>
                    <!-- <td><a href="{{ url("/storage/images/{$report->sr_file}") }}" download>Download</a></td> -->
                    <td><a href="{{ asset("storage/images/{$report->image}") }}" download>Download</a></td> <!-- Updated to use $report->image -->
                </tr>
            @endforeach
        </tbody>
    
</body>
</html>