<?php

namespace App\Http\Controllers;

use App\Models\City;
use Illuminate\Http\Request;

class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $records=City::paginate(20);
        return view('cities.index',compact('records'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('cities.create');

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
            'governorate_id'=>'required|exists:governorates,id'
        ];
        $msg = [
            'name.required'=>'this filed is required',
            'governorate_id.required'=>'this filed is required',
            'governorate_id.exists'=>'this filed is not exist'
        ];
        $this->validate($request,$rule,$msg);
       
        $record=City::create($request->all());
        flash()->success('city saved successfully');
        return redirect(route('city.index'));
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
        $model= City::findOrFail($id);
        return view('cities.edit',compact('model'));
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
        $record= City::findOrFail($id);
        $record->update($request->all());
        flash()->success('city edited successfully');
        return redirect(route('city.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $record= City::findOrFail($id);
        $record->delete();
        flash()->success('city deleted successfully');
        return redirect(route('city.index'));
    }
}
