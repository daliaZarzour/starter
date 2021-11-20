<?php

namespace App\Http\Controllers\Relations;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use APP\Models;
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
}
