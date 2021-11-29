<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Doctor;

class Hospital extends Model
{
    use HasFactory;
    protected $table="hospitals";
    protected $fillable = [
        'id',
        'name',
        'address',
        'country_id'
    ];
    protected $hidden=[
        
    ];
   public function doctors(){
   return $this->hasMany('App\Models\Doctor','hospital_id') ;      
   }
}
