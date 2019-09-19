@if (Auth::guard('web')->check())
    <p class="text-success">You are logged in as <b>User</b></p>
    <p><a href="{{ route('user.profile') }}">HOME</a></p>
    <p><a href="{{ route('user.logout') }}">Logout as USER</a></p>
@else
    <p class="text-danger">You are logged out as <b>User</b></p>
    <p><a href="{{ route('login') }}">Login as USER</a></p>
    <p><a href="{{ route('register') }}">Register as USER</a></p>
@endif

@if (Auth::guard('admin')->check())
    <p class="text-success">You are logged in as <b>Admin</b></p>
    <p><a href="{{ route('panel.dashboard') }}">PANEL</a></p>
    <p><a href="{{ route('panel.logout') }}">Logout as ADMIN</a></p>
@else
    <p class="text-danger">You are logged out as <b>Admin</b></p>
    <p><a href="{{ route('panel.login') }}">Login as ADMIN</a></p>
@endif
