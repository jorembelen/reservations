<nav id="sidebar" class="sidebar">
    <div class="sidebar-content js-simplebar">
        <a class="sidebar-brand" href="/dashboard">
            <h2 class="align-middle mr-3">RCL</h2></a>
        <ul class="sidebar-nav">
            <li class="sidebar-header">
                Pages
            </li>
            <li class="sidebar-item">
                <a href="/dashboard" data-toggle="collapse" class="sidebar-link collapsed" aria-expanded="false">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-sliders align-middle"><line x1="4" y1="21" x2="4" y2="14"></line><line x1="4" y1="10" x2="4" y2="3"></line><line x1="12" y1="21" x2="12" y2="12"></line><line x1="12" y1="8" x2="12" y2="3"></line><line x1="20" y1="21" x2="20" y2="16"></line><line x1="20" y1="12" x2="20" y2="3"></line><line x1="1" y1="14" x2="7" y2="14"></line><line x1="9" y1="8" x2="15" y2="8"></line><line x1="17" y1="16" x2="23" y2="16"></line></svg> <span class="align-middle">Dashboard</span>
                <span class="badge badge-sidebar-primary">2</span>
                </a>
                <ul id="dashboard" class="sidebar-dropdown list-unstyled collapse" data-parent="#sidebar">
                    <li class="sidebar-item"><a class="sidebar-link" href="/dashboard">Dashboard</a></li>
                    
                </ul>
            </li>

            <li class="sidebar-item">
                <a href="#pages" data-toggle="collapse" class="sidebar-link">
                    <i class="align-middle" data-feather="layers"></i> <span class="align-middle">Conference Room</span>
                </a>
                <ul id="pages" class="sidebar-dropdown list-unstyled collapse" data-parent="#sidebar">
                        <li class="sidebar-item"><a class="sidebar-link" href="/rooms">Conference Rooms</a></li>
                        
                    </ul>
                </li>
            <li class="sidebar-item">
                <a href="#res" data-toggle="collapse" class="sidebar-link">
                    <i class="align-middle" data-feather="calendar"></i> <span class="align-middle">Reservations</span>
                </a>
                <ul id="res" class="sidebar-dropdown list-unstyled collapse" data-parent="#sidebar">
                        <li class="sidebar-item"><a class="sidebar-link" href="/reservations">Reservations</a></li>
                        
                    </ul>
                </li>
                @if (auth()->user()->role == 1)            
                <li class="sidebar-item">
                    <a href="#users" data-toggle="collapse" class="sidebar-link">
                        <i class="align-middle" data-feather="users"></i> <span class="align-middle">Users</span>
                    </a>
                    <ul id="users" class="sidebar-dropdown list-unstyled collapse" data-parent="#sidebar">
                            <li class="sidebar-item"><a class="sidebar-link" href="/users">Users</a></li>
                            
                        </ul>
                    </li>
                @endif
    </div>
</nav>