@extends('layouts.admin')
@section('title')
Edit Settings
@endsection

@section('content')
<div class="row ">
<div class="col-md-6 m-auto">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Edit Settings</h3>
                

              </div>
              <!-- /.card-header -->
              <!-- form start -->
              {!! Form::model($model,[
                'action' => ['SettingController@update',$model->id],
                'method' => 'put'
                ]) !!}
                <div class="card-body">
                @include('partial.validate_errors')
                <div class="form-group">
                    <label for="exampleInputSetting">Notification Setting Text</label>

                    {!! Form::textarea('notification_setting_text',null,[
                        'class' => 'form-control',
                        'placeholder' => 'Enter Notification Setting Text',
                        'id' => 'exampleInputSetting'
                        ]) !!} 
                </div>

                <div class="form-group">
                    <label for="exampleInputAbout">About Us</label>

                    {!! Form::text('about_us',null,[
                        'class' => 'form-control',
                        'placeholder' => 'Enter About us',
                        'id' => 'exampleInputAbout'
                        ]) !!} 
                </div>

                <div class="form-group">
                    <label for="exampleInputPhone">Phone</label>

                    {!! Form::text('phone',null,[
                        'class' => 'form-control',
                        'placeholder' => 'Enter Phone',
                        'id' => 'exampleInputPhone'
                        ]) !!} 
                </div>

                <div class="form-group">
                    <label for="exampleInputEmail">Email</label>

                    {!! Form::text('email',null,[
                        'class' => 'form-control',
                        'placeholder' => 'Enter Email',
                        'id' => 'exampleInputEmail'
                        ]) !!} 
                </div>

                <div class="form-group">
                    <label for="exampleInputFacebook">Facebook Link</label>

                    {!! Form::text('fb_link',null,[
                        'class' => 'form-control',
                        'placeholder' => 'Enter Facebook Link',
                        'id' => 'exampleInputFacebook'
                        ]) !!} 
                </div>

                <div class="form-group">
                    <label for="exampleInputTwitter">Twitter Link</label>

                    {!! Form::text('tw_link',null,[
                        'class' => 'form-control',
                        'placeholder' => 'Enter Twitter Link',
                        'id' => 'exampleInputTwitter'
                        ]) !!} 
                </div>

                <div class="form-group">
                    <label for="exampleInputInstagram">Instagram Link</label>

                    {!! Form::text('insta_link',null,[
                        'class' => 'form-control',
                        'placeholder' => 'Enter Instagram Link',
                        'id' => 'exampleInputInstagram'
                        ]) !!} 
                </div>

                <div class="form-group">
                    <label for="exampleInputYoutube">Youtube Link</label>

                    {!! Form::text('youtube_link',null,[
                        'class' => 'form-control',
                        'placeholder' => 'Enter Youtube Link',
                        'id' => 'exampleInputYoutube'
                        ]) !!} 
                </div>

                <div class="form-group">
                    <label for="exampleInputGoogle">Google Plus Link</label>

                    {!! Form::text('google_plus_link',null,[
                        'class' => 'form-control',
                        'placeholder' => 'Enter Google Plus Link',
                        'id' => 'exampleInputGoogle'
                        ]) !!} 
                </div>

                <div class="form-group">
                    <label for="exampleInputWhatsapp">Whatsapp Link</label>

                    {!! Form::text('whatsapp_link',null,[
                        'class' => 'form-control',
                        'placeholder' => 'Enter Whatsapp Link',
                        'id' => 'exampleInputWhatsapp'
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
