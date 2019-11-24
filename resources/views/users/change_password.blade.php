@extends('layouts.admin')
@inject('model','App\User')
@section('title')
Change Password
@endsection

@section('content')
<div class="row ">
<div class="col-md-6 m-auto">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Change Password</h3>
                @include('flash::message')

              </div>
              <!-- /.card-header -->
              <!-- form start -->
              {!! Form::model($model,[
                'action' => ['UserController@changePassSave',Auth::user()->id],
                'method' => 'put'
                ]) !!}
                <div class="card-body">
                @include('partial.validate_errors')
                
                <div class="form-group">
                    <label for="exampleInputOld">Old Password</label>

                    {!! Form::text('old_password',null,[
                        'class' => 'form-control',
                        'placeholder' => 'Enter Old Password',
                        'id' => 'exampleInputOld'
                        ]) !!} 
                </div>

                <div class="form-group">
                    <label for="exampleInputNew">New Password</label>

                    {!! Form::text('new_password',null,[
                        'class' => 'form-control',
                        'placeholder' => 'Enter New Password',
                        'id' => 'exampleInputNew'
                        ]) !!} 
                </div>

                <div class="form-group">
                    <label for="exampleInputRNew">Repeat New Password</label>

                    {!! Form::text('r_new_password',null,[
                        'class' => 'form-control',
                        'placeholder' => 'Enter Repeat New Password',
                        'id' => 'exampleInputRNew'
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
