<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProductImage;
use Illuminate\Http\Request;

class ProdcutImageController extends Controller
{

    public function addGallery(Request $request, $id)
    {
        if ($request->isMethod('post')) {
            $data = $request->all();
            // prx($data);
            if (isset($data['piid'])) {
                foreach ($data['piid'] as $key => $val) {
                    // prx($request->file());
                    if ($request->hasFile("img." . $key)) {
                        $attrimage = $request->file("img." . $key);
                        $ext = $attrimage->extension();
                        $image_name = rand(111111111, 999999999) . '.' . $ext;
                        $attrimage->storeAs('/public/media/product_images/gallery/', $image_name);
                    }
                    $productImage = new ProductImage;
                    $productImage->pid = $id;
                    $productImage->images = $image_name;
                    $productImage->save();
                }
                return redirect('/admin/products/addGallery/' . $id)->with('add_msg', 'Image added successfully');
            } else {
                return redirect('/admin/products/addGallery/' . $id)->with('err_msg', 'No image was added. Please try again');
            }
        }
        $productID = $id;
        $productImageData = ProductImage::where('pid', $id)->get();
        $productImageData = json_decode(json_encode($productImageData), true);
        return view('admin.products.add-gallery')->with(compact('productImageData', 'productID'));
    }


    public function deleteImage(Request $request)
    {
        if ($request->post('action') == 'delete') {
            $msg = 'Attribute Deleted successfully';
            $productImage = ProductImage::find($request->post('id'));
            $productImage->delete();
            echo $msg;
        }
    }

    public function replaceImage(Request $request)
    {
        // prx($request->all());
        $productImage = ProductImage::find($request->post('replaceImgId'));
        if ($request->hasFile("replaceImg")) {
            $attrimage = $request->file("replaceImg");
            $ext = $attrimage->extension();
            $image_name = rand(111111111, 999999999) . '.' . $ext;
            $attrimage->storeAs('/public/media/product_images/gallery/', $image_name);
        }
        $productImage->update(['images' => $image_name]);
        echo "success";
    }
}
