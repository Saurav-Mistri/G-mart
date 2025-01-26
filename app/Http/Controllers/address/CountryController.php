<?php

namespace App\Http\Controllers\address;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\country;

class CountryController extends Controller
{
    public function index()
    {
        $country = Country::get();
        return view('user.address.country.country',compact('country',$country));
    }
    public function addCountry(Request $request)
    {
        if($request->isMethod('POST'))
        {
            $data = $request->all();
            $country = new country;
            $country->countryname = $data['countryname'];
            $this->validate($request, [
				'countryname' => 'required|string|max:100',
			]);
            $country->save();
            return redirect('main-country');
        }
        return view('user.address.country.countryinsert');
    }
    public function delCountry(Request $request, $cid = null)
    {
        country::where(['countryid' => $cid])->delete();
        return redirect()->back()->with('success', 'Your data deleted successfully..!');
    }
    public function editCountry(Request $request,$id)
    {
        if($request->isMethod('POST'))
        {
            $data = $request->all();
            $this->validate($request, [
				'countryname' => 'required|string|max:100',
			]);
            country::where(['countryid' => $id])->update(['countryname' => $data['countryname']]);
            return redirect('main-country')->with('success', 'Your data updated successfully..!');
        }
        $country = country::where(['countryid' => $id])->first();
        return view('user.address.country.countryupdate',compact('country',$country));
    }
}
