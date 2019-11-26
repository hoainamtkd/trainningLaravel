<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Utils\Response;

use App\Order;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getOrderbyId(Request $req , $id)
    { 
        $order = Order::where( 'order_id','=',$id)->first(); 
        return Response::success($order);
    }
}
