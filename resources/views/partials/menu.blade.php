<div class="sidebar-profile">
    <div class="d-flex align-items-center justify-content-between">
        {{-- <img src="https://via.placeholder.com/37x37" alt="profile"> --}}
        {{-- <i class="mdi mdi-account-circle menu-icon" style="font-size: 40px"></i> --}}
        <div class="profile-desc">
            <p class="name mb-0" style="color: black">{{ Auth::user()->username }}</p>
            <p class="designation mb-0" style="color: black">{{ "Admin" }} </p>
        </div>
    </div>
</div>
<ul class="nav">
    <li class="nav-item {{ request()->is('admin.dashboard') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('admin.dashboard') }}">
            <i class="mdi mdi-home menu-icon"></i>
            <span class="menu-title">Dashboard</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" data-toggle="collapse" href="#auth" aria-expanded="false" aria-controls="auth">
            <i class="mdi mdi-trending-up menu-icon"></i>
            <span class="menu-title">Epic</span>
            <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="auth">
            <ul class="nav flex-column sub-menu">
                <li class="nav-item {{ request()->is('admin/pra-npc') || request()->is('admin/pra-npc/*') ? 'active' : '' }}"> <a class="nav-link" href="{{ route('admin.pra_npc') }}">Pra NPC</a></li>
                <li class="nav-item {{ request()->is('admin/pra-pra-npc') || request()->is('admin/pra-pra-npc/*') ? 'active' : '' }}"> <a class="nav-link" href="{{ route('admin.pra_pra_npc') }}">Pra Pra NPC</a></li>
            </ul>
        </div>
    </li>
</ul>
<!-- END DATAVIZUI SIDEBAR -->
