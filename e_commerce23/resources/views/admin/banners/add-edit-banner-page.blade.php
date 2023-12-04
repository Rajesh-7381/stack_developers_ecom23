@extends('admin.layouts.layout')
@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Advanced Form</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{alt('/admin/dashboard')}}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{alt('/admin/banners')}}">Back</a></li>
                        <li class="breadcrumb-item active">Advanced Form</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- left column -->
                <div class="col-md-6">
                    <!-- general form elements -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">{{$title}}</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
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
                        <form name="bannerform" id="bannerform" @if(empty($banner['id']))
                            action="{{alt('admin/add-edit-banner-page')}}" @else
                            action="{{alt('admin/add-edit-banner-page/'.$banner['id'])}}" @endif method="post"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="banner_name">banner Name*</label>
                                    <input type="text" class="form-control" id="banner_name" name="banner_name"
                                        placeholder="Enter banner name"
                                        value="{{ isset($banner['banner_name']) ? $banner['banner_name'] : old('banner_name') }}">
                                    @error('banner_name')<span class="text-danger">{{ $message }}</span>@enderror
                                </div>

                                <div class="form-group">
                                    <label for="banner_image">banner Image*</label>
                                    <select name="" id="">
                                        <option value="">fix 1</option>
                                        <option value="">fix 2</option>
                                    </select>
                                    
                                </div>
                                
                                <div class="form-group">
                                    <label for="link">banner link</label>
                                    <input type="text" class="form-control" id="link"
                                        placeholder="enter banner link" name="link"
                                        value="{{ isset($banner['link']) ? $banner['link'] : old('link') }}">
                                    @error('link')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="alt">banner alt</label>
                                    <input type="text" class="form-control" id="alt" name="alt" placeholder="enter alt"
                                        value="{{ isset($banner['alt']) ? $banner['alt'] : old('alt') }}">
                                    @error('banner_alt')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <!-- /.card-body -->
                            <div class="form-group">
                                <label for="title"> title</label>
                                <textarea class="form-control" id="title" name="title"
                                    placeholder="Enter title">{{ isset($banner['title']) ? $banner['title'] : old('title') }}</textarea>
                                @error('title')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                                                                         
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                    <!-- /.card -->
                </div>
            </div>
            <!-- /.row -->

    </section>
    <!-- /.content -->
</div>
@endsection