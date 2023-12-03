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
                        <li class="breadcrumb-item"><a href="{{url('/admin/categories')}}">Back</a></li>
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
                        <form name="categoryform" id="categoryform" @if(empty($category['id'])) action="{{url('admin/add-edit-category-page')}}" @else action="{{url('admin/add-edit-category-page/'.$category['id'])}}" @endif method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="category_name">Category Name*</label>
                                    <input type="text" 
                                    class="form-control" 
                                    id="category_name" 
                                    name="category_name" 
                                    placeholder="Enter category name" 
                                    value="{{ isset($category['category_name']) ? $category['category_name'] : old('category_name') }}">
                                         @error('category_name')<span class="text-danger">{{ $message }}</span>@enderror
                                </div>
                                <div class="form-group">
                                    <label for="parent_id">Category Level</label>
                                    <select name="parent_id" id="parent_id" class="form-control">
                                        <option value="0" {{ $category['parent_id'] == 0 ? 'selected' : '' }}>Main Category</option>
                                        @foreach ($getcategories as $cat)
                                            <option value="{{ $cat['id'] }}" {{ $category['parent_id'] == $cat['id'] ? 'selected' : '' }}>
                                                {{ $cat['category_name'] }}
                                            </option>
                                            @if (!empty($cat['subcategories']))
                                                @foreach ($cat['subcategories'] as $subcat)
                                                    <option value="{{ $subcat['id'] }}" {{ $category['parent_id'] == $subcat['id'] ? 'selected' : '' }}>
                                                        &nbsp;&nbsp;-> {{ $subcat['category_name'] }}
                                                    </option>
                                                    @if (!empty($subcat['subcategories']))
                                                        @foreach ($subcat['subcategories'] as $subsubcat)
                                                            <option value="{{ $subsubcat['id'] }}" {{ $category['parent_id'] == $subsubcat['id'] ? 'selected' : '' }}>
                                                                &nbsp;&nbsp;&nbsp;&nbsp;->-> {{ $subsubcat['category_name'] }}
                                                            </option>
                                                        @endforeach
                                                    @endif
                                                @endforeach
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                                
                                
                                <div class="form-group">
                                    <label for="image">Category Image*</label>
                                    <input type="file" class="form-control" id="image" name="image">
                                    @if(!empty($category['category_image']))
                                    <a href="{{ asset('./admin-assets/front/category/' . $category['category_image']) }}" target="_blank">
                                        <img src="{{ asset('./admin-assets/front/category/' . $category['category_image']) }}" alt="" style="width: 70px">

                                    </a>    
                                        <!-- Your existing delete button with SweetAlert confirmation -->
                                        <a href="javascript:void(0)" record="category-page" record_id="{{$category['id']}}" name="category page" check="category-page" class="confirmdelete btn btn-danger btn-sm" title=" delete it!"><i class="fas fa-trash"></i></a>
                                    @endif
                                    @error('image')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="category_discount">Category Discount</label>
                                    <input type="text" class="form-control" id="category_discount" name="category_discount" value="{{ isset($category['category_discount']) ? $category['category_discount'] : old('category_discount') }}">
                                    @error('category_discount')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="category_url">Category URL</label>
                                    <input type="text" class="form-control" id="url" name="url" value="{{ isset($category['url']) ? $category['url'] : old('url') }}">
                                    @error('category_url')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <!-- /.card-body -->
                        </div>
                    </div>
                </div>

                <!-- right column -->
                <div class="col-md-6">
                    <!-- general form elements -->
                    <div class="card card-primary">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="Description">Category Description</label>
                                <textarea class="form-control" id="Description" name="Description" placeholder="Enter Description">{{ isset($category['description']) ? $category['description'] : old('description') }}</textarea>
                                @error('Description')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="Meta_Title">Meta Title*</label>
                                <input type="text" class="form-control" id="Meta_Title" name="Meta_Title" placeholder="Meta_Title" value="{{ isset($category['meta_title']) ? $category['meta_title'] : old('meta_title') }}">
                                @error('Meta_Title')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="Meta_Description">Meta Description*</label>
                                <input type="text" class="form-control" id="Meta_Description" name="Meta_Description" placeholder="Meta_Description" value="{{ isset($category['meta_description']) ? $category['meta_description'] : old('meta_description') }}">
                                @error('Meta_Description')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="Meta_Keywords">Meta Keywords*</label>
                                <input type="text" class="form-control" id="Meta_Keywords" name="Meta_Keywords" placeholder="Meta_Keywords" value="{{ isset($category['meta_keyword']) ? $category['meta_keyword'] : old('meta_keyword') }}">
                                @error('Meta_Keywords')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
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


