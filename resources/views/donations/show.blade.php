@extends('layouts.admin')

@section('title')
donation request
@endsection

@section('content')
<div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
       
                <h3 class="card-title">Donation Request</h3>
                
               
         </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover">
                  <tbody>
                    <tr>
                       <td>client Name</td>
                       <td>{{$record->client->name}}</td>
                    </tr>
                    <tr>
                       <td>Patient Name</td>
                       <td>{{$record->patient_name}}</td>
                    </tr>
                    <tr>
                        <td>Patient Phone</td>
                        <td>{{$record->patient_phone}}</td>
                    </tr>
                    <tr>
                        <td>Patient age</td>
                        <td>{{$record->patient_age}}</td>
                    </tr>
                    <tr>
                        <td>city</td>
                        <td>{{$record->city->name}}</td>
                    </tr>
                    <tr>
                        <td>Hospital Name</td>
                        <td>{{$record->hospital_name}}</td>
                    </tr>
                    <tr>
                        <td>Hospital address</td>
                        <td>{{$record->hospital_address}}</td>
                    </tr>
                    <tr>
                        <td>Hospital location</td>
                        <td><div id="googleMap" style="width:100%;height:400px;"></div></td>
                    </tr>
                    <tr>
                        <td>Blood Type</td>
                        <td>{{$record->bloodType->name}}</td>
                    </tr>
                    <tr>
                        <td>Number of bags</td>
                        <td>{{$record->bags_num}}</td>
                    </tr>
                    <tr>
                        <td>Details</td>
                        <td>{{$record->details}}</td>
                    </tr>
                    
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        
        
        </div>
        

<script>
function myMap() {
var mapProp= {
  center:new google.maps.LatLng({{$record->lat}},{{$record->lng}}),
  zoom:5,
};
var map = new google.maps.Map(document.getElementById("googleMap"),mapProp);
}
</script>

<script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY&callback=myMap"></script>

@endsection
