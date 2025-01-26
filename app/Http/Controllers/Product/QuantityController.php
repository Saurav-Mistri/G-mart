<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Models\Quantity;
use Illuminate\Http\Request;

class QuantityController extends Controller
{
    public function index()
    {
        $p_unit = Quantity::get();
        return view('user.product.quantity')->with(compact(['p_unit',$p_unit]));
    }
    public function delQuantity(Request $request, $id = null)
    {
        Quantity::where(['puid' => $id])->delete();
        return redirect()->back()->with('success', 'Your data deleted successfully..!');
    }
    public function addQuantity(Request $request)
    {
        if($request->isMethod('POST'))
    	{
    		$data = $request->all();
    		$punit = new Quantity;
			$punit->putype = $data['qtyname'];
			$this->validate($request, [
				'qtyname' => 'required|string|max:100',
			]);
			$punit->save();
    		return redirect('main-quantity')->with('success','Your data inserted Successfully..!');
    	}
    	return view('user.product.quantityinsert');
    }
    public function editQuantity(Request $request, $id = null)
    {
        if($request->isMethod('post'))
        {
            $data = $request->all();
            $this->validate($request, [
				'qtyname' => 'required|string|max:100',
			]);
            Quantity::where(['puid' => $id])->update(['putype' => $data['qtyname']]);
            return redirect('main-quantity')->with('success','Your data Updated Successfully..!');
        }
        $punit = Quantity::where(['puid' => $id])->first();
        return view('user.product.quantityupdate')->with(compact('punit', $punit));
    }
}