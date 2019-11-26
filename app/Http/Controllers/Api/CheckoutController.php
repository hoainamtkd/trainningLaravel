<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Utils\Response;

use App\Order;

class CheckoutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function checkOutOrder(Request $req)
    {
        $last_id = Order::latest()->first();
        $checkout_last = $last_id ? $last_id->id : 1; 
        $checkout = new Order();
        $checkout->order_id = date('dmyi').($checkout_last + 1);
        $checkout->name = $req->input('full_name');
        $checkout->phone = $req->input('phone');
        $address = array(
            'county' => $req->input('county'),
            'province' => $req->input('province'),
            'wards' => $req->input('wards'),
            'address' => $req->input('address')
        );
        $checkout->address = json_encode($address);
        $checkout->email = $req->input('email');
        $checkout->message = strip_tags($req->input('message')); 
        $checkout->product = json_encode($req->input('product'));
        $checkout->total_amount = $req->input('total_amount'); 
        $checkout->save();
        return Response::success($checkout , 'Đặt hàng thành công');
    }
}
