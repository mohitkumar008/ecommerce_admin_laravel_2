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
                            <h2>Add Attributes</h2>
                            <div class="d-flex">
                                <i class="mdi mdi-home text-muted hover-cursor"></i>
                                <p class="text-muted mb-0 hover-cursor">&nbsp;/&nbsp;Dashboard&nbsp;/&nbsp;</p>
                                <p class="text-muted mb-0 hover-cursor">Products&nbsp;/&nbsp;</p>
                                <p class="text-primary mb-0 hover-cursor">Add Attributes</p>
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
        @if (!empty($productAttrData))
            <div class="row">
                @foreach ($productAttrData as $list)
                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 col-12 grid-margin stretch-card"
                        id="attr-col-{{ $loop->iteration }}">
                        <input type="hidden" name="pattrid[]" value="{{ $list['id'] }}">
                        <div class="card">
                            <div class="text-end">
                                <button type="button" onclick="deleteAttr('{{ $list['id'] }}')"
                                    class="btn btn-danger btn-icon text-white">
                                    <i class="mdi mdi-delete"></i>
                                </button>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label>Size</label>
                                    <input type="text" class="form-control form-control-sm" name="size[]"
                                        placeholder="Enter Size" value="{{ $list['size'] }}" required="true">
                                </div>
                                <div class="form-group">
                                    <label>Price</label>
                                    <input type="number" class="form-control form-control-sm" name="price[]"
                                        placeholder="Enter Price" value="{{ $list['price'] }}" required="true">
                                </div>
                                <div class="form-group">
                                    <label>Stock</label>
                                    <input type="number" class="form-control form-control-sm" name="stock[]"
                                        placeholder="Enter Stock" value="{{ $list['stock'] }}" required="true">
                                </div>
                                <div class="form-group">
                                    <label>SKU</label>
                                    <input type="text" class="form-control form-control-sm" name="sku[]"
                                        placeholder="Enter SKU" value="{{ $list['sku'] }}" required="true">
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
        <div class="row" id="attrCards">
            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body flex-align-justify-center">
                        <button type="button" onclick="addAttribute()" class="btn btn-outline-primary btn-rounded btn-icon"
                            id="add-attr-btn">
                            <i class="mdi mdi-shape-square-plus text-muted"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>
    @if (!empty($productAttrData))
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Added Attributes</h4>
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>
                                            Size
                                        </th>
                                        <th>
                                            Price
                                        </th>
                                        <th>
                                            Stock
                                        </th>
                                        <th>
                                            SKU
                                        </th>
                                        <th>
                                            Action
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($productAttrData as $list)
                                        <tr>
                                            <td class="py-1">
                                                {{ $list['size'] }}
                                            </td>
                                            <td>
                                                {{ $list['price'] }}
                                            </td>
                                            <td>
                                                {{ $list['stock'] }}
                                            </td>
                                            <td>
                                                {{ $list['sku'] }}
                                            </td>
                                            <td>
                                                <button type="button" onclick="deleteAttr('{{ $list['id'] }}')"
                                                    class="btn btn-danger text-white btn-sm">Delete</button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
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
            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 col-12 grid-margin stretch-card" id="attr-col-${i}">
                <div class="card">
                    <div class="text-end">
                        <button type="button" onclick="removeAttrCol(${i})" class="btn btn-danger btn-icon text-white">
                            <i class="mdi mdi-delete"></i>
                        </button></div>
                    <div class="card-body">
                        <div class="form-group">
                            <label>Size</label>
                            <input type="text" class="form-control form-control-sm" name="size[]" placeholder="Enter Size"
                                required="true">
                        </div>
                        <div class="form-group">
                            <label>Price</label>
                            <input type="number" class="form-control form-control-sm" name="price[]" placeholder="Enter Price"
                                required="true">
                        </div>
                        <div class="form-group">
                            <label>Stock</label>
                            <input type="number" class="form-control form-control-sm" name="stock[]" placeholder="Enter Stock"
                                required="true">
                        </div>
                        <div class="form-group">
                            <label>SKU</label>
                            <input type="text" class="form-control form-control-sm" name="sku[]" placeholder="Enter SKU"
                                required="true">
                        </div>
                    </div>
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
