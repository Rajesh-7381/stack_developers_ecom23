@extends('admin.layouts.layout')
@section('content')
@section('title', ' Update Admin Details')
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
                            <h3 class="card-title">Update Admin details</h3>
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
                        <form id="updatePasswordForm" method="post" action="{{url('admin/updateadmindetails')}}" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Email address</label>
                                    <input type="email" class="form-control" id="exampleInputEmail1"
                                        value="{{ Auth::guard('admin')->user()->email }}" readonly
                                        style="background-color: #666; color: white;" placeholder="Enter email">
                                </div>
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" class="form-control" id="name" value="{{ Auth::guard('admin')->user()->name }}" placeholder="Enter name" name="name">
                                </div>
                                <div class="form-group">
                                    <label for="mobile">Mobile</label>
                                    <input type="text" class="form-control" id="mobile" value="{{ Auth::guard('admin')->user()->mobile }}" placeholder="Enter mobile number" name="mobile">
                                </div>
                                <div class="form-group">
                                    <label for="image">Photo</label>
                                    <input type="file" class="form-control" id="image"  name="image">
                                    @if(!empty(Auth::guard('admin')->user()->image))
                                    <a href="{{url(''.Auth::guard('admin')->user()->image)}}" target="_blank" rel="noopener noreferrer">View Photo</a>
                                    <input type="hidden" name="current_image" value="{{Auth::guard('admin')->user()->image}}">
                                @endif
                                
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