@extends('admin.layouts.layout')
@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <!-- Header content -->
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- left column -->
                <div class="col-md-6">
                    {{-- <h1>subadmin</h1> --}}
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">{{ $title }}</h3>
                        </div>

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

                        <!-- form start -->
                        <form name="subadminform" id="subadminform" action="{{ url('admin/update-role/' . $id) }}" method="post">
                            @csrf
                            <input type="hidden" name="subadmin_id" value="{{ $id }}">

                            <div class="card-body">
                                @if($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif

                            
                                @php
                                    $viewcmspages = '';
                                    $editcmspages = '';
                                    $fullcmspages = '';

                                    $viewcategories = '';
                                    $editcategories = '';
                                    $fullcategories = '';

                                    $viewproducts = '';
                                    $editproducts = '';
                                    $fullproducts = '';

                                    $viewbrands = '';
                                    $editbrands = '';
                                    $fullbrands = '';
                                @endphp

                                @if(!empty($subadminroles))
                                    @foreach ($subadminroles as $role)
                                        @if ($role['module'] == 'cms_pages')
                                            @php
                                                $viewcmspages = $role['view_acess'] == 1 ? 'checked' : '';
                                                $editcmspages = $role['edit_acess'] == 1 ? 'checked' : '';
                                                $fullcmspages = $role['full_acess'] == 1 ? 'checked' : '';
                                            @endphp
                                        @endif
                                    @endforeach
                                @endif

                                @if(!empty($subadminroles))
                                    @foreach ($subadminroles as $role)
                                        @if ($role['module'] == 'categories')
                                            @php
                                                $viewcategories = $role['view_acess'] == 1 ? 'checked' : '';
                                                $editcategories = $role['edit_acess'] == 1 ? 'checked' : '';
                                                $fullcategories = $role['full_acess'] == 1 ? 'checked' : '';
                                            @endphp
                                        @endif
                                    @endforeach
                                @endif

                                @if(!empty($subadminroles))
                                    @foreach ($subadminroles as $role)
                                        @if ($role['module'] == 'categories')
                                            @php
                                                $viewproducts = $role['view_acess'] == 1 ? 'checked' : '';
                                                $editproducts = $role['edit_acess'] == 1 ? 'checked' : '';
                                                $fullproducts = $role['full_acess'] == 1 ? 'checked' : '';
                                            @endphp
                                        @endif
                                    @endforeach
                                @endif

                                @if(!empty($subadminroles))
                                    @foreach ($subadminroles as $role)
                                        @if ($role['module'] == 'categories')
                                            @php
                                                $viewbrands = $role['view_acess'] == 1 ? 'checked' : '';
                                                $editbrands = $role['edit_acess'] == 1 ? 'checked' : '';
                                                $fullbrands = $role['full_acess'] == 1 ? 'checked' : '';
                                            @endphp
                                        @endif
                                    @endforeach
                                @endif

                                <div class="form-group">
                                    <label for="cms_pages"><span style="color: orange">Cms Pages::</span></label><br>
                                    <input type="checkbox" id="cms_pages_view" name="cms_pages[view]" value="1" {{ $viewcmspages }}>
                                    <label for="cms_pages_view">View</label>&nbsp;&nbsp;
                                    <input type="checkbox" id="cms_pages_edit" name="cms_pages[edit]" value="1" {{ $editcmspages }}>
                                    <label for="cms_pages_edit">View Edit</label>&nbsp;&nbsp;
                                    <input type="checkbox" id="cms_pages_full" name="cms_pages[full]" value="1" {{ $fullcmspages }}>
                                    <label for="cms_pages_full">Full Access</label>&nbsp;&nbsp;
                                </div>
                                <div class="form-group">
                                    <label for="categories"><span style="color: orange">categories Pages::</span></label><br>
                                    <input type="checkbox" id="categories_view" name="categories[view]" value="1" {{ $viewcategories }}>
                                    <label for="categories">View</label>&nbsp;&nbsp;
                                    <input type="checkbox" id="categories_edit" name="categories[edit]" value="1" {{ $editcategories }}>
                                    <label for="categories">View Edit</label>&nbsp;&nbsp;
                                    <input type="checkbox" id="categories_full" name="categories[full]" value="1" {{ $fullcategories }}>
                                    <label for="cms_pages_full">Full Access</label>&nbsp;&nbsp;
                                </div>
                                <div class="form-group">
                                    <label for="products"><span style="color: orange">product Pages::</span></label><br>
                                    <input type="checkbox" id="products_view" name="products[view]" value="1" {{ $viewproducts }}>
                                    <label for="products">View</label>&nbsp;&nbsp;
                                    <input type="checkbox" id="products_edit" name="products[edit]" value="1" {{ $editproducts }}>
                                    <label for="products">View Edit</label>&nbsp;&nbsp;
                                    <input type="checkbox" id="products_full" name="products[full]" value="1" {{ $fullproducts }}>
                                    <label for="cms_pages_full">Full Access</label>&nbsp;&nbsp;
                                </div>
                                <div class="form-group">
                                    <label for="brands"><span style="color: orange">brand Pages::</span></label><br>
                                    <input type="checkbox" id="brands_view" name="brands[view]" value="1" {{ $viewbrands }}>
                                    <label for="brands">View</label>&nbsp;&nbsp;
                                    <input type="checkbox" id="brands_edit" name="brands[edit]" value="1" {{ $editbrands }}>
                                    <label for="brands">View Edit</label>&nbsp;&nbsp;
                                    <input type="checkbox" id="brands_full" name="brands[full]" value="1" {{ $fullbrands }}>
                                    <label for="cms_pages_full">Full Access</label>&nbsp;&nbsp;
                                </div>
                            </div>

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
