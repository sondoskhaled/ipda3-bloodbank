@extends('layouts.admin')
@inject('model','App\Models\Contact')

@section('title')
List of contacts 
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
                <h3>Filter contacts</h3>
               </div>
              </div>
             <div class="info-box bg-info">
              
              <div class="info-box-content">
                
                {!! Form::model($model,[
                'action' => 'ContactUsController@filter',
                'method' => 'post'
                ]) !!}
                  <div class="row" >
                    <div class="form-group col-5">
                      <label for="exampleInputPhone">Client Phone</label>

                      {!! Form::text('phone',null,[
                          'class' => 'form-control',
                          'placeholder' => 'Enter client phone',
                          'id' => 'exampleInputPhone'
                          ]) !!} 
                    </div>
                    <div class="form-group col-5">
                      <label for="exampleInputEmail">Client Email</label>

                      {!! Form::text('email',null,[
                          'class' => 'form-control',
                          'placeholder' => 'Enter client email',
                          'id' => 'exampleInputEmail'
                          ]) !!} 
                    </div>
                    <div class="form-group col-2 text-center">
                        <br>
                     <button type="submit" class="btn btn-danger btn-lg">Filter</button>
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
                <h3 class="card-title">List of contacts</h3>
                @include('flash::message')
               
              </div>
              @if(count($records))
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Name</th>
                      <th>Email</th>
                      <th>Phone</th>
                      <th>Subject</th>
                      <th>Message</th>
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
                      <td>{{$record->subject}}</td>
                      <td>{{$record->msg}}</td>
                      <td>
                      {!! Form::open([
                        'action' => ['ContactUsController@destroy',$record->id],
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
