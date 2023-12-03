@extends('admin.layouts.layout')
@section('content')
@section('title','brand Page')
<div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">brand Pages</h3>
                            {{-- @if($categoriesmodule['edit_acess']==1 ||$categoriesmodule['full_acess']==1 ) --}}
                            <a class="float-right btn btn-primary btn-sm" href="{{url('admin/add-edit-brand-page')}}">Add brand Page</a>
                            {{-- @endif --}}
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="cmspages" class="table table-bordered table-striped">    
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>NAME</th>
                                        
                                        <th>URL</th>
                                        <th>CREATED ON</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($brands as $brand)
                                    <tr>
                                        <td>{{$brand['id']}}</td>
                                        <td>{{$brand['brand_name']}}</td>
                                        
                                        
                                        
                                        <td>{{$brand['url']}}</td>
                                        <td>{{$brand['created_at']}}</td>
                                        <td>
                                            @if($brandsmodule['edit_acess']==1 || $brandsmodule['full_acess']==1  )
                                                @if($brand['status']==1)
                                                <a class="updatebrandstatus" id="brand-{{$brand['id']}}" brand_id="{{$brand['id']}}" check="brand-page" status="Active" href="javascript:void(0)">
                                                    <i class="fas fa-toggle-on"></i>
                                                </a>
                                                @else
                                                <a class="updatebrandstatus" id="brand-{{$brand['id']}}" brand_id="{{$brand['id']}}" check="brand-page"   status="Inactive" href="javascript:void(0)">
                                                    <i class="fas fa-toggle-off" style="color: gray"></i>
                                                </a>
                                            
                                                @endif
                                                @endif
                                                @if($brandsmodule['edit_acess']==1 ||$brandsmodule['full_acess']==1 )

                                            <a href="{{url('admin/add-edit-brand-page/'.$brand['id'])}}"><i class="fas fa-edit btn btn-success btn-sm"></i></a>
                                            {{-- <a href="{{url('admin/delete-brand/'.$brand['id'])}}" name="brand-page"record="brand" record_id="{{$brand['id']}}" class="confirmdelete btn btn-danger btn-sm" title="cms page deleted successfully"><i class="fas fa-trash"></i></a> --}}
                                            <a href="javascript:void(0)" record="brand-page" record_id="{{$brand['id']}}" name="brand page" check="brand-page" class="confirmdelete btn btn-danger btn-sm" title=" delete it!"><i class="fas fa-trash"></i></a>
                                        

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

