<ul class="flex flex-col md:flex-row px-4">
    @if(auth()->check())
        <li>
            <a href="/tsg" class="block py-2 pr-4 pl-3">TSG Users</a>
        </li>
        <li>
            <a href="/service-reports" class="block py-2 pr-4 pl-3">Service Report List</a>
        </li>
        <li>
            <form action="/logout" method="POST">
                @csrf
                <button class="block py-2 pr-4 pl-3">Logout</button>
            </form>
        </li>
    @else
        <li>
            <a href="/login" class="block py-2 pr-4 pl-3">Sign in</a>
        </li>
        <li>
            <a href="/register" class="block py-2 pr-4 pl-3">Sign up</a>
        </li>
    @endif
</ul>
