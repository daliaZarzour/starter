<?php
use App\Http\Controllers\Front\UserController;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;
use App\Http\Controllers\Admin\SecondController;
use App\Http\Controllers\Auth\CustomAuthController;
use App\Http\Controllers\CrudController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\OfferController;
use App\Http\Controllers\Relations\RelationsController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
   // return view('welcome');
   // return view('welcome')->with(['data'=>2,'string'=>'dalia']);
    $data=[];
    // $data['id']=5;
    // $data['age']=33;
    // $data['name']='dalia';
     return view('welcome',$data);
});
Route::get('/notAdult',function(){
    return 'welcome you are not allowed';

})->name('notAdult');
Route::get('/test2/{id}',function($id){
    return $id;
})->name('b');

Route::get('/test3/{id?}',function(){
    return 'wel';
});


Route::namespace('Front')->group(function(){
    //al route all access to controller ot  methods in folder name Front
  //  Route::get('users','UserController@showAdminName');
      Route::get('users',[UserController::class, 'showAdminName'])->middleware('auth');

});

Route::group(['middleware'=>'auth'],function(){
    Route::get('users',[UserController::class, 'showAdminName'])->middleware('auth');
});

Route::get('login',function(){
return 'you must login first';
})->name('login');

// Route::prefix('users')->group(function(){
//     Route::get('/',function(){
//         return 'user work'   ;
//     }
     
//     );
// });


// Route::group(['prefix'=>'users'],function(){
//     route::get('/',function(){
//         return 'ffffffffffffffff';
//     });
// });




//Route::get('second',[SecondController::class, 'getString']);

Route::group(['namespace'=>'Admin'],function(){
    Route::get('second',[SecondController::class,'getString']);
    Route::get('second1',[SecondController::class,'getString1']);

});

Route::resource('news',NewsController::class);

Route::group(['namespace=>Admin'],function(){
    Route::get('index',[SecondController::class,'getIndex']);
});



Route::get('landing',function(){
 return view('landing');
});

Route::get('about',function(){
    return view('about');
   });
Auth::routes(['verify'=>true]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('verified');



Route::get('redirect/{service}',[App\Http\Controllers\SocialController::class,'redirect']);

Route::get('callback/{service}',[SocialController::class,'callback']);

Route::get('fillable',[CrudController::class,'getOffers']);


Route::group(['prefix' => LaravelLocalization::setLocale(), 'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']], function () {


Route::group(['prefix' =>'offers'],function(){
   // Route::get('store',[CrudController::class,'store']);

   

 
   Route::get('create',[CrudController::class,'create']);
   Route::post('store',[CrudController::class,'store'])->name('offers.store');


   Route::get('edit/{offerId}',[CrudController::class,'editOffer']);
   Route::post('update/{offerId}',[CrudController::class,'UpdateOffer'])->name('offers.update');
   Route::get('all',[CrudController::class,'getAllOffers'])->name('offers.all');

   Route::get('delete/{offerId}',[CrudController::class,'deleteOffer'])->name('offers.delete');

  
});

   
Route::get('youtube',[CrudController::class,'getVideo']);
});


###########################begining ajax######################333
Route::group(['prefix'=>'ajax-offers'],function(){
//  Route::get('all',[OfferController::class,'all'])->name('ajax.offers.all');
    Route::get('create',[OfferController::class,'create']);
    Route::post('store',[OfferController::class,'store'])->name('ajax.offers.store');
    Route::get('all',[OfferController::class,'all']);
    Route::post('delete',[OfferController::class,'delete'])->name('ajax.offers.delete');
    Route::get('edit/{offer_id}',[OfferController::class,'edit'])->name('ajax.offers.edit');
    
    Route::post('update',[OfferController::class,'Update'])->name('ajax.offers.update');
    
   
   

});
###########################begining auth and guards###########################
Route::group(['middleware'=>'CheckAge','namespace'=>'Auth'],function(){
    Route::get('adults',[CustomAuthController::class,'adult'])->middleware('auth')->name('adult');
    Route::get('site',[CustomAuthController::class],'site')->middleware('auth:web');
    Route::get('admin',[CustomAuthController::class],'admin')->middleware('auth:admin');

   
});

###########Grud################################
Route::get('admin/login', [CustomAuthController::class,'adminLogin'])-> name('admin.login');
Route::post('admin/login', [CustomAuthController::class,'checkAdminLogin'])-> name('save.admin.login');




##########################Relations########################
Route::get('has-one',[RelationsController::class,'hasOneRelation']);