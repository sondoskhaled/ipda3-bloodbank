<?php

namespace App\Http\Controllers;

use App\Models\DonationRequest;
use Illuminate\Http\Request;

class DonationRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $records=DonationRequest::paginate(20);
        return view('donations.index',compact('records'));
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
        $record= DonationRequest::findOrFail($id);
        return view('donations.show',compact('record'));
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $record= DonationRequest::findOrFail($id);
        $record->delete();
        flash()->success('donation request deleted successfully');
        return redirect(route('donation.index'));
    }

    public function filter(Request $request){
        if(($request->hospital_name != null) && ($request->city_id != null) && ($request->blood_type_id != null)){
           
            $records=DonationRequest::where('hospital_name',$request->hospital_name)->where('city_id',$request->city_id)
            ->where('blood_type_id',$request->blood_type_id)->get();
            //dd($request->phone);
            return view('donations.index',compact('records')); 
        }
        elseif(($request->hospital_name != null) && ($request->city_id != null)){
            $records=DonationRequest::where('hospital_name',$request->hospital_name)->where('city_id',$request->city_id)->get();
            return view('donations.index',compact('records')); 
        }
        elseif(($request->hospital_name != null) && ($request->blood_type_id != null)){
            $records=DonationRequest::where('phone',$request->hospital_name)->where('blood_type_id',$request->blood_type_id)->get();
            return view('donations.index',compact('records')); 
        }
        elseif(($request->city_id != null) && ($request->blood_type_id != null)){
            $records=DonationRequest::where('city_id',$request->city_id)
            ->where('blood_type_id',$request->blood_type_id)->get();
            return view('donations.index',compact('records')); 
        }
        elseif(($request->hospital_name != null)){
            $records=DonationRequest::where('hospital_name',$request->hospital_name)->get();
            return view('donations.index',compact('records')); 
        }
        elseif(($request->city_id != null)){
            $records=DonationRequest::where('city_id',$request->city_id)->get();
            return view('donations.index',compact('records')); 
        }
        elseif(($request->blood_type_id != null)){
            $records=DonationRequest::where('blood_type_id',$request->blood_type_id)->get();
            return view('donations.index',compact('records')); 
        }
        else{
            $records=DonationRequest::paginate(20);
            return view('donations.index',compact('records'));
        }
        
    }
}
