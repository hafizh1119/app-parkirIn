  @extends('layouts.app')

  @push('styles')
  <style>

  .authentication-wrapper{
      padding-top: 85px;
      min-height: calc(100vh - 85px);
  }

  </style>
  @endpush

  @section('content')
    <!-- Content -->

    <div class="authentication-wrapper authentication-cover">
      <div class="authentication-inner row m-0">
        <!-- /Left Section -->
        <div class="d-none d-lg-flex col-lg-7 col-xl-8 align-items-center justify-content-center p-5 pb-2 login-left">

        <div class="login-brand">

            <span class="badge bg-label-primary mb-3">
                Smart Parking Platform
            </span>

            <h1 class="display-4 mb-3">
                Selamat Datang di ParkirIn
            </h1>

            <p class="fs-5 mb-5">
                Temukan slot parkir secara realtime, reservasi lebih cepat,
                dan nikmati pengalaman parkir yang modern.
            </p>

            @include('partials.parking-illustration')

        </div>

    </div>
        <!-- /Left Section -->

        <!-- Login -->
        <div
          class="d-flex col-12 col-lg-5 col-xl-4 align-items-center authentication-bg position-relative py-sm-5 px-4 py-4">
          <div class="w-px-400 mx-auto pt-5 pt-lg-0">
            <h4 class="mb-2">Welcome to Materialize! 👋</h4>
            <p class="mb-4">Please sign-in to your account and start the adventure</p>

            <form id="formAuthentication" class="mb-3" action="{{ url('/login') }}" method="POST">

                @csrf

                <div class="form-floating form-floating-outline mb-3">
                    <input
                        type="email"
                        class="form-control"
                        id="email"
                        name="email"
                        placeholder="Enter your email"
                        autofocus />

                    <label for="email">
                        Email
                    </label>
                </div>

                <div class="mb-3">

                    <div class="form-password-toggle">

                        <div class="input-group input-group-merge">

                            <div class="form-floating form-floating-outline">

                                <input
                                    type="password"
                                    id="password"
                                    class="form-control"
                                    name="password"
                                    placeholder="********">

                                <label for="password">
                                    Password
                                </label>

                            </div>

                            <span class="input-group-text cursor-pointer">
                                <i class="mdi mdi-eye-off-outline"></i>
                            </span>

                        </div>

                    </div>

                </div>
                <div class="mb-3 d-flex justify-content-between">
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" id="remember-me" />
                  <label class="form-check-label" for="remember-me"> Remember Me </label>
                </div>
                <a href="auth-forgot-password-cover.html" class="float-end mb-1">
                  <span>Forgot Password?</span>
                </a>
              </div>

                <button type="submit" class="btn btn-primary d-grid w-100">
                    Sign In
                </button>

            </form>

            <p class="text-center mt-2">
              <span>New on our platform?</span>
              <a href="{{ route('register') }}">
                <span>Create an account</span>
              </a>
            </p>

            <div class="divider my-4">
              <div class="divider-text">or</div>
            </div>

            <div class="d-flex justify-content-center gap-2">
              <a href="javascript:;" class="btn btn-icon btn-lg rounded-pill btn-text-facebook">
                <i class="tf-icons mdi mdi-24px mdi-facebook"></i>
              </a>

              <a href="javascript:;" class="btn btn-icon btn-lg rounded-pill btn-text-twitter">
                <i class="tf-icons mdi mdi-24px mdi-twitter"></i>
              </a>

              <a href="javascript:;" class="btn btn-icon btn-lg rounded-pill btn-text-github">
                <i class="tf-icons mdi mdi-24px mdi-github"></i>
              </a>

              <a href="javascript:;" class="btn btn-icon btn-lg rounded-pill btn-text-google-plus">
                <i class="tf-icons mdi mdi-24px mdi-google"></i>
              </a>
            </div>
          </div>
        </div>
        <!-- /Login -->
      </div>
    </div>

    <!-- / Content -->

    @endsection


<style>
.authentication-wrapper{
    padding-top:85px;
    min-height:calc(100vh - 85px);
    background:linear-gradient(
        135deg,
        #1a1a2e 0%,
        #16161f 50%,
        #0d0d14 100%
    );
}

.login-left{
    position:relative;
    overflow:hidden;
}

.login-left::before{
    content:'';
    position:absolute;
    width:500px;
    height:500px;
    background:rgba(115,103,240,.25);
    border-radius:50%;
    filter:blur(120px);
    top:-150px;
    left:-150px;
}

.login-left::after{
    content:'';
    position:absolute;
    width:400px;
    height:400px;
    background:rgba(167,139,250,.18);
    border-radius:50%;
    filter:blur(120px);
    bottom:-150px;
    right:-100px;
}

.login-brand{
    position:relative;
    z-index:2;
    max-width:550px;
}

.login-brand h1{
    color:#fff;
    font-weight:800;
}

.login-brand p{
    color:#b8b8c5;
}

.authentication-bg{
    background:transparent;
}

.login-card{
    background:rgba(255,255,255,.08);
    backdrop-filter:blur(20px);
    border:1px solid rgba(255,255,255,.08);
    border-radius:24px;
    padding:40px;
    box-shadow:0 20px 60px rgba(0,0,0,.35);
}

.login-card h4,
.login-card p,
.login-card label,
.login-card span{
    color:#fff;
}

.form-control{
    background:rgba(255,255,255,.05)!important;
    border-color:rgba(255,255,255,.1)!important;
    color:#fff!important;
}

.form-control::placeholder{
    color:#9ca3af;
}

.btn-primary{
    background:#7367f0!important;
    border:none!important;
}

.btn-primary:hover{
    background:#6254eb!important;
}

.divider-text{
    color:#b8b8c5!important;
}

a{
    color:#a78bfa;
}
</style>