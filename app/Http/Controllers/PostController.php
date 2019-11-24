<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Image;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $records=Post::paginate(20);
        return view('posts.index',compact('records'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
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
            'title'=>'required',
            'content'=>'required',
            'img'=>'required|image|mimes:jpeg,png,jpg|max:2048',
            'category_id'=>'required|exists:categories,id'
        ];
        $msg = [
            'title.required'=>'this filed is required',
            'content.required'=>'this filed is required',
            'img.required'=>'this filed is required',
            'category_id.required'=>'this filed is required',
            'category_id.exists'=>'this filed is not exist'
        ];
        $this->validate($request,$rule,$msg);
        $record=new Post();
       // dd($request->img); 
        if($request->hasFile('img')){
            $photo=$request->img;
            $filename=time()."-".$photo->getClientOriginalName();
            $dist=public_path('images/posts/'.$filename);
            Image::make($photo)->resize(800,400)->save($dist);
            $photoPath='images/posts/'.$filename;
            //dd($photoPath);

            $record->img=$photoPath;
            }
            $record->title=$request->title;
            $record->content=$request->content;
            $record->category_id=$request->category_id;
            $record->save();
            flash()->success('post saved successfully');
            return redirect(route('post.index'));
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
        $model= Post::findOrFail($id);
        return view('posts.edit',compact('model'));
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
            'title'=>'required',
            'content'=>'required',
            'img'=>'image|mimes:jpeg,png,jpg|max:2048',
            'category_id'=>'required|exists:categories,id'
        ];
        $msg = [
            'title.required'=>'this filed is required',
            'content.required'=>'this filed is required',
            'img.required'=>'this filed is required',
            'category_id.required'=>'this filed is required',
            'category_id.exists'=>'this filed is not exist'
        ];
        $this->validate($request,$rule,$msg);
        $record=Post::findOrFail($id);
       // dd($request->img); 
        if($request->hasFile('img')){
            $photo=$request->img;
            $filename=time()."-".$photo->getClientOriginalName();
            $dist=public_path('images/posts/'.$filename);
            Image::make($photo)->resize(800,400)->save($dist);
            $photoPath='images/posts/'.$filename;
            //dd($photoPath);

            $record->img=$photoPath;
            }
            $record->title=$request->title;
            $record->content=$request->content;
            $record->category_id=$request->category_id;
            $record->save();
            flash()->success('post Edited successfully');
            return redirect(route('post.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
        $record= Post::findOrFail($id);
        $record->delete();
        flash()->success('post deleted successfully');
        return redirect(route('post.index'));
    }
}
