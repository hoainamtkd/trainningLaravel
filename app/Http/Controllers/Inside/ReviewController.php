<?php

namespace App\Http\Controllers\Inside;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Review;
class ReviewController extends Controller
{
    public function __construct() {} 

   	public function index() {
   		$aData = array();
   		$aReview = Review::leftJoin('tbl_product', 'tbl_product.product_id', '=', 'tbl_reviews.product_id')->paginate(10);
   		if($aReview){
   			$aData['reviews'] = $aReview;
   		}
   		return view('cpanel.review.index', $aData);
   	}

   	public function getApprove($id){
   		$aReview = Review::find($id);
        if($aReview){
            $aReview->update(array(
            	'approve_status' => 2
            ));
            return back()->with('status_success', 'Cập nhật thành công');
        }else{
            return back()->with('status_error', 'Có lỗi xảy ra');
        }
   	}

   	public function getUnApprove($id){
   		$aReview = Review::find($id);
        if($aReview){
            $aReview->update(array(
            	'approve_status' => 1
            ));
            return back()->with('status_success', 'Cập nhật thành công');
        }else{
            return back()->with('status_error', 'Có lỗi xảy ra');
        }
   	}


   	public function delete($id){
   		$aReview = Review::find($id);
        if($aReview){
            $aReview->delete();
            return back()->with('status_success', 'Xóa thành công');
        }else{
            return back()->with('status_error', 'Có lỗi xảy ra');
        }
   	}
}
