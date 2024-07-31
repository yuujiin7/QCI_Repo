<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

    <title>{{ $serviceReportId }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .logo {
            width: 80px; /* Adjust width as needed */
            height: auto;
        }

        .title {
            font-family: Arial, Helvetica, sans-serif;
            color: #000000;
            font-size: 20px;
            text-align: center;
            margin: 0;
        }

        .service-number {
            text-align: right;
            margin: 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th,
        td {
            border: 2px solid #000;
            padding: 5px;
            text-align: center;
            font-size: small;
        }

        th {
            background-color: #f2f2f2;
        }

        .footer {
            font-size: 11px;
            margin-top: 20px;
        }

        .footer .container {
            text-align: center;
        }

        .footer .text-right {
            text-align: right;
        }

        .header-table {
            border-style: hidden;
            margin-bottom: 20px;
        }

        .header-table td {
            border-style: hidden;
            background-color: white;
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="container">
       

        <table class="header-table">
            <thead>
                <tr>
                    <td colspan="10">
                        <img class="logo" src="{{ $base64Image }}" alt="Logo">
                    </td>
                    <td colspan="8">
                        <h1 class="title">TSG Service Report</h1>
                    </td>
                    <td colspan="2">
                        <p class="service-number">No. {{ $serviceReportNumber }}</p>
                    </td>
                </tr>
            </thead>
        </table>

        <table>
            <thead>
                <tr>
                    <th colspan="1">EVENT ID</th>
                    <td colspan="5">{{ $eventID }}</td>
                    <th colspan="2">DATE</th>
                    <td colspan="2">{{ $date }}</td>
                </tr>
                <tr>
                    <th colspan="1">Customer Name</th>
                    <td colspan="9">{{ $customer }}</td>
                </tr>
                <tr>
                    <th colspan="1">Address</th>
                    <td colspan="9">{{ $address }}</td>
                </tr>
                <tr>
                    <th colspan="1">Contact Person</th>
                    <td colspan="5">{{ $contactPerson }}</td>
                    <th colspan="2">Contact Number</th>
                    <td colspan="2">{{ $contactNumber }}</td>
                </tr>
                <tr>
                    <th colspan="2">Date</th>
                    <th colspan="2">Start Time</th>
                    <th colspan="2">End Time</th>
                    <th colspan="2">Total Time</th>
                    <th colspan="2">Remarks</th>
                </tr>
                <tr>
                    <td colspan="2">{{ $date }}</td>
                    <td colspan="2">{{ date('h:i A', strtotime($startTime)) }}</td>
                    <td colspan="2">{{ date('h:i A', strtotime($endTime)) }}</td>
                    <td colspan="2">{{ $totalHours }}</td>
                    <td colspan="2">{{ $remarks }}</td>
                </tr>
                <tr>
                    <th colspan="2">
                        <input class="form-check-input" type="checkbox" value="1" id="new_installation" {{ $new_installation ? 'checked' : '' }}>
                        <label class="form-check-label" for="new_installation">New Installation</label>
                    </th>
                    <th colspan="4">
                        <input class="form-check-input" type="checkbox" value="1" id="under_maintenance" {{ $under_maintenance ? 'checked' : '' }}>
                        <label class="form-check-label" for="under_maintenance">Under Maintenance Contract</label>
                    </th>
                    <th colspan="2">
                        <input class="form-check-input" type="checkbox" value="1" id="demo_poc" {{ $demo_poc ? 'checked' : '' }}>
                        <label class="form-check-label" for="demo_poc">Demo/Poc</label>
                    </th>
                    <th colspan="2">
                        <input class="form-check-input" type="checkbox" value="1" id="billable" {{ $billable ? 'checked' : '' }}>
                        <label class="form-check-label" for="billable">Billable</label>
                    </th>
                </tr>
                <tr>
                    <th colspan="2">
                        <input class="form-check-input" type="checkbox" value="1" id="under_warranty" {{ $under_warranty ? 'checked' : '' }}>
                        <label class="form-check-label" for="under_warranty">Under Warranty</label>
                    </th>
                    <th colspan="4">
                        <input class="form-check-input" type="checkbox" value="1" id="corrective_maintenance" {{ $corrective_maintenance ? 'checked' : '' }}>
                        <label class="form-check-label" for="corrective_maintenance">Corrective Maintenance</label>
                    </th>
                    <th colspan="2">
                        <input class="form-check-input" type="checkbox" value="1" id="add_on" {{ $add_on ? 'checked' : '' }}>
                        <label class="form-check-label" for="add_on">Add-On Value</label>
                    </th>
                    <th colspan="2">
                        <input class="form-check-input" type="text" value="{{$others}}">
                        <label class="form-check-label" for="others">Others</label>
                    </th>
                </tr>
                <tr>
                    <th colspan="3">Machine Model</th>
                    <th colspan="3">Serial Number</th>
                    <th colspan="4">Product Number</th>
                </tr>
                <tr>
                    <td colspan="3">{{ $machineModel }}</td>
                    <td colspan="3">{{ $machineSerialNumber }}</td>
                    <td colspan="4">{{ $productNumber }}</td>
                </tr>
                <tr>
                    <th colspan="2">Part Number</th>
                    <th colspan="3">Part Quantity</th>
                    <th colspan="3">Part Description</th>
                    <th colspan="2">Part Usage</th>
                </tr>
                <tr>
                    <td colspan="2">{{ $partNumber }}</td>
                    <td colspan="3">{{ $partQuantity }}</td>
                    <td colspan="3">{{ $partDescription }}</td>
                    <td colspan="2">{{ $partUsage }}</td>
                </tr>
                <tr>
                    <th colspan="1">Action Taken:</th>
                    <td colspan="9">{{ $actionTaken }}</td>
                </tr>
                <tr>
                    <th colspan="1">Pending / Unresolved Items:</th>
                    <td colspan="9">{{ $pending }}</td>
                </tr>
                <tr>
                    <th colspan="2">STATUS</th>
                    <th colspan="4">
                        <input class="form-check-input" type="checkbox" value="1" id="completed" {{ $is_complete ? 'checked' : '' }}>
                        <label class="form-check-label" for="completed">Completed</label>
                    </th>
                    <th colspan="4">
                        <input class="form-check-input" type="checkbox" value="0" id="incomplete" {{ !$is_complete ? 'checked' : '' }}>
                        <label class="form-check-label" for="incomplete">Incomplete</label>
                    </th>
                </tr>
                <tr id="signature">
                    <th colspan="5">
                        {{ $customer }}
                        <br>
                        <span>Customer Signature Over Printed Name</span>
                    </th>
                    <th colspan="5">
                        {{ $engineerAssigned }}
                        <br>
                        <span>Technical Support Engineer/Signature</span>
                    </th>
                </tr>
            </thead>
        </table>

        <div style="border-bottom: 2px dashed red; margin-bottom: 20px; margin-top: 20px;"></div>

        <table id="secondTable">
            <tr>
                <td colspan="3">{{ $engineerAssigned }}</td>
                <td colspan="3">{{ $technician }}</td>
                <td colspan="2">{{ $hrFinance }}</td>
                <td colspan="2">{{ $evpCoo }}</td>
            </tr>
            <tr>
                <th colspan="3">Technical Support Engr</th>
                <th colspan="3">Technical Support Head</th>
                <th colspan="2">HR/Finance</th>
                <th colspan="2">EVP - COO</th>
            </tr>
        </table>
    </div>

    <div class="footer">
        <div class="container">
            <p class="text-center">Questech Co. Inc., 178 Yakal Street, San Antonio Village, Makati, 1203</p>
        </div>
        <div class="col-md-6 text-right">
            <p>No. {{ $serviceReportNumber }}</p>
        </div>
    </div>
</body>

</html>
