<?php

namespace App\Http\Controllers\Admin;


use Illuminate\Routing\Controller as Controller;

class SecondController extends Controller
{
    public function __construct(){
        $this->middleware('auth')->except('getString1','getIndex');
    }
    public function getString(){
        return 'string';
    }
    public function getString1(){
        return 'string1';
    }
    public function getIndex(){
       // return view('welcome');
    //    $data=[];
    //    $data['id']=5;
    //    $data['age']=33;
    //    $data['name']='dalia';
    //    return view('welcome',$data);
       //$obj=new stdClass();
       $obj= new \stdClass();
       $obj->name='dalia';
       $obj->age=32;
       $obj->num=33333;
       return view('welcome',compact('obj'));
      
    }
    
    
    
}

