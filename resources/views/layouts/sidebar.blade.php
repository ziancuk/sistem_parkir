<!-- Sidenav -->
<nav class="sidenav navbar navbar-vertical  fixed-left  navbar-expand-xs navbar-light bg-white" id="sidenav-main">
    <div class="scrollbar-inner">
        <!-- Brand -->
        <div class="sidenav-header text-center ml-2 mt-4    ">
            <i class="fas fa-parking fa-4x text-secondary"></i>
            <br>
            <strong class="text-muted" style="font-size: 19px;">Sistem Parkir</strong>
        </div>
        <div class="navbar-inner mt-3">
            <!-- Collapse -->
            <div class="collapse navbar-collapse" id="sidenav-collapse-main">
                <!-- Nav items -->
                <hr class="my-3">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('dashboard') ? 'active' : '' }}" href="/dashboard">
                            <i class="fas fa-home text-primary"></i>
                            <span class="nav-link-text">Dashboard</span>
                        </a>
                    </li>
                    @if(Auth::user()->role == '1')
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('masterUser') ? 'active' :''}}" href="/master/user">
                            <i class="fas fa-database text-primary"></i>
                            <span class="nav-link-text">Master Data</span>
                        </a>
                    </li>
                    @endif
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('parkirMasuk') ? 'active':''}}" href="/parkir/masuk">
                            <i class="fas fa-parking text-primary"></i>
                            <span class="nav-link-text">Parkir</span>
                        </a>
                    </li>
                    @if(Auth::user()->role == '1')
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('report') ? 'active':''}}" href="/report">
                            <i class="fas fa-clipboard-list text-primary"></i>
                            <span class="nav-link-text">Laporan</span>
                        </a>
                    </li>
                    @endif
                </ul>
                <!-- Divider -->
                <hr class="my-3">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="/logout">
                            <i class="fas fa-sign-out-alt text-danger"></i>
                            <span class="nav-link-text">Logout</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>