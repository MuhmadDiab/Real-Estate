<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Api\BaseController;
use App\Http\Middleware\CheckRole;
use App\Models\Estate;
use App\Models\User;
use App\Models\Photo;
use App\Models\Image;
use GuzzleHttp\Middleware;
use Illuminate\Http\Request;
use Illuminate\Routing\Console\MiddlewareMakeCommand;
use Illuminate\Support\Facades\Validator;
class EstateController extends BaseController
{
  /**
  *
  *
  * @return void
  */
 public function __construct()
  {
    $this->middleware(['auth:sanctum']);
  }
 public function createEstate(Request $request)
  {
    //validation
    $validator = Validator::make($request->all(),
    [
      'name'=>'required',
      'description'=>'required',
      'roomnumber'=>'required',
      'state'=>'required',
      'price'=>'required',
      'local'=>'required',
      'lan'=>'required',
      'lat'=>'required',
      'bathroomnumber'=>'required',
      'bedroomnumber'=>'required',
      'propartytype'=>'required',
    ]);
    if($validator->fails())
    {
      return $this->sendError('Please validate error',$validator->errors);
    }
    $user_id= $request->user()->id;
    $Estate = new Estate();
    $Estate->name = $request->name;
    $Estate->description = $request->description;
    $Estate->roomnumber = $request->roomnumber;
    $Estate->state = $request->state;
    $Estate->price = $request->price;
    $Estate->local = $request->local;
    $Estate->lan = $request->lan;
    $Estate->lat = $request->lat;
    $Estate->bathroomnumber = $request->bathroomnumber;
    $Estate->bedroomnumber = $request->bedroomnumber;
    $Estate->propartytype = $request->propartytype;
    $Estate->user_id = $user_id ;
    $Estate->save();
    $photo= new Photo();
    $photo->photo= $request->photo;
    $photo->estate_id= $Estate->id;
    $photo->save();
    return $this->sendResponse2($Estate,'the Estate created succeflly');
  }
  public function updateEstate(Request $request ,$id)
  {
    $validator = Validator::make($request->all(),
    [
      'name'=>'required',
      'description'=>'required',
      'state'=>'required',
      'price'=>'required',
    ]);
    if($validator->fails())
    {
      return $this->sendError('Please validate error',$validator->errors);
    }
    $estate =Estate::where('id',$id)->first();
    $estate->update(
    [
      'name'=>$request->name,
      'description'=>$request->description,
      'state'=>$request->state,
      'price'=>$request->price,
    ]);
    return $this->sendResponse2($estate,'the Estate created succeflly');
  }

  public function deletEstate($id)
  {
    $estate =Estate::find($id);
    if(!$estate)
    {
     return $this->senderrors('the Estate not found');
    }
    $estate->delete();
   return $this->sendResponse2($estate , 'the Estate deleted succeflly');
  }

  public function Addphoto (Request $request)
  {
    $validator = Validator::make($request->all(),
    [
      'imag'=>'required',
    ]);
    // $images = $request->list_images;
    // $input = [];
    // $i1 = 0; $i2 = 0;
    // foreach($images as $image2) {
    //     $image1 = $image2['image'];
    //     $image_name = time().$image1->getClientOriginalName();
    //     $image1->move(public_path('upload'),$image_name);
    //     $path = "public/upload/$image_name";
    //     $input[$i1] = $path;
    //     $i1++;
    // }
//    return $input;
  //  return "OK";
    if($validator->fails())
    {
      return $this->sendError('Please validate error',$validator->errors);
    }
    $photo= $request->imag;
    $newphoto=time().$photo->getClientOriginalName();
    $photo->move(public_path('upload'),$newphoto);
    $path = "public/upload/$newphoto";
    $photo = Image::create
    ([
      'imag' => $path,
    ]);
    return $this->sendResponse2($photo,'this is all estate');
  }
  public function getEstate(Request $request , $id)
  {
    $user = Estate::where('user_id',$id)->first();
    if(!$user)
    {
        return $this->senderrors('masseg fulse');
    }
    else
    {
        $user = $user->withcount('like','view','comment')->with('photo')->get();
        return $this->sendResponse2($user,'this is all estate');
    }
  }
}
