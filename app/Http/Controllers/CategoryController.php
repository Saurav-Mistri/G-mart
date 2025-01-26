<?php

namespace App\Http\Controllers;

use App\Models\category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    public function index()
    {
        $category = category::get();
        return view('user.category.category',compact(['category',$category]));
    }
    public function addCategory(Request $request)
    {
        if($request->isMethod('POST'))
    	{
    		$data = $request->all();
    		$cat = new category;
			$cat->cname = $data['name'];
			$this->validate($request, [
				'name' => 'required|string|max:100',
			]);
			$cat->save();
    		return redirect('main-category')->with('success','Your data inserted Successfully..!');
    	}
    	return view('user.category.categoryinsert');
	}
	public function editCategory(Request $request,$cid=null)
	{
    	if($request->isMethod('POST'))
    	{
    		$data = $request->all();
			$this->validate($request, [
				'name' => 'required|string|max:100',
			]);
    		category::where(['cid' => $cid])->update(['cname' => $data['name']]);
    		return redirect('main-category')->with('success','Your data Updated Successfully..!');
    	}
    	$cate = category::where(['cid' => $cid])->first();
    	return view('user.category.categoryupdate')->with(compact('cate'));
    }
	public function delCategory(Request $request, $cid=null)
	{
		category::where(['cid' => $cid])->delete();
    	return redirect()->back()->with('success','Your data deleted Successfully..!');
	}
}