@extends('admin.layouts.layout')
@section('content')
@section('title','product Page')
<div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">product Pages</h3>
                            @if($productsmodule['edit_acess']==1 ||$productsmodule['full_acess']==1 )
                            <a class="float-right btn btn-primary btn-sm"
                                href="{{url('admin/add-edit-product-page')}}">Add product </a>
                            @endif
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="cmspages" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>PRODUCT NAME</th>
                                        <th>PRODUCT CODE</th>
                                        <th> product COLOR</th>
                                        <th> GROUP CODE</th>
                                        <th> CATEGORY</th>
                                        <th>PARENT CATEGORY </th>

                                        <th>created_at</th>

                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($products as $product)
                                    <tr>
                                        <td>{{$product['id']}}</td>
                                        <td>{{$product['product_name']}}</td>
                                        <td>{{$product['product_code']}}</td>
                                        <td>{{$product['product_color']}}</td>
                                        <td>{{$product['group_code']}}</td>
                                        @if(isset($product['category']) && isset($product['category']['category_name']))
                                        <td>{{ $product['category']['category_name'] }}</td>
                                        @else
                                        <td>No Category</td>
                                        @endif

                                        <td>
                                            @if(isset($product['category']['parentcategory']['category_name']))
                                            {{$product['category']['parentcategory']['category_name']}}
                                            @endif
                                        </td>


                                        <td>{{$product['created_at']}}</td>
                                        <td>
                                            @if($productsmodule['edit_acess']==1 || $productsmodule['full_acess']==1 )
                                            @if($product['status']==1)
                                            <a class="updateproductstatus" id="product-{{$product['id']}}"
                                                page_id="{{$product['id']}}" check="product-page" status="Active"
                                                href="javascript:void(0)">
                                                <i class="fas fa-toggle-on"></i>
                                            </a>
                                            @else
                                            <a class="updateproductstatus" id="product-{{$product['id']}}"
                                                page_id="{{$product['id']}}" check="product-page" status="Inactive"
                                                href="javascript:void(0)">
                                                <i class="fas fa-toggle-off" style="color: gray"></i>
                                            </a>

                                            @endif
                                            @endif
                                            @if($productsmodule['edit_acess']==1 ||$productsmodule['full_acess']==1 )

                                            <a href="{{url('admin/add-edit-product-page/'.$product['id'])}}"><i
                                                    class="fas fa-edit btn btn-success btn-sm"></i></a>

                                            {{-- <a href="{{url('admin/delete-product/'.$product['id'])}}"
                                                name="product-page" record="product" record_id="{{$product['id']}}"
                                                class="confirmdelete btn btn-danger btn-sm"
                                                title="cms page deleted successfully"><i class="fas fa-trash"></i></a>
                                            --}}
                                            <a href="javascript:void(0)" record="product-page"
                                                record_id="{{$product['id']}}" name="product page" check="product-page"
                                                class="confirmdelete btn btn-danger btn-sm" title=" delete it!"><i
                                                    class="fas fa-trash"></i></a>


                                            {{-- <a href="javascript:void(0)" record="cms-page"
                                                record_id="{{$page['id']}}" name="cms page"
                                                class="confirmdelete btn btn-danger btn-sm"
                                                title="cms page deleted successfully"><i class="fas fa-trash"></i></a>
                                            --}}
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