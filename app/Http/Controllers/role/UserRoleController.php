<?php

namespace App\Http\Controllers\role;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Role;

class UserRoleController extends Controller
{
    public function index()
    {
        $role = Role::get();
        return view('user.role.role',compact(['role',$role]));
    }
    public function addRole(Request $request)
    {
        if($request->isMethod('POST'))
        {
            $data = $request->all();
            $r = new Role;
            $r->rname = $data['rname'];
            $this->validate($request, [
                'rname' => 'required|string|max:100',
            ]);
            $r->save();
            return redirect('main-role');
        }
        return view('user.role.roleinsert');
    }
    public function editRole(Request $request, $rid)
    {
        if($request->isMethod('POST'))
        {
            $data = $request->all();
            $role = new Role;
            $this->validate($request, [
                'rname' => 'required|string|max:100',
            ]);
            Role::where(['rid' => $rid])->update(['rname' => $data['rname']]);
            return redirect('main-role')->with('success','Your data updated successfully..!');
        }
        $rol = Role::where(['rid' => $rid])->first();
        return view('user.role.roleupdate',compact(['rol',$rol]));
    }
    public function delRole(Request $request, $rid = null)
    {
        Role::where(['rid' => $rid])->delete();
        return redirect()->back()->with('success','Your data deleted successfully..!');
    }
}
