@extends('website.layouts.app')
@inject('model','App\Models\Client')
@inject('bloodType','App\Models\BloodType')
@inject('gov','App\Models\Governorate')
@section('content')
    <!-- Navigator Start -->
    <section id="navigator">
        <div class="container">
            <div class="path">
                <div class="path-main" style="color: darkred; display:inline-block;">Home</div>
                <div class="path-directio" style="color: grey; display:inline-block;"> / Sign up</div>
            </div>

        </div>
    </section>
    <!-- Navigator End -->

    <!-- Sign Up Start -->
    <section id="sign-up">
        <div class="container">
                <img src="imgs/logo.png" alt="">
                {!! Form::model($model,[
                'action' => 'Website\MainController@register'
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
                   
                   {!! Form::date('d_o_b',null,[
                       'class' => 'form-control',
                       'placeholder' => 'Birth date',
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
                {!! Form::select('governorate_id', $gov::pluck('name', 'id'), null,
                    ['class' => 'form-control',
                    'placeholder' => 'Select Governorate ...',
                    'required' => 'required']) !!}
                </div>
                    
                <div class="form-group">
                   
                    {!! Form::number('phone',null,[
                        'class' => 'form-control',
                        'placeholder' => 'Phone Number',
                        'required' => 'required'
                        ]) !!} 
                </div>

                <div class="form-group">
                   
                   {!! Form::date('last_donation_date', \Carbon\Carbon::now(),[
                       'class' => 'form-control',
                       'placeholder' => 'Last Donation date',
                       'required' => 'required'
                       ]) !!} 
                </div>
                    <div class="reg-group">
                        <input class="check" name="agree" type="checkbox" required="true" style="height: auto; display:inline; margin: 0 auto;">Agree on terms and conditions<br>
                        <button class="submit" type="submit" style="background-color: rgb(51, 58, 65);">Submit</button>
                    </div>
                {!! Form::close() !!}
        </div>
    </section>
    <!-- Sign Up End -->

@endsection