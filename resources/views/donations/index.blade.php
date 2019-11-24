@extends('layouts.admin')
@inject('model','App\Models\DonationRequest')
@inject('city','App\Models\City')
@inject('BloodType','App\Models\BloodType')

@section('title')
List of donation requests 
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
                <h3>Filter donation requests</h3>
               </div>
              </div>
             <div class="info-box bg-info">
              
              <div class="info-box-content">
                
                {!! Form::model($model,[
                'action' => 'DonationRequestController@filter',
                'method' => 'post'
                ]) !!}
                  <div class="row" >
                    <div class="form-group col-4">
                      <label for="exampleInputHName">Hospital Name</label>

                      {!! Form::text('hospital_name',null,[
                          'class' => 'form-control',
                          'placeholder' => 'Enter hospital name',
                          'id' => 'exampleInputHName'
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
                <h3 class="card-title">List of Donation Requests</h3>
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
                      <th>Patient Name</th>
                      <th>Patient Phone</th>
                      <th>Hospital Name</th>
                      <th>Blood Type</th>
                      <th>Bags Number</th>
                      <th>City</th>
                      <th>show</th>
                      <th>Delete</th>
                      
                    </tr>
                  </thead>
                  <tbody>
                      @foreach($records as $record)
                    <tr>
                      <td>{{$loop->iteration}}</td>
                      <td>{{$record->client->name}}</td>
                      <td>{{$record->patient_name}}</td>
                      <td>{{$record->patient_phone}}</td>
                      <td>{{$record->hospital_name}}</td>
                      <td class="text-center">{{$record->bloodType->name}}</td>
                      <td class="text-center">{{$record->bags_num}}</td>
                      <td class="text-center">{{$record->city->name}}</td>
                      <td>
                        <a href="{{url(route('donation.show',$record->id))}}" class="btn btn-success btn-xs">
                        <i class="fas fa-eye"></i>
                        </a>
                      </td>
                      <td class="text-center">
                      {!! Form::open([
                        'action' => ['DonationRequestController@destroy',$record->id],
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
