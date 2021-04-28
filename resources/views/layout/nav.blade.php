<nav class="p-6 bg-white flex justify-between text-xl font-medium ">
    <ul class="flex items-center">
        <li><a class="p-3" href="/">Todo App</a></li>
    </ul>

    <ul class="flex items-center">
        @auth
            <li><a class="p-3" href="/login">{{auth()->user()->name}}</a></li>
            <li><a class="p-3" href="/logout">Logout</a></li>
        @endauth

        @guest
            <li><a class="p-3" href="/login">Login</a></li>
            <li><a class="p-3" href="/register">Register</a></li>
        @endguest
    </ul>
</nav>