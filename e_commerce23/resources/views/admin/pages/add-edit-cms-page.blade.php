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
                <h3 class="card-title">{{$title}} </h3>
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
              <form name="cmsForm" id="cmsForm" @if(empty($cmsPage['id'])) action="{{url('admin/add-edit-cms-page')}}" 
              @else action="{{url('admin/add-edit-cms-page/'.$cmsPage['id'])}}" 
              @endif method="post" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                  <div class="form-group">
                    <label for="Title">Title* </label>
                    <input type="text" class="form-control" id="Title" name="Title" placeholder="Enter Title" @if(!empty($cmsPage['title'])) value="{{$cmsPage['title']}}"  @endif>
                   
                  </div>
                  <div class="form-group">
                    <label for="URL">URL*</label>
                    <input type="text" class="form-control" id="URL" name="URL" placeholder="URL"  @if(!empty($cmsPage['url'])) value="{{$cmsPage['url']}}"  @endif>
                  </div>
                  <div class="form-group">
                    <label for="Description">Description</label>
                    <textarea class="form-control" id="Description" name="Description" placeholder="Enter Description"> @if(!empty($cmsPage['description'])) {{$cmsPage['description']}}  @endif</textarea>
                  </div>
                  <div class="form-group">
                    <label for="Meta_Title">Meta Title*</label>
                    <input type="text" class="form-control" id="Meta_Title" name="Meta_Title" placeholder="Meta_Title"  @if(!empty($cmsPage['meta_title'])) value="{{$cmsPage['meta_title']}}"  @endif>
                  </div>
                  <div class="form-group">
                    <label for="Meta_Description">Meta Description*</label>
                    <input type="text" class="form-control" id="Meta_Description" name="Meta_Description" placeholder="Meta_Description"  @if(!empty($cmsPage['meta_descriptions'])) value="{{$cmsPage['meta_descriptions']}}"  @endif>
                  </div>
                  <div class="form-group">
                    <label for="Meta_Keywords">Meta Keywords*</label>
                    <input type="text" class="form-control" id="Meta_Keywords" name="Meta_Keywords" placeholder="Meta_Keywords"  @if(!empty($cmsPage['meta_keywords'])) value="{{$cmsPage['meta_keywords']}}"  @endif>
                  </div>
                 
                  
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