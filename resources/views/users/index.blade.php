@extends('layouts.admin')
@section('title')
List of users 
@endsection

@section('content')
<div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">List of users</h3>
                @include('flash::message')
                <div class="card-tools">
                  <div class="input-group input-group-sm" style="width: 150px;">
                    <div class="input-group-append">
                      <a href="{{url(route('user.create'))}}" class="btn btn-success">
                        <i class="fas fa-plus nav-icon"></i> Add user</a>
                    </div>
                  </div>
                </div>
              </div>
              @if(count($records))
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>user Name</th>
                      <th>user Email</th>
                      <th>user Role</th>
                      <th>Edit</th>
                      <th>Delete</th>
                      
                    </tr>
                  </thead>
                  <tbody>
                      @foreach($records as $record)
                    <tr>
                      <td>{{$loop->iteration}}</td>
                      <td>{{$record->name}}</td>
                      <td>{{$record->email}}</td>
                      <td>
                          @foreach($record->roles as $role)
                          <span class="badge badge-success">{{$role->display_name}}</span>
                          
                          @endforeach
                      </td>
                      <td>
                        <a href="{{url(route('user.edit',$record->id))}}" class="btn btn-success btn-xs">
                          <i class="fa fa-edit"></i>
                        </a>
                      </td>
                      <td>
                      {!! Form::open([
                        'action' => ['UserController@destroy',$record->id],
                        'method' => 'delete'
                        ]) !!}
                        <button type="submit" class="btn btn-danger btn-xs">
                          <i class="fas fa-trash"></i>
                        </button>
                      {!! Form::close() !!}
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
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
