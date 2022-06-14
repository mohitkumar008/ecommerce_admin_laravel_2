@extends('layouts.admin_layout.layout')
@section('content')
    <div class="row">
        <div class="col-md-12 grid-margin">
            <div class="d-flex justify-content-between flex-wrap">
                <div class="d-flex align-items-end flex-wrap">
                    <div class="me-md-3 me-xl-5">
                        <h2>{{ $page_title }}</h2>
                        <div class="d-flex">
                            <i class="mdi mdi-home text-muted hover-cursor"></i>
                            <p class="text-muted mb-0 hover-cursor">&nbsp;/&nbsp;Dashboard&nbsp;/&nbsp;</p>
                            <p class="text-muted mb-0 hover-cursor">Products&nbsp;/&nbsp;</p>
                            <p class="text-primary mb-0 hover-cursor">{{ $page_title }}</p>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <p class="card-description">All(*) fields are required</p>
                    <form class="forms-sample" method="post"
                        @if (empty($productData)) action="{{ url('/admin/products/manage-product') }}" @else action="{{ url('/admin/products/manage-product/' . $productData['id'] . '') }}" @endif
                        enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="category_id">Category<span class="text-warning">*</span></label>
                            <select class="form-control" id="category_id" name="category_id">
                                <option disabled selected>Select Category</option>
                                @foreach ($category as $section)
                                    <option disabled>{{ $section['name'] }}</option>
                                    @foreach ($section['categories'] as $categoryList)
                                        <option
                                            @if (!empty($productData)) @if ($productData['category_id'] == $categoryList['id']) {{ 'selected' }} @endif
                                            @endif

                                            value="{{ $categoryList['id'] }}">
                                            &nbsp;&nbsp;&nbsp;—{{ $categoryList['category_name'] }}
                                        </option>
                                        @foreach ($categoryList['subcategories'] as $subcategoryList)
                                            <option
                                                @if (!empty($productData)) @if ($productData['category_id'] == $subcategoryList['id']) {{ 'selected' }} @endif
                                                @endif
                                                value="{{ $subcategoryList['id'] }}">
                                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;—{{ $subcategoryList['category_name'] }}
                                            </option>
                                        @endforeach
                                    @endforeach
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="product_name">Product Name<span class="text-warning">*</span></label>
                            <input type="text" class="form-control"
                                @if (!empty($productData)) value="{{ $productData['product_name'] }}" @else value="{{ old('product_name') }}" @endif
                                id="product_name" name="product_name" placeholder="Product Name">
                        </div>
                        <div class="form-group">
                            <label for="product_url">Product Url<span class="text-warning">*</span></label>
                            <input type="text" class="form-control" id="product_url" name="product_url"
                                @if (!empty($productData)) value="{{ $productData['product_url'] }}" @else value="{{ old('product_url') }}" @endif
                                placeholder="Product Url">
                        </div>
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-12">
                                <div class="form-group">
                                    <label for="product_code">Product Code<span class="text-warning">*</span></label>
                                    <input type="text" class="form-control" id="product_code" name="product_code"
                                        @if (!empty($productData)) value="{{ $productData['product_code'] }}" @else value="{{ old('product_code') }}" @endif
                                        placeholder="Product Code">
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-12">
                                <div class="form-group">
                                    <label for="product_color">Product Color</label>
                                    <input type="text" class="form-control" id="product_color" name="product_color"
                                        @if (!empty($productData)) value="{{ $productData['product_color'] }}" @else value="{{ old('product_color') }}" @endif
                                        placeholder="Product Color">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-12">
                                <div class="form-group">
                                    <label for="product_mrp">Product MRP<span class="text-warning">*</span></label>
                                    <input type="text" class="form-control" id="product_mrp" name="product_mrp"
                                        @if (!empty($productData)) value="{{ $productData['product_mrp'] }}" @else value="{{ old('product_mrp') }}" @endif
                                        placeholder="Product MRP">
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-12">
                                <div class="form-group">
                                    <label for="product_price">Product Price</label>
                                    <input type="text" class="form-control" id="product_price" name="product_price"
                                        @if (!empty($productData)) value="{{ $productData['product_price'] }}" @else value="{{ old('product_price') }}" @endif
                                        placeholder="Product Price">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-12">
                                <div class="form-group">
                                    <label for="product_weight">Product Weight</label>
                                    <input type="text" class="form-control" id="product_weight" name="product_weight"
                                        @if (!empty($productData)) value="{{ $productData['product_weight'] }}" @else value="{{ old('product_weight') }}" @endif
                                        placeholder="Product Weight">
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-12">
                                <div class="form-group">
                                    <label>Product Video</label>
                                    <input type="file" name="product_video" id="product_video" class="file-upload-default">
                                    <div class="input-group col-xs-12">
                                        <input type="text" class="form-control file-upload-info" disabled=""
                                            placeholder="Upload Product Video">
                                        <span class="input-group-append">
                                            <button class="file-upload-browse btn btn-primary" type="button">Upload</button>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Product Image<span class="text-warning">*</span></label>
                            <input type="file" name="product_image" id="product_image" class="file-upload-default">
                            <div class="input-group col-xs-12">
                                <input type="text" class="form-control file-upload-info" disabled=""
                                    placeholder="Upload Product Image">
                                <span class="input-group-append">
                                    <button class="file-upload-browse btn btn-primary" type="button">Upload</button>
                                </span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="product_short_desc">Short Description<span class="text-warning">*</span></label>
                            <textarea class="form-control" id="product_short_desc" name="product_short_desc" rows="4">
