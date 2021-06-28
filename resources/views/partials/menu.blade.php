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
            <i class="mdi mdi-shield-half-full menu-icon"></i>
            <span class="menu-title">Dashboard</span>
        </a>
    </li>
    @can('prospect_access')
    <li class="nav-item {{ request()->is('admin.prospect.index') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('admin.prospect.index') }}">
            <i class="mdi mdi-puzzle menu-icon"></i>
            <span class="menu-title">Smartprofile</span>
        </a>
    </li>
    @endcan
    @can('user_management_access')
    <li class="nav-item">
        <a class="nav-link" data-toggle="collapse" href="#auth" aria-expanded="false" aria-controls="auth">
            <i class="mdi mdi-account-circle menu-icon"></i>
            <span class="menu-title">{{ trans('cruds.userManagement.title') }}</span>
            <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="auth">
            <ul class="nav flex-column sub-menu">
                @can('permission_access')
                <li class="nav-item {{ request()->is('admin/permissions') || request()->is('admin/permissions/*') ? 'active' : '' }}"> <a class="nav-link" href="{{ route('admin.permissions.index') }}"> {{ trans('cruds.permission.title') }} </a></li>
                @endcan
                @can('role_access')
                <li class="nav-item {{ request()->is('admin/roles') || request()->is('admin/roles/*') ? 'active' : '' }}"> <a class="nav-link" href="{{ route('admin.roles.index') }}"> {{ trans('cruds.role.title') }} </a></li>
                @endcan
                @can('user_access')
                <li class="nav-item {{ request()->is('admin/users') || request()->is('admin/users/*') ? 'active' : '' }}"> <a class="nav-link" href="{{ route('admin.users.index') }}"> {{ trans('cruds.user.title') }} </a></li>
                @endcan
                @can('audit_log_access')
                <li class="nav-item {{ request()->is('admin/audit-logs') || request()->is('admin/audit-logs/*') ? 'active' : '' }}"> <a class="nav-link" href="{{ route('admin.audit-logs.index') }}"> {{ trans('cruds.auditLog.title') }} </a></li>
                @endcan
                @can('user_alert_access')
                <li class="nav-item {{ request()->is('admin/user-alerts') || request()->is('admin/user-alerts/*') ? 'active' : '' }}"> <a class="nav-link" href="{{ route('admin.user-alerts.index') }}"> {{ trans('cruds.userAlert.title') }} </a></li>
                @endcan
            </ul>
        </div>
    </li>
    @endcan
    @can('report_access')
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#charts" aria-expanded="false" aria-controls="charts">
                <i class="mdi mdi-poll menu-icon"></i>
                <span class="menu-title">Performansi</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="charts">
                <ul class="nav flex-column sub-menu">
                    @can('reporting_customer')
                    <li class="nav-item {{ request()->is('admin/reporting/pscabut') || request()->is('admin/reporting/ct0') ? 'active' : '' }}"> <a class="nav-link" href="{{ route('admin.reporting.pscabut') }}"> {{ "CRM" }} </a></li>                
                    <li class="nav-item {{ request()->is('admin/reporting/performaddon') || request()->is('admin/reporting/performaddon') || request()->is('admin/performance/provisioning') || request()->is('admin/reporting/achaddon') || request()->is('admin/performance/addon') ? 'active' : '' }}"> <a class="nav-link" href="{{ route('admin.performance.provisioning') }}"> {{ "CRL" }} </a></li>                
                    <li class="nav-item {{ request()->is('admin/reporting/plasa') || request()->is('admin/performance/provisioning/plasa') || request()->is('admin/reporting/rekapwitel') ? 'active' : '' }}"> <a class="nav-link" href="{{ route('admin.performance.provisioning_plasa') }}"> {{ "CTP" }} </a></li>                
                    {{-- <li class="nav-item {{ request()->is('admin/reporting/achaddon') ? 'active' : '' }}"> <a class="nav-link" href="{{ route('admin.reporting.achaddon') }}"> {{ "Ach Addon Bulanan" }} </a></li>
                    <li class="nav-item {{ request()->is('admin/performance/addon') ? 'active' : '' }}"> <a class="nav-link" href="{{ route('admin.performance.addon') }}"> {{ "Report Addon Bulanan" }} </a></li> --}}
                    @endcan
                </ul>
            </div>
        </li>

        {{-- <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#crm" aria-expanded="false" aria-controls="crm">
                <i class="mdi mdi-account-multiple menu-icon"></i>
                <span class="menu-title">CRM</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="crm">
                <ul class="nav flex-column sub-menu">
                    @can('reporting_customer')
                    <li class="nav-item {{ request()->is('admin/reporting/pscabut') || request()->is('admin/reporting/pscabut/*') ? 'active' : '' }}"> <a class="nav-link" href="{{ route('admin.reporting.pscabut') }}"> {{ "Churn" }} </a></li>                
                    <li class="nav-item {{ request()->is('admin/reporting/ct0') || request()->is('admin/reporting/ct0/*') ? 'active' : '' }}"> <a class="nav-link" href="{{ route('admin.reporting.ct0') }}"> {{ "Length of Stay" }} </a></li>              
                    @endcan
                </ul>
            </div>
        </li> --}}

        {{-- <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#crl" aria-expanded="false" aria-controls="crl">
                <i class="mdi mdi-view-grid menu-icon"></i>
                <span class="menu-title">CRL</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="crl">
                <ul class="nav flex-column sub-menu">
                    @can('reporting_customer')                
                    <li class="nav-item {{ request()->is('admin/reporting/performaddon') || request()->is('admin/reporting/performaddon/*') ? 'active' : '' }}"> <a class="nav-link" href="{{ route('admin.reporting.performaddon') }}"> {{ "Addon" }} </a></li>                
                    <li class="nav-item {{ request()->is('admin/reporting/salesaddon') || request()->is('admin/reporting/salesaddon/*') ? 'active' : '' }}"> <a class="nav-link" href="{{ route('admin.reporting.salesaddon') }}"> {{ "SF Gopro" }} </a></li>                
                    <li class="nav-item {{ request()->is('admin/performance/provisioning') ? 'active' : '' }}"> <a class="nav-link" href="{{ route('admin.performance.provisioning') }}"> {{ "Provisioning" }} </a></li>                
                    @endcan
                </ul>
            </div>
        </li> --}}

        {{-- <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#ctp" aria-expanded="false" aria-controls="ctp">
                <i class="mdi mdi-houzz menu-icon"></i>
                <span class="menu-title">CTP</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ctp">
                <ul class="nav flex-column sub-menu">
                    @can('reporting_customer')               
                    <li class="nav-item {{ request()->is('admin/reporting/plasa') || request()->is('admin/reporting/plasa/*') ? 'active' : '' }}"> <a class="nav-link" href="{{ route('admin.reporting.plasa') }}"> {{ "Plasa" }} </a></li>                                                
                    <li class="nav-item {{ request()->is('admin/performance/provisioning/plasa') ? 'active' : '' }}"> <a class="nav-link" href="{{ route('admin.performance.provisioning_plasa') }}"> {{ "Provisioning Plasa" }} </a></li>
                    @endcan
                </ul>
            </div>
        </li> --}}
    @endcan

    @can('management_customer')
    <li class="nav-item {{ request()->is('admin/masterData*') ? 'active' : '' }} {{ request()->is('admin/customer-location') ? 'active' : '' }}">
        <a class="nav-link" data-toggle="collapse" href="#managementPelanggan" aria-expanded="false" aria-controls="managementPelanggan">
            <i class="mdi mdi-account-search menu-icon"></i>
            <span class="menu-title">{{ trans('cruds.manajemen_pelanggan.title') }}</span>
            <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="managementPelanggan">
            <ul class="nav flex-column sub-menu">
                @can('master_treg_access')
                <li class="nav-item {{ request()->is('admin/masterData') ? 'active' : '' }}"> <a class="nav-link" href="{{ route('admin.masterData.index') }}"> {{ "Cari Data Pelanggan" }} </a></li>
                <li class="nav-item {{ request()->is('admin/customer/assets') ? 'active' : '' }}"> <a class="nav-link" href="{{ route('admin.customer.assets') }}"> {{ "Cari Asset Pelanggan" }} </a></li>
                <li class="nav-item {{ request()->is('admin/customer/history-provisioning') ? 'active' : '' }}"> <a class="nav-link" href="{{ route('admin.customer.histProvisioning') }}"> {{ "Query Hist Provisioning" }} </a></li>
                @endcan
                @can('prospect_access')
                <li class="nav-item {{ request()->is('admin/customer-location') || request()->is('admin/customer-location*') ? 'active' : '' }}"> <a class="nav-link" href="{{ route('admin.location.customer') }}"> {{ trans('cruds.location.title') }} </a></li>
                <li class="nav-item {{ request()->is('admin/customer-location-dapros') || request()->is('admin/customer-location-dapros*') ? 'active' : '' }}"> <a class="nav-link" href="{{ route('admin.location.customerDapros') }}"> Pelanggan Dapros </a></li>
                @endcan
            </ul>
        </div>
    </li>
    @endcan
    @can('master_data_access')
    <li class="nav-item">
        <a class="nav-link" data-toggle="collapse" href="#masterDataRegional" aria-expanded="false" aria-controls="masterDataRegional">
            <i class="mdi mdi-database menu-icon"></i>
            <span class="menu-title">{{ trans('cruds.masterData.title') }}</span>
            <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="masterDataRegional">
            <ul class="nav flex-column sub-menu">
                @can('regional_access')
                <li class="nav-item {{ request()->is('admin/regionals') || request()->is('admin/regionals*') ? 'active' : '' }}"> <a class="nav-link" href="{{ route('admin.regionals.index') }}"> {{ trans('cruds.regional.title') }} </a></li>
                @endcan
                @can('witel_access')
                <li class="nav-item {{ request()->is('admin/witels') || request()->is('admin/witels*') ? 'active' : '' }}"> <a class="nav-link" href="{{ route('admin.witels.index') }}"> {{ trans('cruds.witel.title') }} </a></li>
                @endcan
            </ul>
        </div>
    </li>
    @endcan
    @can('racing_access')
    <li class="nav-item {{ request()->is('admin/performance/racing_mic') ? 'active' : '' }}">
        <a class="nav-link" data-toggle="collapse" href="#racing" aria-expanded="false" aria-controls="racing">
            <i class="mdi mdi-star menu-icon"></i>
            <span class="menu-title">{{ "Racing" }}</span>
            <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="racing">
            <ul class="nav flex-column sub-menu">                
                <li class="nav-item {{ request()->is('admin/performance/racing_mic') ? 'active' : '' }}"> <a class="nav-link" href="{{ route('admin.performance.racing_mic') }}"> {{ "Racing SVM"}} </a></li>                    
            </ul>
        </div>
    </li>
    @endcan
    @can('report_access')
    <li class="nav-item {{ request()->is('admin/reporting/arpu') || request()->is('admin/reporting/mig2p3p') || request()->is('admin/reporting/speed') ? 'active' : '' }}">
        @can('reporting_customer')
            <a class="nav-link" data-toggle="collapse" href="#reportingCustomer" aria-expanded="false" aria-controls="reportingCustomer">
                <i class="mdi mdi-file-chart menu-icon"></i>
                <span class="menu-title">{{ "Reporting Customer" }}</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="reportingCustomer">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item {{ request()->is('admin/reporting/arpu') || request()->is('admin/reporting/arpu*') ? 'active' : '' }}"> <a class="nav-link" href="{{ route('admin.reporting.arpu') }}"> {{ trans('cruds.arpu.title') }} </a></li>
                    <li class="nav-item {{ request()->is('admin/reporting/mig2p3p') || request()->is('admin/reporting/mig2p3p*') ? 'active' : '' }}"> <a class="nav-link" href="{{ route('admin.reporting.mig2p3p') }}"> {{ trans('cruds.mig2p3p.title') }} </a></li>
                    <li class="nav-item {{ request()->is('admin/reporting/speed') || request()->is('admin/reporting/speed*') ? 'active' : '' }}"> <a class="nav-link" href="{{ route('admin.reporting.speed') }}"> {{ "Speed Inet" }} </a></li>
                </ul>
            </div>
        @endcan
    </li>
    @endcan
    @can('dapros_crm_access')
    <li class="nav-item {{ request()->is('admin/dapros-ct0') || request()->is('admin/reporting/edukasi-pelanggan') ? 'active' : '' }}">
        <a class="nav-link" data-toggle="collapse" href="#daprosCrm" aria-expanded="false" aria-controls="daprosCrm">
            <i class="mdi mdi-file-document menu-icon"></i>
            <span class="menu-title">{{ "Dapros CRM" }}</span>
            <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="daprosCrm">
            <ul class="nav flex-column sub-menu">
                {{-- @can('caring_ct0_access')
                <li class="nav-item {{ request()->is('admin/caring-ct0') || request()->is('admin/caring-ct0*') ? 'active' : '' }}"> <a class="nav-link" href="{{ route('admin.caring-ct0.index') }}"> {{ "Caring CT0"}} </a></li>
                @endcan --}}
                @can('edukasi_pelanggan_access')
                <li class="nav-item {{ request()->is('admin/edukasi-pelanggan/edukasi') || request()->is('admin/edukasi-pelanggan*') ? 'active' : '' }}"> <a class="nav-link" href="{{ route('admin.edukasi-pelanggan.edukasi') }}"> {{ "Edukasi Pelanggan" }} </a></li>
                @endcan
            </ul>
        </div>
    </li>
    @endcan
    @can('report_ped_access')
    <li class="nav-item {{ request()->is('admin.performance.ped') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('admin.performance.ped') }}">
            <i class="mdi mdi-book-multiple-variant menu-icon"></i>
            <span class="menu-title">Rekon Pembayaran PED</span>
        </a>
    </li>
    @endcan
    
    @php($unread = \App\Models\QaTopic::unreadCount())
    <li class="nav-item {{ request()->is('admin/messenger') || request()->is('admin/messenger/*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('admin.messenger.index') }}">
            <i class="mdi mdi-email menu-icon"></i>
            <span class="menu-title">{{ trans('global.messages') }}</span>
            @if($unread > 0)
            <strong>( {{ $unread }} )</strong>
            @endif
        </a>
    </li>
    @if(file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php')))
        @can('profile_password_edit')
        <li class="nav-item {{ request()->is('profile/password') || request()->is('profile/password/*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('profile.password.edit') }}">
                <i class="mdi mdi-lock menu-icon"></i>
                <span class="menu-title">{{ trans('global.change_password') }}</span>
            </a>
        </li>
        @endcan
    @endif
</ul>
<!-- END DATAVIZUI SIDEBAR -->