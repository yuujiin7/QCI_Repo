@include('partials.__header')
<?php
$array = array('name' => "Service Report List");


;?>



<x-nav/>

<section>
<div class="p-10 sm:ml-64">
    <x-breadcrumbs :title="$array['name']"/>
    <!-- Modal toggle -->
    <div class="flex justify-end">
        

<!-- Modal toggle -->
<button data-modal-target="crud-modal" data-modal-toggle="crud-modal" class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button">
    Create New
  </button>
  
  <!-- Main modal -->
  <div id="crud-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
      <div class="relative p-4 w-auto max-w-full max-h-full rounded">
          <!-- Modal content -->
          <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
              <!-- Modal header -->
              <section class="bg-white dark:bg-gray-900">
                <div class="py-8 px-4 mx-auto max-w-2xl lg:py-16">
                    <h2 class="mb-4 text-xl font-bold text-gray-900 dark:text-white">Add a new SR</h2>
                    <form action="#">
                            <div class="flex mb-4 ">
                                <div class="w-1/4 px-2 flex-1">
                                    <label for="sr_number" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">SR Number</label>
                                    <input type="text" name="sr_number" id="sr_number" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Type product name" required="">
                                </div>
                                <div class="w-1/4 px-2 flex-1">
                                    <label for="event_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Event ID</label>
                                    <input type="text" name="event_id" id="event_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Type product name" required="">
                                </div>
                                <div class="w-1/2 px-2 flex-1">
                                    <label for="brand" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Date</label>
                                    <div class="relative max-w-sm ">
                                        <div class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none">
                                          <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z"/>
                                          </svg>
                                        </div>
                                        <input datepicker type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Select date">
                                      </div>
                                </div>
                            </div>
                            
                            <div class="grid gap-4 sm:grid-cols-2 sm:gap-6">
                            </div>
                        

                        <div class="w-full">
                            <label for="brand" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Brand</label>
                            <input type="text" name="brand" id="brand" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Product brand" required="">
                        </div>
                        <div class="w-full">
                            <label for="price" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Price</label>
                            <input type="number" name="price" id="price" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="$2999" required="">
                        </div>
                        <div>
                            <label for="category" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Category</label>
                            <select id="category" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                <option selected="">Select category</option>
                                <option value="TV">TV/Monitors</option>
                                <option value="PC">PC</option>
                                <option value="GA">Gaming/Console</option>
                                <option value="PH">Phones</option>
                            </select>
                        </div>
                        <div>
                            <label for="item-weight" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Item Weight (kg)</label>
                            <input type="number" name="item-weight" id="item-weight" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="12" required="">
                        </div> 
                        <div class="sm:col-span-2">
                            <label for="description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Description</label>
                            <textarea id="description" rows="8" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Your description here"></textarea>
                        </div>
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="user_avatar">Upload file</label>
                        <input class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" aria-describedby="user_avatar_help" id="user_avatar" type="file">
                        <div class="mt-1 text-sm text-gray-500 dark:text-gray-300" id="user_avatar_help">Upload the softcopy of the SR</div>

                        <button type="submit" class="inline-flex items-center px-5 py-2.5 mt-4 sm:mt-6 text-sm font-medium text-center text-white bg-primary-700 rounded-lg focus:ring-4 focus:ring-primary-200 dark:focus:ring-primary-900 hover:bg-primary-800">
                            Add product
                        </button>
                    </form>
                </div>
              </section>
          </div>
      </div>
  </div> 
  
       
    </div>

        <div class="container mx-auto">
        <div class="overflow-x-auto">
        <table class="min-w-full bg-white shadow-md rounded-lg overflow-hidden display" id="SRTable">
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
                <tr class="bg-white border-b hover:bg-gray-50">
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
