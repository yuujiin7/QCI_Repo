@include('partials.__header')
<?php
$array = array('title' => "Questech");
;?>

<x-nav/>

<section>
<div class="p-10 sm:ml-64">
        <div class="breadcrumbs my-4">
            <a href="/">Home</a> <!-- Link to home page -->
            <span class="mx-2">&rsaquo;</span> <!-- Breadcrumb separator -->
            <span>Service Reports</span> <!-- Current page -->
        </div>

        <div class="container mx-auto">

        <div class="overflow-x-auto">

        <table class="min-w-full bg-white shadow-md rounded-lg overflow-hidden display" id="SRTable">
                <thead class="bg-gray-800 text-white text-xs uppercase">
                <tr>
                    <th scope="col" class="py-3 px-6"></th>
                    <th scope="col" class="py-3 px-6">SR Number</th>
                    <th scope="col" class="py-3 px-6">Customer Name</th>
                    <th scope="col" class="py-3 px-6">Address</th>
                    <th scope="col" class="py-3 px-6">Engineer Assigned</th>
                    <th scope="col" class="py-3 px-6">Start Time</th>
                    <th scope="col" class="py-3 px-6">End Time</th>
                    <th scope="col" class="py-3 px-6">Total Time</th>
                    <th scope="col" class="py-3 px-6">Status</th>
                    <th scope="col" class="py-3 px-6">Machine Model</th>
                    <th scope="col" class="py-3 px-6">Machine Serial</th>
                    <th scope="col" class="py-3 px-6">Product Number</th>
                    <th scope="col" class="py-3 px-6">Part Number</th>
                    <th scope="col" class="py-3 px-6">Part Qty.</th>
                    <th scope="col" class="py-3 px-6">Part Desc.</th>
                    <th scope="col" class="py-3 px-6">Part Usage</th>
                    <th scope="col" class="py-3 px-6">Action Taken</th>
                    <th scope="col" class="py-3 px-6">Pending</th>                    

                    <th scope="col" class="py-3 px-6">Remarks</th>
                    <th scope="col" class="py-3 px-6 text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($service_report as $sr)
                <tr class="bg-white border-b hover:bg-gray-50">
                    @php 
                        $default_profile = "https://api.dicebear.com/8.x/initials/svg?seed=".$sr->sr_number."%20".$sr->customer_name;
                    @endphp
                    <td class="pl-2">
                        <img src="{{ $sr->profile_image ? asset('storage/profile_images/thumbnail/' . $sr->profile_image) : $default_profile }}" alt="{{ $sr->first_name }} {{ $sr->last_name }}" class="w-8 h-8 rounded-full" />
                    </td>
                    <td class="py-3 px-6">{{ $sr->sr_number }}</td>
                    <td class="py-3 px-6">{{ $sr->customer_name }}</td>
                    <td class="py-3 px-6">{{ $sr->address }}</td>
                    <td class="py-3 px-6">{{ $sr->engineer_assigned }}</td>
                    <td class="py-3 px-6">{{ $sr->remarks }}</td>
                    <td class="py-3 px-6 text-center">
                        <div class="flex justify-center space-x-2">
                            <a href="/service-report/{{ $sr->id }}" class="bg-blue-600 text-white px-4 py-1 rounded hover:bg-blue-700">View</a>
                            <form action="/service-report/{{ $sr->id }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-600 text-white px-4 py-1 rounded hover:bg-red-700">Delete</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        </div>

        </div>
              
</div>


</section>

@include('partials.__footer')
