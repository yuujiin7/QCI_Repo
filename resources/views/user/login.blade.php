@include('partials.__header')
    <header class="max-w-lg mx-auto">
        <a href="#">
            <h1 class="text-4xl font-bold text-white text-center">{{ $title }}</h1>
        </a>

    </header>
    <main class="bg-white max-w-lg mx-auto p-8 my-10 rounded-lg shadow-2x1">
        <section>
            <h3 class="font-bold text-2xl text-center">
                Welcome to TSG-SRS
            </h3>
            <p class="text-gray-600 pt-12">Sign in to your account</p>   
        </section>
        <section class="mt-10">
            <form action="/login/process" method="POST" class="flex flex-col">
                @csrf
                
                
                <div class="mb-4">
                    <label for="email" class="block text-sm font-semibold text-gray-800 mb-2">Email</label>
                    <input type="email" id="email" name="email" placeholder="Enter your email address" class="bg-gray-200 rounded w-full text-gray-800 px-3 py-2 focus:outline-none focus:bg-white border-2 border-gray-300 value={{old('email')}}">
                    @error('email')
                        <p class="text-red-500 text-xs mt-2 italic p-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="password" class="block text-sm font-semibold text-gray-800 mb-2">Password*</label>
                    <div class="relative">
                        <input type="password" id="password" name="password" placeholder="Enter your password" class="bg-gray-200 rounded w-full text-gray-800 px-3 py-2 focus:outline-none focus:bg-white border-2 border-gray-300">
                        <button type="button" class="absolute top-0 right-0 mr-2 mt-2 focus:outline-none" onclick="togglePasswordVisibility('password')">
                            <svg class="h-6 w-6 text-gray-400 hover:text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14v2a1 1 0 001 1h2a1 1 0 001-1v-2m-3 0v-2a1 1 0 011-1h2a1 1 0 011 1v2"></path>
                            </svg>
                        </button>
                    </div>
                    @error('password')
                        <p class="text-red-500 text-xs mt-2 italic p-1">{{ $message }}</p>
                    @enderror
                </div>
                <button class="bg-purple-600 hover:bg-purple-700 text-white font-bold py-2 rounded shadow-lg hover:shadow-xl transition duration-200 text-center" type="submit">Login</button>
                

            </form>
            <div class="m-2 text-center">
                <p class="inline">Need an account?</p>
                <a href="/register" class="text-blue-400 hover:text-blue-600 inline">Register</a>
            </div>
            
        </section>
        
    </main>
    
@include('partials.__footer')