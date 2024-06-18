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
                        <li class="breadcrumb-item"><a href="{{url('/admin/cupons')}}">Back</a></li>
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
                <div class="col-md-12">
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
                        <form name="cuponform" id="cuponform" @if(empty($cupon['id'])) action="{{url('admin/add-edit-cupon')}}" @else action="{{url('admin/add-edit-cupon/'.$cupon['id'])}}" @endif method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                
                                <div class="form-group">
                                    <label for="cupon_name">cupon option </label>
                                    <input type="radio" name="cupon-option" id="manualCupon" value="manual"  >&nbsp;Manual &nbsp;&nbsp;                                    
                                    <input type="radio" name="cupon-option" id="automaticCupon" value="Automatic"  >&nbsp;Automatic &nbsp;&nbsp;
                                    {{-- <input type="text" class="form-control" id="cupon_name" name="cupon_name" placeholder=" Enter cupon name" value="{{ isset($cupon['cupon_name']) ? $cupon['cupon_name'] : old('cupon_name') }}"> --}}
                                </div>
                                <div class="form-group" style="display: none" id="cuponfield">
                                    <label for="cupon_code">cupon Code </label>
                                    <input type="text" class="form-control" id="cupon_code" name="cupon_code" placeholder=" Enter cupon Code" value="{{ isset($cupon['cupon_code']) ? $cupon['cupon_code'] : old('cupon_code') }}">
                                   
                                </div>
                                <div class="form-group">
                                    <label for="cupon_name">cupon type </label>
                                    <input type="radio" name="cupon_type"  value="Single Time" >&nbsp;Single Time &nbsp;&nbsp;                                    
                                    <input type="radio" name="cupon_type" value="Multiple Times"  >&nbsp;Multiple Time &nbsp;&nbsp;
                                    {{-- <input type="text" class="form-control" id="cupon_name" name="cupon_name" placeholder=" Enter cupon name" value="{{ isset($cupon['cupon_name']) ? $cupon['cupon_name'] : old('cupon_name') }}"> --}}
                                </div>
                                <div class="form-group">
                                    <label for="cupon_name">amount type  </label>
                                    <input type="radio" name="amount_type"  value="Percentage"  >&nbsp;Percentage &nbsp;&nbsp;                                    
                                    <input type="radio" name="amount_type" value="Fixed"  >&nbsp;Fixed  &nbsp;&nbsp;
                                    {{-- <input type="text" class="form-control" id="cupon_name" name="cupon_name" placeholder=" Enter cupon name" value="{{ isset($cupon['cupon_name']) ? $cupon['cupon_name'] : old('cupon_name') }}"> --}}
                                </div>
                                <div class="form-group">
                                    <label for="amount">Amount<span style="color: red">*</span></label>
                                    <input type="text" class="form-control" id="amount" name="amount" placeholder=" Enter amount" >
                                    @error('cupon_name')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group ">
                                    <label for="categories">select category<span style="color: red">*</span></label>
                                    <select name="categories[]" multiple="" id="categories" class="form-control">
                                        {{-- <option value="">select</option> --}}
                                        @foreach ($getcategories as $cat)
                                            <option  value="{{$cat['id']}}" >{{$cat['category_name']}} </option>

                                            @if (!empty($cat['subcategories']))
                                                @foreach ($cat['subcategories'] as $subcat)
                                                    <option  value="{{$subcat['id']}}"  > &nbsp;&nbsp;-> {{ $subcat['category_name'] }}</option>
                                                    
                                                    @if (!empty($subcat['subcategories']))
                                                        @foreach ($subcat['subcategories'] as $subsubcat)
                                                            <option   value="{{$cat['id']}}" > &nbsp;&nbsp;&nbsp;&nbsp;->-> {{ $subsubcat['category_name'] }}</option>
                                                                                                                        
                                                        @endforeach
                                                    @endif
                                                @endforeach
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="brands">Select Brands <span style="color: red">*</span></label>
                                    <select class="form-control" name="brands[]" multiple="" id="brands">
                                        {{-- <option value="">select</option> --}}
                                        @foreach($getBrands as $key => $brand)
                                            <option value="{{$brand['id']}}" @if(!empty($cupon['brands']) && $cupon['brands'] == $brand['id']) selected @endif>
                                                {{$brand['brand_name']}}
                                            </option>
                                        @endforeach
                                    </select>                                    
                                </div>
                                <div class="form-group">
                                    <label for="users">Select user <span style="color: red">*</span></label>
                                    <select class="form-control" name="users[]" multiple="" id="users">
                                        {{-- <option value="">select</option> --}}
                                        @foreach($getusers as $key => $user)
                                            <option value="{{$user['email']}}" > {{$user['email']}} </option>
                                        @endforeach
                                    </select>                                    
                                </div>
                                <div class="form-group">
                                    <label for="cupon_name">cupon name<span style="color: red">*</span></label>
                                    <input type="text" class="form-control" id="cupon_name" name="cupon_name" placeholder=" Enter cupon name" value="{{ isset($cupon['cupon_name']) ? $cupon['cupon_name'] : old('cupon_name') }}">
                                    @error('cupon_name')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="expiary_date">expiary Date</label>
                                    <input type="date" class="form-control" id="expiary_date" name="expiary_date" placeholder=" Enter expiary_date" >
                                   
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                        </div>
                        <!-- /.card-body -->

                        
                    </div>
                    <!-- /.card -->
                {{-- </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid --> --}}
    </section>
    <!-- /.content -->
</div>
@endsection
