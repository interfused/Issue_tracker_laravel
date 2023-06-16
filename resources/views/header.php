<header>
    <h1>Issue Tracker Proof of Concept</h1>
    <a href="/">HOME</a>
    @if(Session::has('logged_in_user'))
    <a href="/issues">ISSUES</a>
    <a href="/logout">LOGOUT</a>
    @else
    <a href="/login">LOGIN</a>
    @endif
</header>
