<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\ApiController; 
use App\Http\Utils\Response;

use App\Slider;

class SliderController extends ApiController
{
    /**
    * @OA\Get(
    *   path="/api/slider",
    *   tags={"slider"},
    *   summary="get list slider",
    *   @OA\Response(
    *     response=200,
    *     description="successfully"
    *   ),
    *   @OA\Parameter(
    *      name="position",
    *      in="path",
    *      required=true,
    *      description="1: Banner Large , 2: Banner Small",
    *      @OA\Schema(
    *         type="integer"
    *      )
    *    ),   
    *   @OA\Response(
    *     response="404",
    *     description="not found"
    *   ),
    *   @OA\Response(
    *     response="403",
    *     description="access denied"
    *   ),
    *   @OA\Response(
    *     response="409",
    *     description="exists"
    *   ),
    *   @OA\Response(
    *     response="500",
    *     description="error"
    *   )
    * )
    */
    public function getSliderbyPosition(Request $req)
    {
        try {
            $position = $req->position;
            if($position){
                $sliders = Slider::where('position' , '=' , $position)->get();
                if($sliders){
                    foreach ($sliders as $val) {
                        $val->slider = url($val->slider);
                    }
                    return Response::success($sliders);
                }
            }
            return Response::error();
        } catch (Exception $e) {
            return Response::error();
        }
    }
}
