<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
use App\Http\Utils\Response;

// Model
use App\Product;
use App\Category;

class ProductController extends ApiController {
    /**
    * @OA\Get(
    *   path="/api/products",
    *   tags={"product"},
    *   summary="get list product",
    *   @OA\Response(
    *     response=200,
    *     description="successfully"
    *   ),
    *   @OA\Parameter(
    *      name="page",
    *      in="query",
    *      required=false, 
    *      @OA\Schema(
    *         type="integer"
    *      )
    *    ),   
    *   @OA\Parameter(
    *      name="name",
    *      in="query",
    *      required=false,
    *      @OA\Schema(
    *         type="string"
    *      ), 
    *    ),
    *   @OA\Parameter(
    *      name="category_id",
    *      in="query",
    *      required=false,
    *      @OA\Schema(
    *         type="integer"
    *      )
    *    ),
    *   @OA\Parameter(
    *      name="price_from",
    *      in="query",
    *      required=false,
    *      @OA\Schema(
    *         type="string"
    *      )
    *    ), 
    *   @OA\Parameter(
    *      name="price_to",
    *      in="query",
    *      required=false,
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
    public function getAllProduct(Request $req) {
    	try { 
			$sQuery = Product::leftJoin('tbl_category', 'tbl_category.category_id', '=', 'tbl_product.category_id');

			$name = $req->input('name');
			if ($name) {
				$sQuery = $sQuery->where('name', 'like', "%{$name}%");
			}

			$category_id = $req->input('category_id');
			if ($category_id) {
				$sQuery = $sQuery->where('category_id', '=', $category_id);
			}

			$price_from = $req->input('price_from');
			$price_to = $req->input('price_to');
			if($price_to || $price_to){
				if($price_from && !$price_to) {
    				$sQuery = $sQuery->where('product_price_sales', '>=', $price_from);
    			} elseif (!$price_from && $price_to) {
    				$sQuery = $sQuery->where('product_price_sales', '<=', $price_to);
    			}else{
    				$sQuery = $sQuery->whereBetween('product_price_sales', array($price_from , $price_to));
    			}
			}         
			
			$paged = $req->input('page') ? $req->input('page') : 1; 
			$aProduct = $sQuery
            ->select(
                'product_id', 
                'product_name', 
                'product_description', 
                'product_short_description', 
                'product_price', 
                'product_price_sales', 
                'feature_image',
                'category_name'
            )
            ->paginate(10)
            ->withPath('api/products?page='.$paged);
			$aProductList = array();

			// Set path for feature image
			if($aProduct->count()){
				foreach ($aProduct->getCollection() as $k => $aVal) {
					$aVal->feature_image = url($aVal->feature_image);
				}
				return Response::success($aProduct);
			}
			return Response::error();
    	} catch (\Exception $e) { 
    		return Response::error($e->getMessage());
    	}
    }


    /**
    * @OA\Get(
    *   path="/api/related-products/{id}",
    *   tags={"product"},
    *   summary="get list related product",
    *   @OA\Response(
    *     response=200,
    *     description="successfully"
    *   ),
    *   @OA\Parameter(
    *      name="product_id",
    *      in="path",
    *      required=true,
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
    public function getAllRelatedProduct(Request $req , $id) {
        try { 
            $sQuery = Product::leftJoin('tbl_category', 'tbl_category.category_id', '=', 'tbl_product.category_id')->where('tbl_product.product_id','<>',$id);
            $category_id = $req->input('category_id');
            if ($category_id) {
                $sQuery = $sQuery->where('tbl_product.category_id','=', $category_id);
            }

            $aProduct = $sQuery->select(
                'product_id', 
                'product_name', 
                'product_description', 
                'product_short_description', 
                'product_price', 
                'product_price_sales', 
                'feature_image',
                'category_name'
            )
            ->paginate(4);

            $aProductList = array();
            // Set path for feature image
            if($aProduct->count()){
                foreach ($aProduct->getCollection() as $k => $aVal) {
                    $aVal->feature_image = url($aVal->feature_image);
                }
                return Response::success($aProduct);
            }
            return Response::error();
        } catch (\Exception $e) { 
            return Response::error($e->getMessage());
        }
    }

    /**
    * @OA\Get(
    *   path="/api/products/{id}",
    *   tags={"product"},
    *   summary="get product detail",
    *   @OA\Response(
    *     response=200,
    *     description="successfully"
    *   ),
    *   @OA\Parameter(
    *      name="id",
    *      in="path",
    *      required=false, 
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
    public function getProductDetail(Request $req , $id) {
    	try {
    		$aData = array();
	        $aProduct = Product::where('product_id','=',$id)->first();
            // Set url image absolute
            $aProduct->feature_image = url($aProduct->feature_image);
            if( $aProduct->gallery ){
                $aGallery = array();
                $gallerys = json_decode($aProduct->gallery);
                foreach($gallerys as $gallery){
                    $aGallery[] = url($gallery);
                }
                $aProduct->gallery = $aGallery;
            }

	        if($aProduct){
	        	return Response::success($aProduct);
	        }
	        return Response::error();
    	} catch (\Exception $e) { 
    		return Response::error($e->getMessage());
    	}
    }

}