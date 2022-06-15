@extends('layouts.admin_layout.layout')
@section('content')
    <div class="row">
        <div class="col-md-12 grid-margin">
            <div class="d-flex justify-content-between flex-wrap">
                <div class="d-flex align-items-end flex-wrap">
                    <div class="me-md-3 me-xl-5">
                        <h2>Coupons</h2>
                        <div class="d-flex">
                            <i class="mdi mdi-home text-muted hover-cursor"></i>
                            <p class="text-muted mb-0 hover-cursor">&nbsp;/&nbsp;Dashboard&nbsp;/&nbsp;</p>
                            <p class="text-primary mb-0 hover-cursor">Coupons</p>
                        </div>

                    </div>
                </div>
                <div class="d-flex justify-content-between align-items-end flex-wrap">
                    <a href="{{ route('manageCoupon') }}" class="btn btn-primary text-white mt-2 mt-xl-0">Add
                        Coupon</a>
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
                        @csrf
                        <table class="table table-striped" id="datatables">
                            <thead>
                                <tr>
                                    <th>
                                        S. No.
                                    </th>
                                    <th>
                                        Title
                                    </th>
                                    <th>
                                        Code
                                    </th>
                                    <th>
                                        Discount
                                    </th>
                                    <th>
                                        Type
                                    </th>
                                    <th>
                                        Min Order Amount
                                    </th>
                                    <th>
                                        One time
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
                                            {{ $list->title }}
                                        </td>
                                        <td>
                                            {{ $list->code }}
                                        </td>
                                        <td>
                                            {{ $list->discount }}
                                        </td>
                                        <td>
                                            {{ $list->type }}
                                        </td>
                                        <td>
                                            {{ $list->min_order_amount }}
                                        </td>
                                        <td>
                                            {{ $list->is_one_time == 1 ? 'Yes' : 'No' }}
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
                                                @if ($list['status'] == 1)
                                                    <button onclick="changeCouponStatus('{{ $list->id }}','deactivate')"
                                                        type="button" title="Deactivate"
                                                        class="btn btn-inverse-warning btn-rounded btn-icon flex-align-justify-center"><i
                                                            class="mdi mdi-block-helper"></i></button>
                                                @else
                                                    <button onclick="changeCouponStatus('{{ $list->id }}','activate')"
                                                        type="button" title="Activate"
                                                        class="btn btn-inverse-success btn-rounded btn-icon flex-align-justify-center"><i
                                                            class="mdi mdi-security"></i></button>
                                                @endif
                                                <a type="button" href="{{ route('manageCoupon', ['id' => $list->id]) }}"
                                                    title="Edit"
                                                    class="btn btn-inverse-info btn-rounded btn-icon flex-align-justify-center">
                                                    <i class="mdi mdi-lead-pencil"></i>
                                                </a>
                                                <button onclick="deleteCoupon('{{ $list->id }}','delete')"
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
                    {{ $data->render() }}
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
