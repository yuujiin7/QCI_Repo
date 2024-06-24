@include('partials.__header')
<?php
$array = array('name' => "Service Report List");; ?>

<x-nav />

<section>
    <div class="p-10 sm:ml-64">
    <main class="bg-white max-w-full mx-auto p-8 my-10 rounded-lg shadow-2xl dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white">
        <!-- <x-breadcrumbs :title="$array['name']"/> -->
        <div class="container mx-auto">
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white shadow-md rounded-lg overflow-hidden display dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white" id="SRTable">
                    <thead class="bg-gray-800 text-white text-xs uppercase">
                        <tr>
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
                        <tr class="bg-white border-b text-black hover:bg-gray-50 dark:hover:bg-gray-600">
                           
                            <td class="py-3 px-6">{{ $sr->sr_number }}</td>
                            <td class="py-3 px-6">{{ $sr->customer_name }}</td>
                            <td class="py-3 px-6">{{ $sr->address }}</td>
                            <td class="py-3 px-6">{{ $sr->engineer_assigned }}</td>
                            <td class="py-3 px-6">{{ date('h:i A', strtotime($sr->start_time)) }}</td>
                            <td class="py-3 px-6">{{ date('h:i A', strtotime($sr->end_time)) }}</td>
                            <td class="py-3 px-6">{{ $sr->total_hours }}</td>
                            <td class="py-3 px-6">{{ $sr->isCompleted }}</td>
                            <td class="py-3 px-6">{{ $sr->machine_model }}</td>
                            <td class="py-3 px-6">{{ $sr->machine_serial }}</td>
                            <td class="py-3 px-6">{{ $sr->product_number }}</td>
                            <td class="py-3 px-6">{{ $sr->part_number }}</td>
                            <td class="py-3 px-6">{{ $sr->part_qty }}</td>
                            <td class="py-3 px-6">{{ $sr->part_desc }}</td>
                            <td class="py-3 px-6">{{ $sr->part_usage }}</td>
                            <td class="py-3 px-6">{{ $sr->action_taken }}</td>
                            <td class="py-3 px-6">{{ $sr->pending }}</td>
                            <td class="py-3 px-6">{{ $sr->remarks }}</td>
                            <td class="py-3 px-6 text-center">
                                <div class="flex justify-center space-x-2">
                                    <a href="/generate-pdf/{{ $sr->id }}" class="bg-blue-600 text-white px-4 py-1 rounded hover:bg-blue-700" target="_blank">
                                        
                                        <svg class="w-6 h-6 text-white-800 dark:text-gray" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                        <path stroke="currentColor" stroke-width="2" d="M21 12c0 1.2-4.03 6-9 6s-9-4.8-9-6c0-1.2 4.03-6 9-6s9 4.8 9 6Z"/>
                                        <path stroke="currentColor" stroke-width="2" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/>
                                        </svg>


                                    </a>
                                    <a href="/service-report/{{ $sr->id }}" class="bg-blue-600 text-white px-4 py-1 rounded hover:bg-blue-700" ><svg class="w-6 h-6 text-white-800 dark:text-gray" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m14.304 4.844 2.852 2.852M7 7H4a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-4.5m2.409-9.91a2.017 2.017 0 0 1 0 2.853l-6.844 6.844L8 14l.713-3.565 6.844-6.844a2.015 2.015 0 0 1 2.852 0Z"/>
                                        </svg>
                                    </a>
                                    <form action="/service-report/{{ $sr->id }}" method="POST" class="inline" id="deleteForm">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" id="submitDelete" class="bg-red-600 text-white px-4 py-1 rounded hover:bg-red-700"> <svg class="w-6 h-6 text-white-800 dark:text-gray" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 7h14m-9 3v8m4-8v8M10 3h4a1 1 0 0 1 1 1v3H9V4a1 1 0 0 1 1-1ZM6 7h12v13a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V7Z"/>
                                        </svg></button>
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