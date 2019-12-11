@extends('website.layouts.app')
@inject('posts','App\Models\Post')
@section('content')

    <!-- Navigator Start -->
    <section id="navigator">
        <div class="container">
            <div class="path">
                <div class="path-main" style="color: darkred; display:inline-block;">Home</div>
                <div class="path-main" style="color: darkred; display:inline-block;">/ Posts</div>
                <div class="path-directio" style="color: grey; display:inline-block;"> / {{$record->category->name}}</div>
            </div>

        </div>
    </section>
    <!-- Navigator End -->

    <!-- article Start -->
    <section id="article">
        <div class="container">
            <img class="head-img" src="/{{$record->img}}" alt="">
            <div class="details-container">
                <div class="title">{{$record->title}}</div>
                <p>{{$record->content}}</p>
                <strong><a>Share this article:</a></strong>
                <div class="icons">
                    <i class="fab fa-facebook-square fa-3x"></i>
                    <i class="fab fa-google-plus-square fa-3x"></i>
                    <i class="fab fa-twitter-square fa-3x"></i>
                </div>

            </div>
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
                                <a class="card-btn" href="{{route('post', ['id' => $post->id])}}" >Details</a>
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

        </div>
    </section>
    <!-- Article End -->

 
@endsection