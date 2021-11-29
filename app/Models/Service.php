<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;
    protected $table="services";
    protected $fillable = [
        'id',
        'service_id',
        
    ];
    protected $hidden=[
         'pivot'
    ];
  
   public function doctors(){
    return $this -> belongsToMany('App\Models\Doctor','doctor_service','service_id','doctor_id','id','id');
    
}

}
