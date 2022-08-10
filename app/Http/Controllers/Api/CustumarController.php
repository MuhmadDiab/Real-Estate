<?php

namespace App\Http\Controllers\Api;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Api\BaseController;
use App\Models\User;

class CustumarController extends BaseController
{
    // REGISTER API
    public function registeruser(Request $request)
    {
        // validation
        $validator = Validator::make($request->all(),
        [
            'name'=>'required',
            'email'=>'required|email',
            'password'=>'required',
        ]);
        if($validator->fails())
        {
            return $this->sendError('Please validate error',$validator->errors()->toArray());
        }
        $user_check = User::where("email", "=", $request->email)->first();
        if(isset($user_check->id))
        {
            return $this->sendError('this email is already in use');
        }
        $photo=$request->photo;
        $path = '' ;
        if($photo != null)
        {
            $newphoto=time().$photo->getClientOriginalName();
            $photo->move(public_path('upload'),$newphoto);
            $path = "public/upload/$newphoto";
        }

        // create data
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->role = "user";
        $user->phone_no = isset($request->phone_no) ? $request->phone_no : "";
        $user->photo=$path;
        $user->save();
        $token = $user->createToken("auth_token")->plainTextToken;
        // send response
        return $this->loginAndRegisterResponse($user,'User registered successfully',$token);
    }
    public function registermanjer(Request $request)
    {
        // validation
        $validator = Validator::make($request->all(),
        [
            'name'=>'required',
            'email'=>'required|email',
            'password'=>'required',
        ]);
        if($validator->fails())
        {
            return $this->sendError('Please validate error',$validator->errors()->toArray());
        }
        $user_check = User::where("email", "=", $request->email)->first();
        if(isset($user_check->id))
        {
            return $this->sendError('this email is already in use');
        }
        $photo=$request->photo;
        $path = '' ;
        if($photo != null)
        {
            $newphoto=time().$photo->getClientOriginalName();
            $photo->move(public_path('upload'),$newphoto);
            $path = "public/upload/$newphoto";
        }
        // create data
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->role = "manger";
        $user->phone_no = isset($request->phone_no) ? $request->phone_no : "";
        $user->photo=$path;
        $user->save();
        $token = $user->createToken("auth_token")->plainTextToken;
        // send response
        return $this->loginAndRegisterResponse($user,'User registered successfully',$token);
    }

    // LOGIN API
    public function login(Request $request)
    {
        // validation
        $request->validate
        ([
            "email" => "required|email",
            "password" => "required"
        ]);
        // check student
        $user = User::where("email", "=", $request->email)->first();
        if(isset($user->id))
        {
            if(Hash::check($request->password, $user->password))
            {
                // create a token
                $token = $user->createToken("auth_token")->plainTextToken;
                /// send a response
                return $this->loginAndRegisterResponse($user,'User login successfully',$token);
            }
        }
        else
        {
            return $this->sendError('please  check your Auth',['error'=>'Unauthorised']);
        }
    }
    // PROFILE API
    public function profile()
    {
        return $this->sendResponse2(auth()->user(),'this is user profile');
    }
    /////////////auth()->user()
    // LOGOUT API
    public function logout()
    {
        auth()->user()->tokens()->delete();
        return $this->sendResponseWithJustMessage('the user logged out');
    }
}
