@extends('layouts.admin_layout.layout')
@section('content')
    <div class="row">
        <div class="col-md-12 grid-margin">
            <div class="d-flex justify-content-between flex-wrap">
                <div class="d-flex align-items-end flex-wrap">
                    <div class="me-md-3 me-xl-5">
                        <h2>Products</h2>
                        <div class="d-flex">
                            <i class="mdi mdi-home text-muted hover-cursor"></i>
                            <p class="text-muted mb-0 hover-cursor">&nbsp;/&nbsp;Dashboard&nbsp;/&nbsp;</p>
                            <p class="text-primary mb-0 hover-cursor">Products</p>
                        </div>

                    </div>
                </div>
                <div class="d-flex justify-content-between align-items-end flex-wrap">
                    <a href="{{ route('manageProduct') }}" class="btn btn-primary text-white mt-2 mt-xl-0">Add
                        Product</a>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    @if (session('flash_msg'))
                        <h4 class="card-title text-success">{{ session('flash_msg') }}</h4>
                    @endif
                    <div class="table-responsive">
                        <table class="table" id="datatables">
                            <thead>
                                <tr>
                                    <th>
                                        S. No.
                                    </th>
                                    <th>
                                        Image
                                    </th>
                                    <th>
                                        Name
                                    </th>
                                    <th>
                                        Category
                                    </th>
                                    <th>
                                        MRP
                                    </th>
                                    <th>
                                        Price
                                    </th>
                                    <th>
                                        Featured
                                    </th>
                                    <th>
                                        Status
                                    </th>
                                    <th>
                                        Action
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($productData as $list)
                                    <tr>
                                        <td class="py-1">
                                            {{ $loop->iteration }}.
                                        </td>
                                        <td>
                                            @if ($list['product_image'] != '')
                                                <img src="{{ url('storage/media/product_images/' . $list['product_image'] . '') }}"
                                                    alt="image">
                                            @else
                                                <img src="{{ asset('admin_assets/images/demo.jpg') }}" alt="image">
                                            @endif

                                        </td>
                                        <td>
                                            {{ $list['product_name'] }}
                                        </td>
                                        <td>
                                            @if (!empty($list['category']))
                                                {{ $list['category']['category_name'] }}
                                            @else
                                                {{ 'Root' }}
                                            @endif
                                        </td>

                                        <td>
                                            {{ $list['product_mrp'] }}
                                        </td>
                                        <td>
                                            {{ $list['product_price'] }}
                                        </td>
                                        <td>
                                            {{ $list['is_featured'] }}
                                        </td>
                                        <td>
                                            @if ($list['status'] == 1)
                                                <span class="text-success">Active</span>
                                            @else
                                                <span class="text-danger">Inactive</span>
                                            @endif
                                        </td>
                                        <td>
                                            @csrf
                                            <div class="template-demo d-flex justify-content-between flex-nowrap">
                                                @if ($list['status'] == 1)
                                                    <button
                                                        onclick="changeProductStatus('{{ $list['id'] }}','deactivate',)"
                                                        type="button" title="Deactivate"
                                                        class="btn btn-inverse-warning btn-rounded btn-icon flex-align-justify-center"><i
                                                            class="mdi mdi-block-helper"></i></button>
                                                @else
                                                    <button onclick="changeProductStatus('{{ $list['id'] }}','activate')"
                                                        type="button" title="Activate"
                                                        class="btn btn-inverse-success btn-rounded btn-icon flex-align-justify-center"><i
                                                            class="mdi mdi-security"></i></button>
                                                @endif
                                                <a type="button"
                                                    href="{{ route('addAttribute', ['id' => $list['id']]) }}"
                                                    title="Add Attribute"
                                                    class="btn btn-inverse-success btn-rounded btn-icon flex-align-justify-center">
                                                    <i class="mdi mdi-library-plus"></i>
                                                </a>
                                                <a type="button" href="{{ route('addGallery', ['id' => $list['id']]) }}"
                                                    title="Add Gallery"
                                                    class="btn btn-inverse-warning btn-rounded btn-icon flex-align-justify-center">
                                                    <i class="mdi mdi-image-multiple"></i>
                                                </a>
                                                <a type="button"
                                                    href="{{ route('manageProduct', ['id' => $list['id']]) }}"
                                                    title="Edit"
                                                    class="btn btn-inverse-info btn-rounded btn-icon flex-align-justify-center">
                                                    <i class="mdi mdi-lead-pencil"></i>
                                                </a>
                                                <button onclick="deleteProduct('{{ $list['id'] }}','delete')"
                                                    type="button" title="Delete"
                                                    class="btn btn-inverse-danger btn-rounded btn-icon flex-align-justify-center">
                                                    <i class="mdi mdi-delete-variant"></i>
                                                </button>
                                            </div>

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
@endsection
@section('scripts')
    <script>
        $('#datatables').DataTable();
    </script>
    <script src="{{ url('admin_assets/js/dashboard.js') }}"></script>
    <script src="{{ url('admin_assets/js/data-table.js') }}"></script>
    <script src="{{ url('admin_assets/js/jquery.dataTables.js') }}"></script>
    <script src="{{ url('admin_assets/js/dataTables.bootstrap4.js') }}"></script>
@endsection
