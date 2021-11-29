<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use APP\Models\Hospital;

class Doctor extends Model
{
    use HasFactory;
    protected $table="doctors";
    protected $fillable = [
        'id',
        'name',
        'address',
        'gender',
        'medical_id'
    ];
    protected $hidden=[
        'hospital_id', 'pivot'
    ];

    public function hospitals(){
       // $this->belongsTo('App\Models\Hospital'::class);
        return $this -> belongsTo('App\Models\Hospital','hospital_id','id');
    }
   
    public function services(){
        return $this -> belongsToMany('App\Models\Service','doctor_service','doctor_id','service_id','id','id');
    }
    
       
}
