<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BaseController extends Controller
{
    public function sendResponse($result,$result2,$message){
        $response=[
          'success'=>true,
          'data'=>$result,$result2,
          'massage'=>$message
        ];
        return response()->json($response,200);
    }
    public function loginAndRegisterResponse($result,$message,$token){
        $response=[
          'success'=>true,
          'data'=>$result,
          'token'=>$token,
          'massage'=>$message
        ];
        return response()->json($response,200);
    }
    public function sendResponseWithJustMessage($message){
        $response=[
          'success'=>true,
          'massage'=>$message
        ];
        return response()->json($response,200);
    }
    public function sendError($error,$errormessage=[],$code=404){
        $response=[
          'success'=>false,
          'data'=>$error,
        ];
        if(!empty($errormessage)){
            $request['data']=$errormessage;
        }
        return response()->json($response,$code);
    }


    public function senderrors($massege){

        $response=[
            'massege'=>$massege
        ];
        return response()->json($massege);
    }
    public function sendResponse2($result,$message){
        $response=[
          'success'=>true,
          'data'=>$result,
          'massage'=>$message

        ];
        return response()->json($response,200);
    }
    Public function sendResponse3($message){
        $response=[
            'success'=>true,
            'message'=>$message,
             'code'=>200,
        ];
        return response()->json($response);
    }
}
