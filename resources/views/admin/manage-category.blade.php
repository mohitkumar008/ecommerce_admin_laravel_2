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
                            <p class="text-muted mb-0 hover-cursor">Categories&nbsp;/&nbsp;</p>
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
                        @if (!isset($categoryData)) action="{{ url('/admin/categories/manage-category') }}" @else action="{{ url('/admin/categories/manage-category/' . $categoryData->id . '') }}" @endif
                        enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="sectionData">Section<span class="text-warning">*</span></label>
                            <select class="form-control" id="sectionData" name="sectionData">
                                <option disabled selected>Select Section</option>
                                @foreach ($getSection as $list)
                                    <option value="{{ $list->id }}"
                                        @if (!empty($categoryData) && $categoryData->section_id == $list->id) {{ 'selected' }} @endif>
                                        {{ $list->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div id="appendCategoryLevel">
                            @include('admin.appendCategoryLevel')
                        </div>
                        <div class="form-group">
                            <label for="category_name">Category Name<span class="text-warning">*</span></label>
                            <input type="text" class="form-control"
                                @if (isset($categoryData)) value="{{ $categoryData->category_name }}" @else value="{{ old('category_name') }}" @endif
                                id="category_name" name="category_name" placeholder="Category Name">
                        </div>
                        <div class="form-group">
                            <label for="category_url">Category Url<span class="text-warning">*</span></label>
                            <input type="text" class="form-control" id="category_url" name="category_url"
                                @if (isset($categoryData)) value="{{ $categoryData->url }}" @else value="{{ old('category_url') }}" @endif
                                placeholder="Category Url">
                        </div>
                        <div class="form-group">
                            <label>Category Image</label>
                            <input type="file" name="category_image" id="category_image" class="file-upload-default">
                            <div class="input-group col-xs-12">
                                <input type="text" class="form-control file-upload-info" disabled=""
                                    placeholder="Upload Category Image">
                                <span class="input-group-append">
                                    <button class="file-upload-browse btn btn-primary" type="button">Upload</button>
                                </span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="category_discount">Category Discount</label>
                            <input type="text" class="form-control" id="category_discount" name="category_discount"
                                @if (isset($categoryData)) value="{{ $categoryData->category_discount }}" @else value="{{ old('category_discount') }}" @endif
                                placeholder="Category Discount">
                        </div>
                        <div class="form-group">
                            <label for="category_desc">Description</label>
                            <textarea class="form-control" id="category_desc" name="category_desc" rows="4">
@if (isset($categoryData))
{{ $categoryData->description }}
@else
{{ old('category_desc') }}
@endif
</textarea>
                        </div>
                        <div class="form-group">
                            <label for="meta_title">Meta Title</label>
                            <input type="text" class="form-control" id="meta_title" name="meta_title"
                                @if (isset($categoryData)) value="{{ $categoryData->meta_title }}" @else value="{{ old('meta_title') }}" @endif
                                placeholder="Meta Title">
                        </div>
                        <div class="form-group">
                            <label for="meta_desc">Meta Description</label>
                            <input type="text" class="form-control" id="meta_desc" name="meta_desc"
                                @if (isset($categoryData)) value="{{ $categoryData->meta_desc }}" @else value="{{ old('meta_desc') }}" @endif
                                placeholder="Meta Description">
                        </div>
                        <div class="form-group">
                            <label for="meta_keywords">Meta Keywords</label>
                            <input type="text" class="form-control" id="meta_keywords" name="meta_keywords"
                                @if (isset($categoryData)) value="{{ $categoryData->meta_keyword }}" @else value="{{ old('meta_keywords') }}" @endif
                                placeholder="Meta Keywords">
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
