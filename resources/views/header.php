<header>
    <h1>Issue Tracker Proof of Concept</h1>
    <a href="{{ route('getHomeUrl') }}">HOME</a>
    @if(Session::has('logged_in_user'))
    <a href="{{ route('showIssues') }}">ISSUES</a>
    <a href="{{ route('logout') }}">LOGOUT</a>
    @else
    <a href="{{ route('getLoginUrl') }}">LOGIN</a>
    @endif
</header>