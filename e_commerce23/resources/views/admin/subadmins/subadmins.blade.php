@extends('admin.layouts.layout')
@section('content')
@section('title','Sub Admins')
<div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Sub Admins</h3>
                            <a class="float-right btn btn-primary btn-sm" href="{{url('admin/add-edit-subadmins-page')}}">Add Sub Admins</a>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="cmspages" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>NAME</th>
                                        <th>MOBILE</th>
                                        <th>EMAIL</th>
                                        <th>TYPE</th>
                                        <th>ACTION</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($subadmins as $subadmin)
                                    <tr>
                                        <td>{{$subadmin['id']}}</td>
                                        <td>{{$subadmin['name']}}</td>
                                        <td>{{$subadmin['mobile']}}</td>
                                        <td>{{$subadmin['email']}}</td>
                                        <td>{{$subadmin['type']}}</td>
                                        
                                        <td>
                                            @if($subadmin->status==1)
                                                <a class="updatestatussubadmin" id="subadmin-{{$subadmin['id']}}" page_id="{{$subadmin['id']}}" check="subadmin-page" status="Active" href="javascript:void(0)">
                                                    <i class="fas fa-toggle-on"></i>
                                                </a>
                                            @else
                                                <a class="updatestatussubadmin" id="subadmin-{{$subadmin['id']}}" page_id="{{$subadmin['id']}}" check="subadmin-page" status="Inactive" href="javascript:void(0)">
                                                    <i class="fas fa-toggle-off" style="color: gray"></i>
                                                </a>
                                            @endif
                                            <a href="{{url('admin/add-edit-subadmins-page/'.$subadmin->id)}}"><i class="fas fa-edit btn btn-success btn-sm"></i></a>
                                            {{-- <a href="{{url('admin/delete-cms-page/'.$page['id'])}}" name="cms page" class="confirmdelete btn btn-danger btn-sm" title="cms page deleted successfully"><i class="fas fa-trash"></i></a> --}}
                                            {{-- <a href="javascript:void(0)" subadmin="subadmin" subadmin_id="{{$subadmin->id}}" name="subadmin" class="confirmdeletesubadmin btn btn-danger btn-sm" title="delete"><i class="fas fa-trash"></i></a> --}}
                                            <a href="javascript:void(0)" record="subadmin-page" record_id="{{$subadmin['id']}}" check="subadmin-page" name="subadmin page" class="confirmdelete btn btn-danger btn-sm" title=" delete it!"><i class="fas fa-trash"></i></a>
                                            <a href="{{ url('admin/update-role/'.$subadmin->id) }}"><i class="fas fa-lock "></i> </a>
                                                
                                                                                    
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

