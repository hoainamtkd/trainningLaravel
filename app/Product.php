<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
   	protected $table = 'tbl_product';
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'product_id',
		'product_name',
		'product_description',
		'product_price',
		'product_price_sales',
		'category_id',
		'user_id',
		'feature_image',
	];
	public $timestamps = true; 
}

