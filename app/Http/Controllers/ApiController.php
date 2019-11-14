<?php
namespace App\Http\Controllers;
use App\Http\Utils\Response;
use Tymon\JWTAuth\Facades\JWTAuth;

/**
* @OA\Info(
*      description="",
*      version="1.0.0",
*      title="API Controller",
* )
* @OA\SecurityScheme(
*    securityScheme="bearerAuth",
*    type="http",
*    scheme="bearer",
*    bearerFormat="JWT"
* )
*/

class ApiController extends Controller
{

    function authenticate()  {
        $user = JWTAuth::parseToken()->authenticate();
        if($user)
        {
            if($user->status == 3)
            {
                echo Response::not_permission("account is banned")->content();
                exit();
            }
        }

        return $user;
    }

}