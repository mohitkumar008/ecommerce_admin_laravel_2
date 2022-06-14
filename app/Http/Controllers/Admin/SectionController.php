<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Section;
use Illuminate\Http\Request;

class SectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $result['data'] = Section::all();
        return view('admin/sections/section', $result);
    }

    public function change_status(Section $section, $status, $id)
    {
        if ($status == 'deactivate') {
            $update_status = 0;
            $msg = '*Deactivaed successfully';
        } else {
            $update_status = 1;
            $msg = '*Activaed successfully';
        }
        Section::where(['id' => $id])->update(['status' => $update_status]);
        return redirect('/admin/section')->with('flash_msg', $msg);
    }
}
