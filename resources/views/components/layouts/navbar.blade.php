<nav class="layout-navbar container shadow-none py-0">
      <div class="navbar navbar-expand-lg landing-navbar border-top-0 px-3 px-md-4">
        <!-- Menu logo wrapper: Start -->
        <div class="navbar-brand app-brand demo d-flex py-0 my-0 me-4" style="padding-top: 0 !important; padding-bottom: 0 !important; margin-top: 0 !important; margin-bottom: 0 !important;">
          <!-- Mobile menu toggle: Start-->
          <button
            class="navbar-toggler border-0 px-0 me-2"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent"
            aria-expanded="false"
            aria-label="Toggle navigation">
            <i class="tf-icons mdi mdi-menu mdi-24px align-middle"></i>
          </button>
          <!-- Mobile menu toggle: End-->
          <a href="{{ route('dashboard') }}" class="app-brand-link d-flex align-items-center" style="padding: 0 !important; gap: 6px; margin: 0 !important;">
              <img 
                  src="{{ asset('assets/img/icon/logo.svg') }}" 
                  alt="ParkirIn Logo"
                  style="height: 50px; width: auto; display: block; margin: 0 !important; padding: 0 !important;"
              />
              <div class="d-flex flex-column" style="margin: 0 !important; padding: 0 !important; line-height: 1;">
                  <span class="app-brand-text demo menu-text" style="font-size: 1 rem; line-height: 1.1; margin: 0 !important; padding: 0 !important; font-family: 'Gilroy', 'Gilroy ExtraBold', sans-serif; font-weight: 800; color: #000000;">
                      Parkir<span style="color: #666cff; font-family: 'Gilroy', 'Gilroy ExtraBold', sans-serif; font-weight: 800;">In</span>
                  </span>
                  <span style="font-size: 0.45rem; color: #a0a0a0; line-height: 1.1; margin: 0 !important; padding: 0 !important; letter-spacing: 0.3px; font-family: 'Gilroy', 'Gilroy ExtraBold', sans-serif; font-weight: 500;">
                      Reservasi Parkir Mudah dan Aman
                  </span>
              </div>
          </a>
        </div>
        <!-- Menu logo wrapper: End -->
        <!-- Menu wrapper: Start -->
        <div class="collapse navbar-collapse landing-nav-menu" id="navbarSupportedContent">
          <button
            class="navbar-toggler border-0 text-heading position-absolute end-0 top-0 scaleX-n1-rtl"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent"
            aria-expanded="false"
            aria-label="Toggle navigation">
            <i class="tf-icons mdi mdi-close"></i>
          </button>
          <ul class="navbar-nav me-auto p-3 p-lg-0">
            <li class="nav-item">
                <a class="nav-link fw-medium" href="{{ route('dashboard') }}">
                    Dashboard
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link fw-medium" href="{{ route('customer.cari-parkir') }}">
                    Cari Parkir
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link fw-medium" data-scroll href="#cara-kerja">
                    Cara Kerja
                </a>
            </li>
          </ul>
        </div>
        <div class="landing-menu-overlay d-lg-none"></div>
        <!-- Menu wrapper: End -->
        <!-- Toolbar: Start -->
        <ul class="navbar-nav flex-row align-items-center ms-auto">
          <!-- Style Switcher -->
          <li class="nav-item dropdown-style-switcher dropdown me-2 me-xl-0">
            <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
              <i class="mdi mdi-24px"></i>
            </a>
            <ul class="dropdown-menu dropdown-menu-end dropdown-styles">
              <li>
                <a class="dropdown-item" href="javascript:void(0);" data-theme="light">
                  <span class="align-middle"><i class="mdi mdi-weather-sunny me-2"></i>Light</span>
                </a>
              </li>
              <li>
                <a class="dropdown-item" href="javascript:void(0);" data-theme="dark">
                  <span class="align-middle"><i class="mdi mdi-weather-night me-2"></i>Dark</span>
                </a>
              </li>
              <li>
                <a class="dropdown-item" href="javascript:void(0);" data-theme="system">
                  <span class="align-middle"><i class="mdi mdi-monitor me-2"></i>System</span>
                </a>
              </li>
            </ul>
          </li>
          <!-- / Style Switcher-->

          <!-- navbar button: Start -->
          @guest
          <li>
              <a
                  href="{{ route('login') }}"
                  class="btn btn-primary px-2 px-sm-4 px-lg-2 px-xl-4">

                  <span class="tf-icons mdi mdi-account me-md-1"></span>

                  <span class="d-none d-md-block">
                      Login/Register
                  </span>

              </a>
          </li>
          @endguest

          @auth
          <li class="nav-item dropdown">

              <a
                  class="btn btn-primary dropdown-toggle px-2 px-sm-4 px-lg-2 px-xl-4"
                  href="#"
                  role="button"
                  data-bs-toggle="dropdown"
                  aria-expanded="false">

                  <span class="tf-icons mdi mdi-account me-md-1"></span>

                  <span class="d-none d-md-inline">
                      {{ Auth::user()->name }}
                  </span>

              </a>

              <ul class="dropdown-menu dropdown-menu-end">

                  <li>
                      <a class="dropdown-item" href="{{ route('customer.profil') }}">
                          Profil
                      </a>
                  </li>

                  <li>
                      <a class="dropdown-item" href="{{ route('customer.riwayat') }}">
                          Riwayat
                      </a>
                  </li>

                  <li><hr class="dropdown-divider"></li>

                  <li>
                      <form action="{{ route('logout') }}" method="POST">
                          @csrf

                          <button type="submit" class="dropdown-item text-danger">
                              Logout
                          </button>
                      </form>
                  </li>

              </ul>

          </li>
          @endauth
          <!-- navbar button: End -->
        </ul>
        <!-- Toolbar: End -->
      </div>
    </nav>