<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    public function index()
    {
        $result['data'] = Coupon::simplePaginate(10);
        // prx($result);
        return view('admin/coupons/coupons', $result);
    }

    public function change_status(Request $request)
    {
        if ($request->post('action') == 'deactivate') {
            $update_status = 0;
            $msg = 'deactivaed';
        } else {
            $update_status = 1;
            $msg = 'activaed';
        }
        $statusChanged = Coupon::where(['id' => $request->post('id')])->update(['status' => $update_status]);
        if ($statusChanged) {
            echo $msg;
        }
    }

    public function manage_coupon(Request $request, $id = null)
    {
        if ($id == "") {
            $msg = '*Coupon added successfully';
            $result['page_title'] = "Add Coupon";
            $result['couponData'] = "";
            $coupon = new Coupon;
        } else {
            $msg = '*Coupon updated successfully';
            $result['page_title'] = "Edit Coupon";
            $result['couponData'] = Coupon::where('id', $id)->first();
            $result['couponData'] = json_decode(json_encode($result['couponData']), true);

            $coupon = Coupon::find($id);
        }


        if ($request->isMethod('post')) {
            $data = $request->all();

            //Validation
            $rules = [
                'coupon_title' => 'required',
                'coupon_code' => 'required|unique:coupons,code,' . $id,
                'coupon_discount' => 'required',
                'coupon_type' => 'required',
            ];
            $customErrMsg = [
                'coupon_title.required' => 'Coupon title is required',
                'coupon_code.required' => 'Coupon code is required',
                'coupon_code.unique' => 'Coupon code already exists!',
                'coupon_discount.required' => 'Coupon discount is required',
                'coupon_type.required' => 'Coupon type is required',
            ];
            $this->validate($request, $rules, $customErrMsg);

            $coupon->title = $data['coupon_title'];
            $coupon->code = $data['coupon_code'];
            $coupon->discount = $data['coupon_discount'];
            $coupon->type = $data['coupon_type'];
            $coupon->min_order_amount = $data['min_order_amount'];
            $coupon->is_one_time = $data['is_one_time'];
            $coupon->status = 1;
            $coupon->save();
            return redirect('/admin/coupons')->with('flash_msg', $msg);
        }
        // prx($result);
        return view('/admin/coupons/manage-coupon', $result);
    }

    public function deleteCoupon(Request $request)
    {
        if ($request->post('action') == 'delete') {
            $msg = 'Coupon Deleted successfully';
            $category = Coupon::find($request->post('id'));
            $category->delete();
            echo $msg;
        }
    }
}
