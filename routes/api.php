<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CustumarController;
use App\Http\Controllers\Api\EstateController;
use App\Http\Controllers\Api\Operationusercontroller;
use App\Http\Controllers\Api\Commentcontroller;
use App\Http\Middleware\CheckManager;
use App\Http\Middleware\CheckAdmin;
use App\Http\Middleware\CheckUser;
use App\Http\Controllers\Api\AdminController;




Route::post("/registeruser", [CustumarController::class, "registeruser"]);
Route::post("/registermanjer", [CustumarController::class, "registermanjer"]);
Route::post("/login", [CustumarController::class, "login"]);

Route::group(["middleware" => ["auth:sanctum"]], function(){
    Route::group(["middleware" => ["checkAdmin"]], function(){

    });
    Route::group(["middleware" => ["checkUser"]], function(){
        Route::get("/listEstates",[Operationusercontroller::class,"listallEstate"]);
        Route::post("/likeEstates/{id}",[Operationusercontroller::class,"like"]);
        Route::post("/createcomment/{id}",[Commentcontroller::class,"createcomment"]);
        Route::get("/getcomment/{id}",[Commentcontroller::class,"getcomments"]);
        Route::get("/viewestate/{id}",[Commentcontroller::class,"view"]);
        Route::get("/search", [Commentcontroller::class, "searsh"]);;
        Route::get("/searchestatebyprice/{min}/{max}",[Commentcontroller::class, "foundEstatebyprice"]);
        Route::get("/searchestateonmap/{lan1}/{lat1}/{lan2}/{lat2}/{lan3}/{lat3}/{lan4}/{lat4}",
        [Commentcontroller::class, "foundEstateonmap"]);

    });

    Route::group(["middleware" => ["checkManager"]], function(){
        Route::post("/addphoto", [EstateController::class, "Addphoto"]);
        Route::get("/getallEstate's/{id}", [EstateController::class, "getEstate"]);
        Route::post("/creatEstate", [EstateController::class, "createEstate"]);
        Route::post("/updateEstate/{id}", [EstateController::class, "updateEstate"]);
        Route::delete("/deleteEstate/{id}", [EstateController::class, "deletEstate"]);
    });
    Route::get("/profile", [CustumarController::class, "profile"]);
    Route::get("/logout", [CustumarController::class, "logout"]);
});
