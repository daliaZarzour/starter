@extends('layouts.app')

@section('content')
<div class="alert alert-success" style="display:none" class="success_msg">Done</div>
<table class="table">
  <thead>
    <tr>
    <th scope="col">ID</th>
      <th scope="col">{{__('messages.name_ar')}}</th>
      <th scope="col">{{__('messages.name_en')}}</th>
      <th scope="col">{{__('price')}}</th>
      <th scope="col">{{__('messages.details_ar')}}</th>
      <th scope="col">{{__('messages.details_en')}}</th>
      
      
      
    </tr>
  </thead>
  <tbody>
        @foreach ($offers as $offer) 
      <tr class="offerrow-{{$offer->id}}">
      <td>{{$offer->id}}</td>
      <td>{{$offer->name_ar}}</td>
      <td>{{$offer->name_en}}</td>
      <td>{{$offer->price}}</td>
      <td>{{$offer->details_ar}}</td>
      <td>{{$offer->details_en}}</td>
      <td><img src="" width="100px" height="100px"></td>
      
      <td><a href="{{route('ajax.offers.edit',$offer->id)}}"  class="btn btn-success">{{__('messages.update')}}</a></td>
      <!--td><a href="{{url('offers/delete/'.$offer->id)}}"  class="btn btn-danger">Delete</a></td-->
      <td><a href="" offer_id="{{$offer -> id}}"  class="delete_btn btn btn-danger">Delete ajax</a></td>
      
    </tr>
          
       @endforeach 
   
   
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
