@extends('Web/layout/app')
@section('title') Login @endsection
@section('style')
<style>

</style>
@endsection

@section('main')
<nav aria-label="breadcrumb" class="breadcrumb-nav border-0 mb-0">
    <div class="container">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.html">Home</a></li>
            <li class="breadcrumb-item"><a href="#">Pages</a></li>
            <li class="breadcrumb-item active" aria-current="page">Login</li>
        </ol>
    </div><!-- End .container -->
</nav><!-- End .breadcrumb-nav -->

<div class="login-page bg-image pt-8 pb-8 pt-md-12 pb-md-12 pt-lg-17 pb-lg-17" style="background-image: url('https://puppyuniverse.000webhostapp.com/assets/img/banner/frenchbulldog.webp')">
    <div class="container">
        <div class="form-box">
            <div class="form-tab">

                <ul class="nav nav-pills nav-fill" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="signin-tab-2" data-toggle="tab" href="#signin-2" role="tab" aria-controls="signin-2" aria-selected="false">Sign In</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " id="register-tab-2" data-toggle="tab" href="#register-2" role="tab" aria-controls="register-2" aria-selected="true">Register</a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane fade  show active" id="signin-2" role="tabpanel" aria-labelledby="signin-tab-2">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="form-group">
                                <label for="singin-email-2">Username or email address *</label>
                                <input type="email" class="form-control" id="singin-email-2" value="{{ old('email') }}" name="email" autofocus autocomplete="username" required>
                                @error('email')
                                <div class="alert alert-warning">
                                    {{ $message }}
                                </div>
                                @endsession
                            </div><!-- End .form-group -->

                            <div class="form-group">
                                <label for="singin-password-2">Password *</label>
                                <input type="password" class="form-control" id="singin-password-2" name="password" required>
                                @error('email')
                                <div class="alert alert-warning">
                                    {{ $message }}
                                </div>
                                @endsession
                            </div><!-- End .form-group -->

                            <div class="form-footer">
                                <button type="submit" class="btn btn-outline-primary-2">
                                    <span>LOG IN</span>
                                    <i class="icon-long-arrow-right"></i>
                                </button>

                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" name="remember" class="custom-control-input" id="signin-remember-2">
                                    <label class="custom-control-label" for="signin-remember-2">Remember Me</label>
                                </div><!-- End .custom-checkbox -->

                                <a href="#" class="forgot-link">Forgot Your Password?</a>
                            </div><!-- End .form-footer -->
                        </form>
                        <div class="form-choice">
                            <p class="text-center">or sign in with</p>
                            <div class="row">
                                <div class="col-sm-6">
                                    <a href="#" class="btn btn-login btn-g">
                                        <i class="icon-google"></i>
                                        Login With Google
                                    </a>
                                </div><!-- End .col-6 -->
                                <div class="col-sm-6">
                                    <a href="#" class="btn btn-login btn-f">
                                        <i class="icon-facebook-f"></i>
                                        Login With Facebook
                                    </a>
                                </div><!-- End .col-6 -->
                            </div><!-- End .row -->
                        </div><!-- End .form-choice -->
                    </div><!-- .End .tab-pane -->
                    <div class="tab-pane fade" id="register-2" role="tabpanel" aria-labelledby="register-tab-2">
                        <form method="POST" action="{{ route('register') }}" autocomplete="off" aria-autocomplete="none">
                            @csrf
                            <div class="form-group">
                                <label for="register-email-2">Your Name *</label>
                                <div class="d-flex flex-row">
                                    <input type="text" class="form-control" id="register-name-2" value="{{old('name') }}" name="name" required>
                                    @error('name')
                                    <a class="nav-link count-indicator dropdown-toggle text-danger" id="openness_to_strangersmessageDropdown" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="mdi mdi-email-outline"></i>
                                        <span class="count-symbol bg-warning"></span>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="openness_to_strangersmessageDropdown">
                                        <div class="text-danger"> {{ $message }}</div>
                                    </div>
                                    @enderror
                                </div>
                            </div><!-- End .form-group -->
                            <div class="form-group">
                                <label for="register-email-2">Your email address *</label>
                                <div class="d-flex flex-row">
                                    <input type="email" class="form-control" id="register-email-2" value="{{old('email') }}" name="email" required>
                                    @error('email')
                                    <a class="nav-link count-indicator dropdown-toggle text-danger" id="openness_to_strangersmessageDropdown" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="mdi mdi-email-outline"></i>
                                        <span class="count-symbol bg-warning"></span>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="openness_to_strangersmessageDropdown">
                                        <div class="text-danger"> {{ $message }}</div>
                                    </div>
                                    @enderror
                                </div>
                            </div><!-- End .form-group -->

                            <div class="form-group">
                                <label for="register-password-2">Password *</label>
                                <div class="d-flex flex-row">
                                    <input type="password" class="form-control" id="register-password-2" name="password" required>
                                    @error('password')
                                    <a class="nav-link count-indicator dropdown-toggle text-danger" id="openness_to_strangersmessageDropdown" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="mdi mdi-email-outline"></i>
                                        <span class="count-symbol bg-warning"></span>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="openness_to_strangersmessageDropdown">
                                        <div class="text-danger"> {{ $message }}</div>
                                    </div>
                                    @enderror
                                </div>
                            </div><!-- End .form-group -->
                            <div class="form-group">
                                <label for="register-password_confirmation-2">Confirm Password *</label>
                                <div class="d-flex flex-row">
                                    <input type="password" class="form-control" id="register-password_confirmation-2" name="password_confirmation" required>
                                    @error('password_confirmation')
                                    <a class="nav-link count-indicator dropdown-toggle text-danger" id="openness_to_strangersmessageDropdown" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="mdi mdi-email-outline"></i>
                                        <span class="count-symbol bg-warning"></span>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="openness_to_strangersmessageDropdown">
                                        <div class="text-danger"> {{ $message }}</div>
                                    </div>
                                    @enderror
                                </div>
                            </div><!-- End .form-group -->

                            <div class="form-footer">
                                <button type="submit" class="btn btn-outline-primary-2">
                                    <span>SIGN UP</span>
                                    <i class="icon-long-arrow-right"></i>
                                </button>

                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="register-policy-2" required>
                                    <label class="custom-control-label" for="register-policy-2">I agree to the <a href="#">privacy policy</a> *</label>
                                </div><!-- End .custom-checkbox -->
                            </div><!-- End .form-footer -->
                        </form>
                        <div class="form-choice">
                            <p class="text-center">or sign in with</p>
                            <div class="row">
                                <div class="col-sm-6">
                                    <a href="#" class="btn btn-login btn-g">
                                        <i class="icon-google"></i>
                                        Login With Google
                                    </a>
                                </div><!-- End .col-6 -->
                                <div class="col-sm-6">
                                    <a href="#" class="btn btn-login  btn-f">
                                        <i class="icon-facebook-f"></i>
                                        Login With Facebook
                                    </a>
                                </div><!-- End .col-6 -->
                            </div><!-- End .row -->
                        </div><!-- End .form-choice -->
                    </div><!-- .End .tab-pane -->
                </div><!-- End .tab-content -->
            </div><!-- End .form-tab -->
        </div><!-- End .form-box -->
    </div><!-- End .container -->
</div><!-- End .login-page section-bg -->
@endsection

@section('scripts')

@endsection