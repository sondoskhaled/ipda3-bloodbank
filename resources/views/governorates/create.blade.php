@extends('layouts.admin')
@inject('model','App\Models\Governorate')
@section('title')
Add New Governorate
@endsection

@section('content')
<div class="row ">
<div class="col-md-6 m-auto">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Add New Governorate</h3>
                

              </div>
              <!-- /.card-header -->
              <!-- form start -->
              {!! Form::model($model,[
                'action' => 'GovernorateController@store'
                ]) !!}
                <div class="card-body">
                @include('partial.validate_errors')
                  <div class="form-group">
                    <label for="exampleInputEmail1">Governorate Name</label>

                    {!! Form::text('name',null,[
                        'class' => 'form-control',
                        'placeholder' => 'Enter governorate name',
                        'id' => 'exampleInputEmail1'
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
