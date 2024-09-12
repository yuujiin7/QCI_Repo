

@include('partials.__header', [$title])
<?php
$array = array('title' => "Questech");
?>
<x-nav :data="$array" />
<header class="max-w-lg mx-auto">
</header>
<div class="p-10 sm:ml-64 ">
    <main class="bg-white max-w-3xl mx-auto p-8 my-10 rounded-lg shadow-2xl">
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
<form action="/store" method="POST" class="">
    @csrf
    <div class="flex mb-4">
        <div class="px-2 flex-1">

            <label for="first_name" class="block mb-2 text-sm font-medium text-gray-900 ">First Name</label>
            <input type="text" name="first_name" id="first_name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 " placeholder="Serial Number" required="" value="{{old('first_name')}}">
            @error('first_name')
            <p class="text-red-500 text-xs mt-2 italic p-1">{{ $message }}</p>
            @enderror
        </div>
        <div class="px-2 flex-1">
            <label for="last_name" class="block mb-2 text-sm font-medium text-gray-900">Last Name</label>
            <input type="text" name="last_name" id="last_name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 " placeholder="Account Manager" value="{{old('last_name')}}">
            @error('last_name')
            <p class="text-red-500 text-xs mt-2 italic p-1">{{ $message }}</p>
            @enderror
        </div>

    </div>
    <div class="flex mb-4">
    <div class="px-2 flex-1">
            <label for="emp_id" class="block mb-2 text-sm font-medium text-gray-900">Employee ID</label>
            <input type="text" name="emp_id" id="emp_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 " placeholder="Account Manager" value="{{old('emp_id')}}">
            @error('emp_id')
            <p class="text-red-500 text-xs mt-2 italic p-1">{{ $message }}</p>
            @enderror
        </div>

        
    </div>
    <div class="flex flex-wrap mb-4">
        <div class="px-2 flex-1">

            <label for="email" class="block mb-2 text-sm font-medium text-gray-900">Email Address</label>
            <input type="email" name="email" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 " placeholder="Email Address" required="" value="{{old('email')}}">
            @error('email')
            <p class="text-red-500 text-xs mt-2 italic p-1">{{ $message }}</p>
            @enderror
        </div>
        <div class="px-2 flex-1">
            <label for="phone_number" class="block mb-2 text-sm font-medium text-gray-900">Phone Number</label>
            <input type="tel" name="phone_number" id="phone_number" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 " placeholder="Phone Number" value="{{old('phone_number')}}">
            @error('phone_number')
            <p class="text-red-500 text-xs mt-2 italic p-1">{{ $message }}</p>
            @enderror
        </div>

    </div>



    <div class="px-2 flex-1 mb-4">
        <label for="user_type" class="block mb-2 text-sm font-medium text-gray-900">User Type</label>
        <select id="user_type" name="user_type" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">

            <option>Admin</option>
            <option>User</option>
        </select>
        @error('user_type')
        <p class="text-red-500 text-xs mt-2 italic p-1">{{ $message }}</p>
        @enderror
    </div>

    <div class="px-2 flex-1 mb-4">
        <label for="role" class="block mb-2 text-sm font-medium text-gray-900">Role</label>
        <select id="role" name="role" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">

            <option>TSG</option>
            <option>SMG</option>
            <option>PMG</option>
            <option>Admin</option>

        </select>
        @error('role')
        <p class="text-red-500 text-xs mt-2 italic p-1">{{ $message }}</p>
        @enderror
    </div>
    <div class="flex mb-4">
        <div class="px-2 flex-1">

            <label for="password" class="block mb-2 text-sm font-medium text-gray-900">Password</label>
            <input type="password" name="password" id="password" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 " placeholder="Password" required="" value="{{old('password')}}">
            @error('password')
            <p class="text-red-500 text-xs mt-2 italic p-1">{{ $message }}</p>
            @enderror
        </div>
        <div class="px-2 flex-1">
            <label for="password_confirmation" class="block mb-2 text-sm font-medium text-gray-900">Confirm Password</label>
            <input type="password" name="password_confirmation" id="password_confirmation" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 " placeholder="Confirm Password" value="{{old('password_confirmation')}}">
            @error('password_confirmation')
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