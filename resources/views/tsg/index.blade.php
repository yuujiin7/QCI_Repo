@include('partials.__header', [$title])
<?php
$array = array('title' => "Questech");
;?>
<x-nav :data="$array"/>

<header class="max-w-lg mx-auto mt-5">
    <a href="#">
        <h1 class="text-4xl font-bold text-white text-center pb-10 uppercase">TSG user list</h1>
    </a>
</header>
<section>
    <div class="overflow-x-auto relative">
        <table class="w-96 mx-auto text-sm text-left text-gray-500 display" id="TSGTable">
            <thead class="text-xs text gray-700 uppercase bg-gray-50">
                <tr>
                    <th scope="col" class="py-3 px-6">
                        Employee ID
                    </th>
                    <th scope="col" class="py-3 px-6">
                        First Name
                    </th>
                    <th scope="col" class="py-3 px-6">
                        Last Name
                    </th>
                    <th scope="col" class="py-3 px-6">
                        Email
                    </th>
                    <th scope="col" class="py-3 px-6">
                        Phone Number
                    </th>
                    <th scope="col" class="py-3 px-6 text-center">
                        Actions
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach($tsg as $tsg_users)
                <tr class="bg-white border-b border-gray-200">
                    <td class="py-3 px-6 text-left whitespace-nowrap">
                        <div class="flex items-center">
                            <span class="font-medium">{{$tsg_users->id}}</span>
                        </div>
                    </td>
                    <td class="py-3 px-6 text-left">
                        <div class="flex items-center">
                            <span>{{$tsg_users->first_name}}</span>
                        </div>
                    </td>
                    <td class="py-3 px-6 text-left">
                        <div class="flex items-center">
                            <span>{{$tsg_users->last_name}}</span>
                        </div>
                    </td>
                    <td class="py-3 px-6 text-left">
                        <div class="flex items-center">
                            <span>{{$tsg_users->email}}</span>
                        </div>
                    </td>
                    <td class="py-3 px-6 text-left">
                        <div class="flex items-center">
                            <span>{{$tsg_users->phone_number}}</span>
                        </div>
                    </td>
                    <td class="py-4 px-6">
                        <div class="flex items-center space-x-2">
                            <a href="/tsg/{{$tsg_users->id}}" class="bg-sky-600 text-white px-4 py-1 rounded">View</a>
                            <form action="/tsg/{{$tsg_users->id}}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-600 text-white px-4 py-1 rounded">Delete</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="mx-auto max-w-lg pt-6 p-4">
            {{$tsgs->links()}}
        </div>
    </div>
</section>


@include('partials.__footer')
