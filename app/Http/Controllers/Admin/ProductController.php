<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Section;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $productData = Product::with('section', 'category')->get();
        $productData = json_decode(json_encode($productData), true);
        return view('admin.products')->with(compact('productData'));
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
        $statusChanged = Product::where(['id' => $request->post('id')])->update(['status' => $update_status]);
        if ($statusChanged) {
            echo $msg;
        }
    }

    public function deleteProduct(Request $request)
    {
        if ($request->post('action') == 'delete') {
            $update_status = 0;
            $msg = 'Product Deleted successfully';
            $category = Product::find($request->post('id'));
            $category->delete();
            echo $msg;
        }
    }

    public function manage_product(Request $request, $id = null)
    {
        if ($id == "") {
            $msg = 'Product added successfully';
            $page_title = "Add Product";
            $productData = "";
            $product = new Product;
        } else {
            $msg = '*Product updated successfully';
            $page_title = "Edit Product";
            $productData = Product::where('id', $id)->first();
            $productData = json_decode(json_encode($productData), true);

            $product = Product::find($id);
        }

        //Get Section and categories with subcategories
        $category = Section::with('categories')->get();
        $category = json_decode(json_encode($category), true);

        if ($request->isMethod('post')) {
            $data = $request->all();

            //Validation
            $rules = [
                'category_id' => 'required',
                'product_name' => 'required',
                'product_url' => 'required|unique:products,product_url,' . $id,
                'product_code' => 'required',
                'product_mrp' => 'required',
                'product_short_desc' => 'required',
                'product_long_desc' => 'required',
            ];
            $customErrMsg = [
                'product_name.required' => 'Product name is required',
                'product_url.required' => 'Product url is required',
                'product_code.unique' => 'Product code is required',
                'product_mrp.unique' => 'Product MRP is required',
                'product_short_desc.unique' => 'Short Description is required',
                'product_long_desc.unique' => 'Description is required',
            ];
            $this->validate($request, $rules, $customErrMsg);

            if ($request->hasFile('product_image')) {
                $image = $request->file('product_image');
                $ext = $image->extension();
                $image_name = rand(111111111, 999999999) . '.' . $ext;
                $image->storeAs('/public/media/product_images/', $image_name);
                $product->product_image = $image_name;
            }

            if ($request->hasFile('product_video')) {
                $video = $request->file('product_video');
                $ext = $video->extension();
                $video_name = rand(111111111, 999999999) . '.' . $ext;
                $video->storeAs('/public/media/product_images/', $video_name);
                $product->product_video = $video_name;
            }

            $product->category_id = $data['category_id'];
            $product->product_name = $data['product_name'];
            $product->product_url = $data['product_url'];
            $product->product_code = $data['product_code'];
            $product->product_color = $data['product_color'];
            $product->product_mrp = $data['product_mrp'];
            $product->product_price = $data['product_price'];
            $product->product_weight = $data['product_weight'];
            $product->product_short_desc = $data['product_short_desc'];
            $product->product_long_desc = $data['product_long_desc'];
            $product->meta_title = $data['meta_title'];
            $product->meta_desc = $data['meta_desc'];
            $product->meta_keyword = $data['meta_keywords'];
            $product->is_featured = $data['is_featured'];
            $product->status = 1;
            $product->save();
            return redirect('/admin/products')->with('flash_msg', $msg);
        }
        return view('/admin/manage-product')->with(compact('page_title', 'productData', 'category'));
    }

    public function addGallery(Request $request, $id)
    {
        $productData = Product::find($id);
        $productData = json_decode(json_encode($productData), true);
        return view('admin.add-gallery')->with(compact('productData'));
    }
}
