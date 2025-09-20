<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PermissionController extends Controller
{
    // this method will show permission page
    public function index()
    {
        
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
            'name' => 'required|unique::permissions|min:3'
        ]);

        if ($validator->passes()) {
        
        } else {
            return redirect()->route('permissions.create')->withInput()->withErrors($validator);
        }
    }

    // this method will show edit permission page
    public function edit()
    {
        
    }

    // this method will update a permission in DB
    public function update()
    {
        
    }

    // this method will delete a permission in DB
    public function destroy()
    {
        
    }
}
