<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Models\category;
use App\Models\Image;
use App\Models\Product;
use App\Models\Quantity;
use App\Models\subcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function index()
    {
        $product = DB::table('products')->join('subcategory', 'subcategory.id', '=', 'products.subcategoryid')->join('category', 'category.cid', '=', 'subcategory.cid')->join('product_unit', 'product_unit.puid', '=', 'products.puid')->join('images','images.pid', '=', 'products.pid')->get();
        $category = category::get();
        $subcategory = subcategory::get();
        $punit = Quantity::get();
        return view('user.product.product')->with(compact(['category', $category, 'subcategory', $subcategory, 'product', $product, 'punit', $punit]));
    }
    public function delProduct(Request $request, $pid = null)
    {
        Product::where(['pid' => $pid])->delete();
        return redirect()->back()->with('success', 'Your data deleted successfully..!');
    }
    public function addProduct(Request $request)
    {
        if ($request->isMethod('post')) {
            $data = $request->all();
            $this->validate($request, [
                'categoryid' => 'required',
                'subcategoryid' => 'required',
                'pname' => 'required|string|max:100',
                'puid' => 'required',
                'pqty' => 'required|max:3',
                'pdesc' => 'required|string|max:255',
                'pprice' => 'required|regex:/^\d+(\.\d{1,2})?$/',
            ]);

            //Insert multiple img
            /*foreach ($request->file('pimg') as $image) {
                $imageName = $image->getClientOriginalName();
                $image->move(public_path() . '/files/', $imageName);
                $fileNames[] = $imageName;
            }
            $images = json_encode($fileNames);*/
            $product = new Product;
            $product->categoryid = $data['categoryid'];
            $product->subcategoryid = $data['subcategoryid'];
            $product->pname = $data['pname'];
            $product->puid = $data['puid'];
            $product->pqty = $data['pqty'];
            $product->pdesc = $data['pdesc'];
            $product->pprice = $data['pprice'];
            $product->save();
            return redirect('main-product')->with('success', 'Your data inserted successfully..!');
        }
        $category = DB::table('category')->get();
        $punit = Quantity::get();
        return view('user.product.productinsert')->with(compact(['category', $category, 'punit', $punit]));
    }
    public function index1()
    {
        $data = DB::table('category')->get();
        return view('user.product.productinsert')->with('data', $data);
    }
    public function CatEdit($cid)
    {
        echo json_encode(DB::table('subcategory')->where('cid', $cid)->get());
    }
    public function editProduct(Request $request, $id)
    {
        $product = DB::table('products')->join('subcategory', 'subcategory.id', '=', 'products.subcategoryid')->join('category', 'category.cid', '=', 'subcategory.cid')->join('product_unit', 'product_unit.puid', '=', 'products.puid')->where(['pid' => $id])->first();
        $category = category::get();
        $subcategory = subcategory::get();
        $punit = Quantity::get();
        return view('user.product.productupdate')->with(compact(['category', $category, 'product', $product, 'subcategory', $subcategory, 'punit', $punit]));
    }
    public function updateProduct(Request $request, $id)
    {
        $this->validate($request, [
            'categoryid' => 'required',
            'subcategoryid' => 'required',
            'pname' => 'required|string|max:100',
            'pdesc' => 'required|string|max:255',
            'pqty' => 'required|',
            'puid' => 'required',
            'pqty' => 'required|max:3',
            'pdesc' => 'required|string|max:255',
            'pprice' => 'required|regex:/^\d+(\.\d{1,2})?$/',
        ]);
        $product = Product::where(['pid' => $id])->first();
        $product->categoryid = $request->input('categoryid');
        $product->subcategoryid = $request->input('subcategoryid');
        $product->pname = $request->input('pname');
        $product->puid = $request->input('puid');
        $product->pqty = $request->input('pqty');
        $product->pdesc = $request->input('pdesc');
        $product->pprice = $request->input('pprice');
        $product->save();
        return redirect('main-product')->with('success', 'Your data updated successfully..!');
    }
    public function updateImage(Request $request, $id)
    {
        $product = Product::where(['pid' => $id])->first();
        return view('user.product.imageupdate')->with(compact('product',$product));
    }
}
