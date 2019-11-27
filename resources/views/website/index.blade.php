@extends('website.layouts.app')
@inject('posts','App\Models\Post')
@inject('blood_type','App\Models\BloodType')
@inject('city','App\Models\City')
@inject('donations','App\Models\DonationRequest')
@inject('settings','App\Models\Setting')
@section('content')

    <!-- Header Start -->
    <section id="header">
        <div class="container">
            <!-- <h1>We are seeking for a better community health.</h1>
            <h4>Lorem ipsum dolor sit amet consectetur adipisicing elit. Tempora repellat inventore nemo repudiandae
                ipsum quos.</h4>
            <button class="btn more" onclick= "window.location.href = 'About-us.html';">More</button> -->
        </div>
    </section>
    <!-- Header End -->

    <!-- Sub Header Start -->
    <section id="sub-header">
        <div class="container">
            <h3>A SINGLE PINT CAN SAVE THREE LIVES, A SINGLE GESTURE CAN CREATE A MILLION SMILES.</h3>
        </div>
    </section>
    <!-- Sub Header End -->

    <!-- Articles Start -->
    <section id="articles">
        <div class="container">
            <h2 style="display: inline-block;">Articles</h2>
            <div class="swiper-container">
            <div class="button-area" style="display: inline-block; margin-left: 850px;">
                    <div class="swiper-button-next"></div>
                    <div class="swiper-button-prev"></div>
                </button>
            </div>

                @foreach($posts->all() as $post)
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <div class="card">
                            <div class="card-img-top" style="position: relative;">
                                <img src="/{{$post->img}}" alt="Card image">
                                <button class="like"><i class="fas fa-heart icon-large"></i></button>
                            </div>
                            <div class="card-body">
                                <h4 class="card-title">{{$post->title}}</h4>
                                <p class="card-text">{{str_limit($post->content, 30)}}</p>
                                <div class="btn-cont">
                                    <button class="card-btn" onclick= "window.location.href = 'article.html';">Details</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- Articles End -->

    <!-- Requests Start -->
    <section id="requests">
        <div class="title">
            <h2>Donations</h2>
            <hr class="line">
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-5">
                <div class="form-group">
                    {!! Form::select('blood_type_id', $blood_type::pluck('name', 'id'), null,
                     ['class' => 'form-control',
                     'id' => 'exampleInputSelect',
                     'placeholder' => 'Select Blood Type ...']) !!}
                </div>
                </div>
                <div class="col-lg-5">
                <div class="form-group">
                    {!! Form::select('city_id', $city::pluck('name', 'id'), null,
                     ['class' => 'form-control',
                     'id' => 'exampleInputSelect',
                     'placeholder' => 'Select City ...']) !!}
                </div>
                </div>
                <div class="search">
                    <button><i class="col-lg-2 fas fa-search"></i></button>
                </div>
            </div>
            @foreach($donations->offset(0)->limit(3)->orderBy('created_at', 'desc')->get() as $donation)
            <div class="row">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-lg-3">
                            <div class="type">
                                <h2>{{$donation->bloodType->name}}</h2>
                            </div>
                        </div>
                        <div class="data col-lg-6">
                            <h4>Name: {{$donation->patient_name}}</h4>
                            <h4>Hospital: {{$donation->hospital_name}}</h4>
                            <h4>City: {{$donation->city->name}}</h4>
                        </div>
                        <div class="col-lg-3">
                            <button onclick= "window.location.href = 'donator.html';">Details</button>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
            <div class="more-req">
                <button onclick= "window.location.href = 'requests.html';">More</button>
            </div>
        </div>
    </section>
    <!-- Requests End -->

    <!-- Call us Start -->
    <section id="call-us">
        <div class="layer">
            <div class="container">
                <h1>Call Us</h1>
                <h4>You can call us for your inquiries about any information.</h4>
                <div class="whats">
                    <img src="{{asset('website/imgs/whats.png')}}" alt="">
                    @foreach($settings->all() as $setting)
                    <h3>{{$setting->whatsapp_link}}</h3>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
    <!-- Call us End -->

    <!-- App Start -->
    <section id="app">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="info">
                        <h1>Blood Bank Application</h1>
                        <h3>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quae earum officiis et eligendi nam
                            harum corporis saepe deserunt.</h3>
                        <h4>Available On</h4>
                        <img src="{{asset('website/imgs/ios.png')}}" alt="">
                        <img src="{{asset('website/imgs/google.png')}}" alt="">
                    </div>
                </div>
                <div class="col-md-6">
                    <img class="app-screen" src="{{asset('website/imgs/App.png')}}" alt="">
                </div>
            </div>
        </div>
    </section>
    <!-- App End -->

   
@endsection