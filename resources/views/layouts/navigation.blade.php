<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

        <li class="nav-item">
            <a class="nav-link " href="{{route('dashboard')}}">
                <i class="bi bi-grid"></i>
                <span>Dashboard</span>
            </a>
        </li>

        @if (Auth::user()->hasRole('admin'))
            <li class="nav-item">
                <a class="nav-link collapsed" href="{{route('admin-types')}}">
                    <i class="bi bi-aspect-ratio"></i>
                    <span>Areas</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="{{route('admin-houses')}}">
                    <i class="bi bi-house"></i>
                    <span>House Holds</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="{{route('admin-applications')}}">
                    <i class="bi bi-clipboard"></i>
                    <span>Applications</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="{{route('admin-transactions')}}">
                    <i class="bi bi-bookmarks"></i>
                    <span>Transactions</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="{{route('admin-suggestions')}}">
                    <i class="bi bi-stickies"></i>
                    <span>Suggestions</span>
                </a>
            </li>
        @elseif (Auth::user()->hasRole('user'))
            <li class="nav-item">
                <a class="nav-link collapsed" href="{{route('user-stands')}}">
                    <i class="bi bi-house"></i>
                    <span>Stands</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="{{route('user-suggestions')}}">
                    <i class="bi bi-stickies"></i>
                    <span>Suggestions</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="{{route('user-applications')}}">
                    <i class="bi bi-clipboard"></i>
                    <span>Applications</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="{{route('user-transactions')}}">
                    <i class="bi bi-bookmarks"></i>
                    <span>Invoice</span>
                </a>
            </li>
        @endif
        <li class="nav-item">
            <form id="logout-form" action="{{ route('logout') }}" method="POST">
                @csrf
            </form>
            <a class="nav-link collapsed" href="#" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                <i class="bi bi-lock"></i>
                <span>Logout</span>
            </a>
        </li>
    </ul>

</aside><!-- End Sidebar-->
