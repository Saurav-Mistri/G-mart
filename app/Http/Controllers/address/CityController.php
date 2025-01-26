<?php

namespace App\Http\Controllers\address;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\city;
use App\Models\state;
use Illuminate\Support\Facades\Redis;
use Whoops\Run;

class CityController extends Controller
{
    public function index()
    {
        $city = DB::table('cities')->join('states','states.stateid','=','cities.stateid')->get();
        return view('user.address.city.city',compact(['city',$city]));
    }
    public function addCity(Request $request)
    {
        if($request->isMethod('POST'))
        {
            $data = $request->all();
            $city = new city;
            $city->stateid = $data['stateid'];
            $city->cityname = $data['cityname'];
            $this->validate($request, [
                'stateid' => 'required',
                'cityname' => 'required|string|max:100',
            ]);
            $city->save();
            return redirect('main-city')->with('success', 'Your data inserted successfully..!');
        }
        $state = state::all();
        return view('user.address.city.cityinsert')->with('state',$state);
    }
    public function delCity(Request $request, $cityid = null)
    {
        city::where(['cityid' => $cityid])->delete();
        return redirect()->back()->with('success','Your data deleted successfully..!');
    }
    public function editCity(Request $request, $cityid)
    {
        $city = DB::table('cities')->where(['cityid' => $cityid])->first();
        $state = state::get();
        return view('user.address.city.cityupdate')->with(compact('city',$city,'state',$state));
    }
    public function updateCity(Request $request, $cityid)
    {
        $this->validate($request, [
            'stateid' => 'required',
            'cityname' => 'required|string|max:100',
        ]);
        $city = city::where(['cityid' => $cityid])->first();
        $city->stateid = $request->input('stateid');
        $city->cityname = $request->input('cityname');
        $city->save();
        return redirect('main-city')->with('status','Your data Updated Successfully..!');
    }
}
