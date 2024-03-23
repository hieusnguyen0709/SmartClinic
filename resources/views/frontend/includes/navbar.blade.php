    <!-- Navbar & Carousel Start -->
    <div class="container-fluid position-relative p-0">
        <nav class="navbar navbar-expand-lg navbar-dark px-5 py-3 py-lg-0">
            <a href="{{ route('frontend.index') }}" class="navbar-brand p-0">
                <h1 class="m-0 text-dark"><i class="fa fa-user-tie me-2"></i>SmartClinic</h1>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                <span class="fa fa-bars"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <div class="navbar-nav ms-auto py-0">
                    <a href="{{ route('frontend.index') }}" class="nav-item nav-link text-dark {{ $pageGroupFrontend == 1 ? 'active' : '' }}">Home</a>
                    <a href="{{ route('frontend.about.index') }}" class="nav-item nav-link text-dark {{ $pageGroupFrontend == 2 ? 'active' : '' }}">About</a>
                    <a href="{{ route('frontend.service.index') }}" class="nav-item nav-link text-dark {{ $pageGroupFrontend == 3 ? 'active' : '' }}">Service</a>
                    <a href="{{ route('frontend.doctor.index') }}" class="nav-item nav-link text-dark {{ $pageGroupFrontend == 4 ? 'active' : '' }}">Doctor</a>
                    <div class="nav-item dropdown">
                        <a href="" onclick="location.href='{{ route('frontend.booking.index') }}'" class="nav-link dropdown-toggle text-dark {{ $pageGroupFrontend == 5 ? 'active' : '' }}" data-bs-toggle="dropdown">Booking</a>
                        <div class="dropdown-menu m-0">
                            <a href="{{ route('frontend.booking.by_day') }}" class="dropdown-item text-dark">By Day</a>
                            <a href="{{ route('frontend.booking.by_doctor') }}" class="dropdown-item text-dark">By Doctor</a>
                        </div>
                    </div>
                    <a href="{{ route('frontend.contact.index') }}" class="nav-item nav-link text-dark {{ $pageGroupFrontend == 6 ? 'active' : '' }}">Contact</a>
                </div>
                <butaton type="button" class="btn text-primary ms-3" data-bs-toggle="modal" data-bs-target="#searchModal"><i class="fa fa-search"></i></butaton>
                @if (Auth::check())
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-danger py-2 px-4 ms-3">Logout</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="btn btn-primary py-2 px-4 ms-3">Login</a>
                @endif
            </div>
        </nav>
    </div>
    <!-- Navbar & Carousel End -->