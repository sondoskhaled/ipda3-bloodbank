<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller 
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $records=Client::paginate(20);
        return view('clients.index',compact('records'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
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
        $record= Client::findOrFail($id);
        if($record->is_active == 0){
            $record->is_active=1;
            $record->save();
            flash()->success('client activated successfully');
            return redirect(route('client.index'));
        }
        elseif($record->is_active == 1){
            $record->is_active=0;
            $record->save();
            flash()->success('client deactivated successfully');
            return redirect(route('client.index'));
        }
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $record= Client::findOrFail($id);
        $record->delete();
        flash()->success('client deleted successfully');
        return redirect(route('client.index'));
    }

    public function filter(Request $request){
        if(($request->phone != null) && ($request->city_id != null) && ($request->blood_type_id != null)){
           
            $records=Client::where('phone',$request->phone)->where('city_id',$request->city_id)
            ->where('blood_type_id',$request->blood_type_id)->get();
            //dd($request->phone);
            return view('clients.index',compact('records')); 
        }
        elseif(($request->phone != null) && ($request->city_id != null)){
            $records=Client::where('phone',$request->phone)->where('city_id',$request->city_id)->get();
            return view('clients.index',compact('records')); 
        }
        elseif(($request->phone != null) && ($request->blood_type_id != null)){
            $records=Client::where('phone',$request->phone)->where('blood_type_id',$request->blood_type_id)->get();
            return view('clients.index',compact('records')); 
        }
        elseif(($request->city_id != null) && ($request->blood_type_id != null)){
            $records=Client::where('city_id',$request->city_id)
            ->where('blood_type_id',$request->blood_type_id)->get();
            return view('clients.index',compact('records')); 
        }
        elseif(($request->phone != null)){
            $records=Client::where('phone',$request->phone)->get();
            return view('clients.index',compact('records')); 
        }
        elseif(($request->city_id != null)){
            $records=Client::where('city_id',$request->city_id)->get();
            return view('clients.index',compact('records')); 
        }
        elseif(($request->blood_type_id != null)){
            $records=Client::where('blood_type_id',$request->blood_type_id)->get();
            return view('clients.index',compact('records')); 
        }
        else{
            $records=Client::paginate(20);
            return view('clients.index',compact('records'));
        }
        
    }
}
