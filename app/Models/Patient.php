<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;
    protected $table="patients";
    protected $fillable = [
        'id',
        'name',
        'age'
    ];


    public function doctors(){
      //  return $this->hasOneThrough('APP\Models\Doctor','APP\Models\Medical','patient_id','medical_id','id','id');

        return $this -> hasOneThrough('App\Models\Doctor','App\Models\Medical','patient_id','medical_id','id','id');
    }
    
}
