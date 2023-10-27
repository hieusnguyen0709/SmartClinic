<aside class="sidenav bg-white navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-4" id="sidenav-main">
    <div class="sidenav-header">
      <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
      <div class="navbar-brand m-0">
        <a href="{{ route('dashboard.index') }}">
          <img src="{{ asset('/assets/admin/img/logo-ct-dark.png') }}" class="navbar-brand-img h-100" alt="main_logo">
          <span class="ms-1 font-weight-bold">Dashboard</span>
        </a>
      </div>
    </div>
    <hr class="horizontal dark mt-0">
    <div class="collapse navbar-collapse w-auto" id="sidenav-collapse-main">
      <ul class="navbar-nav">
        <!-- <li class="nav-item mt-3">
          <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Account Pages</h6>
        </li> -->
        <li class="nav-item">
          <a class="nav-link {{ $pageGroupAdmin == 1 ? 'active' : '' }}" href="{{ route('user.index') }}">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="ni ni-circle-08 text-dark text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Users</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ $pageGroupAdmin == 2 ? 'active' : '' }}" href="{{ route('role.index') }}">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="ni ni-single-02 text-dark text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Roles</span>
          </a>
        </li>
        <hr class="horizontal dark mt-0">
        <li class="nav-item">
          <a class="nav-link {{ $pageGroupAdmin == 3 ? 'active' : '' }}" href="{{ route('category.index') }}">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="ni ni-app text-success text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Categories</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ $pageGroupAdmin == 4 ? 'active' : '' }}" href="{{ route('medicine.index') }}">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="ni ni-ui-04 text-success text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Medicines</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ $pageGroupAdmin == 5 ? 'active' : '' }}" href="{{ route('prescription.index') }}">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="ni ni-bullet-list-67 text-success text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Prescriptions</span>
          </a>
        </li>
        <hr class="horizontal dark mt-0">
        <li class="nav-item">
          <a class="nav-link {{ $pageGroupAdmin == 6 ? 'active' : '' }}" href="{{ route('frame.index') }}">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="ni ni-time-alarm text-primary text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Frames</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ $pageGroupAdmin == 7 ? 'active' : '' }}" href="{{ route('schedule.index') }}">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="ni ni-calendar-grid-58 text-primary text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Schedules</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ $pageGroupAdmin == 8 ? 'active' : '' }}" href="{{ route('appointment.index') }}">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="ni ni-book-bookmark text-primary text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Appointments</span>
          </a>
        </li>
      </ul>
    </div>
</aside>