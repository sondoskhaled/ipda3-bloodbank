@extends('website.layouts.app')
@inject('model','App\Models\Client')
@section('content')
  <!-- Navigator Start -->
  <section id="navigator">
        <div class="container">
            <div class="path">
                <div class="path-main" style="color: darkred; display:inline-block;">Home</div>
                <div class="path-directio" style="color: grey; display:inline-block;"> / Login</div>
            </div>

        </div>
    </section>
    <!-- Navigator End -->

    <!-- Login Start -->
    <section id="login">
        <div class="container">
                <img src="imgs/logo.png" alt="">
                {!! Form::model($model,[
                'action' => 'Website\MainController@login',
                
                ]) !!}
                @include('partial.validate_errors')
                <div class="form-group">
                    {!! Form::number('phone',null,[
                        'class' => 'form-control username',
                        'placeholder' => 'Phone'
                        ]) !!} 
                </div>
                <div class="form-group">
                    {!! Form::password('password',[
                        'class' => 'form-control password',
                        'placeholder' => 'Password'
                        ]) !!} 
                </div>

                    <input class="check" type="checkbox" name="remember">Remember me
                    <a href="#">Forget Password ?</a><br>
                    <div class="reg-group">
                        <button style="background-color: darkred;" type="submit">Login</button>
                        <!-- <button style="background-color: rgb(51, 58, 65);">Make new account</button> -->
                    </div>
                {!! Form::close() !!}
        </div>
    </section>
    <!-- Login End -->

@endsection