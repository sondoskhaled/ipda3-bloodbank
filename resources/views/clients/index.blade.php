@extends('layouts.admin')
@inject('model','App\Models\Client')
@inject('city','App\Models\City')
@inject('BloodType','App\Models\BloodType')

@section('title')
List of clients 
@endsection

@section('content')
<div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <div class="row">
             <div class="col-12">
             <div class="row text-center">
               <div class="col-12">
                <h3>Filter Clients</h3>
               </div>
              </div>
             <div class="info-box bg-info">
              
              <div class="info-box-content">
                
                {!! Form::model($model,[
                'action' => 'ClientController@filter',
                'method' => 'post'
                ]) !!}
                  <div class="row" >
                    <div class="form-group col-4">
                      <label for="exampleInputPhone">Client Phone</label>

                      {!! Form::text('phone',null,[
                          'class' => 'form-control',
                          'placeholder' => 'Enter client phone',
                          'id' => 'exampleInputPhone'
                          ]) !!} 
                    </div>
                  

                  
                    <div class="form-group col-4">
                      <label for="exampleInputSelectCity">Select City</label>
                      {!! Form::select('city_id', $city::pluck('name', 'id'), null,
                     ['class' => 'form-control',
                     'id' => 'exampleInputSelectCity',
                     'placeholder' => 'Select City ...']) !!}
                      
                    </div>
                  
                  
                    <div class="form-group col-4">
                      <label for="exampleInputSelectBlood">Select Blood Type</label>
                      {!! Form::select('blood_type_id', $BloodType::pluck('name', 'id'), null,
                     ['class' => 'form-control',
                     'id' => 'exampleInputSelectBlood',
                     'placeholder' => 'Select Blood Type ...']) !!}
                      
                    </div>
                  </div>

                 <div class="row text-center">
                   <div class="col">
                  <button type="submit" class="btn btn-danger btn-lg ml-auto">Filter</button>
                   </div>
                 </div>
              {!! Form::close() !!}
                
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          
        </div>
        <!-- /.row -->
                <h3 class="card-title">List of clients</h3>
                @include('flash::message')
               
              </div>
              @if(count($records))
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Client Name</th>
                      <th>Client Email</th>
                      <th>Client Phone</th>
                      <th>Client City</th>
                      <th>Client Blood Type</th>
                      <th>Active/DeActive</th>
                      <th>Delete</th>
                      
                    </tr>
                  </thead>
                  <tbody>
                      @foreach($records as $record)
                    <tr>
                      <td>{{$loop->iteration}}</td>
                      <td>{{$record->name}}</td>
                      <td>{{$record->email}}</td>
                      <td>{{$record->phone}}</td>
                      <td>{{$record->city->name}}</td>
                      <td class="text-center">{{$record->bloodType->name}}</td>
                      <td class="text-center">
                        @if($record->is_active == 0)
                        {!! Form::open([
                        'action' => ['ClientController@update',$record->id],
                        'method' => 'put'
                        ]) !!}
                        <button type="submit" class="btn btn-success btn-sm">
                        <i class="fas fa-user-check"></i> 
                        </button>
                      {!! Form::close() !!}
                        
                        @else
                        {!! Form::open([
                        'action' => ['ClientController@update',$record->id],
                        'method' => 'put'
                        ]) !!}
                        <button type="submit" class="btn btn-danger btn-sm">
                        <i class="fas fa-user-times"></i> 
                        </button>
                       {!! Form::close() !!}
                        @endif
                    </td>
                      <td class="text-center">
                      {!! Form::open([
                        'action' => ['ClientController@destroy',$record->id],
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
