    @extends('layouts.app')

    @section('content')
    <!-- Content -->

    <div class="authentication-wrapper authentication-cover">
      <div class="authentication-inner row m-0">
        <!-- /Left Section -->
        <div class="d-none d-lg-flex col-lg-7 col-xl-8 align-items-center justify-content-center p-5 pb-2">
          
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
