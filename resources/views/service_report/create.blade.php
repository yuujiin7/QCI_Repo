@include('partials.__header', [$title])
<?php
$array = array('title' => "Questech");
;?>
<x-nav :data="$array"/>

<header class="max-w-lg mx-auto">
    <a href="#">
        <h1 class="text-4xl font-bold text-white text-center pt-5">CREATE SERVICE REPORT</h1>
    </a>
</header>

<main class="bg-white max-w-3xl mx-auto p-8 my-10 rounded-lg shadow-2xl">
    <section class="mt-10">
        @if ($errors->any())
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li class="text-red-500 text-xs mt-2 italic p-1">{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="/create/tsg" method="POST" class="space-y-4">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <!-- First Name -->
                <div>
                    <label for="first_name" class="block text-sm font-semibold text-gray-800 mb-2">First Name*</label>
                    <input type="text" id="first_name" name="first_name" placeholder="First name" class="bg-gray-200 rounded w-full text-gray-800 px-3 py-2 focus:outline-none focus:bg-white border-2 border-gray-300" value="{{ old('first_name') }}">
                    @error('first_name')
                        <p class="text-red-500 text-xs mt-2 italic p-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Middle Name -->
                <div>
                    <label for="middle_name" class="block text-sm font-semibold text-gray-800 mb-2">Middle Name</label>
                    <input type="text" id="middle_name" name="middle_name" placeholder="Middle name" class="bg-gray-200 rounded w-full text-gray-800 px-3 py-2 focus:outline-none focus:bg-white border-2 border-gray-300" value="{{ old('middle_name') }}">
                    @error('middle_name')
                        <p class="text-red-500 text-xs mt-2 italic p-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Last Name -->
                <div>
                    <label for="last_name" class="block text-sm font-semibold text-gray-800 mb-2">Last Name*</label>
                    <input type="text" id="last_name" name="last_name" placeholder="Last name" class="bg-gray-200 rounded w-full text-gray-800 px-3 py-2 focus:outline-none focus:bg-white border-2 border-gray-300" value="{{ old('last_name') }}">
                    @error('last_name')
                        <p class="text-red-500 text-xs mt-2 italic p-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Suffix -->
                <div>
                    <label for="suffix" class="block text-sm font-semibold text-gray-800 mb-2">Suffix (if any)</label>
                    <input type="text" id="suffix" name="suffix" placeholder="Suffix" class="bg-gray-200 rounded w-full text-gray-800 px-3 py-2 focus:outline-none focus:bg-white border-2 border-gray-300" value="{{ old('suffix') }}">
                    @error('suffix')
                        <p class="text-red-500 text-xs mt-2 italic p-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <!-- Employee ID -->
                <div>
                    <label for="emp_id" class="block text-sm font-semibold text-gray-800 mb-2">Employee ID No.*</label>
                    <input type="text" id="emp_id" name="emp_id" placeholder="Employee ID" class="bg-gray-200 rounded w-full text-gray-800 px-3 py-2 focus:outline-none focus:bg-white border-2 border-gray-300" value="{{ old('emp_id') }}">
                    @error('emp_id')
                        <p class="text-red-500 text-xs mt-2 italic p-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Age -->
                <div>
                    <label for="age" class="block text-sm font-semibold text-gray-800 mb-2">Age</label>
                    <input type="text" id="age" name="age" placeholder="Age" class="bg-gray-200 rounded w-full text-gray-800 px-3 py-2 focus:outline-none focus:bg-white border-2 border-gray-300" value="{{ old('age') }}">
                    @error('age')
                        <p class="text-red-500 text-xs mt-2 italic p-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Gender -->
                <div>
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

            <!-- Email Address -->
            <div>
                <label for="email" class="block text-sm font-semibold text-gray-800 mb-2">Email Address*</label>
                <input type="email" id="email" name="email" placeholder="Email Address" class="bg-gray-200 rounded w-full text-gray-800 px-3 py-2 focus:outline-none focus:bg-white border-2 border-gray-300" value="{{ old('email') }}">
                @error('email')
                    <p class="text-red-500 text-xs mt-2 italic p-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Phone Number -->
            <div>
                <label for="phone_number" class="block text-sm font-semibold text-gray-800 mb-2">Phone Number*</label>
                <input type="tel" id="phone_number" name="phone_number" placeholder="e.g 09123456789" class="bg-gray-200 rounded w-full text-gray-800 px-3 py-2 focus:outline-none focus:bg-white border-2 border-gray-300" value="{{ old('phone_number') }}">
                @error('phone_number')
                    <p class="text-red-500 text-xs mt-2 italic p-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Buttons -->
            <div class="flex justify-end space-x-4">
                <button class="bg-purple-600 hover:bg-purple-700 text-white font-bold py-2 px-4 rounded shadow-lg hover:shadow-xl transition duration-200" type="submit">Create</button>
                <button class="bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded shadow-lg hover:shadow-xl transition duration-200" type="reset">Cancel</button>
            </div>
        </form>
    </section>
</main>

@include('partials.__footer')
