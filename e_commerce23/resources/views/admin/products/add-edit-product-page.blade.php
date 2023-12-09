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
                            <li class="breadcrumb-item"><a href="{{url('/admin/products')}}">Back</a></li>
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
                            <form name="productform" id="productform" @if(empty($product['id'])) action="{{url('admin/add-edit-product-page')}}" @else action="{{url('admin/add-edit-product-page/'.$product['id'])}}" @endif method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="card-body">
                                
                                    <div class="form-group ">
                                        <label for="category_id">select category</label>
                                        <select name="category_id" id="category_id" class="form-control">
                                            <option value="">select</option>
                                            @foreach ($getcategories as $cat)
                                                <option @if(!empty(old('$category_id')) && $cat['id']==old('$category_id')) selected="" @endif value="{{$cat['id']}}" >{{$cat['category_name']}} </option>

                                                @if (!empty($cat['subcategories']))
                                                    @foreach ($cat['subcategories'] as $subcat)
                                                        <option  @if(!empty(old('$category_id')) && $subcat['id']==old('$category_id')) selected="" @endif value="{{$subcat['id']}}"  > &nbsp;&nbsp;-> {{ $subcat['category_name'] }}</option>
                                                        
                                                        @if (!empty($subcat['subcategories']))
                                                            @foreach ($subcat['subcategories'] as $subsubcat)
                                                                <option  @if(!empty(old('$category_id')) && $subsubcat['id']==old('$category_id')) selected="" @endif value="{{$cat['id']}}" > &nbsp;&nbsp;&nbsp;&nbsp;->-> {{ $subsubcat['category_name'] }}</option>
                                                                                                                            
                                                            @endforeach
                                                        @endif
                                                    @endforeach
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="product_name">Select Brands <span style="color: red">*</span></label>
                                        <select class="form-control" name="brand_id" id="brand_id">
                                            <option value="">select</option>
                                            @foreach($getBrands as $key => $brand)
                                                <option value="{{$brand['id']}}" @if(!empty($product['brand_id']) && $product['brand_id'] == $brand['id']) selected @endif>
                                                    {{$brand['brand_name']}}
                                                </option>
                                            @endforeach
                                        </select>                                    
                                    </div>
                                    <div class="form-group">
                                        <label for="product_name">product name<span style="color: red">*</span></label>
                                        <input type="text" class="form-control" id="product_name" name="product_name" placeholder=" Enter product name" value="{{ isset($product['product_name']) ? $product['product_name'] : old('product_name') }}">
                                        @error('product_name')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="product_code">product Code <span style="color: red">*</span></label>
                                        <input type="text" class="form-control" id="product_code" name="product_code" placeholder=" Enter product Code" value="{{ isset($product['product_code']) ? $product['product_code'] : old('product_code') }}">
                                        @error('product_code')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="product_color">product Color<span style="color: red">*</span></label>
                                        <input type="text" class="form-control" id="product_color" name="product_color" placeholder=" Enter product Code" value="{{ isset($product['product_color']) ? $product['product_color'] : old('product_color') }}">
                                        @error('product_color')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    @php
                                        $familycolors= \App\Models\Colors::colors();
                                    @endphp
                                    <div class="form-group">
                                        <label for="family_color">Family Color<span style="color: red">*</span></label>
                                        <select name="family_color" id="family_color">
                                            <option value="">select</option>  
                                            @foreach ($familycolors as $color)
                                                <option value="{{$color['color_name']}}"
                                                    @if(!empty(old('family_color')) && old('family_color') == $color['color_name']) 
                                                        selected 
                                                    @elseif(!empty($product['family_color']) && $product['family_color'] == $color['color_name']) 
                                                        selected 
                                                    @endif>
                                                    {{$color['color_name']}}
                                                </option>                                                   
                                            @endforeach 
                                        </select>                                    
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="group_code">Group Code </label>
                                        <input type="text" class="form-control" id="group_code" name="group_code" placeholder=" Enter group Code" value="{{ isset($product['group_code']) ? $product['group_code'] : old('group_code') }}">
                                        @error('group_code')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="product_price">Product Price <span style="color: red">*</span></label>
                                        <input type="text" class="form-control" id="product_price" name="product_price" placeholder=" Enter product price" value="{{ isset($product['product_price']) ? $product['product_price'] : old('product_price') }}">
                                        @error('product_price')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="product_discount">product Discount (%)<span style="color: red">*</span></label>
                                        <input type="text" class="form-control" id="product_discount" name="product_discount" value="{{ isset($product['product_discount']) ? $product['product_discount'] : old('product_discount') }}">
                                        @error('product_discount')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="final_price">final price</label>
                                        <input readonly type="text" class="form-control" id="final_price" name="final_price" value="{{ isset($product['final_price']) ? $product['final_price'] : old('final_price') }}">
                                        @error('final_price')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="product_weight">product Weight</label>
                                        <input type="text" class="form-control" id="product_weight" name="product_weight" value="{{ isset($product['product_weight']) ? $product['product_weight'] : old('product_weight') }}">
                                        @error('product_weight')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="description">description </label>
                                        <input type="text" class="form-control" id="description" name="description" value="{{ isset($product['description']) ? $product['description'] : old('description') }}">
                                        @error('description')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="product_video">product Video(Recomonded size :less than 2 MB)</label>
                                        
                                        <input type="file" class="form-control" id="product_video" name="product_video"  @if (!empty($product['product_video'])) value="{{$product['product_video']}}"  @else value="{{@old('product_video')}}"  @endif>
                                        @if(!empty($product['product_video']))                                    
                                        <a href="{{ asset('./admin-assets/front/VIDEOS/' . $product['product_video']) }}" target="_blank"><i class="fas fa-eye eye-icon btn btn-sm btn-warning "></i>
                                            {{-- <img src="{{ asset('./admin-assets/front/VIDEOS/' . $product['product_video']) }}" alt="" style="width: 70px"> --}}
                                        </a>  
                                            <!-- Your existing delete button with SweetAlert confirmation -->
                                        <a href="javascript:void(0)" record="product-video" record_id="{{$product['id']}}" name="product page" check="product-page" class="confirmdelete btn btn-danger btn-sm" title=" delete it!"><i class="fas fa-trash"></i></a>
                                        @endif 
                                            
                                    </div>
                                
                                    <div class="form-group">
                                        <label for="">Add Attributes</label>
                                        <div class="table-responsive">
                                            <table class="table table-bordered">
                                                <thead class="thead-dark">
                                                    <tr>
                                                        <th>ID</th>
                                                        <th>SIZE</th>
                                                        <th>SKU</th>
                                                        <th>PRICE</th>
                                                        <th>STOCK</th>
                                                        <th>ACTIONS</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($product['attributes'] as $attribute)
                                                    <input type="hidden" name="attributeId[]" value="{{$attribute['id']}}">
                                                        <tr class="bg-warning">
                                                            <td>{{$attribute['id']}}</td>
                                                            <td>{{$attribute['size']}}</td>
                                                            <td>{{$attribute['sku']}}</td>
                                                            <td>
                                                                <input type="number" style="width: 100px" name="price[]" value="{{$attribute['price']}}">
                                                            </td>
                                                            <td>
                                                                <input type="number" style="width: 100px" name="stock[]" value="{{$attribute['stock']}}">

                                                            </td>
                                                            <td>
                                                                    @if($attribute['status']==1)
                                                                    <a class="updateattributestatus" id="attribute-{{$attribute['id']}}" attribute_id="{{$attribute['id']}}" check="attribute-page" status="Active" href="javascript:void(0)">
                                                                        <i class="fas fa-toggle-on"></i>
                                                                    </a>
                                                                    @else
                                                                    <a class="updateattributestatus" id="attribute-{{$attribute['id']}}" attribute_id="{{$attribute['id']}}" check="attribute-page"   status="Inactive" href="javascript:void(0)">
                                                                        <i class="fas fa-toggle-off" style="color: gray"></i>
                                                                    </a>
                                                                
                                                                    @endif                
                                                                <a href="javascript:void(0)" record="product-page" record_id="{{$product['id']}}" name="product page" check="product-page" class="confirmdelete btn btn-danger btn-sm" title=" delete it!"><i class="fas fa-trash"></i></a>
                                                            
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                
                                    <div class="form-group">
                                        <label for="">Add Attributes</label>
                                        <div class="field_wrapper">
                                            <div class="field_set">
                                                <input type="text" name="size[]" class="size" placeholder="Size" style="width: 120px"/>
                                                <input type="text" name="sku[]" class="sku" placeholder="SKU" style="width: 120px"/>
                                                <input type="text" name="price[]" class="price" placeholder="Price" style="width: 120px"/>
                                                <input type="text" name="stock[]" class="stock" placeholder="Stock" style="width: 120px"/>
                                                <a href="javascript:void(0);" class="add_button" title="Add field">Add</a>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="product_images">Product Images (Recommended size: less than 1040 x 1200)</label>
                                        <input type="file" class="form-control" id="product_images" name="product_images[]" multiple="">
                                        
                                        @if($product->images->isNotEmpty())
                                            <div class="image-preview">
                                                <table cellpadding="10" cellspaceing="10" border="1" style="margin: 10px">
                                                    <tr>
                                                        @foreach($product->images as $image)
                                                    <a href="{{asset('admin-assets/front/products/small/' . $image->image) }}" target="_blank"><img src="{{ asset('admin-assets/front/products/small/' . $image->image) }}" alt="Product Image" style="width: 70px;"></a>
                                                    {{-- if i set input type text it shown image name --}}
                                                    <input type="hidden" name="image[]" value="{{$image['image']}}"> 
                                                    <input type="text" name="image_sort[]" value="{{$image['image_sort']}}" style="width: 30px">
                                                    <a href="javascript:void(0)" record="product-page" record_id="{{$product['id']}}" name="product page" check="product-page" class="confirmdelete btn btn-danger btn-sm" title=" delete it!"><i class="fas fa-trash"></i></a>
                                                        
                                                    {{-- for medium size --}}
                                                    {{-- <a href="{{asset('admin-assets/front/products/medium/' . $image->image) }}" target="_blank"><img src="{{ asset('admin-assets/front/products/medium/' . $image->image) }}" alt="Product Image" style="width: 70px;"></a> --}}
                                                    {{-- if i set input type text it shown image name --}}
                                                    {{-- <input type="text" name="image[]" value="{{$image['image']}}">  --}}
                                                    {{-- <input type="text" name="image_sort[]" value="{{$image['image_sort']}}" style="width: 30px"> --}}
                                                    {{-- <a href="javascript:void(0)" record="product-page" record_id="{{$product['id']}}" name="product page" check="product-page" class="confirmdelete btn btn-danger btn-sm" title=" delete it!"><i class="fas fa-trash"></i></a> --}}


                                                    {{-- for large size --}}
                                                    {{-- <a href="{{asset('admin-assets/front/products/large/' . $image->image) }}" target="_blank"><img src="{{ asset('admin-assets/front/products/large/' . $image->image) }}" alt="Product Image" style="width: 70px;"></a> --}}
                                                    {{-- if i set input type text it shown image name --}}
                                                    {{-- <input type="text" name="image[]" value="{{$image['image']}}">  --}}
                                                    {{-- <input type="text" name="image_sort[]" value="{{$image['image_sort']}}" style="width: 30px"> --}}
                                                    {{-- <a href="javascript:void(0)" record="product-page" record_id="{{$product['id']}}" name="product page" check="product-page" class="confirmdelete btn btn-danger btn-sm" title=" delete it!"><i class="fas fa-trash"></i></a> --}}

                                                @endforeach
                                                    </tr>
                                                </table>
                                                
                                            </div>
                                        @else
                                            <p>No images available.</p>
                                        @endif
                                    </div>
                                    
                                
                                <!-- Example for fabric dropdown -->
                                <div class="form-group">
                                    <label for="fabric">Fabric</label>
                                    <select name="fabric" id="fabric" class="form-control">
                                        <option value="">select</option>
                                        @foreach ($productsfilter['fabricArray'] as $fabric)
                                            <option value="{{ $fabric }}"
                                                @if(!empty($product['fabric']) && $product['fabric'] == $fabric) selected @endif>
                                                {{ $fabric }}
                                            </option>
                                        @endforeach 
                                    </select>     
                                </div>
                                <!-- Repeat a similar structure for other dropdowns (sleeve, pattern, fit, occasion) -->
                            
                                <div class="form-group">
                                    <label for="sleeve"> Sleeve</label>
                                    <select name="sleeve" id="sleeve" class="form-control">
                                        <option value="">select</option>
                                        @foreach ($productsfilter['SleeveArray'] as $sleeve)
                                        <option value="{{ $sleeve }}"
                                        @if(!empty($product['sleeve']) && $product['sleeve'] == $sleeve) selected @endif>
                                        {{ $sleeve }}
                                    </option>
                                        @endforeach 
                                    </select>     
                                
                                </div>
                                <div class="form-group">
                                    <label for="pattern">Pattern</label>
                                    <select name="pattern" id="pattern" class="form-control">
                                        <option value="">Select</option>
                                        @foreach ($productsfilter['PatternArray'] as $pattern)
                                            <option value="{{ $pattern }}"
                                            {{-- strtolower() is a PHP function used to convert a string to lowercase. It takes a string as input and returns that string with all alphabetic characters converted to lowercase. --}}
                                                @if(isset($product['pattern']) && trim(strtolower($product['pattern'])) == trim(strtolower($pattern))) selected @endif>
                                                {{ $pattern }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                
                                <div class="form-group">
                                    <label for="fit"> fit</label>
                                    <select name="fit" id="fit" class="form-control">
                                        <option value="">select</option>
                                        @foreach ($productsfilter['FitArray'] as $fit)
                                        <option value="{{ $fit }}"
                                        @if(!empty($product['fit']) && trim(strtolower($product['fit'])) == trim(strtolower($fit))) selected @endif>
                                        {{ $fit }}
                                    </option>
                                        @endforeach 
                                    </select>     
                                
                                </div>
                                <div class="form-group">
                                    <label for="occassion">Occasion</label>
                                    <select name="occassion" id="occassion" class="form-control">
                                        <option value="">select</option>
                                        @foreach ($productsfilter['OccasionArray'] as $occassion)
                                            <option value="{{ $occassion }}"
                                                @if(!empty($product['occassion']) && trim(strtolower($product['occassion'])) == trim(strtolower($occassion))) 
                                                    selected 
                                                @endif>
                                                {{ $occassion }}
                                            </option>
                                        @endforeach 
                                    </select>     
                                </div>
                                                                                                                
                                <div class="form-group">
                                    <label for="washcare"> washcare</label>
                                    <textarea class="form-control" id="washcare" name="washcare" placeholder="Enter washcare" > @if (!empty($product['washcare'])) {{$product['washcare']}}    @else {{old('washcare')}}    @endif</textarea>
                                    @error('washcare')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="keywords"> search Keywords</label>
                                    <textarea class="form-control" id="keywords" name="keywords" placeholder="Enter keywords">@if (!empty($product['keywords'])) {{$product['keywords']}}    @else {{old('keywords')}}    @endif</textarea>
                                    @error('keywords')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="meta_title">Meta Title*</label>
                                    <input type="text" class="form-control" id="meta_title" name="meta_title" placeholder="Meta_Title" value="{{ isset($product['meta_title']) ? $product['meta_title'] : old('meta_title') }}">
                                    @error('meta_title')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="meta_description">Meta Description*</label>
                                    <input type="text" class="form-control" id="meta_description" name="meta_description" placeholder="Meta_Description"value="{{ isset($product['meta_description']) ? $product['meta_description'] : old('meta_description') }}">
                                    @error('meta_description')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="meta_keywords">Meta Keywords*</label>
                                    <input type="text" class="form-control" id="meta_keywords" name="meta_keywords" placeholder="Meta_Keywords" @if (!empty($product['meta_keywords'])) value="{{$product['meta_keywords']}}"    @else value="{{old('meta_keywords')}}"    @endif >
                                    @error('meta_keywords')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="is_featured">Featured Item</label>
                                    <input type="checkbox" value="Yes" id="is_featured" name="is_featured" @if(isset($product) && $product->is_featured == 'Yes') checked @endif>
                                    @error('is_featured')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                
                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('#product_price, #product_discount').on('input', function() {
            // Get the input values
            var productPrice = parseFloat($('#product_price').val());
            var productDiscount = parseFloat($('#product_discount').val());

            // Calculate the final price
            var finalPrice = productPrice - (productPrice * (productDiscount / 100));

            // Set the final price in the final_price input field
            $('#final_price').val(finalPrice.toFixed(2)); // Adjust to your required precision

            // You can also use AJAX here to send this final price to the server if needed
        });
    });
</script>

