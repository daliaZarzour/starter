<?php

namespace App\Http\Controllers;

use App\Models\Offer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Unique;
use Illuminate\View\ViewName;
use Symfony\Contracts\Service\Attribute\Required;

class CrudController extends Controller
{
    public function getOffers(){
        return Offer::select('id','name')->get();
    }

    
    public function create(){
        return view('offers.create');
    }
    public function Store(Request $request ){
        //validate data before insert database
        $rules=$this->getRules();
        $messages=$this->getMessage();


        $validator=Validator::make($request->all(),$rules,$messages);

        if($validator->fails()){
            //return $validator->errors();
            return redirect()->back()->withErrors($validator)->withInput($request->all());

           
        }

        //insert in database
        Offer::create([
            'name_ar'    => $request->name_ar,
            'name_en'    => $request->name_en,
            'price'      =>  $request->price,
            'details_ar' =>  $request->details_ar,
            'details_en' =>  $request->details_en
        ]);

        //return 'successful';
        return redirect()->back()->with(['successful'=>'Done']);
    }
    protected function getMessage(){
        return $messages=
        [
            'name_ar.unique'     =>'الاسم مكرر',
            'name_ar.required'   =>'مطلوبب'
            

        ];

    }

    protected function getRules(){
        return $rules=
        [
            'name_ar'      =>'required|max:100|unique:offers,name_ar',
            'name_en'      =>'required|max:100|unique:offers,name_en',
            'price'     =>'required|numeric',
            'details_ar'   =>'required',
            'details_en'   =>'required'
        ];
    }


    protected function getAllOffers(){
       $offers= Offer::select('id','name_ar','name_en','details_ar','details_en','price')->get();
        return view('Offers.all',compact('offers'));
      //  return $offers;

    }
}
