@extends('layouts.app')

@section('content')
<h1 class="text-center">Hospitals</h1>
@if(isset($hospitals) && $hospitals -> count() > 0 )
<table class="table">
  <thead>
    <tr>
    <th scope="col">ID</th>
    <th scope="col">Name</th>
    <th scope="col">Address</th>
    <th scope="col">Details</th>  
    </tr>
  </thead>
  <tbody>
      @foreach ($hospitals as $hospital )
      
    <tr >
    <td>{{$hospital -> id}}</td>
      <td>{{$hospital -> name}}</td>
      <td>{{$hospital -> address}}</td>
      <td><a class="btn btn-success" href="{{route('hospital.doctors',$hospital -> id)}}">show Doctors</a></td>
        
     
     
    </tr>
          
    @endforeach
    @endif
   
   
  </tbody>
</table>
@stop
@section('script')
<script>

//$(document).on('click','.delete_btn',function(e){
//$(document).on('click', '.delete_btn', function(e) {  
 // e.preventDefault();
$(document).on('click','.delete_btn', function (e) {
        e.preventDefault();  
  $offer_id=$(this).attr('offer_id')
  $.ajax({
    
    type: 'post',
    url: "{{route('ajax.offers.delete')}}",
    data: {
      _token:"{{csrf_token()}}",
       id   :$offer_id,
    },
    success: function(data){
      if(data.status==true){

        $('#success_msg').show();
        $('.offerrow-'+data.id).remove();
      }

    },
    error: function(reject){

    }

  });

});
  
</script>
@stop
