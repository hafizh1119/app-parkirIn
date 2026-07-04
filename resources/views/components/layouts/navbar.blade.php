<style>
/* ===== FORCE NAVBAR LANDING TAMPIL ===== */
.navbar-collapse {
    display: flex !important;
}

.landing-menu-overlay {
    display: none !important;
}

.navbar-collapse {
    display: flex !important;
    flex-basis: auto !important;
    visibility: visible !important;
    opacity: 1 !important;
}

.landing-menu-overlay {
    display: none !important;
}

/* ===== NAVBAR MODERN & ELEGAN ===== */
.landing-nav-menu .navbar-nav .nav-link {
    font-family: 'Inter', 'Poppins', -apple-system, BlinkMacSystemFont, sans-serif;
    color: #4A4A6A !important;
    padding: 8px 20px !important;
    font-weight: 500 !important;
    font-size: 0.95rem;
    letter-spacing: 0.2px;
    position: relative;
    transition: all 0.3s ease;
    background: transparent !important;
    border-radius: 0 !important;
}

/* Hover hanya pada huruf - tanpa background kotak */
.landing-nav-menu .navbar-nav .nav-link:hover {
    color: #666CFF !important;
    background: transparent !important;
    transform: translateY(-1px);
}

/* Efek underline elegan saat hover */
.landing-nav-menu .navbar-nav .nav-link::after {
    content: '';
    position: absolute;
    bottom: 2px;
    left: 50%;
    width: 0;
    height: 2px;
    background: linear-gradient(90deg, #666CFF, #A29BFE);
    transition: all 0.3s ease;
    transform: translateX(-50%);
    border-radius: 2px;
}

.landing-nav-menu .navbar-nav .nav-link:hover::after {
    width: 60%;
}

/* Active state */
.landing-nav-menu .navbar-nav .nav-link.active {
    color: #666CFF !important;
    background: transparent !important;
}

.landing-nav-menu .navbar-nav .nav-link.active::after {
    width: 60%;
}

/* ===== BUTTON LOGIN/REGISTER YANG ELEGAN ===== */
.btn-login-register {
    font-family: 'Inter', 'Poppins', -apple-system, BlinkMacSystemFont, sans-serif;
    font-weight: 600;
    font-size: 0.9rem;
    padding: 10px 24px !important;
    border-radius: 50px !important;
    background: linear-gradient(135deg, #666CFF 0%, #5A5FDC 100%) !important;
    border: none !important;
    color: #ffffff !important;
    transition: all 0.3s ease;
    box-shadow: 0 4px 16px rgba(102, 108, 255, 0.25);
    letter-spacing: 0.3px;
    white-space: nowrap;
}

.btn-login-register:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 28px rgba(102, 108, 255, 0.35);
    background: linear-gradient(135deg, #7B80FF 0%, #666CFF 100%) !important;
    color: #ffffff !important;
}

.btn-login-register i {
    margin-right: 8px;
    font-size: 1.1rem;
}

/* ===== TOOLBAR / STYLE SWITCHER ===== */
.dropdown-style-switcher .nav-link {
    color: #4A4A6A !important;
    padding: 6px 10px !important;
    font-size: 1.2rem;
    transition: color 0.3s ease;
}

.dropdown-style-switcher .nav-link:hover {
    color: #666CFF !important;
}

/* ===== RESPONSIVE ===== */
.navbar-toggler {
    display: none !important;
}

@media (max-width: 992px) {
    .navbar-toggler {
        display: block !important;
        border: none !important;
        color: #4A4A6A !important;
        padding: 4px 8px !important;
    }
    
    .navbar-toggler i {
        font-size: 28px !important;
    }
    
    .navbar-collapse {
        position: fixed !important;
        top: 0 !important;
        left: 0 !important;
        width: 300px !important;
        height: 100vh !important;
        background: #ffffff !important;
        padding: 24px !important;
        box-shadow: 0 10px 60px rgba(0,0,0,0.12) !important;
        z-index: 9999 !important;
        overflow-y: auto !important;
        transform: translateX(-100%) !important;
        transition: transform 0.35s cubic-bezier(0.4, 0, 0.2, 1) !important;
        border-radius: 0 !important;
        display: block !important;
    }
    
    .navbar-collapse.show {
        transform: translateX(0) !important;
    }
    
    .landing-menu-overlay {
        display: none !important;
    }

    .landing-nav-menu .navbar-nav .nav-link {
        padding: 12px 16px !important;
        font-size: 1rem;
        border-bottom: 1px solid rgba(0,0,0,0.04);
    }

    .landing-nav-menu .navbar-nav .nav-link::after {
        display: none;
    }

    .landing-nav-menu .navbar-nav .nav-link:hover {
        background: rgba(102, 108, 255, 0.06) !important;
        color: #666CFF !important;
        transform: none;
    }

    .btn-login-register {
        padding: 10px 20px !important;
        font-size: 0.85rem;
        width: 100%;
        text-align: center;
        margin-top: 8px;
    }

    .navbar-nav.ms-auto {
        flex-direction: row !important;
        align-items: center !important;
    }
}

@media (max-width: 480px) {
    .navbar-collapse {
        width: 280px !important;
        padding: 20px !important;
    }

    .btn-login-register {
        padding: 8px 16px !important;
        font-size: 0.8rem;
    }

    .btn-login-register i {
        font-size: 0.9rem;
    }
}
</style>

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
                    <span class="app-brand-text demo menu-text" style="font-size: 1rem; line-height: 1.1; margin: 0 !important; padding: 0 !important; font-family: 'Gilroy', 'Gilroy ExtraBold', sans-serif; font-weight: 800; color: #1A1A2E;">
                        Parkir<span style="color: #666CFF; font-family: 'Gilroy', 'Gilroy ExtraBold', sans-serif; font-weight: 800;">In</span>
                    </span>
                    <span style="font-size: 0.45rem; color: #A0A0B8; line-height: 1.1; margin: 0 !important; padding: 0 !important; letter-spacing: 0.3px; font-family: 'Inter', 'Gilroy', sans-serif; font-weight: 500;">
                        Reservasi Parkir Mudah dan Aman
                    </span>
                </div>
            </a>
        </div>
        <!-- Menu wrapper: Start -->
        <div class="collapse navbar-collapse landing-nav-menu" id="navbarSupportedContent">
            <button class="navbar-toggler border-0 text-heading position-absolute end-0 top-0 scaleX-n1-rtl" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <i class="tf-icons mdi mdi-close"></i>
            </button>
            <ul class="navbar-nav me-auto p-3 p-lg-0">
                <li class="nav-item">
                    <a class="nav-link fw-medium" href="{{ route('dashboard') }}">Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link fw-medium" href="{{ route('customer.cari-parkir') }}#parkir-terdekat">Cari Parkir</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link fw-medium" href="{{ route('dashboard') }}#cara-kerja">Cara Kerja</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link fw-medium" href="{{ route('customers.events') }}">Events</a>
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
                    <li><a class="dropdown-item" href="javascript:void(0);" data-theme="light"><span class="align-middle"><i class="mdi mdi-weather-sunny me-2"></i>Light</span></a></li>
                    <li><a class="dropdown-item" href="javascript:void(0);" data-theme="dark"><span class="align-middle"><i class="mdi mdi-weather-night me-2"></i>Dark</span></a></li>
                    <li><a class="dropdown-item" href="javascript:void(0);" data-theme="system"><span class="align-middle"><i class="mdi mdi-monitor me-2"></i>System</span></a></li>
                </ul>
            </li>
            <!-- / Style Switcher-->

            <!-- navbar button Login/Register di sebelah kanan: Start -->
            @guest
            <li class="nav-item ms-2">
                <a href="{{ route('login') }}" class="btn btn-login-register">
                    <i class="tf-icons mdi mdi-account"></i>
                    <span>Login / Register</span>
                </a>
            </li>
            @endguest
            @auth
            <li>
                <a
                    href="{{ route('customer.profil') }}"
                    class="btn btn-primary px-2 px-sm-4 px-lg-2 px-xl-4"
                    style="border-radius: 8px;">

                    <span class="tf-icons mdi mdi-account me-md-1"></span>
                </a>
            </li>
            @endauth
        </ul>
        <!-- Toolbar: End -->
    </div>
</nav>