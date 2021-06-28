<style>  
  .nav-tabs .nav-link.active, .nav-tabs .nav-item.show .nav-link {
    border-top: none;
    border-left: none;
    border-right: none;
    border-bottom: solid #d84f3e;
    font-weight: bold;
  }

  .nav-tabs .nav-link {
    border-top: none;
    border-left: none;
    border-right: none;
    background-color: #ffffff;
  }

  .nav-tabs .nav-link:hover, .nav-tabs .nav-link:focus {
    border-bottom: solid #d84f3e;
  }
</style>
<div class="row">
  <div class="col-12 grid-margin stretch-card">             
    <div class="card">
      <div class="card-body">
        {{-- <div class="py-2 border-top border-bottom"> --}}
          <ul class="nav nav-tabs">
            @if ( (Request::is('admin/reporting/pscabut')) || (Request::is('admin/reporting/ct0')) ) 
              <li class="nav-item">
                <a class="nav-link {{ request()->is('admin/reporting/pscabut') ? 'active' : '' }}" href="{{ route('admin.reporting.pscabut') }}">                
                  Churn 
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link {{ request()->is('admin/reporting/ct0') ? 'active' : '' }}" href="{{ route('admin.reporting.ct0') }}">                
                  Length Of Stay
                </a>
              </li>  
              
            @elseif ((Request::is('admin/performance/ped')) || (Request::is('admin/performance/pda')))
            <li class="nav-item">
              <a class="nav-link {{ request()->is('admin/performance/ped') ? 'active' : '' }}" href="{{ route('admin.performance.ped') }}">                
                ADDON
              </a>
            </li> 
            <li class="nav-item">
              <a class="nav-link {{ request()->is('admin/performance/pda') ? 'active' : '' }}" href="{{ route('admin.performance.pda') }}">                
                PDA
              </a>
            </li> 
            @elseif ( (Request::is('admin/reporting/performaddon')) || (Request::is('admin/reporting/sfgopro')) || (Request::is('admin/performance/provisioning')) || (Request::is('admin/reporting/achaddon')) || (Request::is('admin/performance/addon')) )
              <li class="nav-item">
                <a class="nav-link {{ request()->is('admin/performance/provisioning') ? 'active' : '' }}" href="{{ route('admin.performance.provisioning') }}">                
                  Provisioning
                </a>
              </li> 
              <li class="nav-item">
                <a class="nav-link {{ request()->is('admin/reporting/performaddon') ? 'active' : '' }} " href="{{ route('admin.reporting.performaddon') }}">                
                  Addon 
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link {{ request()->is('admin/reporting/sfgopro') ? 'active' : '' }}" href="{{ route('admin.reporting.sfgopro') }}">                
                  SF GoPro
                </a>
              </li> 
              <li class="nav-item">
                <a class="nav-link {{ request()->is('admin/reporting/achaddon') ? 'active' : '' }}" href="{{ route('admin.reporting.achaddon') }}">                
                  Ach Addon
                </a>
              </li> 
              <li class="nav-item">
                <a class="nav-link {{ request()->is('admin/performance/addon') ? 'active' : '' }}" href="{{ route('admin.performance.addon') }}">                
                  Report Addon
                </a>
              </li> 
            @else
              <li class="nav-item">
                <a class="nav-link {{ request()->is('admin/performance/provisioning/plasa') ? 'active' : '' }}" href="{{ route('admin.performance.provisioning_plasa') }}">                
                  Provisioning Plasa
                </a>
              </li> 
              <li class="nav-item">
                <a class="nav-link {{ request()->is('admin/performance/plasa/rekapwitel') ? 'active' : '' }} " href="{{ route('admin.performance.plasa_rekapwitel') }}">                
                  CSR Plasa 
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link {{ request()->is('admin/reporting/plasa') ? 'active' : '' }} " href="{{ route('admin.reporting.plasa') }}">                
                  Ach Plasa
                </a>
              </li>
            @endif
          </ul>
        {{-- </div> --}}
      </div>
    </div>
  </div>
</div>