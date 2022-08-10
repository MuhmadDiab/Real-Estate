<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Estate;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\BaseController;
use App\Models\Like;

class Operationusercontroller extends BaseController
{
  public function listallEstate()
  {
    $estate = Estate::first();
    if(!$estate)
    {
      return $this->senderrors("not found Estates");
    }
    else
    {
        
        $estate = $estate->withcount('like','comment','view')->with('comment','photo')->get();
        return $this->sendResponse2($estate,'this is all Estates');
    }

  }
  ////////likeeeeeeeeeeeeeee
  public function like(Request $request,$estate_id)
  {
    $estate=Estate::where('id',$estate_id)->first();
    if(!$estate)
    {
     return $this->senderrors('estate not found');
    }
   $estate_like=Like::where('estate_id',$estate_id)->where('user_id',$request->user()->id)->first();
   if($estate_like)
    {
     $estate_like->delete();
     return $this->sendResponse3('your like removed');
    }
   else{
    Like::create([
      'estate_id'=>$estate_id,
      'user_id'=>$request->user()->id
    ]);
   return $this->sendResponse3('Like successfully toggled');
    }


  }
}
