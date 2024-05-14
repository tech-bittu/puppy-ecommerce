@extends('Web.layout.app')
@section('title') Dashboard @endsection
@section('style')
<style>

</style>
@endsection

@section('main')
<div class="page-header text-center" style="background-image: url('assets/images/page-header-bg.jpg')">
    <div class="container">
        <h1 class="page-title">My Account<span>{{ ('Dashboard') }}</span></h1>
    </div><!-- End .container -->
</div><!-- End .page-header -->
<nav aria-label="breadcrumb" class="breadcrumb-nav mb-3">
    <div class="container">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.html">Home</a></li>
            <li class="breadcrumb-item"><a href="#">Shop</a></li>
            <li class="breadcrumb-item active" aria-current="page">My Account</li>
        </ol>
    </div><!-- End .container -->
</nav><!-- End .breadcrumb-nav -->
@session('status')
{{ $value}}
@endsession
<div class="page-content">
    <div class="dashboard">
        <div class="container">
            <div class="row">
                <aside class="col-md-4 col-lg-2">
                    <ul class="nav nav-dashboard flex-column mb-3 mb-md-0" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="tab-dashboard-link" data-toggle="tab" href="#tab-dashboard" role="tab" aria-controls="tab-dashboard" aria-selected="true">Dashboard</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="tab-orders-link" data-toggle="tab" href="#tab-orders" role="tab" aria-controls="tab-orders" aria-selected="false">Orders</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="tab-downloads-link" data-toggle="tab" href="#tab-downloads" role="tab" aria-controls="tab-downloads" aria-selected="false">Downloads</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="tab-address-link" data-toggle="tab" href="#tab-address" role="tab" aria-controls="tab-address" aria-selected="false">Adresses</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="tab-account-link" data-toggle="tab" href="#tab-account" role="tab" aria-controls="tab-account" aria-selected="false">Account Details</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Sign Out</a>
                        </li>
                    </ul>
                </aside><!-- End .col-lg-3 -->

                <div class="col-md-8 col-lg-10">
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="tab-dashboard" role="tabpanel" aria-labelledby="tab-dashboard-link">
                            <p>Hello <span class="font-weight-normal text-dark">{{ auth('web')->user()->name }}</span> (not <span class="font-weight-normal text-dark">User</span>? <a href="#">Log out</a>)
                                <br>
                                From your account dashboard you can view your <a href="#tab-orders" class="tab-trigger-link link-underline">recent orders</a>, manage your <a href="#tab-address" class="tab-trigger-link">shipping and billing addresses</a>, and <a href="#tab-account" class="tab-trigger-link">edit your password and account details</a>.
                            </p>
                        </div><!-- .End .tab-pane -->

                        <div class="tab-pane fade" id="tab-orders" role="tabpanel" aria-labelledby="tab-orders-link">
                            <p>No order has been made yet.</p>
                            <a href="category.html" class="btn btn-outline-primary-2"><span>GO SHOP</span><i class="icon-long-arrow-right"></i></a>
                        </div><!-- .End .tab-pane -->

                        <div class="tab-pane fade" id="tab-downloads" role="tabpanel" aria-labelledby="tab-downloads-link">
                            <p>No downloads available yet.</p>
                            <a href="category.html" class="btn btn-outline-primary-2"><span>GO SHOP</span><i class="icon-long-arrow-right"></i></a>
                        </div><!-- .End .tab-pane -->

                        <div class="tab-pane fade" id="tab-address" role="tabpanel" aria-labelledby="tab-address-link">
                            <p>The following addresses will be used on the checkout page by default.</p>

                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="card card-dashboard">
                                        <div class="card-body">
                                            <h3 class="card-title">Billing Address</h3><!-- End .card-title -->

                                            <p>User Name<br>
                                                User Company<br>
                                                John str<br>
                                                New York, NY 10001<br>
                                                1-234-987-6543<br>
                                                yourmail@mail.com<br>
                                                <a href="#">Edit <i class="icon-edit"></i></a>
                                            </p>
                                        </div><!-- End .card-body -->
                                    </div><!-- End .card-dashboard -->
                                </div><!-- End .col-lg-6 -->

                                <div class="col-lg-6">
                                    <div class="card card-dashboard">
                                        <div class="card-body">
                                            <h3 class="card-title">Shipping Address</h3><!-- End .card-title -->

                                            <p>You have not set up this type of address yet.<br>
                                                <a href="#">Edit <i class="icon-edit"></i></a>
                                            </p>
                                        </div><!-- End .card-body -->
                                    </div><!-- End .card-dashboard -->
                                </div><!-- End .col-lg-6 -->
                            </div><!-- End .row -->
                        </div><!-- .End .tab-pane -->

                        <div class="tab-pane fade" id="tab-account" role="tabpanel" aria-labelledby="tab-account-link">
                            <div class="row">
                                <div class="col-lg-6">
                                    <form method="post" action="{{ route('profile.update') }}" class="">
                                        @csrf
                                        @method('patch')
                                        <div class="row">
                                            <div class="col-12">
                                                <label>Name *</label>
                                                <input type="text" name="name" class="form-control" value="{{old('name', $user->name)}}" required autofocus autocomplete="name">
                                            </div><!-- End .col-sm-6 .col-md-4 -->
                                            <div class="col-12">
                                                <label>Email address *</label>
                                                <input type="email" class="form-control" name="email" value="{{ old('email', $user->email)}}" required autocomplete="username">
                                                @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                                                <div>
                                                    <p class="text-sm mt-2 text-gray-800">
                                                        {{ __('Your email address is unverified.') }}

                                                        <button form="send-verification" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                                            {{ __('Click here to re-send the verification email.') }}
                                                        </button>
                                                    </p>

                                                    @if (session('status') === 'verification-link-sent')
                                                    <p class="mt-2 font-medium text-sm text-green-600">
                                                        {{ __('A new verification link has been sent to your email address.') }}
                                                    </p>
                                                    @endif
                                                </div>
                                                @endif
                                            </div>
                                            <div class="col-sm-6 col-md-4 d-flex align-items-end">
                                                <button type="submit" class="btn btn-outline-primary-2 mb-2">
                                                    <span>SAVE CHANGES</span>
                                                    <i class="icon-long-arrow-right"></i>
                                                </button>
                                            </div>
                                        </div><!-- End name and email .row -->
                                    </form>
                                </div>
                                <div class="col-lg-6">
                                    <form method="post" action="{{ route('password.update') }}" class="">
                                        @csrf
                                        @method('put')
                                        <label>Current password (leave blank to leave unchanged)</label>
                                        <input type="password" name="current_password" class="form-control">
                                        @error('current_password')
                                        <div class="alert alert-warning">
                                            {{ $message }}
                                        </div>
                                        @endsession

                                        <label>New password (leave blank to leave unchanged)</label>
                                        <input type="password" name="password" autocomplete="new-password" class="form-control">
                                        @error('password')
                                        <div class="alert alert-warning">
                                            {{ $message }}
                                        </div>
                                        @endsession

                                        <label>Confirm new password</label>
                                        <input type="password" name="password_confirmation" class="form-control mb-2" autocomplete="new-password">
                                        @error('password_confirmation')
                                        <div class="alert alert-warning">
                                            {{ $message }}
                                        </div>
                                        @endsession
                                        <button type="submit" class="btn btn-outline-primary-2">
                                            <span>SAVE CHANGES</span>
                                            <i class="icon-long-arrow-right"></i>
                                        </button>
                                    </form>
                                </div>
                                <div class="col-12">
                                    <h6>Delete Account</h6>
                                    <p>Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.</p>
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#deleteAccountModal">
                                        Delete account
                                    </button>
                                    <form method="post" action="{{ route('profile.destroy') }}" class="p-6" autocomplete="off">
                                        @csrf
                                        @method('delete')
                                        <!-- Confirm dialog with input -->
                                        <div class="modal fade" id="deleteAccountModal" tabindex="-1" role="dialog" aria-labelledby="deleteAccountModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="deleteAccountModalLabel">Delete Account Confirm</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body p-3">

                                                        <p>Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.</p>
                                                        <input type="password" name="password" class="form-control" id="delete-password" placeholder="{{ __('Password') }}">
                                                        @error('password')
                                                        <div class="alert alert-warning">
                                                            {{ $message }}
                                                        </div>
                                                        @endsession
                                                        <p>Are you sure you want to delete your account?</p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-success" data-dismiss="modal">Cancel</button>
                                                        <button type="submit" class="btn btn-danger">Delete account</button>
                                                    </div>
                                                </div>
                                            </div>
                                    </form>

                                </div>

                            </div><!-- End .row -->

                        </div><!-- .End .tab-pane -->
                    </div>
                </div><!-- End .col-lg-9 -->
            </div><!-- End .row -->
        </div><!-- End .container -->
    </div><!-- End .dashboard -->
</div><!-- End .page-content -->
@endsection