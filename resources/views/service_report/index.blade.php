@include('partials.__header')
<?php
$array = array('title' => "Questech");
;?>
<x-nav :data="$array"/>

    <header class="max-w-lg mx-auto mt-5">
        <a href="#">
            <h1 class="text-4xl font-bold text-white text-center pb-10 uppercase">{{$title}}</h1>
        </a>

    </header>
    <section>
        <div class="overflow-x-auto relative">
            <table class="w-96 mx-auto text-sm text-left text-gray-500 display" id="TSGTable">
                <thead class="text-xs text gray-700 uppercase bg-gray-50">
                    <tr>
                        <th scope="col" class="py-3 px-6">
                            SR Number
                        </th>
                        <th scope="col" class="py-3 px-6">
                            Customer Name
                        </th>
                        <th scope="col" class="py-3 px-6">
                            Address
                        </th>
                        
                        <th scope="col" class="py-3 px-6">
                            Contact Person
                        </th>
                        <th scope="col" class="py-3 px-6">
                            Engineer Assigned
                        </th>
                        <th scope="col" class="py-3 px-6">
                            Actions
                        </th>
                    </tr>

                </thead>
                <tbody>
                    @foreach($service_report as $report)
                    <tr class="bg-white border-b border-gray-200">
                        <!-- checkbox -->
                        <td class="py-3 px-6 text-left whitespace-nowrap">
                            <div class="flex items center">
                                <span class="font-medium">{{ $report->sr_number }}</span>
                            </div>
                        </td>
                        <td class="py-3 px-6 text-left">
                            <div class="flex items
                            center">
                                <span>{{ $report->customer_name }}</span>
                            </div>
                        </td>
                        
                        <td class="py-3 px-6 text-left">
                            <div class="flex items
                            center">
                                <span>{{ $report->address }}</span>
                            </div>
                        </td>
                        <td class="py-3 px-6 text-left">
                            <div class="flex items
                            center">
                                <span>{{ $report->contact_person }}</span>
                            </div>
                        </td>
                        <td class="py-3 px-6 text-left">
                            <div class="flex items
                            center">    
                                <span>{{ $report->engineer_assigned }}</span>
                            </div>
                        </td>

                        <td class="py-4 px-6">
                            <a href="/service-report/{{$report->id}}" class="bg-sky-600 text-white px-4 py-1 rounded">view</a>
                        </td>
                        
                    </tr>
                    @endforeach
                    
                </tbody>
            </table>
        </div>
    </section>
@include('partials.__footer')