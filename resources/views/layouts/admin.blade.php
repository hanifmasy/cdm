<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ trans('panel.site_title') }}</title>
    <!-- base:css -->
    <link rel="stylesheet" href="{{ asset('public/css/materialdesignicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/css/flag-icon.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/css/vendor.bundle.base.css') }}">
    <link rel="stylesheet" href="{{ asset('public/css/bootstrap-datepicker.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/css/select2.min.css') }}">
    <!-- endinject -->
    <!-- plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- <link rel="stylesheet" id="theme" href="{{ asset('public/css/style.css') }}"> -->
    <link rel="stylesheet" id="theme" href="{{ asset('public/css/style-light.css') }}">
    <!-- endinject -->
    <link rel="shortcut icon" href="{{ asset('public/img/simbol-mini.png') }}" />   
    @yield('styles')
</head>
<body class="sidebar-icon-only">
  <div class="container-scroller">
    <!-- partial:../../partials/_navbar.html -->
    <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
      <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
        <a class="navbar-brand brand-logo" href="{{ route('admin.dashboard') }}"><img src="{{ asset('public/img/simbol.png') }}"
            alt="logo" /></a>
        <a class="navbar-brand brand-logo-mini" href="{{ route('admin.dashboard') }}"><img src="{{ asset('public/img/simbol-mini.png') }}"
            alt="logo" /></a>
      </div>
      <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
        <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
          <span class="mdi mdi-menu"></span>
        </button>
        <ul class="navbar-nav navbar-nav-left">
          <li class="nav-item d-none d-lg-block">
            <div class="btn-group mr-3">
              <button type="button" class="btn btn-light">{{ date("j F Y") }}</button>
            </div>
          </li> 
          {{-- <li class="nav-item d-none d-lg-block">
            <a href="#" class="nav-link">
              <p>Purchases</p>
            </a>
          </li>
          <li class="nav-item d-none d-lg-block">
            <a href="#" class="nav-link">
              <p>My status</p>
            </a>
          </li> --}}
        </ul>
        
        <ul class="navbar-nav navbar-nav-right">
          {{-- <li class="nav-item nav-search d-none d-lg-block">
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text" id="search">
                  <i class="mdi mdi-magnify"></i>
                </span>
              </div>
              <input type="text" class="form-control" placeholder="Type to search" aria-label="search"
                aria-describedby="search">
            </div>
          </li> --}}
          
          {{-- <li class="nav-item dropdown">
            <a class="nav-link count-indicator dropdown-toggle d-flex align-items-center justify-content-center"
              id="notificationDropdown" href="#" data-toggle="dropdown">
              <i class="mdi mdi-bell-outline mx-0"></i>
              @php($alertsCount = \Auth::user()->userUserAlerts()->where('read', false)->count())
              @if($alertsCount > 0)
                  <span class="count badge badge-warning navbar-badge">
                      {{ $alertsCount }}
                  </span>
              @endif
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list"
              aria-labelledby="notificationDropdown">
              <p class="mb-0 font-weight-normal float-left dropdown-header">Notifications</p>
              @if(count($alerts = \Auth::user()->userUserAlerts()->withPivot('read')->limit(10)->orderBy('created_at', 'ASC')->get()->reverse()) > 0)
                @foreach($alerts as $alert)
                    <a class="dropdown-item preview-item" href="{{ $alert->alert_link ? $alert->alert_link : "#" }}" target="_blank" rel="noopener noreferrer">
                      <div class="preview-thumbnail">
                        <div class="preview-icon bg-info">
                          <i class="mdi mdi-account-box mx-0"></i>
                        </div>
                      </div>
                      <div class="preview-item-content">
                        <h6 class="preview-subject font-weight-normal">
                        @if($alert->pivot->read === 0) <strong> @endif
                          {{ $alert->alert_text }}
                        @if($alert->pivot->read === 0) </strong> @endif
                        </h6>
                        <p class="font-weight-light small-text mb-0">
                          2 days ago
                        </p>
                      </div>
                    </a>
                @endforeach
              @else
                <a class="dropdown-item preview-item">
                  <div class="preview-thumbnail">
                    <div class="preview-icon bg-info">
                      <i class="mdi mdi-account-box mx-0"></i>
                    </div>
                  </div>
                  <div class="preview-item-content">
                    <h6 class="preview-subject font-weight-normal">
                    {{ trans('global.no_alerts') }}
                    </h6>
                    <p class="font-weight-light small-text mb-0">
                      Just now
                    </p>
                  </div>
                </a>
              @endif
            </div>
          </li> --}}
          {{-- <li class="nav-item dropdown">
            <a class="nav-link count-indicator dropdown-toggle d-flex justify-content-center align-items-center"
              id="messageDropdown" href="#" data-toggle="dropdown">
              <i class="mdi mdi-email-outline mx-0"></i>
              <span class="count"></span>
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list"
              aria-labelledby="messageDropdown">
              <p class="mb-0 font-weight-normal float-left dropdown-header">Messages</p>
              <a class="dropdown-item preview-item">
                <div class="preview-thumbnail">
                  <img src="https://via.placeholder.com/36x36" alt="image" class="profile-pic">
                </div>
                <div class="preview-item-content flex-grow">
                  <h6 class="preview-subject ellipsis font-weight-normal">David Grey
                  </h6>
                  <p class="font-weight-light small-text mb-0">
                    The meeting is cancelled
                  </p>
                </div>
              </a>
              <a class="dropdown-item preview-item">
                <div class="preview-thumbnail">
                  <img src="https://via.placeholder.com/36x36" alt="image" class="profile-pic">
                </div>
                <div class="preview-item-content flex-grow">
                  <h6 class="preview-subject ellipsis font-weight-normal">Tim Cook
                  </h6>
                  <p class="font-weight-light small-text mb-0">
                    New product launch
                  </p>
                </div>
              </a>
              <a class="dropdown-item preview-item">
                <div class="preview-thumbnail">
                  <img src="https://via.placeholder.com/36x36" alt="image" class="profile-pic">
                </div>
                <div class="preview-item-content flex-grow">
                  <h6 class="preview-subject ellipsis font-weight-normal"> Johnson
                  </h6>
                  <p class="font-weight-light small-text mb-0">
                    Upcoming board meeting
                  </p>
                </div>
              </a>
            </div>
          </li> --}}
          <li class="nav-item dropdown">
            <button type="button" class="btn btn-light btn-sm" onclick="themeToggle()"><i id="icontheme" class="mdi mdi-theme-light-dark"></i></button>
          </li>
          <li class="nav-item nav-profile dropdown">
            <a class="nav-link" href="#" data-toggle="dropdown" id="profileDropdown">
              {{-- <img src="https://via.placeholder.com/31x31" alt="profile" /> --}}
              <i class="mdi mdi-dots-horizontal" style="font-size: 23px"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
              <a class="dropdown-item">
                <i class="mdi mdi-settings text-primary"></i>
                Settings
              </a>
              <a class="dropdown-item" onclick="event.preventDefault(); document.getElementById('logoutform').submit();">
                <i class="mdi mdi-logout text-primary"></i>
                {{ trans('global.logout') }}
              </a>
            </div>
          </li>
          {{-- <li class="nav-item nav-settings d-none d-lg-flex">
            <a class="nav-link" href="#">
              <i class="mdi mdi-dots-horizontal"></i>
            </a>
          </li> --}}
        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button"
          data-toggle="offcanvas">
          <span class="mdi mdi-menu"></span>
        </button>
      </div>
    </nav>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <!-- partial:../../partials/_settings-panel.html -->
      <div id="right-sidebar" class="settings-panel">
        <i class="settings-close mdi mdi-close"></i>
        <ul class="nav nav-tabs" id="setting-panel" role="tablist">
          <li class="nav-item">
            <a class="nav-link active" id="todo-tab" data-toggle="tab" href="#todo-section" role="tab"
              aria-controls="todo-section" aria-expanded="true">TO DO LIST</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="chats-tab" data-toggle="tab" href="#chats-section" role="tab"
              aria-controls="chats-section">CHATS</a>
          </li>
        </ul>
        <div class="tab-content" id="setting-content">
          <div class="tab-pane fade show active scroll-wrapper" id="todo-section" role="tabpanel"
            aria-labelledby="todo-section">
            <div class="add-items d-flex px-3 mb-0">
              <form class="form w-100">
                <div class="form-group d-flex">
                  <input type="text" class="form-control todo-list-input" placeholder="Add To-do">
                  <button type="submit" class="add btn btn-primary todo-list-add-btn" id="add-task">Add</button>
                </div>
              </form>
            </div>
            <div class="list-wrapper px-3">
              <ul class="d-flex flex-column-reverse todo-list">
                <li>
                  <div class="form-check">
                    <label class="form-check-label">
                      <input class="checkbox" type="checkbox">
                      Team review meeting at 3.00 PM
                    </label>
                  </div>
                  <i class="remove mdi mdi-close-circle-outline"></i>
                </li>
                <li>
                  <div class="form-check">
                    <label class="form-check-label">
                      <input class="checkbox" type="checkbox">
                      Prepare for presentation
                    </label>
                  </div>
                  <i class="remove mdi mdi-close-circle-outline"></i>
                </li>
                <li>
                  <div class="form-check">
                    <label class="form-check-label">
                      <input class="checkbox" type="checkbox">
                      Resolve all the low priority tickets due today
                    </label>
                  </div>
                  <i class="remove mdi mdi-close-circle-outline"></i>
                </li>
                <li class="completed">
                  <div class="form-check">
                    <label class="form-check-label">
                      <input class="checkbox" type="checkbox" checked>
                      Schedule meeting for next week
                    </label>
                  </div>
                  <i class="remove mdi mdi-close-circle-outline"></i>
                </li>
                <li class="completed">
                  <div class="form-check">
                    <label class="form-check-label">
                      <input class="checkbox" type="checkbox" checked>
                      Project review
                    </label>
                  </div>
                  <i class="remove mdi mdi-close-circle-outline"></i>
                </li>
              </ul>
            </div>
            <div class="events py-4 border-bottom px-3">
              <div class="wrapper d-flex mb-2">
                <i class="mdi mdi-circle-outline text-primary mr-2"></i>
                <span>Feb 11 2018</span>
              </div>
              <p class="mb-0 font-weight-thin">Creating component page</p>
              <p class="mb-0">build a js based app</p>
            </div>
            <div class="events pt-4 px-3">
              <div class="wrapper d-flex mb-2">
                <i class="mdi mdi-circle-outline text-primary mr-2"></i>
                <span>Feb 7 2018</span>
              </div>
              <p class="mb-0 font-weight-thin">Meeting with Alisa</p>
              <p class="mb-0">Call Sarah Graves</p>
            </div>
          </div>
          <!-- To do section tab ends -->
          <div class="tab-pane fade" id="chats-section" role="tabpanel" aria-labelledby="chats-section">
            <div class="d-flex align-items-center justify-content-between border-bottom">
              <p class="settings-heading border-top-0 mb-3 pl-3 pt-0 border-bottom-0 pb-0">Friends</p>
              <small class="settings-heading border-top-0 mb-3 pt-0 border-bottom-0 pb-0 pr-3 font-weight-normal">See
                All</small>
            </div>
            <ul class="chat-list">
              <li class="list active">
                <div class="profile"><img src="https://via.placeholder.com/40x40" alt="image"><span
                    class="online"></span></div>
                <div class="info">
                  <p>Thomas Douglas</p>
                  <p>Available</p>
                </div>
                <small class="my-auto">19 min</small>
              </li>
              <li class="list">
                <div class="profile"><img src="https://via.placeholder.com/40x40" alt="image"><span
                    class="offline"></span></div>
                <div class="info">
                  <div class="wrapper d-flex">
                    <p>Catherine</p>
                  </div>
                  <p>Away</p>
                </div>
                <div class="badge badge-success badge-pill my-auto mx-2">4</div>
                <small class="my-auto">23 min</small>
              </li>
              <li class="list">
                <div class="profile"><img src="https://via.placeholder.com/40x40" alt="image"><span
                    class="online"></span></div>
                <div class="info">
                  <p>Daniel Russell</p>
                  <p>Available</p>
                </div>
                <small class="my-auto">14 min</small>
              </li>
              <li class="list">
                <div class="profile"><img src="https://via.placeholder.com/40x40" alt="image"><span
                    class="offline"></span></div>
                <div class="info">
                  <p>James Richardson</p>
                  <p>Away</p>
                </div>
                <small class="my-auto">2 min</small>
              </li>
              <li class="list">
                <div class="profile"><img src="https://via.placeholder.com/40x40" alt="image"><span
                    class="online"></span></div>
                <div class="info">
                  <p>Madeline Kennedy</p>
                  <p>Available</p>
                </div>
                <small class="my-auto">5 min</small>
              </li>
              <li class="list">
                <div class="profile"><img src="https://via.placeholder.com/40x40" alt="image"><span
                    class="online"></span></div>
                <div class="info">
                  <p>Sarah Graves</p>
                  <p>Available</p>
                </div>
                <small class="my-auto">47 min</small>
              </li>
            </ul>
          </div>
          <!-- chat tab ends -->
        </div>
      </div>
      <!-- partial -->
      <!-- partial:../../partials/_sidebar.html -->
      <nav class="sidebar sidebar-offcanvas" id="sidebar">
      @include('partials.menu')
      </nav>
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
        @yield('content')
        </div>
        <!-- content-wrapper ends -->
        <!-- partial:../../partials/_footer.html -->
        <footer class="footer">
          <div class="d-sm-flex justify-content-center justify-content-sm-between">
            <span class="text-center text-sm-left d-block d-sm-inline-block">Copyright © 2021 
              <b>CDM</b>. CC TREG VI Kalimantan.</span>
            <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Made with <i
                class="mdi mdi-heart text-danger"></i> CC</span>
          </div>
        </footer>
        <form id="logoutform" action="{{ route('logout') }}" method="POST" style="display: none;">
          {{ csrf_field() }}
        </form>
        <!-- partial -->
      </div>
      <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
    <script src="{{ asset('public/js/vendor.bundle.base.js') }}"></script>
    <!-- endinject -->
    <!-- Plugin js for this page-->
    <!-- End plugin js for this page-->
    <!-- inject:js -->
    <script src="{{ asset('public/js/off-canvas.js') }}"></script>
    <script src="{{ asset('public/js/hoverable-collapse.js') }}"></script>
    <script src="{{ asset('public/js/template.js') }}"></script>
    <script src="{{ asset('public/js/settings.js') }}"></script>
    <script src="{{ asset('public/js/todolist.js') }}"></script>
    <script src="{{ asset('public/js/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('public/js/select2.min.js') }}"></script>
    <!-- endinject -->
    <!-- plugin js for this page -->
    <!-- End plugin js for this page -->
    <!-- Custom js for this page-->
    <!-- End custom js for this page-->
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> -->
    <!-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.10.22/b-1.6.5/b-colvis-1.6.5/b-flash-1.6.5/b-html5-1.6.5/b-print-1.6.5/r-2.2.6/rg-1.1.2/sp-1.2.1/sl-1.3.1/datatables.min.js"></script>
    <script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
    <script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/16.0.0/classic/ckeditor.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.js"></script>
    <script>
        $(function() {
  let copyButtonTrans = '{{ trans('global.datatables.copy') }}'
  let csvButtonTrans = '{{ trans('global.datatables.csv') }}'
  let excelButtonTrans = '{{ trans('global.datatables.excel') }}'
  let pdfButtonTrans = '{{ trans('global.datatables.pdf') }}'
  let printButtonTrans = '{{ trans('global.datatables.print') }}'
  let colvisButtonTrans = '{{ trans('global.datatables.colvis') }}'
  let selectAllButtonTrans = '{{ trans('global.select_all') }}'
  let selectNoneButtonTrans = '{{ trans('global.deselect_all') }}'

  let languages = {
    'id': 'https://cdn.datatables.net/plug-ins/1.10.19/i18n/Indonesian.json',
        'en': 'https://cdn.datatables.net/plug-ins/1.10.19/i18n/English.json'
  };

  // $.extend(true, $.fn.dataTable.Buttons.defaults.dom.button, { className: 'btn' })
  $.extend(true, $.fn.dataTable.defaults, {
    language: {
      url: languages['{{ app()->getLocale() }}']
    },
    columnDefs: [ {
        orderable: false,
        searchable: false,
        targets: -1
    }],
    select: {
      style:    'multi+shift',
      selector: 'td:first-child'
    },
    order: [],
    scrollX: true,
    pageLength: 100,
    // dom: 'lBfrtip<"actions">',
    dom: `<'row'<'col-sm-12 text-left'B>>
      <'row'<'col-sm-12'tr>>
      <'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7 dataTables_pager'lp>>`,
    buttons: [
      // {
      //   extend: 'selectAll',
      //   className: 'btn-primary',
      //   text: selectAllButtonTrans,
      //   exportOptions: {
      //     columns: ':visible'
      //   },
      //   action: function(e, dt) {
      //     e.preventDefault()
      //     dt.rows().deselect();
      //     dt.rows({ search: 'applied' }).select();
      //   }
      // },
      // {
      //   extend: 'selectNone',
      //   className: 'btn-primary',
      //   text: selectNoneButtonTrans,
      //   exportOptions: {
      //     columns: ':visible'
      //   }
      // },
      // {
      //   extend: 'collection',
      //   text: 'Options',
      //   className: 'btn-default',
      //   buttons: [
      //     {
      //   extend: 'copy',
      //   className: 'btn-default',
      //   text: copyButtonTrans,
      //   footer: true,
      //   exportOptions: {
      //     columns: ':visible'
      //   }
      // },
      // {
      //   extend: 'csv',
      //   className: 'btn-default',
      //   text: csvButtonTrans,
      //   footer: true,
      //   exportOptions: {
      //     columns: ':visible'
      //   }
      // },
      // {
      //   extend: 'excel',
      //   className: 'btn-default',
      //   text: excelButtonTrans,
      //   exportOptions: {
      //     columns: ':visible'
      //   },
      //   header:true,
      //   footer: true,
      // },
      // {
      //   extend: 'pdf',
      //   className: 'btn-default',
      //   text: pdfButtonTrans,
      //   orientation: 'potrait',
      //   exportOptions: {
      //     columns: ':visible'
      //   }
      // },
      // {
      //   extend: 'print',
      //   className: 'btn-default',
      //   text: printButtonTrans,
      //   exportOptions: {
      //     columns: ':visible'
      //   }
      // },
      // {
      //   extend: 'colvis',
      //   className: 'btn-default',
      //   text: colvisButtonTrans,
      //   exportOptions: {
      //     columns: ':visible'
      //   }
      // }
      //   ]
      // }

    ]
  });

  $.fn.dataTable.ext.classes.sPageButton = '';
});

    </script>
    <script>
        $(document).ready(function () {
    $(".notifications-menu").on('click', function () {
        if (!$(this).hasClass('open')) {
            $('.notifications-menu .label-warning').hide();
            $.get('/admin/user-alerts/read');
        }
    });
});

    </script>
    <script>
      $('.select-all').click(function () {
        let $select2 = $(this).parent().siblings('.select2')
        $select2.find('option').prop('selected', 'selected')
        $select2.trigger('change')
      })
      $('.deselect-all').click(function () {
        let $select2 = $(this).parent().siblings('.select2')
        $select2.find('option').prop('selected', '')
        $select2.trigger('change')
      })
    </script>   
    <script>
      // On page load set the theme.
