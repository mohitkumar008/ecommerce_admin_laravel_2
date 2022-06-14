@extends('layouts.admin_layout.layout')
@section('content')
    <form method="post" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="pid" value="{{ $productID }}">
        <div class="row">
            @if (session('err_msg'))
                <div class="alert alert-danger">
                    <span>{{ session('err_msg') }}</span>
                </div>
            @endif
            @if (session('add_msg'))
                <div class="alert alert-success">
                    <span>{{ session('add_msg') }}</span>
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
            @foreach ($productImageData as $list)
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 col-6 grid-margin stretch-card">
                    <div class="card">
                        <div class="text-end">
                            <button type="button" title="Replace" onclick="replaceGalleryImage('{{ $list['id'] }}')"
                                class="btn btn-info btn-icon text-white">
                                <i class="mdi mdi-replay"></i>
                            </button>
                            <button type="button" title="Delete"
                                onclick="deleteGalleryImage('{{ $list['id'] }}', 'delete')"
                                class="btn btn-danger btn-icon text-white">
                                <i class="mdi mdi-delete"></i>
                            </button>
                        </div>
                        <div class="card-body">
                            <img src="{{ url('storage/media/product_images/gallery/' . $list['images'] . '') }}"
                                class="img-responsive img-fluid" alt="">
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body text-center" id="attrCards">

                        <button type="button" onclick="addAttribute()" class="btn btn-outline-primary btn-icon-text">
                            <i class="mdi mdi-image-multiple btn-icon-prepend"></i>
                            Add Images
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <form method="post" enctype="multipart/form-data" id="replaceImageform">
        @csrf
        <input type="number" id="replaceImgId" name="replaceImgId" hidden />
        <input type="file" id="replaceImg" name="replaceImg" hidden>
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
                    <input type="hidden" value="${i}" name="piid[]" class="form-control">
                    <input type="file" name="img[]" class="form-control">
                    <button type="button" onclick="removeAttrCol(${i})" class="btn btn-inverse-danger btn-icon">
                        <i class="mdi mdi-delete-variant"></i>
                      </button>
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
