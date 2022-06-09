@extends('layouts.admin_layout.layout')
@section('content')
    <div class="row">
        <div class="col-md-12 grid-margin">
            <div class="d-flex justify-content-between flex-wrap">
                <div class="d-flex align-items-end flex-wrap">
                    <div class="me-md-3 me-xl-5">
                        <h2>Section</h2>
                        <div class="d-flex">
                            <i class="mdi mdi-home text-muted hover-cursor"></i>
                            <p class="text-muted mb-0 hover-cursor">&nbsp;/&nbsp;Dashboard&nbsp;/&nbsp;</p>
                            <p class="text-primary mb-0 hover-cursor">Section</p>
                        </div>

                    </div>
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
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>
                                        S. No.
                                    </th>
                                    <th>
                                        Name
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
                                            {{ $list->name }}
                                        </td>
                                        <td>
                                            @if ($list->status == 1)
                                                <span class="text-success">Active</span>
                                            @else
                                                <span class="text-danger">Inactive</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($list->status == 1)
                                                <a href="{{ url('/admin/section/deactivate/' . $list->id . '') }}"
                                                    type="button" class="btn btn-warning btn-rounded btn-fw">Deactivate</a>
                                            @else
                                                <a href="{{ url('/admin/section/activate/' . $list->id . '') }}"
                                                    type="button" class="btn btn-success btn-rounded btn-fw">Activate</a>
                                            @endif
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
    <script src="{{ url('admin_assets/js/file-upload.js') }}"></script>
@endsection
