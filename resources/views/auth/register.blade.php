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
        <!-- /Left Text -->
        <div class="d-none d-lg-flex col-lg-7 col-xl-8 align-items-center justify-content-center p-5 pb-2 login-left">
          
        </div>
        <!-- /Left Text -->
            <div class="login-brand">

                <span class="badge bg-label-primary mb-3">
                    Smart Parking Platform
                </span>

                <h1 class="display-4 mb-3">
                    Bergabung dengan ParkirIn
                </h1>

                <p class="fs-5 mb-5">
                    Buat akun sekarang dan nikmati kemudahan mencari serta
                    memesan slot parkir secara realtime.
                </p>

                @include('partials.parking-illustration')

            </div>

        </div>
        <!-- Register -->
        <div
          class="d-flex col-12 col-lg-5 col-xl-4 align-items-center authentication-bg position-relative py-sm-5 px-4 py-4">
          <div class="w-px-400 mx-auto pt-5 pt-lg-0 login-card">
            <h4 class="mb-2">Buat Akun ParkirIn</h4>
            <p class="mb-4">
                Daftar sekarang untuk menikmati fitur pencarian,
                reservasi, dan monitoring parkir secara realtime.
            </p>

            <form id="formAuthentication" class="mb-3" action="index.html" method="GET">
              <div class="form-floating form-floating-outline mb-3">
                <input
                  type="text"
                  class="form-control"
                  id="username"
                  name="username"
                  placeholder="Enter your username"
                  autofocus />
                <label for="username">Username</label>
              </div>
              <div class="form-floating form-floating-outline mb-3">
                <input type="text" class="form-control" id="email" name="email" placeholder="Enter your email" />
                <label for="email">Email</label>
              </div>
              <div class="mb-3 form-password-toggle">
                <div class="input-group input-group-merge">
                  <div class="form-floating form-floating-outline">
                    <input
                      type="password"
                      id="password"
                      class="form-control"
                      name="password"
                      placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                      aria-describedby="password" />
                    <label for="password">Password</label>
                  </div>
                  <span class="input-group-text cursor-pointer"><i class="mdi mdi-eye-off-outline"></i></span>
                </div>
              </div>
              <div class="mb-3">
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" id="terms-conditions" name="terms" />
                  <label class="form-check-label" for="terms-conditions">
                    I agree to
                    <a href="javascript:void(0);">privacy policy & terms</a>
                  </label>
                </div>
              </div>
              <button class="btn btn-primary d-grid w-100">Sign up</button>
            </form>

            <p class="text-center mt-2">
                <span>Sudah punya akun?</span>

                <a href="{{ route('login') }}">
                    <span>Masuk sekarang</span>
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
        <!-- /Register -->
      </div>
    </div>

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
    overflow:hidden;
    position:relative;
}

.authentication-wrapper::before{
    content:"";
    position:absolute;
    top:-200px;
    left:-200px;
    width:500px;
    height:500px;
    background:rgba(115,103,240,.25);
    border-radius:50%;
    filter:blur(120px);
}

.authentication-wrapper::after{
    content:"";
    position:absolute;
    bottom:-200px;
    right:-200px;
    width:500px;
    height:500px;
    background:rgba(167,139,250,.15);
    border-radius:50%;
    filter:blur(120px);
}

.login-left{
    position:relative;
    z-index:2;
    color:#fff;
}

.login-left h1{
    color:#fff;
    font-weight:800;
}

.login-left p{
    color:#b8b8c5;
}

.login-brand{
    max-width:700px;
}

.login-card{
    background:rgba(255,255,255,.95);
    backdrop-filter:blur(15px);
    border-radius:24px;
    padding:40px;
    box-shadow:0 20px 60px rgba(0,0,0,.25);
}

.login-card h4{
    font-weight:700;
}

.btn-primary{
    background:#7367f0;
    border:none;
}

.btn-primary:hover{
    background:#685dd8;
}

.badge.bg-label-primary{
    background:rgba(115,103,240,.2)!important;
    color:#c4b8ff!important;
    border:1px solid rgba(115,103,240,.3);
}

.login-brand{
    max-width: 650px;
    margin: 0 auto;
}

.login-brand .parking-illustration-wrapper{
    max-width: 520px;
    margin: 0 auto;
}

.login-brand .parking-illustration-wrapper svg{
    width: 100%;
    height: auto;
}

</style>