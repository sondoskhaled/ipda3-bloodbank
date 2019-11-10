@extends('layouts.admin')
@inject('client','App\Models\Client')
@inject('donation','App\Models\DonationRequest')
@section('title')
Statistics
@endsection

@section('content')
        <div class="row">
          <div class="col-md-6 col-sm-6 col-12">
            <div class="info-box">
              <span class="info-box-icon bg-info"><i class="far fa-user"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Clients</span>
                <span class="info-box-number">{{$client->count()}}</span>
              </div>
              <!-- /.info-box-content -->
            </div>
          </div>
            <!-- /.info-box -->
            <div class="col-md-6 col-sm-6 col-12">
            <div class="info-box">
              <span class="info-box-icon bg-danger"><i class="fas fa-tint"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Donation Requests</span>
                <span class="info-box-number">{{$donation->count()}}</span>
              </div>
              <!-- /.info-box-content -->
            </div>
          </div>
            <!-- /.info-box -->

        </div>
@endsection
