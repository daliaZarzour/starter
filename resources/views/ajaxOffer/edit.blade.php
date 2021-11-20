@extends('layouts.app')

@section('content')

<div class="flex-center position-ref full-height"></div>
<meta name="csrf-token" content="{{ csrf_token() }}">
<div class="container">
    <h2>Edit your Offer</h2>
<div class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center py-4 sm:pt-0">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
           
            <div class="alert alert-success" id="success-msg" style="display: none;" >
                Done
            </div>

            <form method="POST" id="offerFormUpdate" action="" enctype="multipart/form-data">
                    @csrf
                    {{-- <input name="_token" value="{{csrf_token()}}"> --}}


                <div class="form-group">
                    <label for="exampleInputEmail1">UPLOAD IMAGE</label>
                    <input type="file" class="form-control" value="{{$offer -> photo}}" id="photo" name="photo" placeholder="photo">
                    @error('photo')
                    <div class="alert alert-danger" role="alert">
                        {{$message}}
                    </div>
                        
                    @enderror
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">{{__('messages.name_ar')}}</label>
                    <input type="text" class="form-control" id="name_ar"  value="{{$offer -> name_ar}}" name="name_ar" placeholder="{{__('messages.name_ar')}}">
                    @error('name_ar')
                    <div class="alert alert-danger" role="alert">
                        {{$message}}
                    </div>
                        
                    @enderror
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">{{__('messages.name_en')}}</label>
                    <input type="text"  value="{{$offer -> name_en}}" class="form-control" id="name_en" name="name_en" placeholder="{{__('messages.name_en')}}">
                    @error('name_en')
                    <div class="alert alert-danger" role="alert">
                        {{$message}}
                    </div>
                        
                    @enderror
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">price</label>
                    <input type="text" class="form-control"  value="{{$offer -> price}}" id="price"name="price"  placeholder="price">
                    @error('price')
                    <div class="alert alert-danger" role="alert">
                        {{$message}}
                    </div>
                        
                    @enderror
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">{{__('messages.details_en')}}</label>
                    <input type="text" class="form-control" id="details_en"name="details_en"  value="{{$offer -> details_en}}" placeholder="{{__('messages.details_en')}}">
                    @error('details_en')
                    <div class="alert alert-danger" role="alert">
                        {{$message}}
                    </div>
                        
                    @enderror
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">{{__('messages.details_ar')}}</label>
                    <input type="text"  value="{{$offer -> details_ar}}"class="form-control" id="details_ar"name="details_ar"  placeholder="{{__('messages.details_ar')}}">
                    @error('details_ar')
                    <div class="alert alert-danger" role="alert">
                        {{$message}}
                    </div>
                        
                    @enderror
                </div>
                <input type="text" style="display: none;" class="form-control" value="{{$offer -> id}}" name="offer_id">
                <button id="update_offer"type="" class="btn btn-primary">Save</button>
            </form>




        </div>
    </div>


</div>
@stop

@section('script')
<script>
    $(document).on('click','#update_offer', function (e) {
        e.preventDefault();
      //  var formData = new FormData($('#offerform')[0]);
        var formData = new FormData($('#offerFormUpdate')[0]);
        $.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});
        $.ajax({ 
        type:'post',
        url:"{{Route('ajax.offers.update')}}",
       // data:{
           // '_token':"{{csrf_token()}}",
            // 'name_ar':$("input[name='name_ar']").val(),
            // 'name_en':$("input[name='name_en']").val(),
            // 'price':$("input[name='price']").val(),
            // 'details_ar':$("input[name='details_ar']").val(),
            // 'details_en':$("input[name='details_en']").val(),
            
       // },
    
        data: formData,
        processData: false,
        contentType: false,
        cache: false,
        enctype: 'multipart/form-data',
        success:function(data){
            if(data.status==true){
                $('#success-msg').show();
            }

        },
        error:function(reject){

        },

    });

    });
    
</script>
@stop