@include('partials.__header')
<header class="max-w-lg mx-auto">
    <a href="#">
        <h1 class="text-3xl font-bold text-gray-900 text-center">{{ $title }}</h1>
    </a>
</header>
<main class="bg-gray-100 max-w-lg mx-auto p-8 my-10 rounded-lg shadow-lg">
    <section>
        <h2 class="font-bold text-2xl text-gray-900 text-center">
            Registration
        </h2>
        <p class="text-gray-700 text-center mt-4">Please fill in the form below</p>   
    </section>
    <section class="mt-8">
        <form action="/store" method="POST" class="flex flex-col">
            @csrf
            <div class="mb-4">
                <div class="flex justify-between">
                    <div class="w-1/4">
                        <label for="first_name" class="block text-sm font-semibold text-gray-800 mb-2">First Name</label>
                        <input type="text" id="first_name" name="first_name" placeholder="Enter your first name" class="bg-gray-200 rounded w-full text-gray-800 px-3 py-2 focus:outline-none focus:bg-white border-2 border-gray-300">
                    </div>
                    <div class="w-1/4 ml-3">
                        <label for="middle_name" class="block text-sm font-semibold text-gray-800 mb-2">Middle Name</label>
                        <input type="text" id="middle_name" name="middle_name" placeholder="Enter your middle name" class="bg-gray-200 rounded w-full text-gray-800 px-3 py-2 focus:outline-none focus:bg-white border-2 border-gray-300">
                    </div>
                    <div class="w-1/4 ml-3">
                        <label for="last_name" class="block text-sm font-semibold text-gray-800 mb-2">Last Name</label>
                        <input type="text" id="last_name" name="last_name" placeholder="Enter your last name" class="bg-gray-200 rounded w-full text-gray-800 px-3 py-2 focus:outline-none focus:bg-white border-2 border-gray-300">
                    </div>
                    <div class="w-1/4 ml-3">
                        <label for="suffix" class="block text-sm font-semibold text-gray-800 mb-2">Suffix (if any)</label>
                        <input type="text" id="suffix" name="suffix" placeholder="Enter your suffix" class="bg-gray-200 rounded w-full text-gray-800 px-3 py-2 focus:outline-none focus:bg-white border-2 border-gray-300">
                    </div>
                </div>
            </div>

            <div class="mb-4">
                <label for="email" class="block text-sm font-semibold text-gray-800 mb-2">Email</label>
                <input type="email" id="email" name="email" placeholder="Enter your email address" class="bg-gray-200 rounded w-full text-gray-800 px-3 py-2 focus:outline-none focus:bg-white border-2 border-gray-300">
            </div>

            <div class="mb-4">
                <label for="phone_number" class="block text-sm font-semibold text-gray-800 mb-2">Phone Number</label>
                <input type="tel" id="phone_number" name="phone_number" placeholder="Enter your phone number" class="bg-gray-200 rounded w-full text-gray-800 px-3 py-2 focus:outline-none focus:bg-white border-2 border-gray-300">
            </div>


            <div class="mb-4">
                <label for="password" class="block text-sm font-semibold text-gray-800 mb-2">Password</label>
                <input type="password" id="password" name="password" placeholder="Enter your password" class="bg-gray-200 rounded w-full text-gray-800 px-3 py-2 focus:outline-none focus:bg-white border-2 border-gray-300">
            </div>

            <div class="mb-4">
                <label for="password_confirmation" class="block text-sm font-semibold text-gray-800 mb-2">Confirm Password</label>
                <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Confirm your password" class="bg-gray-200 rounded w-full text-gray-800 px-3 py-2 focus:outline-none focus:bg-white border-2 border-gray-300">
            </div>

            

            <button class="bg-purple-600 hover:bg-purple-700 text-white font-semibold py-2 rounded shadow-lg hover:shadow-xl transition duration-200 text-center" type="submit">Sign up</button>

        </form>
    </section>
</main>
@include('partials.__footer')
