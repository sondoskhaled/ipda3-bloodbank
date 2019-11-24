<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $records=Role::paginate(20);
        return view('roles.index',compact('records'));
   
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('roles.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       // dd($request->all());
        $rule = [
            'name'=>'required|unique:roles,name',
            'display_name'=>'required|unique:roles,display_name',
            'permissions_list' => 'required|array'
        ];
        $msg = [
            'name.required'=>'name filed is required',
            'display_name.required'=>'display name filed is required',
            'permissions_list.required'=>'permissions filed is required',
        ];
        $this->validate($request,$rule,$msg);
       
        $record=Role::create($request->all());
        $record->permissions()->attach($request->permissions_list);
        flash()->success('role saved successfully');
        return redirect(route('role.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $model= Role::findOrFail($id);
        return view('roles.edit',compact('model'));
   
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rule = [
            'name'=>'required|unique:roles,name,'.$id,
            'display_name'=>'required|unique:roles,display_name,'.$id,
            'permissions_list' => 'required|array'
        ];
        $msg = [
            'name.required'=>'name filed is required',
            'display_name.required'=>'display name filed is required',
            'permissions_list.required'=>'permissions filed is required',
        ];
        $this->validate($request,$rule,$msg);
        
       
        $record= Role::findOrFail($id);
        $record->update($request->all());
        $record->permissions()->sync($request->permissions_list);
        flash()->success('role edited successfully');
        return redirect(route('role.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $record= Role::findOrFail($id);
        $record->delete();
        flash()->success('role deleted successfully');
        return redirect(route('role.index'));
    }
}
