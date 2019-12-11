@extends('website.layouts.app')
@inject('model','App\Models\DonationRequest')
@inject('bloodType','App\Models\BloodType')
@inject('city','App\Models\City')
@section('content')
    <!-- Navigator Start -->
    <section id="navigator">
        <div class="container">
            <div class="path">
                <div class="path-main" style="color: darkred; display:inline-block;">Home</div>
                <div class="path-directio" style="color: grey; display:inline-block;"> / Add Request</div>
            </div>

        </div>
    </section>
    <!-- Navigator End -->

    <!-- Sign Up Start -->
    <section id="sign-up">
        <div class="container">
                @include('flash::message')
                <img src="imgs/logo.png" alt="">
                {!! Form::model($model,[
                'action' => ['Website\MainController@requestSave',Auth::user()->id]
                ]) !!}

                @include('partial.validate_errors')
                
                <div class="form-group">
                   
                    {!! Form::text('patient_name',null,[
                        'class' => 'form-control',
                        'placeholder' => 'Patient Name',
                        'required' => 'required'
                        ]) !!} 
                </div>

                <div class="form-group">
                   
                    {!! Form::number('patient_phone',null,[
                        'class' => 'form-control',
                        'placeholder' => 'Patient Phone Number',
                        'required' => 'required'
                        ]) !!} 
                </div>

                <div class="form-group">
                   
                    {!! Form::number('patient_age',null,[
                        'class' => 'form-control',
                        'placeholder' => 'Patient Age',
                        'required' => 'required'
                        ]) !!} 
                </div>

                <div class="form-group">
                   
                    {!! Form::number('bags_num',null,[
                        'class' => 'form-control',
                        'placeholder' => 'Bags Number',
                        'required' => 'required'
                        ]) !!} 
                </div>

                <div class="form-group">
                   
                    {!! Form::text('hospital_name',null,[
                        'class' => 'form-control',
                        'placeholder' => 'Hospital Name',
                        'required' => 'required'
                        ]) !!} 
                </div>

                <div class="form-group">
                   
                    {!! Form::text('hospital_address',null,[
                        'class' => 'form-control',
                        'placeholder' => 'Hospital Address',
                        'required' => 'required'
                        ]) !!} 
                </div>

                <div class="form-group">
                   
                    {!! Form::text('lat','31.26525585',[
                        'class' => 'form-control',
                        'placeholder' => 'Lat',
                        'required' => 'required'
                        ]) !!} 
                </div>

                <div class="form-group">
                   
                    {!! Form::text('lng','29.25566555',[
                        'class' => 'form-control',
                        'placeholder' => 'Lng',
                        'required' => 'required'
                        ]) !!} 
                </div>


                <div class="form-group">
                {!! Form::select('blood_type_id', $bloodType::pluck('name', 'id'), null,
                    ['class' => 'form-control',
                    'placeholder' => 'Select blood type ...',
                    'required' => 'required']) !!}
                </div>

                <div class="form-group">
                {!! Form::select('city_id', $city::pluck('name', 'id'), null,
                    ['class' => 'form-control',
                    'placeholder' => 'Select City ...',
                    'required' => 'required']) !!}
                </div>
                    
                <div class="form-group">
                   
                    {!! Form::textarea('details',null,[
                        'class' => 'form-control',
                        'placeholder' => 'Details',
                        'required' => 'required'
                        ]) !!} 
                </div>
         
                    <div class="reg-group">
                        <button class="submit" type="submit" style="background-color: rgb(51, 58, 65);">Send</button>
                    </div>
                {!! Form::close() !!}
        </div>
    </section>
    <!-- Sign Up End -->

@endsection