@if (!empty($productData))
{{ $productData['product_short_desc'] }}
@else
{{ old('product_short_desc') }}
@endif
</textarea>
                        </div>
                        <div class="form-group">
                            <label for="product_long_desc">Description<span class="text-warning">*</span></label>
                            <textarea class="form-control" id="product_long_desc" name="product_long_desc" rows="8">
@if (!empty($productData))
{{ $productData['product_long_desc'] }}
@else
{{ old('product_long_desc') }}
@endif
</textarea>
                        </div>
                        <div class="form-group">
                            <label for="meta_title">Meta Title</label>
                            <input type="text" class="form-control" id="meta_title" name="meta_title"
                                @if (!empty($productData)) value="{{ $productData['meta_title'] }}" @else value="{{ old('meta_title') }}" @endif
                                placeholder="Meta Title">
                        </div>
                        <div class="form-group">
                            <label for="meta_desc">Meta Description</label>
                            <input type="text" class="form-control" id="meta_desc" name="meta_desc"
                                @if (!empty($productData)) value="{{ $productData['meta_desc'] }}" @else value="{{ old('meta_desc') }}" @endif
                                placeholder="Meta Description">
                        </div>
                        <div class="form-group">
                            <label for="meta_keywords">Meta Keywords</label>
                            <input type="text" class="form-control" id="meta_keywords" name="meta_keywords"
                                @if (!empty($productData)) value="{{ $productData['meta_keyword'] }}" @else value="{{ old('meta_keywords') }}" @endif
                                placeholder="Meta Keywords">
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Featured</label>
                            <div class="col-sm-4">
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input type="radio" class="form-check-input" name="is_featured" id="featureRadios1"
                                            value="No" checked="">
                                        No
                                        <i class="input-helper"></i></label>
                                </div>
                            </div>
                            <div class="col-sm-5">
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input type="radio" class="form-check-input" name="is_featured" id="featureRadios2"
                                            value="Yes">
                                        Yes
                                        <i class="input-helper"></i></label>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary me-2">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        $('#datatables').DataTable();
    </script>
    <!-- Custom js for this page-->
    <script src="{{ url('admin_assets/js/file-upload.js') }}"></script>
    <script src="{{ url('admin_assets/js/dashboard.js') }}"></script>
    <script src="{{ url('admin_assets/js/data-table.js') }}"></script>
    <script src="{{ url('admin_assets/js/jquery.dataTables.js') }}"></script>
    <script src="{{ url('admin_assets/js/dataTables.bootstrap4.js') }}"></script>
@endsection
