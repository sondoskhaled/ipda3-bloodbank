@extends('layouts.admin')
@section('title')
List of posts 
@endsection

@section('content')
<div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">List of posts</h3>
                @include('flash::message')
                <div class="card-tools">
                  <div class="input-group input-group-sm" style="width: 150px;">
                    <div class="input-group-append">
                      <a href="{{url(route('post.create'))}}" class="btn btn-success">
                        <i class="fas fa-plus nav-icon"></i> Add post</a>
                    </div>
                  </div>
                </div>
              </div>
              @if(count($records))
              <div class="row">
              @foreach ($records as $record)
              <!-- /.card-header -->
              <div class="col-md-6 mt-3">
            <!-- Box Comment -->
            <div class="card card-widget">
              <div class="card-header">
                <div class="user-block">
                  <span class="username"><a href="#">{{$record->title}}</a></span>
                  <span class="description">Published at - {{$record->created_at}}</span>
                  
                </div>
                <!-- /.user-block -->

                <div class="card-tools  mt-2">
                {!! Form::open([
                    'action' => ['PostController@destroy',$record->id],
                    'method' => 'delete'
                    ]) !!}
                    <a href="{{url(route('post.edit',$record->id))}}" class="btn btn-success btn-sm">
                    <i class="fas fa-edit"></i> Edit</a>
                
                    <button type="submit" class="btn btn-danger btn-sm">
                    <i class="fas fa-trash"></i> Delete</button>
                  {!! Form::close() !!}
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <p>{{$record->category->name}}</p>
                <img class="img-fluid pad" src="{{$record->img}}" alt="Photo">

                <p>{{$record->content}}</p>
                
                
              </div>
              <!-- /.card-body -->
              
              
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
          @endforeach
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        
         

         @else
         <div class="alert alert-danger" role="alert">
                no data
            </div>
        @endif
        </div>
@endsection
