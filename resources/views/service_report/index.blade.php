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
            </tr>
        </thead>
        <tbody>
            @foreach ($service_reports as $service_report)
                <tr>
                    <td>{{ $service_report->sr_number }}</td>
                    <td>{{ $service_report->customer_name }}</td>
                    <td>{{ $service_report->address }}</td>
                    <td>{{ $service_report->contact_person }}</td>
                    <td>{{ $service_report->engineer_assigned }}</td>
                </tr>
            @endforeach
        </tbody>
    
</body>
</html>