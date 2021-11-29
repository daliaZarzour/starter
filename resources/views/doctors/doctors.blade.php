@extends('layouts.app')

@section('content')
<h1 class="text-center">Doctors in hospital {{$hospital->name}} </h1>
@if(isset($doctors) && $doctors -> count() > 0 )
<table class="table">
  <thead>
    <tr>
    <th scope="col">ID</th>
    <th scope="col">Name</th>
    <th scope="col">Gender</th>
    <th scope="col">Operations</th>
    
    </tr>
  </thead>
  <tbody>
      @foreach ($doctors as $doctor )
      
    <tr >
    <td>{{$doctor -> id}}</td>
      <td>{{$doctor -> name}}</td>
      <td>{{$doctor -> gender}}</td>
      <td> <a href="{{route('doctors.services',$doctor -> id)}}" class="btn btn-success">Services</a></td>
     
        
     
     
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
