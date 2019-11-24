@extends('layouts.admin')
@inject('permissions','App\Models\Permission')
@section('title')
Edit Role
@endsection

@section('content')
<div class="row ">
<div class="col-md-6 m-auto">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Edit Role</h3>
                

              </div>
              <!-- /.card-header -->
              <!-- form start -->
              {!! Form::model($model,[
                'action' => ['RoleController@update',$model->id],
                'method' => 'put'
                ]) !!}
                <div class="card-body">
                @include('partial.validate_errors')
                
                <div class="form-group">
                    <label for="exampleInputEmail1">Role Name</label>

                    {!! Form::text('name',null,[
                        'class' => 'form-control',
                        'placeholder' => 'Enter role name',
                        'id' => 'exampleInputEmail1'
                        ]) !!} 
                </div>

                <div class="form-group">
                    <label for="exampleInputDName">Role Display Name</label>

                    {!! Form::text('display_name',null,[
                        'class' => 'form-control',
                        'placeholder' => 'Enter role display name',
                        'id' => 'exampleInputDName'
                        ]) !!} 
                </div>

                <div class="form-group">
                    <label for="exampleInputDes">Role Discreption</label>

                    {!! Form::textarea('description',null,[
                        'class' => 'form-control',
                        'placeholder' => 'Enter role discreption',
                        'id' => 'exampleInputDes'
                        ]) !!} 
                </div>
                
                <div class="form-group">
                    <label for="exampleInputDes">Role Permissions</label>
                    <div class="row">
                      <div class="col">
                      <input type="checkbox" id="select-all"> Select All
                      </div>
                    </div>
                    <div class="row">
                      @foreach($permissions->all() as $permission)
                        <div class="col-sm-4">
                          <input type="checkbox" name="permissions_list[]" value="{{$permission->id}}"

                            @if($model->hasPermission($permission->name))
                              checked
                            @endif
                          
                          >
                           {{$permission->display_name}}
                        </div>
                      @endforeach
                    </div>
                </div>
                </div>
                <!-- /.card-body -->

                @push('script')
                  <script>
                    $('#select-all').click(function(){
                      $('input[type=checkbox]').prop('checked',$(this).prop('checked'));
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
