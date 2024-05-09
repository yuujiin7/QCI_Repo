@include('partials.__header')
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
            <table class="w-96 mx-auto text-sm text-left text-gray-500">
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
                            SR
                        </th>

                    </tr>

                </thead>
                <tbody>
                    @foreach ($tsg as $tsg_users)
                    <tr class="bg-gray-800 border-b text-white">
                        <td class="py-4 px-6">
                            {{ $tsg_users->emp_id }}
                        </td>
                        <td class="py-4 px-6">
                            {{ $tsg_users->first_name }}
                        </td>
                        <td class="py-4 px-6">
                            {{ $tsg_users->last_name }}
                        </td>
                        <td class="py-4 px-6">
                            {{ $tsg_users->email }}
                        </td>
                        <td class="py-4 px-6">
                            {{ $tsg_users->gender }}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </section>
@include('partials.__footer')