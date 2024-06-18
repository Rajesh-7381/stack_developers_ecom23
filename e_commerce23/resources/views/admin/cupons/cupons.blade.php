@extends('admin.layouts.layout')
@section('content')
@section('title','cupon Page')
<div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">cupon Pages</h3>
                            {{-- @if($cuponsmodule['edit_acess']==1 ||$cuponsmodule['full_acess']==1 ) --}}
                            <a class="float-right btn btn-primary btn-sm"
                                href="{{url('admin/add-edit-cupon')}}">Add cupon Page</a>
                            {{-- @endif --}}
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="cmspages" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Code</th>
                                        <th>cupon type</th>
                                        <th>Amount</th>
                                        <th>Expiary Date</th>
                                        <th>CREATED ON</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($cupons as $cupon)
                                    <tr>
                                        <td>{{$cupon['id']}}</td>
                                        <td>{{$cupon['cupon_code']}}</td>
                                        <td>{{$cupon['cupon_type']}}</td>
                                        <td>{{$cupon['amount']}} @if($cupon['amount']=='percentage') % @else INR  @endif </td>                                      
                                        <td>{{$cupon['expiary_date']}}</td>
                                        <td>{{$cupon['created_at']}}</td>
                                        <td>
                                            {{-- @if($cuponsmodule['edit_acess']==1 || $cuponsmodule['full_acess']==1 ) --}}
                                           
                                            @if($cupon['status']==1)
                                                <a class="updatecuponstatus" id="cupon-{{$cupon['id']}}"
                                                cuppon_id="{{$cupon['id']}}" check="cupon-page" status="Active"
                                                    href="javascript:void(0)">
                                                    <i class="fas fa-toggle-on"></i>
                                                </a>
                                            @else
                                                <a class="updatecuponstatus" id="cupon-{{$cupon['id']}}"
                                                cuppon_id="{{$cupon['id']}}" check="cupon-page" status="Inactive"
                                                    href="javascript:void(0)">
                                                    <i class="fas fa-toggle-off" style="color: gray"></i>
                                                </a>

                                            @endif
                                            {{-- @endif --}}
                                            {{-- @if($cuponsmodule['edit_acess']==1 ||$cuponsmodule['full_acess']==1 ) --}}

                                                <a href="{{url('admin/add-edit-cupon/'.$cupon['id'])}}"><i
                                                        class="fas fa-edit btn btn-success btn-sm"></i></a>
                                               
                                                <a href="javascript:void(0)" record="cupon-page"
                                                    record_id="{{$cupon['id']}}" name="cupon page" check="cupon-page"
                                                    class="confirmdelete btn btn-danger btn-sm" title=" delete it!"><i
                                                        class="fas fa-trash"></i></a>

                                            {{-- @endif --}}
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
