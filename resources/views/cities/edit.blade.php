@extends('layouts.admin')
@inject('gov','App\Models\Governorate')
@section('title')
Edit City
@endsection

@section('content')
<div class="row ">
<div class="col-md-6 m-auto">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Edit City</h3>
                

              </div>
              <!-- /.card-header -->
              <!-- form start -->
              {!! Form::model($model,[
                'action' => ['CityController@update',$model->id],
                'method' => 'put'
                ]) !!}
                <div class="card-body">
                @include('partial.validate_errors')
                <div class="form-group">
                    <label for="exampleInputSelect">Select Governorate</label>
                    {!! Form::select('governorate_id', $gov::pluck('name', 'id'), null,
                     ['class' => 'form-control',
                     'id' => 'exampleInputSelect',
                     'placeholder' => 'Select Governorate ...']) !!}
                </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">City Name</label>

                    {!! Form::text('name',null,[
                        'class' => 'form-control',
                        'placeholder' => 'Enter city name',
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
