<?php

namespace App\Http\Controllers;

use App\Models\Offer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Unique;
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
            'name'    => $request->name,
            'price'   =>  $request->price,
            'details' =>  $request->details
        ]);

        //return 'successful';
        return redirect()->back()->with(['successful'=>'Done']);
    }
    protected function getMessage(){
        return $messages=
        [
            'name.unique'     =>'الاسم مكرر',
            'name.required'   =>'مطلوبب'

        ];

    }

    protected function getRules(){
        return $rules=
        [
            'name'      =>'required|max:100|unique:offers,name',
            'price'     =>'required|numeric',
            'details'   =>'required'
        ];
    }
}
