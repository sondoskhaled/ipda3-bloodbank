<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Hash;
use Auth;
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // if (! auth()->user()->can('user-list'))
        // {
        //     abort(403);
        // }
        $records=User::paginate(20);
        return view('users.index',compact('records'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rule = [
            'name'=>'required',
            'password'=>'required',
            'email'=>'required|email',
            'roles_list' => 'required|array'
        ];
        $msg = [
            'name.required'=>'name filed is required',
            'password.required'=>'password filed is required',
            'email.required'=>'email filed is required',
            'roles_list.required'=>'roles filed is required',
        ];
        $this->validate($request,$rule,$msg);
        $request->merge(['password'=> bcrypt($request->password)]);
        $record=User::create($request->except('roles_list'));
        $record->roles()->attach($request->roles_list);
        flash()->success('user saved successfully');
        return redirect(route('user.index'));
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
        $model= User::findOrFail($id);
        return view('users.edit',compact('model'));
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
            'name'=>'required',
            'password'=>'confirmed',
            'email'=>'email',
            'roles_list' => 'required'
        ];
        $msg = [
            'name.required'=>'name filed is required',
            'password.required'=>'password filed is required',
            'email.required'=>'email filed is required',
            'roles_list.required'=>'roles filed is required',
        ];
        $this->validate($request,$rule,$msg);
        $record=Role::findOrFail($id);
        $request->merge(['password'=> bcrypt($request->password)]);
        
        $record->roles()->sync((array) $request->roles_list);
        $update=$record->update($request->all());

        flash()->success('user edited successfully');
        return redirect(route('user.index'));
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $record= User::findOrFail($id);
        $record->delete();
        flash()->success('user deleted successfully');
        return redirect(route('user.index'));
    }

    public function changePass (){
        return view('users.change_password');
    } 

    public function changePassSave (Request $request, $id){
        if(Hash::check($request->old_password,Auth::user()->password)){
            if($request->new_password == $request->r_new_password){
             Auth::user()->password= bcrypt($request->new_password);
             Auth::user()->save();
             flash()->success('password changed successfully');
             return redirect(route('home'));
            }
         else{
             flash()->error('new password not equal repeat new password');
             return redirect(route('home'));
         }
            
        }
        else{
         flash()->error('old password is wrong');
         return redirect(route('home'));
        }
    }
}
