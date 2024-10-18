<nav class="fixed top-0 z-50 w-full bg-white border-b border-gray-200 ">
  <div class="px-3 py-3 lg:px-5 lg:pl-3">
    <div class="flex items-center justify-between">
      <div class="flex items-center justify-start rtl:justify-end">
        <button data-drawer-target="logo-sidebar" data-drawer-toggle="logo-sidebar" aria-controls="logo-sidebar" type="button" class="inline-flex items-center p-2 text-sm text-gray-500 rounded-lg sm:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 ">
          <span class="sr-only">Open sidebar</span>
          <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
            <path clip-rule="evenodd" fill-rule="evenodd" d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z"></path>
          </svg>
        </button>
        <a href="#" class="flex ms-2 md:me-24">
          <img src="/images/logo.png" class="h-8 me-3" alt="Questech Logo" />
          <span class="self-center text-xl font-semibold sm:text-2xl whitespace-nowrap text-[#001451] font-arialRounded" >QUESTECH </span>
        </a>
      </div>
      <div class="flex items-center">
        <div class="flex items-center ms-3">
          <div>
            <button type="button" class="flex text-sm bg-gray-800 rounded-full focus:ring-4 focus:ring-gray-300 " aria-expanded="false" data-dropdown-toggle="dropdown-user">
              <span class="sr-only">Open user menu</span>

              @if (Auth::user()->profile_image)
              <img src="{{ asset('storage/profile_images/thumbnail/' . Auth::user()->profile_image) }}" alt="{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}" class="w-8 h-8 rounded-full" />
              @else
              @php
              $default_profile = "https://api.dicebear.com/8.x/initials/svg?seed=".Auth::user()->first_name."%20".Auth::user()->last_name;
              @endphp
              <img src="{{ $default_profile }}" alt="{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}" class="w-8 h-8 rounded-full" />
              @endif


            </button>
          </div>
          <div class="z-50 hidden my-4 text-base list-none bg-white divide-y divide-gray-100 rounded shadow " id="dropdown-user">
            <div class="px-4 py-3" role="none">
              <p class="text-sm text-gray-900 " role="none">
                <!-- logged in users name from database -->
                {{ Auth::user()->first_name }} {{ Auth::user()->last_name }}

              <p class="text-sm font-medium text-gray-900 truncate " role="none">
                {{ Auth::user()->email }}
              </p>
            </div>
            <ul class="py-1" role="none">
              <li>
                <form action="/logout" method="POST">
                  @csrf
                  <div class="flex justify-center">
                    <button class="w-full block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Logout</button>

                  </div>
                </form>
              </li>

            </ul>
          </div>
        </div>

      </div>

    </div>
  </div>
</nav>

<aside id="logo-sidebar" class="fixed top-0 left-0 z-40 w-64 h-screen pt-20 transition-transform -translate-x-full bg-white border-r border-gray-200 sm:translate-x-0" aria-label="Sidebar">
  <div class="h-full px-3 pb-4 overflow-y-auto bg-white ">
    <ul class="space-y-2 font-medium">

      <li>
        <button type="button" class="flex items-center w-full p-2 text-base text-gray-900 transition duration-75 rounded-lg group hover:bg-gray-100 " aria-controls="dropdown-users" data-collapse-toggle="dropdown-users">
          <svg class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 group-hover:text-gray-900 " xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
            <path d="M12 12c2.21 0 4-1.79 4-4S14.21 4 12 4 8 5.79 8 8s1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z" />
          </svg>
          <span class="flex-1 ms-3 text-left rtl:text-right whitespace-nowrap font-bold">Users</span>
          <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4" />

          </svg>
        </button>
        <ul id="dropdown-users" class="hidden py-2 space-y-2">
          <li>
            <a href="/tsg" class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100">User List</a>
          </li>
          <li>
            <a href="/create/tsg" class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 ">Create User </a>
          </li>
        </ul>
      </li>
      <li>
        <button type="button" class="flex items-center w-full p-2 text-base text-gray-900 transition duration-75 rounded-lg group hover:bg-gray-100" aria-controls="dropdown-smg" data-collapse-toggle="dropdown-smg">
          <svg class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 group-hover:text-gray-900" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
            <path d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm0 16H5V5h14v14zm-8-6h2v5h-2zm0-8h2v6h-2zm4 2h2v4h-2zm-8 2h2v2H7z" />
          </svg>
          <span class="flex-1 ms-3 text-left rtl:text-right whitespace-nowrap font-bold">Maint. Agreement</span>
          <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4" />
          </svg>
        </button>
        <ul id="dropdown-smg" class="hidden py-2 space-y-2">
          <li>
            <a href="/ma-reports" id="" class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100">MA List</a>
            <a href="/create/ma-report" id="" class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100">MA Create</a>
          </li>
        </ul>
      </li>


      <li>
        <button type="button" class="flex items-center w-full p-2 text-base text-gray-900 transition duration-75 rounded-lg group hover:bg-gray-100 " aria-controls="dropdown-service-reports" data-collapse-toggle="dropdown-service-reports">
          <svg class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 group-hover:text-gray-900 " xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
            <path d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm-7 14H8v-2h4v2zm5-4H8v-2h9v2zm0-4H8V7h9v2z" />
          </svg>
          <span class="flex-1 ms-3 text-left rtl:text-right whitespace-nowrap font-bold">Service Reports</span>
          <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4" />
          </svg>
        </button>
        <ul id="dropdown-service-reports" class="hidden py-2 space-y-2">
          <li>
            <a href="/service-reports" class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 ">SR List</a>
          </li>
          <li>
            <a href="/create/service-report" class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 ">Create SR</a>
          </li>
        </ul>
      </li>


    </ul>
  </div>

</aside>