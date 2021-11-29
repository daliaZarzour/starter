@extends('layouts.app')

@section('content')
<h1 class="text-center">Services </h1>
@if(isset($services) && $services -> count() > 0 )
<table class="table">
  <thead>
    <tr>
    <th scope="col">ID</th>
    <th scope="col">Name</th>
    
    
    </tr>
  </thead>
  <tbody>
      @foreach ($services as $service )
      
    <tr >
    <td>{{$service -> id}}</td>
      <td>{{$service -> name}}</td>
     
        
     
     
    </tr>
          
    @endforeach
   @endif
   
   
  </tbody>
</table>
<form method="POST" action="{{route('save.doctors.services')}}">
                    @csrf
                    {{-- <input name="_token" value="{{csrf_token()}}"> --}}


                    <div class="form-group">
                        <label for="exampleInputEmail1">choice doctors </label>
                        <select class="form-control" name="doctor_id" >
                            @foreach($doctors as $doctor)
                                <option value="{{$doctor -> id}}">{{$doctor -> name}}</option>
                            @endforeach
                        </select>

                    </div>


                    <div class="form-group">
                        <label for="exampleInputEmail1">choce services </label>

                        <select class="form-control" name="servicesIds[]" multiple>
                            @foreach($allServices as $allService)
                                <option value="{{$allService -> id}}">{{$allService -> name}}</option>
                            @endforeach
                        </select>

                    </div>

                    <button type="submit" class="btn btn-primary">{{__('messages.Save Offer')}}</button>
                </form>





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
