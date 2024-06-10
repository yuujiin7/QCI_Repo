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
                            {{-- <th scope="col" class="p-4">
                        <div class="flex items-center">
                            <input id="checkbox-all-search" type="checkbox"
                                   class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                            <label for="checkbox-all-search" class="sr-only">checkbox</label>
                        </div>
                    </th> --}}
                            {{-- <th scope="col" class="py-3 px-6"></th> --}}
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
                        <tr class="bg-white border-b hover:bg-gray-50 dark:hover:bg-gray-600">
                            {{-- <td class="w-4 p-4">
                        <div class="flex items-center">
                            <input type="checkbox"
                                   class="checkbox-table-search w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                            <label for="checkbox-table-search-1" class="sr-only" >checkbox</label>
                        </div>
                    </td> --}}
                            <td class="py-3 px-6">{{ $sr->sr_number }}</td>
                            <td class="py-3 px-6">{{ $sr->customer_name }}</td>
                            <td class="py-3 px-6">{{ $sr->address }}</td>
                            <td class="py-3 px-6">{{ $sr->engineer_assigned }}</td>
                            <td class="py-3 px-6">{{ date('h:i A', strtotime($sr->start_time)) }}</td>
                            <td class="py-3 px-6">{{ date('h:i A', strtotime($sr->end_time)) }}</td>
                            {{-- <td class="py-3 px-6">{{ $sr->start_time }}</td>
                            <td class="py-3 px-6">{{ $sr->end_time }}</td> --}}
                            <td class="py-3 px-6">{{ $sr->total_hours }}</td>
                            <td class="py-3 px-6">{{ $sr->status }}</td>
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
                                    <a href="/service-report/{{ $sr->id }}" class="bg-blue-600 text-white px-4 py-1 rounded hover:bg-blue-700">Edit</a>
                                    <form action="/service-report/{{ $sr->id }}" method="POST" class="inline" id="deleteForm">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" id="submitDelete" class="bg-red-600 text-white px-4 py-1 rounded hover:bg-red-700">Delete</button>
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