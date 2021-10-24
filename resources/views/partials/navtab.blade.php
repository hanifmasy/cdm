<style>
  .nav-tabs .nav-link.active,
  .nav-tabs .nav-item.show .nav-link {
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

  .nav-tabs .nav-link:hover,
  .nav-tabs .nav-link:focus {
    border-bottom: solid #d84f3e;
  }
</style>
<div class="row">
  <div class="col-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        {{-- <div class="py-2 border-top border-bottom"> --}}
        <ul class="nav nav-tabs">

          @if ( (Request::is('admin/pra-npc')) || (Request::is('admin/pra-pra-npc')) )
          <li class="nav-item">
            <a class="nav-link {{ request()->is('admin/pra-npc') ? 'active' : '' }}" href="{{ route('admin.pra_npc') }}">
              Pra NPC
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ request()->is('admin/pra-pra-npc') ? 'active' : '' }}" href="{{ route('admin.pra_pra_npc') }}">
              Pra Pra NPC
            </a>
          </li>
          @endif
        </ul>
        {{-- </div> --}}
      </div>
    </div>
  </div>
</div>
