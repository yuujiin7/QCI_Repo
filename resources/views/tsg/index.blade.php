@include('partials.__header', ['title' => 'Questech'])

<?php
$array = array('name' => "TSG User List");
;?>
<x-nav/>

<section>
<div class="p-10 sm:ml-64">
    <main class="bg-white max-w-full mx-auto p-8 my-10 rounded-lg shadow-2xl ">
    <!-- <x-breadcrumbs :title="$array['name']"/> -->
    <div class="container mx-auto">
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white shadow-md rounded-lg overflow-hidden display " id="TSGTable">
                <thead class="bg-gray-800 text-white text-xs uppercase">
                    <tr>
                        <th scope="col" class="py-3 px-6"></th>
                        <th scope="col" class="py-3 px-6">Employee ID</th>
                        <th scope="col" class="py-3 px-6">First Name</th>
                        <th scope="col" class="py-3 px-6">Last Name</th>
                        <th scope="col" class="py-3 px-6">Email</th>
                        <th scope="col" class="py-3 px-6">Phone Number</th>
                        <th scope="col" class="py-3 px-6 text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $tsg_user)
                    <tr class="bg-white border-b hover:bg-gray-50 ">
                        @php 
                            $default_profile = "https://api.dicebear.com/8.x/initials/svg?seed=".$tsg_user->first_name."%20".$tsg_user->last_name;
                        @endphp
                        <td class="pl-2">
                            <img src="{{ $tsg_user->profile_image ? asset('storage/profile_images/thumbnail/' . $tsg_user->profile_image) : $default_profile }}" alt="{{ $tsg_user->first_name }} {{ $tsg_user->last_name }}" class="w-8 h-8 rounded-full" />
                        </td>
                        <td class="py-3 px-6">{{ $tsg_user->emp_id }}</td>
                        <td class="py-3 px-6">{{ $tsg_user->first_name }}</td>
                        <td class="py-3 px-6">{{ $tsg_user->last_name }}</td>
                        <td class="py-3 px-6">{{ $tsg_user->email }}</td>
                        <td class="py-3 px-6">{{ $tsg_user->phone_number }}</td>
                        <td class="py-3 px-6 text-center">
                            <div class="flex justify-center space-x-2">
                                <a href="/tsg/{{ $tsg_user->id }}" class="bg-blue-600 text-white px-4 py-1 rounded hover:bg-blue-700">View</a>
                               
                                <form action="/tsg/{{ $tsg_user->id }}" method="POST" class="inline" id="deleteFormTSG">
                                    @csrf
                                    @method('DELETE')
                                    <button class="bg-red-600 text-white px-4 py-1 rounded hover:bg-red-700 submitDelete" data-form-id="deleteFormTSG"> <svg class="w-6 h-6 text-white-800 dark:text-gray" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
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
    </main>
</div>
</section>


@include('partials.__footer')
