@include('partials.__header', [$title])
<?php
$array = array('title' => "Questech");
;?>
<x-nav :data="$array"/>
<header class="max-w-lg mx-auto">
    <a href="#">
        <h1 class="text-4xl font-bold text-white text-center pt-5">CREATE NEW TSG USER</h1>
    </a>

</header>
<main class="bg-white max-w-lg mx-auto p-8 my-10 rounded-lg shadow-2x1">
    <section class="mt-10">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li class="text-red-500 text-xs mt-2 italic p-1">{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="/create/tsg" method="POST" class="flex flex-col">
            @csrf
            <div class="mb-4">
                <div class="flex justify-between">
                    <div class="w-1/4">
                        <label for="first_name" class="block text-sm font-semibold text-gray-800 mb-2">First Name*</label>
                        <input type="text" id="first_name" name="first_name" placeholder="First name" class="bg-gray-200 rounded w-full text-gray-800 px-3 py-2 focus:outline-none focus:bg-white border-2 border-gray-300" value={{old('first_name')}}>
                        @error('first_name')
                            <p class="text-red-500 text-xs mt-2 italic p-1">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div class="w-1/4 ml-3">
                        <label for="middle_name" class="block text-sm font-semibold text-gray-800 mb-2">Middle Name</label>
                        <input type="text" id="middle_name" name="middle_name" placeholder="Middle name" class="bg-gray-200 rounded w-full text-gray-800 px-3 py-2 focus:outline-none focus:bg-white border-2 border-gray-300" value={{old('middle_name')}}>
                        @error('middle_name')
                            <p class="text-red-500 text-xs mt-2 italic p-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="w-1/4 ml-3">
                        <label for="last_name" class="block text-sm font-semibold text-gray-800 mb-2">Last Name*</label>
                        <input type="text" id="last_name" name="last_name" placeholder="Last name" class="bg-gray-200 rounded w-full text-gray-800 px-3 py-2 focus:outline-none focus:bg-white border-2 border-gray-300" value={{old('last_name')}}>
                        @error('last_name')
                            <p class="text-red-500 text-xs mt-2 italic p-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="w-1/4 ml-3">
                        <label for="suffix" class="block text-sm font-semibold text-gray-800 mb-2">Suffix (if any)</label>
                        <input type="text" id="suffix" name="suffix" placeholder="Suffix" class="bg-gray-200 rounded w-full text-gray-800 px-3 py-2 focus:outline-none focus:bg-white border-2 border-gray-300" value={{old('suffix')}}>
                        @error('suffix')
                            <p class="text-red-500 text-xs mt-2 italic p-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="mb-4">
                
                <div class="flex justify-start">
                    <div class="w-1/2">
                        <label for="emp_id" class="block text-sm font-semibold text-gray-800 mb-2">Employee ID No.*</label>
                        <input type="text" id="emp_id" name="emp_id" placeholder="Employee ID" class="bg-gray-200 rounded w-full text-gray-800 px-3 py-2 focus:outline-none focus:bg-white border-2 border-gray-300" value={{old('emp_id')}}>
                        @error('emp_id')
                            <p class="text-red-500 text-xs mt-2 italic p-1">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div class="w-1/4 ml-3">
                        <label for="age" class="block text-sm font-semibold text-gray-800 mb-2">Age</label>
                        <input type="text" id="age" name="age" placeholder="Age" class="bg-gray-200 rounded w-full text-gray-800 px-3 py-2 focus:outline-none focus:bg-white border-2 border-gray-300" value={{old('age')}}>
                        @error('age')
                            <p class="text-red-500 text-xs mt-2 italic p-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="w-1/4 ml-3">
                        <label for="gender" class="block text-sm font-semibold text-gray-800 mb-2">Gender</label>
                        <select id="gender" name="gender" class="bg-gray-200 rounded w-full text-gray-800 px-3 py-2 focus:outline-none focus:bg-white border-2 border-gray-300">
                            <option value="">Gender</option>
                            <option value="Male" {{ old('gender') == 'Male' ? 'selected' : '' }}>Male</option>
                            <option value="Female" {{ old('gender') == 'Female' ? 'selected' : '' }}>Female</option>
                            <option value="Other" {{ old('gender') == 'Other' ? 'selected' : '' }}>Other</option>
                        </select>
                        @error('gender')
                            <p class="text-red-500 text-xs mt-2 italic p-1">{{ $message }}</p>
                        @enderror
                    </div>
                    
                </div>
            </div>

            <div class="mb-4">
                <label for="email" class="block text-sm font-semibold text-gray-800 mb-2">Email Address*</label>
                <input type="email" id="email" name="email" placeholder="Email Address" class="bg-gray-200 rounded w-full text-gray-800 px-3 py-2 focus:outline-none focus:bg-white border-2 border-gray-300 value={{old('email')}}">
                @error('email')
                    <p class="text-red-500 text-xs mt-2 italic p-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="phone_number" class="block text-sm font-semibold text-gray-800 mb-2">Phone Number*</label>
                <input type="tel" id="phone_number" name="phone_number" placeholder="e.g 09123456789" class="bg-gray-200 rounded w-full text-gray-800 px-3 py-2 focus:outline-none focus:bg-white border-2 border-gray-300 value={{old('phone_number')}}">
                @error('phone_number')
                    <p class="text-red-500 text-xs mt-2 italic p-1">{{ $message }}</p>
                @enderror
            </div>
           
            <button class="bg-purple-600 hover:bg-purple-700 text-white font-bold py-2 rounded shadow-lg hover:shadow-xl transition duration-200 text-center" type="submit">Create</button>

            <a href="/tsg" class="bg-red-600 hover:bg-red-700 text-white font-bold py-2 rounded shadow-lg hover:shadow-xl transition duration-200 text-center mt-2">Back</a>
            

        </form>
      

    </section>
    
</main>


@include('partials.__footer')

