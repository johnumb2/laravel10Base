
        <div class="col-lg-10">
            <img src="https://www.kadencewp.com/wp-content/uploads/2020/10/alogo-4.png" class="header-logo" alt="Logo Placeholder">
        </div>

        <div class="col-lg-2 text-right">

            @if (Auth::check())
                <a href="{{ route('logout') }}">Logout</a>
            @else
                <a href="{{ route('login') }}">Login</a> |
                <a href="{{ route('signup') }}">Signup</a>
            @endif
        </div>
    </div>
</div>
