@extends('website.layouts.app')
@inject('model','App\Models\DonationRequest')
@inject('blood_type','App\Models\BloodType')
@inject('city','App\Models\City')
@section('content')
    <!-- Navigator Start -->
    <section id="navigator">
        <div class="container">
            <div class="path">
                <div class="path-main" style="color: darkred; display:inline-block;">Home</div>
                <div class="path-directio" style="color: grey; display:inline-block;"> / Donations</div>
            </div>

        </div>
    </section>
    <!-- Navigator End -->

    <!-- Requests Start -->
    <section id="requests">
        <div class="title">
            <h2>Donations</h2>
            <hr class="line">
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-5">
                    {!! Form::model($model,[
                    'action' => 'Website\MainController@filter',
                    
                    ]) !!}
                    @include('partial.validate_errors')
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
                    <button type="submit"><i class="col-lg-2 fas fa-search"></i></button>
                </div>
                {!! Form::close() !!}
            </div>
          
            @foreach($record as $donation)
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
                       <button class="card-btn"> <a class="card-btn" href="{{route('donation', ['id' => $donation->id])}}" >Details</a>
                       </button>
                    </div>
                    </div>
                </div>
            </div>
            @endforeach
            <div class="page-num">
            
                    <nav aria-label="Page navigation example">
                    
                        <ul class="pagination justify-content-center">
                        {{ $record->links() }}
                            <!-- <li class="page-item">
                                <a class="page-link" href="#" aria-label="Previous">
                                    <span aria-hidden="true">&laquo;</span>
                                    <span class="sr-only">Previous</span>
                                </a>
                            </li>
                            <li class="page-item"><a class="page-link" href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item">
                                <a class="page-link" href="#" aria-label="Next">
                                    <span aria-hidden="true">&raquo;</span>
                                    <span class="sr-only">Next</span>
                                </a>
                            </li> -->
                        </ul>
                    </nav>
                </div>
        </div>
    </section>
    <!-- Requests End -->

   
  
@endsection