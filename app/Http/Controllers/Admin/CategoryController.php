<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CategoryController extends Controller
{

    public function index()
    {
        $result['data'] = Category::with('section', 'parentCategory')->get();
        // echo "<pre>";
        // print_r($result['data'][0]['parentCategory']);
        // die();
        return view('admin/categories', $result);
    }

    public function change_status(Request $request, $status, $id)
    {
        if ($status == 'deactivate') {
            $update_status = 0;
            $msg = '*Deactivaed successfully';
        } else {
            $update_status = 1;
            $msg = '*Activaed successfully';
        }
        Category::where(['id' => $id])->update(['status' => $update_status]);
        return redirect('/admin/categories')->with('flash_msg', $msg);
    }

    public function appendCategoryLevel(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all();
            $getCategory = Category::with('subcategories')->where(['section_id' => $data['sectionID'], 'parent_id' => 0, 'status' => 1,])->get();
            $getCategory = json_decode(json_encode($getCategory), true);
            // echo '<pre>';
            // print_r($getCategory);
            // die();

            return view('admin/appendCategoryLevel')->with(compact('getCategory'));
        }
    }

    public function manage_category(Request $request, $id = null)
    {
        if ($id == "") {
            $msg = '*Category added successfully';
            $result['page_title'] = "Add Category";
            $category = new Category;
        } else {
            $msg = '*Category updated successfully';
            $result['page_title'] = "Edit Category";
            $result['categoryData'] = Category::where('id', $id)->first();
            $result['getCategory'] = Category::with('subcategories')->where(['section_id' => $result['categoryData']->section_id, 'parent_id' => 0, 'status' => 1,])->get();
            $result['getCategory'] = json_decode(json_encode($result['getCategory']), true);

            $category = Category::find($id);
            // echo "<pre>";
            // print_r($result['getCategory']);
            // die();
        }

        //Get Section
        $result['getSection'] = Section::where(['status' => 1])->get();

        if ($request->isMethod('post')) {
            $data = $request->all();

            //Validation
            $rules = [
                'sectionData' => 'required',
                'category_name' => 'required',
                'category_url' => 'required|unique:categories,url,' . $id,
                'category_image' => 'image',
            ];
            $customErrMsg = [
                'sectionData.required' => 'Parent category is required',
                'category_name.required' => 'Category name is required',
                'category_url.required' => 'Category url is required',
                'category_name.unique' => 'Category name is already exixts!',
                'category_url.unique' => 'Category url is already exixts!',
                'category_image.image' => 'Valid category image is required',
            ];
            $this->validate($request, $rules, $customErrMsg);

            if ($request->hasFile('category_image')) {
                $image = $request->file('category_image');
                $ext = $image->extension();
                $image_name = rand(111111111, 999999999) . '.' . $ext;
                $image->storeAs('/public/media/category_images/', $image_name);
                $category->category_image = $image_name;
            }

            $category->parent_id = $data['parent_category'];
            $category->section_id = $data['sectionData'];
            $category->category_name = $data['category_name'];
            // $category->category_image = $data['sectionData'];
            $category->category_discount = $data['category_discount'];
            $category->description = $data['category_desc'];
            $category->url = $data['category_url'];
            $category->meta_title = $data['meta_title'];
            $category->meta_desc = $data['meta_desc'];
            $category->meta_keyword = $data['meta_keywords'];
            $category->status = 1;
            $category->save();
            return redirect('/admin/categories')->with('flash_msg', $msg);
        }
        return view('/admin/manage-category', $result);
    }

    public function deleteCategory(Request $request, $id)
    {
        $category = Category::find($id);
        $category->delete();

        return redirect('/admin/categories')->with('flash_msg', 'Category deleted successfully');
    }
}
