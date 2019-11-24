@extends('layouts.admin')

@section('title')
Settings
@endsection

@section('content')
<div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
       
          <h3 class="card-title">Settings</h3>

          @include('flash::message')
            <div class="card-tools">
            @foreach($records as $record)
                <div class="input-group input-group-sm" style="width: 150px;">
                <div class="input-group-append">
                    <a href="{{url(route('setting.edit',$record->id))}}" class="btn btn-success">
                    <i class="fas fa-edit nav-icon"></i> Edit setting</a>
                </div>
                </div>
            </div>
                
               
         </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover">
                  <tbody>
                    <tr>
                        <td>Notification Setting Text</td>
                        <td>{{$record->notification_setting_text}}</td>
                    </tr>
                    <tr>
                        <td>About Us</td>
                        <td>{{$record->about_us}}</td>
                    </tr>
                    <tr>
                        <td>Phone</td>
                        <td>{{$record->phone}}</td>
                    </tr>
                    <tr>
                        <td>Email</td>
                        <td>{{$record->email}}</td>
                    </tr>
                    <tr>
                        <td>FaceBook Link</td>
                        <td>{{$record->fb_link}}</td>
                    </tr>
                    <tr>
                        <td>Twitter Link</td>
                        <td>{{$record->tw_link}}</td>
                    </tr>
                    <tr>
                        <td>Instagram Link</td>
                        <td>{{$record->insta_link}}</td>
                    </tr>
                    <tr>
                        <td>Youtube Link</td>
                        <td>{{$record->youtube_link}}</td>
                    </tr>
                    <tr>
                        <td>Google Plus Link</td>
                        <td>{{$record->google_plus_link}}</td>
                    </tr>
                    <tr>
                        <td>WhatsApp Link</td>
                        <td>{{$record->whatsapp_link}}</td>
                    </tr>
                    
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        
        
        </div>
        

@endforeach
@endsection
