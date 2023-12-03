@extends('admin.layouts.layout')
@section('content')
@section('title','CMS Page')
<div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">CMS Pages</h3>
                            @if($pagesmodule['edit_acess']==1 || $pagesmodule['full_acess']==1  )
                            <a class="float-right btn btn-primary btn-sm" href="{{url('admin/add-edit-cms-page')}}">Add Cms Page</a>
                            @endif
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="cmspages" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>TITLE</th>
                                        <th>URL(s)</th>
                                        <th>CREATED ON</th>
                                        <th>ACTION</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($cmspage as $page)
                                    <tr>
                                        <td>{{$page['id']}}</td>
                                        <td>{{$page['title']}}</td>
                                        <td>{{$page['url']}}</td>
                                        <td>{{$page['created_at']}}</td>
                                        <td>
                                            @if($pagesmodule['edit_acess']==1 || $pagesmodule['full_acess']==1  )
                                            @if($page['status']==1)
                                                <a class="updatestatus" id="page-{{$page['id']}}" page_id="{{$page['id']}}" check="cms-page" status="Active" href="javascript:void(0)">
                                                    <i class="fas fa-toggle-on"></i>
                                                </a>
                                            @else
                                                <a class="updatestatus" id="page-{{$page['id']}}" page_id="{{$page['id']}}" check="cms-page" status="Inactive" href="javascript:void(0)">
                                                    <i class="fas fa-toggle-off" style="color: gray"></i>
                                                </a>
                                            @endif
                                            @endif
                                            @if($pagesmodule['edit_acess']==1 ||$pagesmodule['full_acess']==1 )

                                            <a href="{{url('admin/add-edit-cms-page/'.$page['id'])}}"><i class="fas fa-edit btn btn-success btn-sm"></i></a>
                                            {{-- <a href="{{url('admin/delete-cms-page/'.$page['id'])}}" name="cms page" class="confirmdelete btn btn-danger btn-sm" title="cms page deleted successfully"><i class="fas fa-trash"></i></a> --}}
                                            @endif
                                            @if($pagesmodule['full_acess']==1 )

                                            <a href="javascript:void(0)" record="cms-page" check="cms-page" record_id="{{$page['id']}}" name="cms page" class="confirmdelete btn btn-danger btn-sm" title=" delete it!"><i class="fas fa-trash"></i></a>
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

