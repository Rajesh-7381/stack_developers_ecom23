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
                        <li class="breadcrumb-item"><a href="{{url('/admin/brands')}}">Back</a></li>
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
                        <form name="brandform" id="brandform" @if(empty($brand['id']))
                            action="{{url('admin/add-edit-brand-page')}}" @else
                            action="{{url('admin/add-edit-brand-page/'.$brand['id'])}}" @endif method="post"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="brand_name">brand Name*</label>
                                    <input type="text" class="form-control" id="brand_name" name="brand_name"
                                        placeholder="Enter brand name"
                                        value="{{ isset($brand['brand_name']) ? $brand['brand_name'] : old('brand_name') }}">
                                    @error('brand_name')<span class="text-danger">{{ $message }}</span>@enderror
                                </div>
                                {{-- <div class="form-group">
                                    <label for="parent_id">brand Level</label>
                                    <select name="parent_id" id="parent_id" class="form-control">
                                        <option value="0" {{ $brand['parent_id']==0 ? 'selected' : '' }}>Main brand
                                        </option>
                                        @foreach ($getcategories as $cat)
                                        <option value="{{ $cat['id'] }}" {{ $brand['parent_id']==$cat['id'] ? 'selected'
                                            : '' }}>
                                            {{ $cat['brand_name'] }}
                                        </option>
                                        @if (!empty($cat['subcategories']))
                                        @foreach ($cat['subcategories'] as $subcat)
                                        <option value="{{ $subcat['id'] }}" {{ $brand['parent_id']==$subcat['id']
                                            ? 'selected' : '' }}>
                                            &nbsp;&nbsp;-> {{ $subcat['brand_name'] }}
                                        </option>
                                        @if (!empty($subcat['subcategories']))
                                        @foreach ($subcat['subcategories'] as $subsubcat)
                                        <option value="{{ $subsubcat['id'] }}" {{ $brand['parent_id']==$subsubcat['id']
                                            ? 'selected' : '' }}>
                                            &nbsp;&nbsp;&nbsp;&nbsp;->-> {{ $subsubcat['brand_name'] }}
                                        </option>
                                        @endforeach
                                        @endif
                                        @endforeach
                                        @endif
                                        @endforeach
                                    </select>
                                </div> --}}


                                <div class="form-group">
                                    <label for="brand_image">brand Image*</label>
                                    <input type="file" class="form-control" id="brand_image" name="brand_image">
                                    @if(!empty($brand['brand_image']))
                                    <a href="{{ asset('./admin-assets/front/brands/brand-image/' . $brand['brand_image']) }}"
                                        target="_blank">
                                        <img src="{{ asset('./admin-assets/front/brands/brand-image/' . $brand['brand_image']) }}"
                                            alt="" style="width: 70px">

                                    </a>
                                    <!-- Your existing delete button with SweetAlert confirmation -->
                                    <a href="javascript:void(0)" record="brand-page" record_id="{{$brand['id']}}"
                                        name="brand page" check="brand-page" class="confirmdelete btn btn-danger btn-sm"
                                        title=" delete it!"><i class="fas fa-trash"></i></a>
                                    @endif
                                    @error('image')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="brand_logo">brand Logo*</label>
                                    <input type="file" class="form-control" id="brand_logo" name="brand_logo">
                                    @if(!empty($brand['brand_logo']))
                                    <a href="{{ asset('./admin-assets/front/brands/brand-logo/' . $brand['brand_logo']) }}"
                                        target="_blank">
                                        <img src="{{ asset('./admin-assets/front/brands/brand-logo/' . $brand['brand_logo']) }}"
                                            alt="" style="width: 70px">

                                    </a>
                                    <!-- Your existing delete button with SweetAlert confirmation -->
                                    <a href="javascript:void(0)" record="brand-page" record_id="{{$brand['id']}}"
                                        name="brand page" check="brand-page" class="confirmdelete btn btn-danger btn-sm"
                                        title=" delete it!"><i class="fas fa-trash"></i></a>
                                    @endif
                                    @error('image')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="brand_discount">brand Discount</label>
                                    <input type="text" class="form-control" id="brand_discount"
                                        placeholder="enter brand discount" name="brand_discount"
                                        value="{{ isset($brand['brand_discount']) ? $brand['brand_discount'] : old('brand_discount') }}">
                                    @error('brand_discount')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="url">brand URL</label>
                                    <input type="text" class="form-control" id="url" name="url" placeholder="enter url"
                                        value="{{ isset($brand['url']) ? $brand['url'] : old('url') }}">
                                    @error('brand_url')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <!-- /.card-body -->


                            <div class="form-group">
                                <label for="description"> description</label>
                                <textarea class="form-control" id="description" name="description"
                                    placeholder="Enter description">{{ isset($brand['description']) ? $brand['description'] : old('description') }}</textarea>
                                @error('description')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="meta_title">Meta Title*</label>
                                <input type="text" class="form-control" id="meta_title" name="meta_title"
                                    placeholder="meta_title"
                                    value="{{ isset($brand['meta_title']) ? $brand['meta_title'] : old('meta_title') }}">
                                @error('meta_title')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="meta_description">Meta description*</label>
                                <input type="text" class="form-control" id="meta_description" name="meta_description"
                                    placeholder="meta_description"
                                    value="{{ isset($brand['meta_description']) ? $brand['meta_description'] : old('meta_description') }}">
                                @error('meta_description')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="meta_keywords">Meta Keywords*</label>
                                <input type="text" class="form-control" id="meta_keywords" name="meta_keywords"
                                    placeholder="meta_keywords"
                                    value="{{ isset($brand['meta_keywords']) ? $brand['meta_keywords'] : old('meta_keywords') }}">
                                @error('meta_keywords')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        
                    <!-- /.card-body -->

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
                </div>
                <!-- /.card -->
            </div>
        </div>
        <!-- /.row -->
</div><!-- /.container-fluid -->
</section>
<!-- /.content -->
</div>
@endsection
<!-- Include SweetAlert library -->
{{-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script> --}}