(function() {
  let onpageLoad = localStorage.getItem("theme") || "";
  var link = document.getElementById("theme");

  if(onpageLoad == "dark-mode")
    {
      link.setAttribute('href', "{{ env('APP_URL') }}/public/css/style.css");
      document.getElementById("icontheme").className = "mdi mdi-theme-light-dark";
    }
    else{
      link.setAttribute('href', "{{ env('APP_URL') }}/public/css/style-light.css");
      document.getElementById("icontheme").className = "mdi mdi-white-balance-sunny";
    }
})();

function themeToggle() {
  let element = document.body;
  element.classList.toggle("dark-mode");
  var link = document.getElementById("theme");

  let theme = localStorage.getItem("theme");
    if (theme && theme === "dark-mode") {
      localStorage.setItem("theme", "");
    } else {
      localStorage.setItem("theme", "dark-mode");
    }

    let mode = localStorage.getItem("theme");
    if(mode == "dark-mode")
    {
      link.setAttribute('href', "{{ env('APP_URL') }}/public/css/style.css");
      document.getElementById("icontheme").className = "mdi mdi-theme-light-dark";
    }
    else{
      link.setAttribute('href', "{{ env('APP_URL') }}/public/css/style-light.css");
      document.getElementById("icontheme").className = "mdi mdi-white-balance-sunny";
    }
  }
    </script> 
    @yield('scripts')
</body>

</html>