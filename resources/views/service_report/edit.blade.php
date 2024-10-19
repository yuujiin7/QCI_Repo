@include('partials.__header', [$title])
<?php
$array = array('title' => "Questech");
?>
<x-nav :data="$array" />
<header class="max-w-lg mx-auto">
</header>
<div class="p-10 sm:ml-64 ">
    <main class="bg-white max-w-3xl mx-auto p-8 my-10 rounded-lg shadow-2xl ">
        <section class="mt-10">
            {{-- @if ($errors->any())
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li class="text-red-500 text-xs mt-2 italic p-1">{{ $error }}</li>
            @endforeach
            </ul>
</div>
@endif --}}
<form action="/service-report/{{ $service_report->id }}" method="POST" enctype="multipart/form-data">
    @method('PUT')
    @csrf
    <div class="flex mb-4">
        <div class="px-2 flex-1">
            <label for="sr_number" class="block mb-2 text-sm font-medium text-gray-900 ">SR Number</label>
            <input type="text" name="sr_number" id="sr_number" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 " placeholder="SR Number" required="" value={{$service_report->sr_number}}>
            @error('sr_number')
            <p class="text-red-500 text-xs mt-2 italic p-1">{{ $message }}</p>
            @enderror
        </div>
        <div class="px-2 flex-1">
            <label for="event_id" class="block mb-2 text-sm font-medium text-gray-900 ">Event ID</label>
            <input type="text" name="event_id" id="event_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 " placeholder="Event ID" value="{{$service_report->event_id}}">
            @error('event_id')
            <p class="text-red-500 text-xs mt-2 italic p-1">{{ $message }}</p>
            @enderror
        </div>
        <div class="px-2 flex-1">
            <label for="date" class="block mb-2 text-sm font-medium text-gray-900 ">Date</label>
            <div class="relative max-w-sm ">
                <div class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none">
                    <svg class="w-4 h-4 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
                    </svg>
                </div>
                <input datepicker type="text" name="date" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5 " placeholder="Select date" value="{{$service_report->date}}">
            </div>
            @error('date')
            <p class="text-red-500 text-xs mt-2 italic p-1">{{ $message }}</p>
            @enderror
        </div>
    </div>
    <div class="grid gap-4 sm:grid-cols-2 sm:gap-6"></div>
    <div class="px-2 flex-1 mb-4">
        <label for="customer_name" class="block mb-2 text-sm font-medium text-gray-900 ">Customer Name</label>
        <input type="text" name="customer_name" id="customer_name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 " placeholder="Customer Name" required="" value="{{$service_report->customer_name}}">
        @error('customer_name')
        <p class="text-red-500 text-xs mt-2 italic p-1">{{ $message }}</p>
        @enderror
    </div>
    <div class="px-2 flex-1 mb-4">
        <label for="address" class="block mb-2 text-sm font-medium text-gray-900 ">Address</label>
        <input type="text" name="address" id="address" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 " placeholder="Address" required="" value="{{$service_report->address}}">
        @error('address')
        <p class="text-red-500 text-xs mt-2 italic p-1">{{ $message }}</p>
        @enderror
    </div>
    <div class="flex mb-4">
        <div class="px-2 flex-1">
            <label for="contact_person" class="block mb-2 text-sm font-medium text-gray-900 ">Contact Person</label>
            <input type="text" name="contact_person" id="contact_person" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 " placeholder="Contact Person" required="" value="{{$service_report->contact_person}}">
            @error('contact_person')
            <p class="text-red-500 text-xs mt-2 italic p-1">{{ $message }}</p>
            @enderror
        </div>
        <div class="px-2 flex-1">
            <label for="contact_number" class="block mb-2 text-sm font-medium text-gray-900 ">Contact Number</label>
            <input type="tel" name="contact_number" id="contact_number" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 " placeholder="09123456789" value="{{$service_report->contact_number}}">
            @error('contact_number')
            <p class="text-red-500 text-xs mt-2 italic p-1">{{ $message }}</p>
            @enderror
        </div>
    </div>
    <div class="flex flex-wrap mb-4">

        <div class="px-2 w-1/4">
            <label for="start_time" class="block mb-2 text-sm font-medium text-gray-900 ">Start time:</label>
            <div class="relative">
                <input type="time" id="start_time" name="start_time" class="bg-gray-50 border leading-none border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 " min="05:00" max="18:00" required value="{{ date('H:i', strtotime($service_report->start_time)) }}" />
            </div>
            @error('start_time')
            <p class="text-red-500 text-xs mt-2 italic p-1">{{ $message }}</p>
            @enderror
        </div>
        <div class="px-2 w-1/4">
            <label for="end_time" class="block mb-2 text-sm font-medium text-gray-900 ">End time:</label>
            <div class="relative">
                <input type="time" id="end_time" name="end_time" class="bg-gray-50 border leading-none border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 " min="07:00" max="18:00" value="{{ date('H:i', strtotime($service_report->end_time)) }}" required />
            </div>
            @error('end_time')
            <p class="text-red-500 text-xs mt-2 italic p-1">{{ $message }}</p>
            @enderror
        </div>


        <div class="px-2 flex-1">
            <label for="total_hours" class="block mb-2 text-sm font-medium text-gray-900 ">Total Hours:</label>
            <input type="text" name="total_hours" id="total_hours" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 " placeholder="0.00" value="{{$service_report->total_hours}}" disabled>
            @error('total_hours')
            <p class="text-red-500 text-xs mt-2 italic p-1">{{ $message }}</p>
            @enderror
        </div>
        <div class="px-2 flex-1">
            <label for="remarks" class="block mb-2 text-sm font-medium text-gray-900  xl:py-0 lg:py-0 md:py-0 sm:py-2.5">Remarks</label>
            <input type="text" name="remarks" id="remarks" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 " placeholder="Remarks" value="{{$service_report->remarks}}">
            @error('remarks')
            <p class="text-red-500 text-xs mt-2 italic p-1">{{ $message }}</p>
            @enderror
        </div>
    </div>
    <div class="flex flex-wrap mb-4 px-2">
        <ul class="items-center w-full text-sm font-medium text-gray-900 bg-white border border-gray-200 border-b-0 rounded-lg sm:flex">
            <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r ">
                <div class="flex items-center ps-3">
                    {{-- <input id="new_installation" type="checkbox" name="new_installation" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 " value="{{$service_report->new_installation}}"> --}}
                    <input type="checkbox" name="new_installation" id="new_installation" class="form-checkbox" value="1" {{ old('new_installation', $service_report->new_installation) ? 'checked' : '' }}>
                    <span class="ml-2">New Installation</span>
                    {{-- <label for="new_installation" class="w-full py-3 ms-2 text-sm font-medium text-gray-900 ">New Installation</label> --}}


                </div>
            </li>
            <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r ">
                <div class="flex items-center ps-3">
                    <input id="under_maintenance" type="checkbox" name="under_maintenance" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 " value="1" {{ old('under_maintenance', $service_report->under_maintenance) ? 'checked' : '' }}>
                    <span class="ml-2">Under Maintenance Contract</span>
                    {{-- <label for="under_maintenance" class="w-full py-3 ms-2 text-sm font-medium text-gray-900 ">Under Maintenance Contract</label> --}}
                </div>
            </li>
            <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r ">
                <div class="flex items-center ps-3">
                    <input id="demo_poc" type="checkbox" name="demo_poc" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 " value="1" {{ old('demo_poc', $service_report->demo_poc) ? 'checked' : '' }}>
                    <span class="ml-2">Demo/Poc</span>

                    {{-- <label for="demo_poc" class="w-full py-3 ms-2 text-sm font-medium text-gray-900 ">Demo/Poc</label> --}}
                </div>
            </li>
            <li class="w-full ">
                <div class="flex items-center ps-3">
                    <input id="billable" type="checkbox" name="billable" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 " value="1" {{ old('billable', $service_report->billable) ? 'checked' : '' }}>
                    {{-- <label for="billable" class="w-full py-3 ms-2 text-sm font-medium text-gray-900 ">Billable</label> --}}
                </div>
            </li>
        </ul>
        <ul class="items-center w-full text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg sm:flex ">
            <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r ">
                <div class="flex items-center ps-3">
                    <input id="under_warranty" type="checkbox" name="under_warranty" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 " value="1" {{ old('under_warranty', $service_report->under_warranty) ? 'checked' : '' }}>
                    {{-- <label for="under_warranty" class="w-full py-3 ms-2 text-sm font-medium text-gray-900 ">Under Warranty</label> --}}
                </div>
            </li>
            <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r ">
                <div class="flex items-center ps-3">
                    <input id="corrective_maintenance" type="checkbox" name="corrective_maintenance" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 " value="1" {{ old('corrective_maintenance', $service_report->corrective_maintenance) ? 'checked' : '' }}>
                    <span class="ml-2">Corrective Maintenance</span>
                    {{-- <label for="corrective_maintenance" class="w-full py-3 ms-2 text-sm font-medium text-gray-900 ">Corrective Maintenance</label> --}}

                </div>
            </li>
            <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r ">
                <div class="flex items-center ps-3">
                    <input id="add_on" type="checkbox" name="add_on" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 " value="1" {{ old('add_on', $service_report->add_on) ? 'checked' : '' }}>

                    <span class="ml-2">Add-On Value</span>

                    {{-- <label for="add_on" class="w-full py-3 ms-2 text-sm font-medium text-gray-900 ">Add-On Value</label> --}}
                </div>
            </li>
            <li class="w-full ">
                <div class="px-2 flex-1">
                    <input type="text" name="others" id="others" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 " placeholder="Others" value="{{$service_report->others}}">
                    @error('remarks1')
                    <p class="text-red-500 text-xs mt-2 italic p-1">{{ $message }}</p>
                    @enderror
                </div>
            </li>
        </ul>
    </div>
    <div class="flex flex-wrap mb-4">
        <div class="px-2 flex-1">
            <label for="machine_model" class="block mb-2 text-sm font-medium text-gray-900  ">Machine Model</label>
            <input type="text" name="machine_model" id="machine_model" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 " placeholder="Machine Model" value="{{$service_report->machine_model}}">
            @error('machine_model')
            <p class="text-red-500 text-xs mt-2 italic p-1">{{ $message }}</p>
            @enderror
        </div>
        <div class="px-2 flex-1">
            <label for="machine_serial_number" class="block mb-2 text-sm font-medium text-gray-900 ">Serial Number</label>
            <input type="text" name="machine_serial_number" id="machine_serial_number" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 " placeholder="Type product name" value="{{$service_report->machine_serial_number}}">
            @error('machine_serial_number')
            <p class="text-red-500 text-xs mt-2 italic p-1">{{ $message }}</p>
            @enderror
        </div>
        <div class="px-2 flex-1">
            <label for="product_number" class="block mb-2 text-sm font-medium text-gray-900 ">Product Number</label>
            <input type="text" name="product_number" id="product_number" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 " placeholder="Type product name" value="{{$service_report->product_number}}">
            @error('product_number')
            <p class="text-red-500 text-xs mt-2 italic p-1">{{ $message }}</p>
            @enderror
        </div>
    </div>
    <div class="flex mb-4">
        <div class="px-2 flex-1">
            <label for="part_number" class="block mb-2 text-sm font-medium text-gray-900 ">Part Number</label>
            <input type="text" name="part_number" id="part_number" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 " placeholder="Type product name" value="{{$service_report->part_number}}">
            @error('part_number')
            <p class="text-red-500 text-xs mt-2 italic p-1">{{ $message }}</p>
            @enderror
        </div>
        <div class="px-2 flex-1">
            <label for="part_quantity" class="block mb-2 text-sm font-medium text-gray-900 ">Part Quantity</label>
            <input type="text" name="part_quantity" id="part_quantity" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 " placeholder="Type product name" value="{{$service_report->part_quantity}}">
            @error('part_quantity')
            <p class="text-red-500 text-xs mt-2 italic p-1">{{ $message }}</p>
            @enderror
        </div>
        <div class="px-2 flex-1">
            <label for="part_description" class="block mb-2 text-sm font-medium text-gray-900 ">Part Description</label>
            <input type="text" name="part_description" id="part_description" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 " placeholder="Type product name" value="{{$service_report->part_description}}">
            @error('part_description')
            <p class="text-red-500 text-xs mt-2 italic p-1">{{ $message }}</p>
            @enderror
        </div>
        <div class="px-2 flex-1">
            <label for="part_usage" class="block mb-2 text-sm font-medium text-gray-900 ">Part Usage</label>
            <input type="text" name="part_usage" id="part_usage" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 " placeholder="Type product name" value="{{$service_report->part_usage}}">
            @error('part_usage')
            <p class="text-red-500 text-xs mt-2 italic p-1">{{ $message }}</p>
            @enderror
        </div>
    </div>
    <div class="sm:col-span-2 px-2 mb-4">
        <label for="action_taken" class="block mb-2 text-sm font-medium text-gray-900">Action Taken</label>
        <textarea id="action_taken" rows="8" name="action_taken" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-primary-500 focus:border-primary-500 " placeholder="Your action taken here" required>{{$service_report->action_taken}}</textarea>
        @error('action_taken')
        <p class="text-red-500 text-xs mt-2 italic p-1">{{ $message }}</p>
        @enderror
    </div>
    <div class="px-2 flex-1 mb-4">
        <label for="pending" class="block mb-2 text-sm font-medium text-gray-900">Pending/Unresolved Items</label>
        <input type="text" name="pending" id="pending" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 " placeholder="Pending or Unresolved Items" value="{{$service_report->pending}}">
        @error('pending')
        <p class="text-red-500 text-xs mt-2 italic p-1">{{ $message }}</p>
        @enderror
    </div>
    <div class="flex mb-4">
        <div class="px-2 flex-1">
            <h3 class="mb-4 font-semibold text-gray-900 text-sm ">Status</h3>
            <label class="inline-flex items-center cursor-pointer">
                <input type="checkbox" class="sr-only peer" onclick="toggleCompleteStatus()" id="is_complete" name="is_complete" value="1" {{ $service_report->is_complete == 1 ? 'checked' : '' }}>
                <div class="relative w-11 h-6 bg-gray-200 rounded-full peer peer-focus:ring-4 peer-focus:ring-blue-300 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all  peer-checked:bg-blue-600"></div>
                <span class="ms-3 text-sm font-medium text-gray-900 " id="status-text">{{ $service_report->is_complete ? 'Complete' : 'Incomplete' }}</span>
            </label>
            @error('is_complete')
            <p class="text-red-500 text-xs mt-2 italic p-1">{{ $message }}</p>
            @enderror
        </div>


        <div class="px-2 flex-1">
            <h3 class="mb-4 font-semibold text-gray-900 text-sm">Engineer Assigned</h3>
            @php
            $authenticatedUserName = auth()->user()->first_name . ' ' . auth()->user()->last_name;
            $engineers = ['Ramwell Sahagun', 'Abner Abelardo', 'Rhodel Tejano', 'EJ Mercado', 'Luis Laborera', 'Marwin Manalastas', 'Eugene Rey Carta'];
            foreach ($user_data as $user) {
                if ($user->role === 'TSG' || $user->user_type === 'User') {
                    $registeredEngineers[] = $user->first_name . ' ' . $user->last_name;
                }
            }
            
            @endphp

            <button id="dropdownBgHoverButton" data-dropdown-toggle="dropdownBgHover" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center" type="button">
                Select Engineer
                <svg class="w-2.5 h-2.5 ms-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4" />
                </svg>
            </button>

            <!-- Dropdown menu -->
            <div id="dropdownBgHover" class="z-10 hidden w-48 bg-white rounded-lg shadow">
                <ul class="p-3 space-y-1 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownBgHoverButton">
                    @foreach ($registeredEngineers as $engineer)
                    
                    
                    <li>
                        <div class="flex items-center p-2 rounded hover:bg-gray-100 dark:hover:bg-gray-600">
                            <input
                                id="checkbox-{{ $loop->index }}"
                                type="checkbox"
                                value="{{ $engineer }}"
                                name="engineers_assigned[]"
                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 focus:ring-2"
                                @if($engineer===$authenticatedUserName) checked @endif>
                            <label for="checkbox-{{ $loop->index }}" class="w-full ms-2 text-sm font-medium text-gray-900 rounded">{{ $engineer }}</label>
                        </div>
                    </li>
                    @endforeach
                </ul>
            </div>


        </div>
    </div>
    <div class="flex mb-4">
        <div class="px-2 flex-1">
            <label class="block mb-2 text-sm font-medium text-gray-900 " for="sr_image">Upload file</label>
            <div class="flex justify-center items-center mb-2">
                <img id="profileImagePreview" src="{{ $service_report->sr_image ? asset('storage/profile_images/thumbnail/small_' . $tsg->profile_image) : 'https://api.dicebear.com/9.x/icons/svg?seed=Midnight' }}" alt="Profile Image" class="w-20 h-20 rounded-full object-cover">
            </div>
            <input type="file" id="sr_image" name="sr_image" class="bg-gray-200 rounded w-full text-gray-800 px-3 py-2 focus:outline-none focus:bg-white border-2 border-gray-300" onchange="previewImage(event)">

            <!-- <input class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none " aria-describedby="sr_image_help" id="sr_image" type="file" value={{$service_report->sr_image}} > -->
            <div class="mt-1 text-sm text-gray-500 " id="sr_image_help">Upload the softcopy of the SR</div>
            @error('sr_image')
            <p class="text-red-500 text-xs mt-2 italic p-1">{{ $message }}</p>
            @enderror
        </div>
    </div>
    <div class="flex justify-end">
        <button type="submit" class="inline-flex items-center px-5 py-2.5 mt-4 sm:mt-6 text-sm font-medium text-center text-white bg-blue-700 rounded-lg focus:ring-4 focus:ring-primary-200 hover:bg-primary-800"> Submit </button>
    </div>
</form>
</section>
</main>
</div>
@include('partials.__footer')