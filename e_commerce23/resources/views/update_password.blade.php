@extends('admin.layouts.layout')
@section('content')
@section('title', ' Update Password')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Settings</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{url('/admin/dashboard')}}">Home</a></li>
                        <li class="breadcrumb-item active">General Form</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Update Admin Password</h3>
                        </div>
                        @if (session('error_message'))
                        <div class="alert alert-danger">
                            {{ session('error_message') }}
                        </div>
                        @endif
                        @if (session('success_message'))
                        <div class="alert alert-success">
                            {{ session('success_message') }}
                        </div>
                        @endif
                        <form id="updatePasswordForm" method="post" action="{{url('admin/updatepassword')}}">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Email address</label>
                                    <input type="email" class="form-control" id="exampleInputEmail1"
                                        value="{{ Auth::guard('admin')->user()->email }}" readonly
                                        style="background-color: #666; color: white;" placeholder="Enter email">
                                </div>
                                <div class="form-group">
                                    <label for="CurrentPassword">Current Password</label>
                                    <input type="password" class="form-control" id="CurrentPassword"
                                        name="CurrentPassword" placeholder="Password">
                                    <span id="verifycurntpwd"></span>
                                </div>
                                <div class="form-group">
                                    <label for="NewPassword">New Password</label>
                                    <input type="password" class="form-control" id="NewPassword" name="NewPassword"
                                        placeholder="Password">
                                </div>
                                <div class="form-group">
                                    <label for="ConfirmPassword">Confirm Password</label>
                                    <input type="password" class="form-control" id="ConfirmPassword"
                                        name="ConfirmPassword" placeholder="Password">
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>




@endsection