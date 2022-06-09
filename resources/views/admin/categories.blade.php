@extends('layouts.admin_layout.layout')
@section('content')
    <div class="row">
        <div class="col-md-12 grid-margin">
            <div class="d-flex justify-content-between flex-wrap">
                <div class="d-flex align-items-end flex-wrap">
                    <div class="me-md-3 me-xl-5">
                        <h2>Categories</h2>
                        <div class="d-flex">
                            <i class="mdi mdi-home text-muted hover-cursor"></i>
                            <p class="text-muted mb-0 hover-cursor">&nbsp;/&nbsp;Dashboard&nbsp;/&nbsp;</p>
                            <p class="text-primary mb-0 hover-cursor">Categories</p>
                        </div>

                    </div>
                </div>
                <div class="d-flex justify-content-between align-items-end flex-wrap">
                    <a href="{{ route('manageCategory') }}" class="btn btn-primary text-white mt-2 mt-xl-0">Add
                        Category</a>
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
                        <table class="table table-striped" id="datatables">
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
                                        Section
                                    </th>
                                    <th>
                                        Parent
                                    </th>
                                    <th>
                                        Discount
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
                                @foreach ($data as $list)
                                    <tr>
                                        <td class="py-1">
                                            {{ $loop->iteration }}.
                                        </td>
                                        <td>
                                            <img src="{{ url('storage/media/category_images/' . $list->category_image . '') }}"
                                                alt="image">

                                        </td>
                                        <td>
                                            {{ $list->category_name }}
                                        </td>
                                        <td>
                                            {{ $list['section']->name }}
                                        </td>
                                        <td>
                                            @if (!empty($list['parentCategory']))
                                                {{ $list['parentCategory']->category_name }}
                                            @else
                                                {{ 'Root' }}
                                            @endif
                                        </td>

                                        <td>
                                            {{ $list->category_discount }}
                                        </td>
                                        <td>
                                            @if ($list->status == 1)
                                                <span class="text-success">Active</span>
                                            @else
                                                <span class="text-danger">Inactive</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="template-demo d-flex justify-content-between flex-nowrap">
                                                @if ($list->status == 1)
                                                    <a href="{{ route('status', ['id' => $list->id, 'status' => 'deactivate', 'url' => $list->url]) }}"
                                                        type="button" title="Deactivate"
                                                        class="btn btn-inverse-warning btn-rounded btn-icon flex-align-justify-center"><i
                                                            class="mdi mdi-block-helper"></i></a>
                                                @else
                                                    <a href="{{ route('status', ['id' => $list->id, 'status' => 'activate', 'url' => $list->url]) }}"
                                                        type="button" title="Activate"
                                                        class="btn btn-inverse-success btn-rounded btn-icon flex-align-justify-center"><i
                                                            class="mdi mdi-security"></i></a>
                                                @endif
                                                <a type="button"
                                                    href="{{ route('manageCategory', ['id' => $list->id]) }}"
                                                    title="Edit"
                                                    class="btn btn-inverse-info btn-rounded btn-icon flex-align-justify-center">
                                                    <i class="mdi mdi-lead-pencil"></i>
                                                </a>
                                                <a type="button" title="Delete"
                                                    href="{{ route('deleteCategory', ['id' => $list->id]) }}"
                                                    class="btn btn-inverse-danger btn-rounded btn-icon flex-align-justify-center">
                                                    <i class="mdi mdi-delete-variant"></i>
                                                </a>
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
