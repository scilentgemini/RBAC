<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    // this method will show permission page
    public function index()
    {
        $permissions = Permission::orderBy('created_at', 'asc')->paginate(10);
        return view('permissions.list',[
            'permissions' => $permissions
        ]);
    }

    // this method will show create permission page
    public function create()
    {
        return view('permissions.create');
    }

    // this method will insert a permission in DB
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name' => 'required|unique:permissions|min:3'
        ]);

        if ($validator->passes()) {
            Permission::create(['name' => $request->name]);
            return redirect()->route('permissions.index')->with('success', 'Permission added successfully.');

        } else {
            return redirect()->route('permissions.create')->withInput()->withErrors($validator);
        }
    }

    // this method will show edit permission page
    public function edit($id)
    {
        $permission = Permission::findOrFail($id);

        return view('permissions.edit', [
            'permission' => $permission
        ]);

    }

    // this method will update a permission in DB
    public function update($id, Request $request)
    {
         $validator = Validator::make($request->all(),[
            'name' => 'required|min:3|unique:permissions,name,'.$id.',id'
        ]);

        if ($validator->passes()) {
            $permission = Permission::findOrFail($id);

            //Permission::create(['name' => $request->name]);
            $permission->name = $request->name;
            $permission->save();

            return redirect()->route('permissions.index')->with('success', 'Permission updated successfully.');

        } else {
            return redirect()->route('permissions.edit', $id)->withInput()->withErrors($validator);
        }
    }

    // this method will delete a permission in DB
    public function destroy()
    {
        
    }
}
