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
              <h3 class="card-title">{{$title}}</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <!-- Your form elements -->
            

            @if($errors->any())
            <div class="alert alert-danger">
              <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
              </ul>
            </div>
            @endif

            <!-- Your form inputs -->

            <form name="subadminform" id="subadminform" enctype="multipart/form-data" @if(empty($subadminData['id']))
              action="{{url('admin/add-edit-subadmins-page')}}" @else
              action="{{url('admin/add-edit-subadmins-page/'.$subadminData['id'])}}" @endif method="post">
              @csrf
              <div class="card-body">
                <div class="form-group">
                  <label for="name">name </label>
                  <input type="text" class="form-control" id="name" name="name" placeholder="Enter name"
                    @if(!empty($subadminData['name'])) value="{{$subadminData['name']}}" @else value="{{old('name')}}"
                    @endif>

                </div>
                <div class="form-group">
                  <label for="mobile">mobile</label>
                  <input type="text" class="form-control" id="mobile" name="mobile" placeholder="mobile"
                    @if(!empty($subadminData['mobile'])) value="{{$subadminData['mobile']}}" @else
                    value="{{old('mobile')}}" @endif>
                </div>

                <div class="form-group">
                  <label for="email">email</label>
                  <input type="email" class="form-control" id="email" name="email" placeholder="email"
                    @if(!empty($subadminData['email'])) value="{{$subadminData['email']}}" @else
                    value="{{old('email')}}" @endif autocomplete="username">
                </div>
                <div class="form-group">
                  <label for="URL">password</label>
                  <input type="password" class="form-control" id="password" name="password" placeholder="password"
                    @if(!empty($subadminData['password'])) value="{{$subadminData['password']}}" @else
                    value="{{old('password')}}" @endif autocomplete="current-password">
                </div>
                <div class="form-group">
                  <label for="image">Photo</label>
                  <input type="file" class="form-control" id="image" name="image">
                  @if(!empty($subadminData['image']))
                  <a href="{{url($subadminData['image'])}}" target="_blank"
                    rel="noopener noreferrer">View Photo</a>
                  <input type="hidden" name="current_image" value="{{url($subadminData['image'])}}">
                  @endif

                </div>
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