@include('partials.__header', ['title' => 'Questech'])

<?php
$array = array('name' => "TSG User List");
;?>
<x-nav/>

<section>
<div class="p-10 sm:ml-64">
    <main class="bg-white max-w-full mx-auto p-8 my-10 rounded-lg shadow-2xl dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white">
    <!-- <x-breadcrumbs :title="$array['name']"/> -->
    <div class="container mx-auto">
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white shadow-md rounded-lg overflow-hidden display dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white" id="TSGTable">
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
                    @foreach($tsg as $tsg_user)
                    <tr class="bg-white border-b hover:bg-gray-50 dark:hover:bg-gray-600">
                        @php 
                            $default_profile = "https://api.dicebear.com/8.x/initials/svg?seed=".$tsg_user->first_name."%20".$tsg_user->last_name;
                        @endphp
                        <td class="pl-2">
                            <img src="{{ $tsg_user->profile_image ? asset('storage/profile_images/thumbnail/' . $tsg_user->profile_image) : $default_profile }}" alt="{{ $tsg_user->first_name }} {{ $tsg_user->last_name }}" class="w-8 h-8 rounded-full" />
                        </td>
                        <td class="py-3 px-6">{{ $tsg_user->id }}</td>
                        <td class="py-3 px-6">{{ $tsg_user->first_name }}</td>
                        <td class="py-3 px-6">{{ $tsg_user->last_name }}</td>
                        <td class="py-3 px-6">{{ $tsg_user->email }}</td>
                        <td class="py-3 px-6">{{ $tsg_user->phone_number }}</td>
                        <td class="py-3 px-6 text-center">
                            <div class="flex justify-center space-x-2">
                                <a href="/tsg/{{ $tsg_user->id }}" class="bg-blue-600 text-white px-4 py-1 rounded hover:bg-blue-700">View</a>
                                <form action="/tsg/{{ $tsg_user->id }}" method="POST" class="inline">
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
    </main>
</div>
</section>


@include('partials.__footer')
