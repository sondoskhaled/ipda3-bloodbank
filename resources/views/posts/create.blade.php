@extends('layouts.admin')
@inject('model','App\Models\Post')
@inject('category','App\Models\Category')
@section('title')
Add New Post
@endsection

@section('content')
<div class="row ">
<div class="col-md-6 m-auto">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Add New Post</h3>
                

              </div>
              <!-- /.card-header -->
              <!-- form start -->
              {!! Form::model($model,[
                'action' => 'PostController@store'
                ]) !!}
                <div class="card-body">
                @include('partial.validate_errors')
                <div class="form-group">
                    <label for="exampleInputSelect">Select Category</label>
                    {!! Form::select('category_id', $category::pluck('name', 'id'), null,
                     ['class' => 'form-control',
                     'id' => 'exampleInputSelect',
                     'placeholder' => 'Select Category ...']) !!}
                </div>
                <div class="form-group">
                    <label for="exampleInputTitle">Post Title</label>

                    {!! Form::text('title',null,[
                        'class' => 'form-control',
                        'placeholder' => 'Enter poat title',
                        'id' => 'exampleInputTitle'
                        ]) !!} 
                </div>

                <div class="form-group">
                    <label for="exampleInputContent">Post Content</label>

                    {!! Form::textarea('content',null,[
                        'class' => 'form-control',
                        'placeholder' => 'Enter poat Content',
                        'id' => 'exampleInputContent'
                        ]) !!} 
                </div>

                <div class="form-group">
                    <label for="exampleInputImage">Post image</label>

                    {!! Form::file('img',[
                        'class' => 'form-control',
                        'placeholder' => 'choose image',
                        'id' => 'exampleInputImage'
                        ]) !!} 
                </div>
                
                </div>
                <!-- /.card-body -->


                
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
              {!! Form::close() !!}
            </div>
        </div>
@endsection
