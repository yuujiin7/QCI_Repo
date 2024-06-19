<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

    <title>{{ $serviceReportId }}</title>
    @vite(['resources/css/app.css','resources/js/app.js'])
</head>

<body class="font-sans">
    <div class="container mx-auto">

        <table class="w-full border-collapse">
            <thead>
                <tr>
                    <th colspan="3" class="text-left">
                        <img class="w-1/10 h-auto" src="{{ $base64Image }}" alt="Logo">
                    </th>
                    <th colspan="6" class="text-center">
                        <h1 class="text-2xl font-bold">TSG Service Report</h1>
                    </th>
                    <th colspan="3" class="text-right">
                        <p>No. {{ $serviceReportNumber }}</p>
                    </th>
                </tr>
            </thead>
        </table>

        <div class="container">
            <table class="w-full border-collapse border border-black">
                <thead>
                    <tr>
                        <th colspan="1" class="border border-black p-1 text-xs bg-gray-200">EVENT ID</th>
                        <td colspan="5" class="border border-black p-1 text-xs">{{ $eventID }}</td>
                        <th colspan="2" class="border border-black p-1 text-xs bg-gray-200">DATE</th>
                        <td colspan="2" class="border border-black p-1 text-xs">{{ $date }}</td>
                    </tr>
                    <tr>
                        <th colspan="1" class="border border-black p-1 text-xs bg-gray-200">Customer Name</th>
                        <td colspan="9" class="border border-black p-1 text-xs">{{ $customer }}</td>
                    </tr>
                    <tr>
                        <th colspan="1" class="border border-black p-1 text-xs bg-gray-200">Address</th>
                        <td colspan="9" class="border border-black p-1 text-xs">{{ $address }}</td>
                    </tr>
                    <tr>
                        <th colspan="1" class="border border-black p-1 text-xs bg-gray-200">Contact Person</th>
                        <td colspan="5" class="border border-black p-1 text-xs">{{ $contactPerson }}</td>
                        <th colspan="2" class="border border-black p-1 text-xs bg-gray-200">Contact Number</th>
                        <td colspan="2" class="border border-black p-1 text-xs">{{ $contactNumber }}</td>
                    </tr>
                    <tr>
                        <th colspan="2" class="border border-black p-1 text-xs bg-gray-200">Date</th>
                        <th colspan="2" class="border border-black p-1 text-xs bg-gray-200">Start Time</th>
                        <th colspan="2" class="border border-black p-1 text-xs bg-gray-200">End Time</th>
                        <th colspan="2" class="border border-black p-1 text-xs bg-gray-200">Total Time</th>
                        <th colspan="2" class="border border-black p-1 text-xs bg-gray-200">Remarks</th>
                    </tr>
                    <tr>
                        <td colspan="2" class="border border-black p-1 text-xs">{{ $date }}</td>
                        <td colspan="2" class="border border-black p-1 text-xs">{{ date('h:i A', strtotime($startTime)) }}</td>
                        <td colspan="2" class="border border-black p-1 text-xs">{{ date('h:i A', strtotime($endTime)) }}</td>
                        <td colspan="2" class="border border-black p-1 text-xs">{{ $totalHours }}</td>
                        <td colspan="2" class="border border-black p-1 text-xs">{{ $remarks }}</td>
                    </tr>
                    <tr>
                        <th colspan="2" class="border border-black p-1 text-xs">
                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault1">
                            <label class="form-check-label" for="flexCheckDefault1">New Installation</label>
                        </th>
                        <th colspan="4" class="border border-black p-1 text-xs">
                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault2">
                            <label class="form-check-label" for="flexCheckDefault2">Under Maintenance Contract</label>
                        </th>
                        <th colspan="2" class="border border-black p-1 text-xs">
                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault3">
                            <label class="form-check-label" for="flexCheckDefault3">Demo/Poc</label>
                        </th>
                        <th colspan="2" class="border border-black p-1 text-xs">
                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault4">
                            <label class="form-check-label" for="flexCheckDefault4">Billable</label>
                        </th>
                    </tr>
                    <tr>
                        <th colspan="2" class="border border-black p-1 text-xs">
                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault5">
                            <label class="form-check-label" for="flexCheckDefault5">Under Warranty</label>
                        </th>
                        <th colspan="4" class="border border-black p-1 text-xs">
                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault6">
                            <label class="form-check-label" for="flexCheckDefault6">Corrective Maintenance</label>
                        </th>
                        <th colspan="2" class="border border-black p-1 text-xs">
                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault7">
                            <label class="form-check-label" for="flexCheckDefault7">Add-On Value</label>
                        </th>
                        <th colspan="2" class="border border-black p-1 text-xs">
                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault8">
                            <label class="form-check-label" for="flexCheckDefault8">Others:</label>
                        </th>
                    </tr>
                    <tr>
                        <th colspan="3" class="border border-black p-1 text-xs bg-gray-200">Machine Model</th>
                        <th colspan="3" class="border border-black p-1 text-xs bg-gray-200">Serial Number</th>
                        <th colspan="4" class="border border-black p-1 text-xs bg-gray-200">Product Number</th>
                    </tr>
                    <tr>
                        <td colspan="3" class="border border-black p-1 text-xs">{{ $machineModel }}</td>
                        <td colspan="3" class="border border-black p-1 text-xs">{{ $machineSerialNumber }}</td>
                        <td colspan="4" class="border border-black p-1 text-xs">{{ $productNumber }}</td>
                    </tr>
                    <tr>
                        <th colspan="2" class="border border-black p-1 text-xs bg-gray-200">Part Number</th>
                        <th colspan="3" class="border border-black p-1 text-xs bg-gray-200">Part Quantity</th>
                        <th colspan="3" class="border border-black p-1 text-xs bg-gray-200">Part Description</th>
                        <th colspan="2" class="border border-black p-1 text-xs bg-gray-200">Part Usage</th>
                    </tr>
                    <tr>
                        <td colspan="2" class="border border-black p-1 text-xs">{{ $partNumber }}</td>
                        <td colspan="3" class="border border-black p-1 text-xs">{{ $partQuantity }}</td>
                        <td colspan="3" class="border border-black p-1 text-xs">{{ $partDescription }}</td>
                        <td colspan="2" class="border border-black p-1 text-xs">{{ $partUsage }}</td>
                    </tr>
                    <tr>
                        <th colspan="1" class="border border-black p-1 text-xs bg-gray-200">Action Taken:</th>
                        <td colspan="9" class="border border-black p-1 text-xs">{{ $actionTaken }}</td>
                    </tr>
                    <tr>
                        <th colspan="1" class="border border-black p-1 text-xs bg-gray-200">Pending / Unresolved Items:</th>
                        <td colspan="9" class="border border-black p-1 text-xs">{{ $pending }}</td>
                    </tr>
                    <tr>
                        <th colspan="2" class="border border-black p-1 text-xs bg-gray-200">STATUS</th>
                        <th colspan="4" class="border border-black p-1 text-xs">
                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault9">
                            <label class="form-check-label" for="flexCheckDefault9">Completed</label>
                        </th>
                        <th colspan="4" class="border border-black p-1 text-xs">
                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault10">
                            <label class="form-check-label" for="flexCheckDefault10">Incomplete</label>
                        </th>
                    </tr>
                    <tr id="signature">
                        <th colspan="5" class="border border-black p-1 text-xs">
                            {{ $customer }}
                            <br>
                            <span>Customer Signature Over Printed Name</span>
                        </th>
                        <th colspan="5" class="border border-black p-1 text-xs">
                            {{ $engineerAssigned }}
                            <br>
                            <span>Technical Support Engineer/Signature</span>
                        </th>
                    </tr>
                </thead>
            </table>

            <div class="border-b-2 border-dashed border-red-500 my-5"></div>

            <table class="w-full border-collapse border border-black">
                <tr>
                    <td colspan="3" class="border border-black p-1 text-xs">{{ $engineerAssigned }}</td>
                    <td colspan="3" class="border border-black p-1 text-xs">{{ $technician }}</td>
                    <td colspan="2" class="border border-black p-1 text-xs">{{ $hrFinance }}</td>
                    <td colspan="2" class="border border-black p-1 text-xs">{{ $evpCoo }}</td>
                </tr>
                <tr>
                    <th colspan="3" class="border border-black p-1 text-xs bg-gray-200">Technical Support Engr</th>
                    <th colspan="3" class="border border-black p-1 text-xs bg-gray-200">Technical Support Head</th>
                    <th colspan="2" class="border border-black p-1 text-xs bg-gray-200">HR/Finance</th>
                    <th colspan="2" class="border border-black p-1 text-xs bg-gray-200">EVP - COO</th>
                </tr>
            </table>
        </div>

        <div class="text-xs mt-5">
            <div class="text-center">
                <p>Questech Co. Inc., 178 Yakal Street, San Antonio Village, Makati, 1203</p>
            </div>
            <div class="text-right">
                <p>No. {{ $serviceReportNumber }}</p>
            </div>
        </div>
    </div>
</body>

</html>
