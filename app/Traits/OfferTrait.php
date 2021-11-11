<?php

namespace App\traits;


Trait OfferTrait
{
     function saveImage($photo,$folder){
        //save photo in folder 
        $file_extention=$photo->getClientOriginalExtension();
        $file_name=time().'.'.$file_extention;
        $path=$folder;
        $photo->move($path,$file_name);
        return $file_name;
    }
}
