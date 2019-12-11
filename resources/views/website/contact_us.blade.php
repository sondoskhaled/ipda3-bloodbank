@extends('website.layouts.app')
@inject('model','App\Models\Contact')

@section('content')
  <!-- Navigator Start -->
  <section id="navigator">
        <div class="container">
            <div class="path">
                <div class="path-main" style="color: darkred; display:inline-block;">Home</div>
                <div class="path-directio" style="color: grey; display:inline-block;"> / Contact Us</div>
            </div>

        </div>
    </section>
    <!-- Navigator End -->

    <!-- login Start -->
    <section id="contact">
        <div class="container">
            <div class="row">
                <div class="col-md-6 call">
                    <div class="title">Head</div>
                    <img src="imgs/logo.png" alt="">
                    <hr>
                    <h4>Mobile: {{$settings->phone}}</h3>
                        <!-- <h4>Fax: +2 455 6646</h3> -->
                            <h4>Email: {{$settings->email}}</h3>
                                <hr>
                                <h3>Find Us On</h3>
                                <div class="icons">
                                    <i class="fab fa-facebook-square fa-3x"></i>
                                    <i class="fab fa-google-plus-square fa-3x"></i>
                                    <i class="fab fa-twitter-square fa-3x"></i>
                                    <i class="fab fa-whatsapp-square fa-3x"></i>
                                    <i class="fab fa-youtube-square fa-3x"></i>
                                </div>
                </div>
                <div class="col-md-6 info">
                    <div class="title">Head</div>
                    {!! Form::model($model,[
                        'action' => 'Website\MainController@contactUsSave'
                        ]) !!}
                        @include('partial.validate_errors')
                        <div class="form-group">
                        
                            {!! Form::text('name',null,[
                                'class' => 'form-control',
                                'placeholder' => 'Name',
                                'required' => 'required'
                                ]) !!} 
                        </div>
                        <div class="form-group">
                        
                            {!! Form::email('email',null,[
                                'class' => 'form-control',
                                'placeholder' => 'Email',
                                'required' => 'required'
                                ]) !!} 
                        </div>
                        <div class="form-group">
                   
                            {!! Form::number('phone',null,[
                                'class' => 'form-control',
                                'placeholder' => 'Phone Number',
                                'required' => 'required'
                                ]) !!} 
                        </div>
                        <div class="form-group">
                        
                            {!! Form::text('subject',null,[
                                'class' => 'form-control',
                                'placeholder' => 'Title',
                                'required' => 'required'
                                ]) !!} 
                        </div>
                        <div class="form-group">
                        
                            {!! Form::textarea('msg',null,[
                                'class' => 'form-control',
                                'placeholder' => 'Message',
                                'required' => 'required'
                                ]) !!} 
                        </div>
                        <div class="reg-group">
                            <button type="submit">Send</button>
                        </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </section>
    <!-- login End -->
   
    
@endsection