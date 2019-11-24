@extends('layouts.admin')
@inject('role','App\Models\Role')
@section('title')
Edit User
@endsection

@section('content')
<div class="row ">
<div class="col-md-6 m-auto">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Edit User</h3>
                

              </div>
              <!-- /.card-header -->
              <!-- form start -->
              {!! Form::model($model,[
                'action' => ['UserController@update',$model->id],
                'method' => 'put'
                ]) !!}
                <div class="card-body">
                @include('partial.validate_errors')
                
                <div class="form-group">
                    <label for="exampleInputName">User Name</label>

                    {!! Form::text('name',null,[
                        'class' => 'form-control',
                        'placeholder' => 'Enter user name',
                        'id' => 'exampleInputName'
                        ]) !!} 
                </div>

                <div class="form-group">
                    <label for="exampleInputEmail">User Email</label>

                    {!! Form::text('email',null,[
                        'class' => 'form-control',
                        'placeholder' => 'Enter user email',
                        'id' => 'exampleInputEmail'
                        ]) !!} 
                </div>

                <div class="form-group">
                    <label for="exampleInputPassword">User Password</label>

                    {!! Form::password('password',[
                        'class' => 'form-control',
                        'placeholder' => 'Enter user password',
                        'id' => 'exampleInputPassword'
                        ]) !!} 
                </div>

                <div class="form-group">
                    <label for="exampleInputPasswordConfirmation">User Password Confirmation</label>

                    {!! Form::password('password_confirmation',[
                        'class' => 'form-control',
                        'placeholder' => 'Enter user password confirmation',
                        'id' => 'exampleInputPasswordConfirmation'
                        ]) !!} 
                </div>
                
                <div class="form-group">
                    <label for="exampleInputSelect">Select Role</label>
                    {!! Form::select('roles_list[]', $role::pluck('display_name', 'id'), null,
                     ['class' => 'form-control select2',
                     'multiple' => 'multiple',
                     'id' => 'exampleInputSelect',
                     'data-placeholder' => 'Select Role ...']) !!}
                </div>
                
                </div>
                <!-- /.card-body -->

                @push('script')
                <script>
                    $(function () {
                        //Initialize Select2 Elements
                        $('.select2').select2()
                    });
                </script>  
                @endpush

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
              {!! Form::close() !!}
            </div>
        </div>
@endsection
