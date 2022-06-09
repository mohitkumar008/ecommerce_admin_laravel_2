<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;;

use Illuminate\Support\Facades\Session;;

use App\Models\Admin;

class AdminController extends Controller
{
    public function dashboard()
    {
        $result['data'] = Auth::guard('admin')->user();
        return view('admin/dashboard', $result);
    }

    public function settings()
    {
        $result['data'] = Auth::guard('admin')->user();
        // dd($result['data']->password);
        return view('admin/settings', $result);
    }

    public function login(Request $request)
    {
        if ($request->isMethod('post')) {

            $validated = $request->validate([
                'email' => 'required|email|max:255',
                'password' => 'required',
            ]);

            $data = $request->all();
            if (Auth::guard('admin')->attempt(['email' => $data['email'], 'password' => $data['password']])) {
                Session::put('ADMIN_ID', Auth::guard('admin')->user()->id);
                Session::put('ADMIN_NAME', Auth::guard('admin')->user()->name);
                Session::put('ADMIN_EMAIL', Auth::guard('admin')->user()->email);
                Session::put('ADMIN_IMAGE', Auth::guard('admin')->user()->image);
                return redirect('admin/dashboard');
            } else {
                Session::flash('login_err', 'Incorrect email or password!');
                return redirect()->back();
            }
        }
        return view('admin/login');
    }

    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
        return redirect('admin/')->with('logout_msg', 'Loggedout successfully!');
    }

    public function check_curr_pwd(Request $request)
    {
        $data = $request->post('curr_pwd');
        if (Hash::check($request->post('curr_pwd'), Auth::guard('admin')->user()->password)) {
            echo true;
        } else {
            echo false;
        }
    }

    public function change_pwd(Request $request)
    {
        $data = $request->all();
        if (Hash::check($request->post('curr_pwd'), Auth::guard('admin')->user()->password)) {
            if ($data['new_pwd'] === $data['cnfrm_new_pwd']) {
                Admin::where(['id' => Auth::guard('admin')->user()->id])->update(['password' => Hash::make($data['new_pwd'])]);
                return redirect('admin/settings')->with('update_pwd', "Password changed successfully :)");
            }
        } else {
            return redirect('admin/settings')->back();
        }
    }

    public function update_profile(Request $request)
    {
        $data = $request->all();
        if ($request->hasFile('admin_image')) {
            $image = $request->file('admin_image');
            $ext = $image->extension();
            $image_name = rand(111111111, 999999999) . '.' . $ext;
            $image->storeAs('/public/media', $image_name);
        } else {
            $image_name = Auth::guard('admin')->user()->image;
        }
        Admin::where(['id' => Auth::guard('admin')->user()->id])->update(['name' => $data['admin_name'], 'mobile' => $data['admin_mobile'], 'image' => $image_name]);
        return redirect('admin/settings')->with('update_pwd', "Profile information updated successfully:)");
    }
}
