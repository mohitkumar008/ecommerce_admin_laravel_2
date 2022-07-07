<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    public function index()
    {
        $brandData = Brand::all();
        $brandData = json_decode(json_encode($brandData), true);
        return view('admin/brands/brands')->with(compact('brandData'));
    }
}
