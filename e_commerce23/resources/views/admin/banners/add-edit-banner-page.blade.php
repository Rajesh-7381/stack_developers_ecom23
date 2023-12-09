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
                        <li class="breadcrumb-item"><a href="{{url('/admin/dashboard')}}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{url('/admin/banners')}}">Back</a></li>
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
                        <form name="bannerform" id="bannerform" method="post" @if(empty($banner['id']))
                        action="{{url('admin/add-edit-banner-page')}}" @else
                        action="{{url('admin/add-edit-banner-page/'.$banner['id'])}}" @endif
                            enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="image">Banner Image*</label>
                                    <input type="file" class="form-control" id="image" name="image"> 
                                
                                    @if(!empty($banner['image']))
                                        <a href="{{ asset('./admin-assets/front/banners/' . $banner['image']) }}" target="_blank">
                                            <!-- Adjust width to a smaller size, e.g., 150px -->
                                            <img src="{{ asset('./admin-assets/front/banners/' . $banner['image']) }}" alt="" style="width: 150px">
                                        </a>
                                        <!-- Your existing delete button with SweetAlert confirmation -->
                                        <a href="javascript:void(0)" record="brand-page" record_id="{{$banner['id']}}"
                                            name="brand page" check="brand-page" class="confirmdelete btn btn-danger btn-sm"
                                            title=" delete it!"><i class="fas fa-trash"></i></a>
                                    @endif
                                
                                    @error('image')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                
                                <div class="form-group">
                                    <label for="type">Banner Type*</label>
                                    <select name="type" id="type">
                                        <option value="">--select--</option>
                                        <option value="fix" @if(!empty($banner['type']) && $banner['type'] == 'fix') selected @endif>fix</option>
                                        <option value="slider" @if(!empty($banner['type']) && $banner['type'] == 'slider') selected @endif>slider</option>
                                        
                                    </select>
                                </div>                                
                                
                                <div class="form-group">
                                    <label for="link">Banner link</label>
                                    <input type="text" class="form-control" id="link"
                                        placeholder="enter banner link" name="link"
                                        value="{{ isset($banner['link']) ? $banner['link'] : old('link') }}">
                                    @error('link')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="alt">Banner alt</label>
                                    <input type="text" class="form-control" id="alt" name="alt" placeholder="enter alt"
                                        value="{{ isset($banner['alt']) ? $banner['alt'] : old('alt') }}">
                                    @error('banner_alt')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                           
                            <!-- /.card-body -->
                            <div class="form-group">
                                <label for="title">Banner title</label>
                                <textarea class="form-control" id="title" name="title"
                                    placeholder="Enter title">{{ isset($banner['title']) ? $banner['title'] : old('title') }}</textarea>
                                @error('title')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                                                                         
                            <div class="form-group">
                                <label for="sort">Banner SORT</label>
                                <input type="number" class="form-control" id="sort" name="sort" value="{{ isset($banner['sort']) ? $banner['sort'] : old('sort') }}">
                                @error('sort')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                                                                         
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div> 
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