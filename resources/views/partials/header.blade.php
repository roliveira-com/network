<nav class="navbar is-transparent">
    <div class="navbar-brand">
    <a class="navbar-item" href="{{ route('dashboard') }}">
            <img src="/image/logo/logo.png" alt="Network - A place to connect" height="28">
        </a>
        <div class="navbar-burger burger" data-target="main-nav">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </div>

    <div id="main-nav" class="navbar-menu">
        <div class="navbar-start">
            <a class="navbar-item" href="/">option</a>
            <a class="navbar-item" href="/">option</a>
        </div>

        <div class="navbar-end">
            @if (Auth::user())
            <div class="navbar-item">
                <div class="field is-grouped">
                    <p class="control">
                    <a href="{{ route('profile') }}" class="button is-default">Olá, {{ Auth::user()->name }}</a>
                    </p>
                    <p class="control">
                        <a class="button is-primary" href="{{ route('logout') }}">Log out</a>
                    </p>
                </div>
            </div>                
            @endif
            {{-- <div class="navbar-item has-dropdown is-hoverable">
                <a class="navbar-link" href="/documentation/overview/start/">
                    option
                </a>
                <div class="navbar-dropdown is-boxed">
                    <a class="navbar-item" href="#">
                        option
                    </a>
                    <a class="navbar-item" href="#">
                        option
                    </a>
                </div>
            </div> --}}
        </div>
    </div>
</nav>