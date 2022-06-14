<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductAttr;

class ProductAttrController extends Controller
{
    public function addAttribute(Request $request, $id)
    {
        $productData = Product::find($id);
        $productData = json_decode(json_encode($productData), true);
        if ($request->isMethod('post')) {

            $productAttrData = "";
            $data = $request->all();

            foreach ($data['sku'] as $key => $val) {
                if (!empty($val)) {

                    if (!isset($data['pattrid'][$key]) || $data['pattrid'][$key] == "") {

                        $validateSku = ProductAttr::where(['sku' => $val, 'pid' => $data['pid']])->count();
                        if ($validateSku > 0) {
                            return redirect('/admin/products/add-attribute/' . $id . '')->with('err_sku_msg', 'Please enter unique sku in every attribute and make sure that you don\'t use the existing sku');
                            exit();
                        }

                        $validateSize = ProductAttr::where(['size' => $data['size'][$key], 'pid' => $data['pid']])->count();
                        if ($validateSize > 0) {
                            return redirect('/admin/products/add-attribute/' . $id . '')->with('err_size_msg', 'Please enter another size and make sure that you don\'t use the existing size');
                            exit();
                        }
                        $productAttr = new ProductAttr;
                    } else {
                        $productAttr = ProductAttr::where(['id' => $data['pattrid'][$key]])->first();
                    }
                    $productAttr->pid = $data['pid'];
                    $productAttr->size = $data['size'][$key];
                    $productAttr->price = $data['price'][$key];
                    $productAttr->stock = $data['stock'][$key];
                    $productAttr->sku = $val;
                    $productAttr->save();
                }
            }
            return redirect('/admin/products/add-attribute/' . $id . '')->with(compact('productData', 'productAttrData'));
        } else {
            $productAttrData = ProductAttr::where(['pid' => $id])->get();
            $productAttrData = json_decode(json_encode($productAttrData), true);
            return view('admin.products.add-attribute')->with(compact('productData', 'productAttrData'));
        }
    }


    public function deleteAttribute(Request $request)
    {
        $update_status = 0;
        $msg = 'Attribute Deleted successfully';
        $category = ProductAttr::find($request->post('id'));
        $category->delete();
        echo $msg;
    }
}
