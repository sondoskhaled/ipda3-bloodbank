<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactUsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $records=Contact::paginate(20);
        return view('contacts.index',compact('records'));
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
        $record= Contact::findOrFail($id);
        $record->delete();
        flash()->success('contact deleted successfully');
        return redirect(route('contact.index'));
    }

    public function filter(Request $request){

        if(($request->phone != null) && ($request->email != null)){
           
            $records=Contact::where('phone',$request->phone)->where('email',$request->email)->get();
            
            return view('contacts.index',compact('records')); 
        }
        elseif(($request->phone != null)){
            $records=Contact::where('phone',$request->phone)->get();
            return view('contacts.index',compact('records')); 
        }
        elseif(($request->email != null)){
            $records=Contact::where('email',$request->email)->get();
            return view('contacts.index',compact('records')); 
        }
        else{
            $records=Contact::paginate(20);
            return view('contacts.index',compact('records'));
        }

    }
}
