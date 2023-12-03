@extends('admin.layouts.layout')
@section('content')
@section('title','Category Page')
<div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">ctaegory Pages</h3>
                            @if($categoriesmodule['edit_acess']==1 ||$categoriesmodule['full_acess']==1 )
                            <a class="float-right btn btn-primary btn-sm" href="{{url('admin/add-edit-category-page')}}">Add Category Page</a>
                            @endif
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="cmspages" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>NAME</th>
                                        <th>PARENT CATEGORY</th>
                                        <th>URL</th>
                                        <th>CREATED ON</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($categories as $category)
                                    <tr>
                                        <td>{{$category['id']}}</td>
                                        <td>{{$category['category_name']}}</td>
                                        <td>
                                            @if(isset($category['parentcategory']['category_name']))
                                                {{ $category['parentcategory']['category_name'] }}
                                            @endif
                                        </td>
                                        
                                        <td>{{$category['url']}}</td>
                                        <td>{{$category['created_at']}}</td>
                                        <td>
                                            @if($categoriesmodule['edit_acess']==1 || $categoriesmodule['full_acess']==1  )
                                                @if($category['status']==1)
                                                <a class="updateCategorystatus" id="category-{{$category['id']}}" page_id="{{$category['id']}}" check="category-page" status="Active" href="javascript:void(0)">
                                                    <i class="fas fa-toggle-on"></i>
                                                </a>
                                                @else
                                                <a class="updateCategorystatus" id="category-{{$category['id']}}" page_id="{{$category['id']}}" check="category-page"   status="Inactive" href="javascript:void(0)">
                                                    <i class="fas fa-toggle-off" style="color: gray"></i>
                                                </a>
                                            
                                                @endif
                                                @endif
                                                @if($categoriesmodule['edit_acess']==1 ||$categoriesmodule['full_acess']==1 )

                                            <a href="{{url('admin/add-edit-category-page/'.$category['id'])}}"><i class="fas fa-edit btn btn-success btn-sm"></i></a>
                                            {{-- <a href="{{url('admin/delete-category/'.$category['id'])}}" name="category-page"record="category" record_id="{{$category['id']}}" class="confirmdelete btn btn-danger btn-sm" title="cms page deleted successfully"><i class="fas fa-trash"></i></a> --}}
                                            <a href="javascript:void(0)" record="category-page" record_id="{{$category['id']}}" name="category page" check="category-page" class="confirmdelete btn btn-danger btn-sm" title=" delete it!"><i class="fas fa-trash"></i></a>
                                        

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

