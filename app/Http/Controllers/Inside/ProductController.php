<?php

namespace App\Http\Controllers\Inside;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

// Model
use App\Product;
use App\Category;

class ProductController extends Controller
{
	public function __construct() {}

    public function getProducts() {
        $aData = array();
    	$aProduct = Product::paginate(10); 
        if($aProduct){
            $aData['products'] = $aProduct;
        }
    	return view('cpanel.product.index', $aData);
    }

    public function getAdd() {    
        $aData = array();
        $aCategory = Category::get()->toArray();
        if($aCategory){
            $aData['category'] = $aCategory;
        }
        return view('cpanel.product.add',$aData);
    }

    public function postAdd(Request $req) {
        try {
            $data = new Product();
            if($req['name']){
                $data->product_name = $req['name'];
            }
            if($req['description']){
                $data->product_description = $req['description'];
            }
            if($req['price']){
                $data->product_price = $req['price'];
            }
            if($req['price_sales']){
                $data->product_price_sales = $req['price_sales'];
            }
            if($req['category']){
                $data->category_id = $req['category'];
            }

            // Feature image
            $feature_img = $req->file('feature_img');
            if($feature_img){ 
                $feature_img_path = $feature_img->store('uploads');
                if($feature_img_path){ 
                    // Set feature_image_id
                    $data->feature_image = $feature_img_path;
                }
            }

            // Gallery
            $galleries = $req->file('gallery');
            if($galleries){ 
                $gallery = array();
                foreach($galleries as $photo){
                    $picture = $photo->store('uploads');
                    $gallery[] = $picture; 
                }
                // Set gallery
                $data->gallery = json_encode($gallery);
            }
 
            $data->save();
            return back()->with('status_success', 'Thêm sản phẩm thành công');
        } catch (Exception $e) {
            return redirect()->route('product')->with('status_error', 'Có lỗi xảy ra');
        }
    }

    public function getEdit($id) {
        $aData = array();
        $aCategory = Category::get()->toArray();
        $aProduct = Product::where('product_id','=',$id)->first();
        if($aProduct){
            $aData['product'] = $aProduct;
            $aData['category'] = $aCategory;
        }else{
            return redirect()->route('product')->with('status_error', 'Có lỗi xảy ra');
        }
    	return view('cpanel.product.edit' , $aData);
    }

    public function postEdit(Request $req , $id) {
        try {
            $obj_product = Product::where('product_id','=' , $id);
            if($req->name){
                $data['product_name'] = $req->name;
            }
            if($req->description){
                $data['product_description'] = $req->description;
            }
            if($req->price){
                $data['product_price'] = $req->price;
            }
            if($req->price_sales){
                $data['product_price_sales'] = $req->price_sales;
            }
            if($req->category){
                $data['category_id'] = $req->category;
            }

            // Feature image
            $feature_img = $req->file('feature_img');
            if($feature_img){
                $feature_img_path = $feature_img->store('uploads');
                if($feature_img_path){ 
                    // Set feature_image_id
                    $data['feature_image'] = $feature_img_path;
                }
            }

            // Gallery
            $galleries = $req->file('gallery');
            if($galleries){ 
                $gallery = array();
                foreach($galleries as $photo){
                    $picture = $photo->store('uploads');
                    $gallery[] = $picture; 
                }
                // Set gallery
                $data['gallery'] = json_encode($gallery);
            }
            $obj_product->update($data);
            return back()->with('status_success', 'Cập nhật thành công');
        } catch (Exception $e) {
            return redirect()->route('product')->with('status_error', 'Có lỗi xảy ra');
        }
    }

    public function deleteProduct($id) {
        $aProduct = Product::where('product_id','=',$id)->first();
        if($aProduct){
            Product::where('product_id','=',$id)->delete();
            return back()->with('status_success', 'Product Deleted');
        }else{
            return back()->with('status_error', 'Có lỗi xảy ra');
        }
    }
}
