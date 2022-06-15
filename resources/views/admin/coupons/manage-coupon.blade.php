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
                            <p class="text-muted mb-0 hover-cursor">Coupon&nbsp;/&nbsp;</p>
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
                        @if (empty($couponData)) action="{{ url('/admin/coupon/manage-coupon') }}" @else action="{{ url('/admin/coupon/manage-coupon/' . $couponData['id'] . '') }}" @endif>
                        @csrf

                        <div class="form-group">
                            <label for="coupon_title">Coupon Title<span class="text-warning">*</span></label>
                            <input type="text" class="form-control"
                                @if (!empty($couponData)) value="{{ $couponData['title'] }}" @else value="{{ old('coupon_title') }}" @endif
                                id="coupon_title" name="coupon_title" placeholder="Coupon Title">
                        </div>
                        <div class="form-group">
                            <label for="coupon_code">Coupon Code<span class="text-warning">*</span></label>
                            <input type="text" class="form-control" id="coupon_code" name="coupon_code"
                                @if (!empty($couponData)) value="{{ $couponData['code'] }}" @else value="{{ old('coupon_code') }}" @endif
                                placeholder="Coupon Code">
                        </div>
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label for="coupon_discount">Coupon Discount</label>
                                    <input type="text" class="form-control" id="coupon_discount" name="coupon_discount"
                                        @if (!empty($couponData)) value="{{ $couponData['discount'] }}" @else value="{{ old('coupon_discount') }}" @endif
                                        placeholder="Coupon Discount">
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label for="coupon_type">Coupon Type</label>
                                    <select class="form-control" id="coupon_type" name="coupon_type"
                                        placeholder="Coupon Type">
                                        <option @if (!empty($couponData) && $couponData['type'] == 'Val') {{ 'selected' }} @endif value="Val">
                                            Value</option>
                                        <option @if (!empty($couponData) && $couponData['type'] == 'Per') {{ 'selected' }} @endif value="Per">
                                            Percent</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label for="min_order_amount">Minimum Order Amount</label>
                                    <input type="text" class="form-control" id="min_order_amount" name="min_order_amount"
                                        @if (!empty($couponData)) value="{{ $couponData['min_order_amount'] }}" @else value="{{ old('min_order_amount') }}" @endif
                                        placeholder="Minimum Order Amount">
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label for="is_one_time">Is one time?</label>
                                    <select class="form-control" id="is_one_time" name="is_one_time">
                                        <option @if (!empty($couponData) && $couponData['is_one_time'] == '1') {{ 'selected' }} @endif value="1">
                                            Yes</option>
                                        <option @if (!empty($couponData) && $couponData['is_one_time'] == '0') {{ 'selected' }} @endif value="0">
                                            No</option>
                                    </select>
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
