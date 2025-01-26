<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Models\Image;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ImageController extends Controller
{
    public function index()
    {
        $ps = DB::table('images')->join('products','products.pid', '=', 'images.pid')->get();
        return view('user.product.image.image')->with(compact('ps',$ps));
    }
    public function delImage(Request $request, $id)
    {
        DB::table('images')->where(['pimgid' => $id])->delete();
        return redirect()->back()->with('success','Your data deleted successfully..!');
    }
    public function addImage(Request $request)
    {
        if($request->isMethod('post'))
        {
            $this->validate($request, [
                'pid' => 'required',
                'pimg' => 'required',
                'pimg.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:3048',
            ]);

            $fileName = date('Ymd_His').'.'.$request->pimg->extension();
            $request->pimg->move(public_path('/files/'), $fileName);
        
            $data = $request->all();
            $img = new Image;
            $img->pid = $data['pid'];
            $img->pimg = $fileName;
            $img->save();
            return redirect('main-image')->with('success','Your data inserted successfully..!');
        }
        $pro = Product::all();
        return view('user.product.image.imageinsert')->with(compact('pro',$pro));
    }
    public function updateImage(Request $request,$id)
    {
        $this->validate($request, [
            'pimg' => 'required',
            'pimg.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:3048',
        ]);

        $fileName = date('Ymd_His').'.'.$request->pimg->extension();
        $request->pimg->move(public_path('/files/'), $fileName);
        
        $image = Image::where(['pimgid' => $id])->first();
        $image->pid = $request->pid;
        $image->pimg = $fileName;
        $image->save();
        return redirect('main-image')->with('success','Your data updated successfully..!');
    }
    public function editImage(Request $request, $id)
    {
        $image1 = DB::table('images')->where(['pimgid' => $id])->first();
        $pro = Product::get();
        return view('user.product.image.imageupdate')->with(compact('image1', $image1, 'pro', $pro));
    }
}