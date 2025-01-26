<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\subcategory;
use App\Models\category;

class SubCategoryController extends Controller
{
    public function index()
    {
        $subcategory = DB::table('subcategory')->join('category','category.cid','=','subcategory.cid')->get();
        return view('user.subcategory.subcategory', compact(['subcategory',$subcategory]));
    }
    public function addSubcategory(Request $request)
    {
        if($request->isMethod('POST'))
    	{
    		$data = $request->all();
            $sub = new subcategory;
            $sub->scname = $data['scname'];
            $sub->cid = $data['cid'];
            $this->validate($request, [
                'scname' => 'required|string|max:100',
                'cid' => 'required',
            ]);
			$sub->save();
    		return redirect('main-sub-category')->with('success','Your data inserted Successfully..!');
        }
        $category = category::all();
        return view('user.subcategory.subcategoryinsert')->with('category',$category);
    }
    public function delSubcategory(Request $request, $id = null)
    {
		subcategory::where(['id' => $id])->delete();
    	return redirect()->back()->with('success','Your data deleted Successfully..!');
    }
    public function editSubCategory(Request $request, $id)
    {
        $subcate = DB::table('subcategory')->find($id);
        $cate = category::get();
        return view('user.subcategory.subcategoryupdate')->with(compact('subcate',$subcate,'cate',$cate));
    }
    public function updateSubCategory(Request $request, $id)
    {
        $this->validate($request, [
            'scname' => 'required|string|max:100',
            'cid' => 'required',
        ]);
        $subcate = subcategory::find($id);
        $subcate->cid = $request->input('cid');
        $subcate->scname = $request->input('scname');
        $subcate->save();
        return redirect('main-sub-category')->with('status','Your data Updated Successfully..!');
    }
}
