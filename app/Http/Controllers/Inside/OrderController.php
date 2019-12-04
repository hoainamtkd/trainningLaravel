<?php

namespace App\Http\Controllers\Inside;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Order;

class OrderController extends Controller
{
    public function index(Request $req)
    {    
        $sqlOrder = new Order();
        $isSearch = $req->input('search');
        if($isSearch){
            $status = $req->input('order_status');
            if($status != 'all'){
                $sqlOrder = $sqlOrder->where(
                    'order_status',
                    '=',
                    $status
                );
            }

            $name = $req->input('name');
            if($name){
                $sqlOrder = $sqlOrder->where(
                    'name',
                    'like',
                    '%'.$name.'%'
                );
            }
        }
        $order = $sqlOrder->paginate(10);
    	$data = array(
    		'orders' => $order
     	);

    	return view('cpanel.order.index',$data);   
    }

    public function edit(Request $req , $id){
    	$order = Order::find($id);
    	$data = array(
    		'orders' => $order
     	);
    	return view('cpanel.order.edit',$data);   
    }

    public function getUpdate(Request $req , $id){
    	$order = Order::find($id);
    	$order->order_status = $req->input('order_status');
    	$order->update();
    	return redirect()->route('order');  
    }
}
