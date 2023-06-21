<div class="container">
    <header>
        <h1>Issue Tracker Proof of Concept (test deploy 6)</h1>
        <nav>
            <a href="{{ route('getHomeUrl') }}">HOME</a>
            @if (Session::has('logged_in_user'))
                <a href="{{ route('showIssues') }}">ISSUES</a>
                <a href="{{ route('logout') }}">LOGOUT</a>
            @else
                <a href="{{ route('getLoginUrl') }}">LOGIN</a>
                <a href="{{ route('getRegisterUserForm') }}" class="button">CREATE AN ACCOUNT</a>
            @endif
        </nav>
    </header>
