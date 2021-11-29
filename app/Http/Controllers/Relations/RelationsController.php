<?php

namespace App\Http\Controllers\Relations;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\phone;
use APP\Models;
use App\Models\Country;
use App\Models\User;
use App\Models\Doctor;
use App\Models\Hospital;
use App\Models\Patient;
use App\Models\Service;

//use APP\Models\phone;
//use App\Models\User;


class RelationsController extends Controller
{
    public function hasOneRelation(){
       
       //  $user=\App\Models\User::find(7);
      // $user=\App\Models\User::with('Phone')->find(7);
      $user=\App\Models\User::with(['Phone'=>function($q){
          $q->select('code','phone','user_id');
      }])->find(7);

        return response()->json($user);
    }

    public function hasOneRelationReverse(){
       // $phone=phone::with('user')->find(1);
       //$phone=Phone::find(1);
       //return $phone->code;
       $phone=phone::with(['user'=>function($q){
        $q->select('id','name');
       }])->find(1);
      // $phone->makeVisible(['user_id']);
       //$phone->makeHidden(['code']);
       //return $phone->user;
       return $phone;
    }

    public function getUserHasPhone(){
       return  $phone=User::WhereHas('phone')->get();
    }
    public function getUserNotHasPhone (){

        return $phone=User::WhereDoesntHave('phone')->get();
    }
    public function getUserWhereHasPhoneWithCondition(){
        return $phone=User::whereHas('phone',function($q){
            $q->where('code','963');
        })->get();
    }

    public function hospitals(){
      // $hospitals = Hospital::with('doctors');
       $hospitals = Hospital::select('id', 'name', 'address')->get();
        return view('doctors.hospitals',compact('hospitals'));

    }
    public function doctors($hospital_id){
       $hospital=Hospital::find($hospital_id);
      $doctors=$hospital->doctors;
       return view('doctors.doctors',compact(['doctors','hospital']));
    }
    public function hospitalsHasDoctor(){
     
        return $hospitals = Hospital::whereHas('doctors')->get();
    }
    public function hospitalsHasOnlyMaleDoctors(){
      return   $hospital=Hospital::with('doctors')->whereHas('doctors',function($q){
            $q->where('gender',1);
        })->get();

        
       
    }
    public function hospitals_not_has_doctors(){
        return Hospital::whereDoesntHave('doctors')->get();
    }

    public function getDoctorsService(){
         $doctor=Doctor::with('services')->find(3);
     // $doctor=Doctor::find(2);
      //return  $doctor->services;
       return $doctor->services->name;
    }
    public function getServiceDoctors(){
       return  $service=Service::with(['doctors'=> function($q){
            $q->select('name');
        }])->get();
      //  return $service->doctors;
    }
    public function getDoctorsServices($doctorId){
        $doctor=Doctor::find($doctorId);
        $services= $doctor->services;

        $doctors=Doctor::select('id','name')->get();
        $allServices=Service::select('id','name')->get();
        return view('doctors.services',compact(['services','allServices','doctors']));
    }
    public function saveServicesToDoctors(Request $request){
        $doctor=Doctor::find($request->doctor_id);
        if(! $doctor)
        return abort('404');
       // $doctor->services()->attach($request->service_id);
       $doctor ->services()-> attach($request -> servicesIds);
         //$doctor ->services()-> sync($request -> servicesIds); //update and remove old data
         $doctor->services()->syncWithoutDetaching($request->servicesIds);//update and save old data
         return 'success';
       return $request;
    }

    public function has_one_through(){
         $patient=Patient::find(1);
         return $patient->doctors;

    }
    public function  doctorsInCountry(){
         $countries=Country::find(1);

         return  $countries->doctors;
    }

}
