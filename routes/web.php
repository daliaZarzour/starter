<?php
use App\Http\Controllers\Front\UserController;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;
use App\Http\Controllers\Admin\SecondController;
use App\Http\Controllers\NewsController; 


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
Route::get('/test1',function(){
    return 'welcome';

})->name('a');
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