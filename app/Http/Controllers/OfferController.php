<?php

namespace App\Http\Controllers;

use App\Http\Requests\OfferRequest;
use App\Models\Offer;
use App\traits\OfferTrait;
use Facade\FlareClient\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Unique;
use Illuminate\View\ViewName;
use Symfony\Contracts\Service\Attribute\Required;

class OfferController extends Controller
{
    use OfferTrait;
   
    public function create(){
        return view('ajaxOffer.create');
    }

//     public function store(OfferRequest $request){
//      //   $folder='images/offers';
//      //   $file_name=$this->saveImage($request->photo,$folder);
//         Offer::create([
//        //     'photo'       => $file_name,
//             'name_ar'    =>  $request->name_ar,
//             'name_en'    =>  $request->name_en,
//             'price'      =>  $request->price,
//             'details_ar' =>  $request->details_ar,
//             'details_en' =>  $request->details_en

//         ]);
//          return redirect()->back()->with(['successful'=>'Done']);
        
//     }
//
public function store(OfferRequest $request)
{
    //save offer into DB using AJAX

    $file_name = $this->saveImage($request->photo, 'images/offers');
    //insert  table offers in database
    $offer = Offer::create([
       'photo' => $file_name,
        'name_ar' => $request->name_ar,
        'name_en' => $request->name_en,
        'price' => $request->price,
        'details_ar' => $request->details_ar,
        'details_en' => $request->details_en,

    ]);
    if($offer)
    return Response()->json([
        'status'  =>true,
        'msg'     =>'success'
    ]);
    else
    return Response()->json([
        'status'  =>false,
        'msg'     =>'faild'
    ]);
}

public function all(){
   $offers= Offer::select('id','name_ar','name_en','details_ar','details_en','price')->get();
    return view('ajaxOffer.all',compact('offers'));
    return $offers;
 }
 public function delete(Request $request){
    // return $request;
    $offer=Offer::find($request->id);

    if(!$offer)
    return redirect()->back()->with(['error'=>'not found']);
    $offer->delete();
    return response()->json([
        'status' => true,
        'msg'    =>'delete',
        'id'     =>$request->id
    ]);
   
 }
 public function edit (Request $request){
     $offer=Offer::find($request->offer_id);
     if(!$offer)
     return response()->json([
        'status' =>false,
        'msg'    =>'it is not  exist'
     ]);

     $offer=Offer::select('id','name_ar','name_en','details_ar','details_en','photo','price')->find($request->offer_id);
     return view('ajaxOffer.edit',compact('offer'));

 }
public function update (Request $request){
    //return $request;
    $offer=Offer::find($request->offer_id);
    if(!$offer)
    return response()->json([
        'status' => false,
        'msg' => 'هذ العرض غير موجود',
    ]

    );

    $offer->update($request->all());
    
    return response()->json([
        'status' => true,
        'msg' => 'تم  التحديث بنجاح',
    ]);
     
 }

 
}
