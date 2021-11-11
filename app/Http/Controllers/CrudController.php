<?php

namespace App\Http\Controllers;

use App\Events\Video as EventsVideo;
use App\Events\VideoViewer;
use App\Http\Requests\OfferRequest;
use App\Models\Offer;
use App\Models\Video;
use App\traits\OfferTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Unique;
use Illuminate\View\ViewName;
use Symfony\Contracts\Service\Attribute\Required;

class CrudController extends Controller
{
    use OfferTrait;
    public function getOffers(){
        return Offer::select('id','name')->get();
    }

    
    public function create(){
        return view('offers.create');
    }
    public function Store( OfferRequest $request/*Request $request*/ ){
        //validate data before insert database
        // $rules=$this->getRules();
        // $messages=$this->getMessage();


        // $validator=Validator::make($request->all(),$rules,$messages);

        // if($validator->fails()){
        //     //return $validator->errors();
        //     return redirect()->back()->withErrors($validator)->withInput($request->all());

           
        // }
        //save photo in folder 
       // $file_extention=$request->photo->getClientOriginalExtension();
       // $file_name=time().'.'.$file_extention;
       // $path='images/offers';
       // $request->photo->move($path,$file_name);
        //insert in database
         $folder='images/offers';
         $file_name= $this->saveImage($request->photo,$folder);
        Offer::create([
            'photo'       => $file_name,
            'name_ar'    =>  $request->name_ar,
            'name_en'    =>  $request->name_en,
            'price'      =>  $request->price,
            'details_ar' =>  $request->details_ar,
            'details_en' =>  $request->details_en
        ]);

        //return 'successful';
        return redirect()->back()->with(['successful'=>'Done']);
    }
    // protected function getMessage(){
    //     return $messages=
    //     [
    //         'name_ar.unique'     =>'الاسم مكرر',
    //         'name_ar.required'   =>'مطلوبب'
            

    //     ];

    // }

    // protected function getRules(){
    //     return $rules=
    //     [
    //         'name_ar'      =>'required|max:100|unique:offers,name_ar',
    //         'name_en'      =>'required|max:100|unique:offers,name_en',
    //         'price'     =>'required|numeric',
    //         'details_ar'   =>'required',
    //         'details_en'   =>'required'
    //     ];
    // }


    protected function getAllOffers(){
       $offers= Offer::select('id','name_ar','name_en','details_ar','details_en','price')->get();
        return view('Offers.all',compact('offers'));
      //  return $offers;

    }

    public function editOffer($offerId){

    //    $offer= Offer::find($offerId);//search in given table id only
    //    if(!$offer){
    //        return redirect()->back();
    //    }
      $offer= Offer::select('id','name_ar','name_en','price','details_ar','details_en')->find($offerId);
       return view('offers.edit',compact('offer'));
       // return $offerId;

    }
    public function UpdateOffer( OfferRequest $request,$offerId){
        //validatation
        //check if offer exisit
        $offer=Offer::select('id','name_ar','name_en','price','details_ar','details_en')->find($offerId);
        if(!$offer)
            return redirect()->back();
        //update data
        $offer->update($request ->all());
        return redirect()->back()->with(['success'=>'Successfully update']);
    }
    // protected function saveImage($photo,$folder){
    //     //save photo in folder 
    //     $file_extention=$photo->getClientOriginalExtension();
    //     $file_name=time().'.'.$file_extention;
    //     $path=$folder;
    //     $photo->move($path,$file_name);
    //     return $file_name;
    // }


    public function getVideo(){
       $video= Video::first();
       event(new VideoViewer($video));
        return view('video')->with('video',$video);
    }
}
