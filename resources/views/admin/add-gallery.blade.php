@extends('layouts.admin_layout.layout')
@section('content')
    <form method="post">
        @csrf
        <input type="hidden" name="pid" value="{{ $productData['id'] }}">
        <div class="row">
            @if (session('err_sku_msg'))
                <div class="alert alert-danger">
                    <span>{{ session('err_sku_msg') }}</span>
                </div>
            @endif
            @if (session('err_size_msg'))
                <div class="alert alert-danger">
                    <span>{{ session('err_size_msg') }}</span>
                </div>
            @endif
            <div class="col-md-12 grid-margin">
                <div class="d-flex justify-content-between flex-wrap">
                    <div class="d-flex align-items-end flex-wrap">
                        <div class="me-md-3 me-xl-5">
                            <h2>Add Gallery</h2>
                            <div class="d-flex">
                                <i class="mdi mdi-home text-muted hover-cursor"></i>
                                <p class="text-muted mb-0 hover-cursor">&nbsp;/&nbsp;Dashboard&nbsp;/&nbsp;</p>
                                <p class="text-muted mb-0 hover-cursor">Products&nbsp;/&nbsp;</p>
                                <p class="text-primary mb-0 hover-cursor">Add Gallery</p>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between align-items-end flex-wrap">
                        <button type="submit" class="btn btn-primary text-white mt-2 mt-xl-0">Save
                            Changes</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body text-center" id="attrCards">

                        <button type="button" onclick="addAttribute()" class="btn btn-outline-primary btn-icon-text">
                            <i class="mdi mdi-image-multiple btn-icon-prepend"></i>
                            Add
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
@section('scripts')
    <script>
        @if (!empty($productAttrData))
            var i = {{ count($productAttrData) }} + 1;
        @else
            var i = 1;
        @endif



        function addAttribute() {
            $('#attrCards').prepend(`
                <div class="form-group d-flex align-items-center" id="attr-col-${i}">
                    <button type="button" onclick="removeAttrCol(${i})" class="btn btn-inverse-danger btn-icon">
                        <i class="mdi mdi-delete-variant"></i>
                      </button>
                    <input type="file" name="img[]" class="file-upload-default">
                    <div class="input-group col-xs-12">
                        <input type="text" class="form-control file-upload-info" disabled="" placeholder="Upload Image">
                        <span class="input-group-append">
                            <button class="file-upload-browse btn btn-primary" type="button">Upload</button>
                        </span>
                    </div>
                </div>
            `);
            i++;
        }

        function removeAttrCol(index) {
            $('#attr-col-' + index).remove();
        }
    </script>
    <!-- Custom js for this page-->
    <script src="{{ url('admin_assets/js/file-upload.js') }}"></script>
    <script src="{{ url('admin_assets/js/dashboard.js') }}"></script>
    <script src="{{ url('admin_assets/js/data-table.js') }}"></script>
    <script src="{{ url('admin_assets/js/jquery.dataTables.js') }}"></script>
    <script src="{{ url('admin_assets/js/dataTables.bootstrap4.js') }}"></script>
@endsection
