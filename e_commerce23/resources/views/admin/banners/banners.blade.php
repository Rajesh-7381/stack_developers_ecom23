@extends('admin.layouts.layout')
@section('content')
@section('title','banner Page')
<div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">banner Pages</h3>
                            {{-- @if($bannersmodule['edit_acess']==1 ||$bannersmodule['full_acess']==1 ) --}}
                            <a class="float-right btn btn-primary btn-sm" href="{{ url('admin/add-edit-banner-page') }}">Add Banner Page</a>
                            {{-- @endif --}}
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="cmspages" class="table table-bordered table-striped">    
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>IMAGE</th>
                                        <th>TYPE</th>
                                        <th>LINK</th>
                                        <th>TITLE</th>
                                        <th>ALT</th>
                                        <th>SORT</th>
                                        <th>CREATED ON</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($banners as $banner)
                                    <tr>
                                        <td>{{$banner['id']}}</td>
                                        <td>
                                            <a href="{{ url('./admin-assets/front/banners/' . $banner['image']) }}" target="_blank" rel="noopener noreferrer">
                                                <img src="{{ asset('./admin-assets/front/banners/' . $banner['image']) }}" alt="" style="max-width: 200px; height: auto;">
                                            </a>
                                        </td>                                                                                <td>{{$banner['type']}}</td>
                                        <td>{{$banner['link']}}</td>
                                        <td>{{$banner['title']}}</td>
                                        <td>{{$banner['alt']}}</td>
                                        <td>{{$banner['sort']}}</td>
                                        <td>{{$banner['created_at']}}</td>
                                        <td>
                                            @if($bannersmodule['edit_acess']==1 || $bannersmodule['full_acess']==1  )
                                                @if($banner['status']==1)
                                                <a class="updatebannerstatus" id="banner-{{$banner['id']}}" banner_id="{{$banner['id']}}" check="banner-page" status="Active" href="javascript:void(0)">
                                                    <i class="fas fa-toggle-on"></i>
                                                </a>
                                                @else
                                                <a class="updatebannerstatus" id="banner-{{$banner['id']}}" banner_id="{{$banner['id']}}" check="banner-page"   status="Inactive" href="javascript:void(0)">
                                                    <i class="fas fa-toggle-off" style="color: gray"></i>
                                                </a>
                                            
                                                @endif
                                                @endif
                                                @if($bannersmodule['edit_acess']==1 ||$bannersmodule['full_acess']==1 )

                                            <a href="{{url('admin/add-edit-banner-page/'.$banner['id'])}}"><i class="fas fa-edit btn btn-success btn-sm"></i></a>
                                            {{-- <a href="{{url('admin/delete-banner/'.$banner['id'])}}" name="banner-page"record="banner" record_id="{{$banner['id']}}" class="confirmdelete btn btn-danger btn-sm" title="cms page deleted successfully"><i class="fas fa-trash"></i></a> --}}
                                            <a href="javascript:void(0)" record="banner-page" record_id="{{$banner['id']}}" name="banner page" check="banner-page" class="confirmdelete btn btn-danger btn-sm" title=" delete it!"><i class="fas fa-trash"></i></a>
                                        

                                            {{-- <a href="javascript:void(0)" record="cms-page" record_id="{{$page['id']}}" name="cms page" class="confirmdelete btn btn-danger btn-sm" title="cms page deleted successfully"><i class="fas fa-trash"></i></a> --}}
                                           @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
@endsection


{{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script> --}}
