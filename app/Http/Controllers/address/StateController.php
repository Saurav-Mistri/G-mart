<?php

namespace App\Http\Controllers\address;

use App\Http\Controllers\Controller;
use App\Models\country;
use App\Models\state;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StateController extends Controller
{
    public function index()
    {
        $state = DB::table('states')->join('countries','countries.countryid', '=', 'states.countryid')->get();
        return view('user.address.state.state',compact(['state',$state]));
    }
    public function addState(Request $request)
    {
        if($request->isMethod('POST'))
        {
            $this->validate($request, [
                'countryid' => 'required',
                'statename' => 'required|string|max:100',
            ]);
            $data = $request->all();
            $state = new state;
            $state->countryid = $data['countryid'];
            $state->statename = $data['statename'];
            $state->save();
            return redirect('main-state')->with('success','Your data inserted Successfully..!');
        }
        $country = country::all();
        return view('user.address.state.stateinsert')->with('country',$country);
    }
    public function delState(Request $request, $stateid = null)
    {
        state::where(['stateid'=>$stateid])->delete();
        return redirect()->back()->with('success','Your data deleted Successfully..!');
    }
    public function editState(Request $request,$id)
    {
        $state = state::where(['stateid' => $id])->first();
        $country = country::get();
        return view('user.address.state.stateupdate')->with(compact('state',$state,'country',$country));
    }
    public function updateState(Request $request, $id)
    {
        $this->validate($request, [
            'countryid' => 'required',
            'statename' => 'required|string|max:100',
        ]);
        $state = state::find($id);
        $state->countryid = $request->input('countryid');
        $state->statename = $request->input('statename');
        $state->save();
        return redirect('main-state')->with('success','Your data Updated Successfully..!');
    }
}
